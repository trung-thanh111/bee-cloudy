<?php

namespace App\Services;

use App\Models\Promotion;
use App\Models\UserVoucher;
use App\Models\PromotionProductVariant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromotionService
{
    public function getAllPromotions()
    {
        return Promotion::all();
    }

    public function createPromotion(Request $request)
    {
        // Xác thực dữ liệu
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount' => $request->apply_for === 'freeship' ? 'nullable' : 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'apply_for' => 'required|in:specific_products,freeship,all',
            'status' => 'required|in:active,inactive',
            'product_id' => 'nullable|exists:products,id',
            'description' => 'nullable|string',
        ]);

        $code = strtoupper(Str::random(6));
        $discount = $data['apply_for'] === 'freeship' ? 0 : $data['discount'];

        $promotion = Promotion::create([
            'name' => $data['name'],
            'code' => $code,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'discount' => $discount,
            'description' => $data['description'] ?? '',
            'minimum_amount' => $data['minimum_amount'] ?? null,
            'usage_limit' => $data['usage_limit'] ?? null,
            'apply_for' => $data['apply_for'],
            'status' => $data['status'],
        ]);

        if ($data['apply_for'] === 'specific_products') {
            PromotionProductVariant::create([
                'promotion_id' => $promotion->id,
                'product_id' => $data['product_id'],
                'discount' => $discount,
            ]);
        }

        return $promotion;
    }

    public function updatePromotion(Promotion $promotion, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:promotions,code,' . $promotion->id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount' => 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'apply_for' => 'required|in:specific_products,freeship,all',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        $promotion->update([
            'name' => $data['name'],
            'code' => $data['code'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'discount' => $data['discount'],
            'minimum_amount' => $data['minimum_amount'] ?? null,
            'usage_limit' => $data['usage_limit'] ?? null,
            'apply_for' => $data['apply_for'],
            'status' => $data['status'],
            'description' => $data['description'] ?? '',
        ]);

        if ($data['apply_for'] === 'specific_products') {
            PromotionProductVariant::updateOrCreate(
                ['promotion_id' => $promotion->id],
                [
                    'product_id' => $data['product_id'],
                    'discount' => $data['discount'],
                ]
            );
        } else {
            PromotionProductVariant::where('promotion_id', $promotion->id)->delete();
        }

        return $promotion;
    }

    public function deletePromotion($id)
    {
        $promotion = Promotion::findOrFail($id);
        return $promotion->delete();
    }

    public function receivePromotion(Promotion $promotion)
    {
        $user = Auth::user();

        if ($promotion->usage_limit <= 0) {
            return 'Voucher đã hết.';
        }

        $existingVoucher = UserVoucher::where('user_id', $user->id)
            ->where('promotion_id', $promotion->id)
            ->first();

        if ($existingVoucher) {
            return 'Bạn đã nhận voucher này rồi.';
        }

        $promotion->decrement('usage_limit');

        UserVoucher::create([
            'user_id' => $user->id,
            'promotion_id' => $promotion->id,
            'code' => $promotion->code,
            'received_at' => now(),
        ]);

        return 'Voucher nhận thành công';
    }

    public function getUserPromotions($userId)
    {
        return UserVoucher::where('user_id', $userId)->get();
    }

    public function getPromotionWithProducts($id)
    {
        return Promotion::with('products')->findOrFail($id);
    }

    public function bulkDeletePromotions(array $ids)
    {
        Promotion::whereIn('id', $ids)->delete();
    }
}
