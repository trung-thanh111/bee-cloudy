<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Promotion;
use App\Models\UserVoucher;
use App\Models\PromotionProductVariant;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PromotionService
{
    public function getFilteredPromotions(array $filters)
    {
        $query = Promotion::query();

        if (!empty($filters['keyword'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('id', 'like', '%' . $filters['keyword'] . '%')
                  ->orWhere('name', 'like', '%' . $filters['keyword'] . '%');
            });
        }

        if (isset($filters['publish'])) {
            $query->where('status', $filters['publish']);
        }

        $perPage = $filters['perpage'] ?? 10;
        return $query->paginate($perPage);
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function createPromotion(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'required|string|max:255',
            'discount' => 'required_unless:apply_for,freeship|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'apply_for' => 'required|in:specific_products,freeship,all',
            'status' => 'required|in:active,inactive',
            'product_id' => 'required_if:apply_for,specific_products|exists:products,id|not_in:null',
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        $code = strtoupper(Str::random(6));
        $discount = $data['apply_for'] === 'freeship' ? 0 : $data['discount'];

        $promotion = Promotion::create([
            'name' => $data['name'],
            'code' => $code,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'discount' => $discount,
            'description' => $data['description'],
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

    public function getPromotionById($id)
    {
        return Promotion::findOrFail($id);
    }

    public function updatePromotion($id, array $data)
    {
        $promotion = $this->getPromotionById($id);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount' => 'required_unless:apply_for,freeship|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'apply_for' => 'required|in:specific_products,freeship,all',
            'status' => 'required|in:active,inactive',
            'product_id' => 'required_if:apply_for,specific_products|exists:products,id|not_in:null',

        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        $promotion->update([
            'name' => $data['name'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'discount' => $data['discount'],
            'minimum_amount' => $data['minimum_amount'] ?? null,
            'usage_limit' => $data['usage_limit'] ?? null,
            'apply_for' => $data['apply_for'],
            'status' => $data['status'],
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
        $promotion = $this->getPromotionById($id);
        return $promotion->delete();
    }

    public function bulkDeletePromotions(array $ids)
    {
        return Promotion::whereIn('id', $ids)->delete();
    }

    public function getPromotionWithProducts($id)
    {
        return Promotion::with('products')->findOrFail($id);
    }

    public function getAllPromotionsWithDates()
    {
        return Promotion::all()->map(function ($promotion) {
            $promotion->start_date = Carbon::parse($promotion->start_date);
            $promotion->end_date = Carbon::parse($promotion->end_date);
            return $promotion;
        });
    }

    public function receivePromotion($id)
    {
        $promotion = $this->getPromotionById($id);
        $user = Auth::user();

        if ($promotion->usage_limit <= 0) {
            return ['type' => 'error', 'text' => 'Voucher đã hết.'];
        }

        $existingVoucher = UserVoucher::where('user_id', $user->id)
            ->where('promotion_id', $promotion->id)
            ->first();

        if ($existingVoucher) {
            return ['type' => 'error', 'text' => 'Bạn đã nhận voucher này rồi.'];
        }

        $promotion->decrement('usage_limit');

        UserVoucher::create([
            'user_id' => $user->id,
            'promotion_id' => $promotion->id,
            'code' => $promotion->code,
            'received_at' => now(),
        ]);

        return ['type' => 'success', 'text' => 'Voucher nhận thành công'];
    }

    public function getUserPromotions()
    {
        $userId = Auth::id();
        return UserVoucher::where('user_id', $userId)->get();
    }
}