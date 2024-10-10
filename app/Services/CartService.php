<?php

namespace App\Services;

use App\Models\Cart as ModelsCart;
use App\Models\orderItem;
use App\Models\Order;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * interface  UserService
 * @package App\Services
 */

class CartService implements CartServiceInterface
{
    protected $cartRepository;
    protected $productRepository;
    protected $productVariantRepository;
    public function __construct(
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
        CartRepository $cartRepository,
    ) {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
    }

    public function all()
    {
        return $this->cartRepository->all(
            ['orderItems', 'orderItems.productVariants', 'orderItems.productVariants.attributes', 'orderItems.products'],
            [
                ['user_id', Auth::id()],
                ['status', 'pending'],
            ]
        );
    }

    public function countProductIncart()
    {
        $carts = $this->cartRepository->all(
            ['orderItems', 'orderItems.productVariants', 'orderItems.productVariants.attributes', 'orderItems.products'],
            [
                ['user_id', Auth::id()],
                ['status', 'pending'],
            ]
        );
        $count = 0;
        if($carts){
            $cart = Order::with('orderItems.products', 'orderItems.productVariants')->find($carts->id);
            foreach ($cart->orderItems as $item) {
                if ($item->products || $item->productVariants) {
                    $count++;
                }
            }
        }
        return $count;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->input();
            $product = $this->productRepository->findById($payload['product_id'], ['productVariant']);
            $cartByUser = Order::firstOrCreate([
                'user_id' => Auth::id(),
                'status' => 'pending',
            ]);
            $price = $product->del != 0 ? $product->del : $product->price;
            $data = [
                'order_id' => $cartByUser->id,
                'product_id' => $product->id,
                'product_variant_id' => null,
                'quantity' => $payload['quantity'],
                'price' => str_replace('.', '', $price),
            ];

            // Nếu có thuộc tính (attribute_id)
            if (isset($payload['attribute_id']) && $payload['attribute_id']) {
                $attributeId = sortAttributeId($payload['attribute_id']);
                $productVariant = $this->productVariantRepository->findVariant($attributeId, $product->id);

                $data['product_id'] = null;
                $data['product_variant_id'] = $productVariant->id;
                $data['price'] = str_replace('.', '', $productVariant->price);
            }

            $orderItem = OrderItem::where('order_id', $cartByUser->id)
                ->where(function ($query) use ($product, $data) {
                    if ($data['product_variant_id']) {
                        $query->where('product_variant_id', $data['product_variant_id']);
                    } else {
                        $query->where('product_id', $product->id);
                    }
                })
                ->first();
            if ($orderItem) {
                $orderItem->quantity += $data['quantity'];
                $orderItem->save();
            } else {
                $orderItem = new OrderItem();
                $orderItem->order_id = $data['order_id'];
                $orderItem->product_id = $data['product_id'];
                $orderItem->product_variant_id = $data['product_variant_id'];
                $orderItem->quantity = $data['quantity'];
                $orderItem->price = $data['price'];
                $orderItem->save();
            }
            // dd($orderItem);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }


    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $cart = $this->cartRepository->all(
                ['orderItems', 'orderItems.productVariants', 'orderItems.productVariants.attributes', 'orderItems.products'],
                [
                    ['user_id', Auth::id()],
                    ['status', 'pending'],
                    ]
                );
                if ($cart) {
                    // loop qua các item trong giỏ hàng 
                    foreach ($cart->orderItems as $item) {
                        $payload = $request->input();
                
                        // product_variant_id tồn tại trong payload (request)
                        if ($payload['product_variant_id'] && $item->productVariants && $item->productVariants->id == $payload['product_variant_id']) {
                            // Cập nhật
                            $quantity = $payload['quantity'];
                            $item->update(['quantity' => $quantity]);
                
                        } elseif ($payload['product_id'] && $item->products && $item->products->id == $payload['product_id']) {
                            $quantity = $payload['quantity'];
                            $item->update(['quantity' => $quantity]);
                        }
                    }
                }
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->input();
            
            $id = $payload['product_id'] ? $payload['product_id'] : $payload['product_variant_id'];
            // lấy ra item dựa trên mối quan hệ                         // closure
            $orderItem = OrderItem::whereHas('productVariants', function($query) use ($id) {
                $query->where('product_variant_id', $id);
            })
            ->orWhereHas('products', function($query) use ($id) {
                $query->where('product_id', $id);
            })
            ->first();
            if ($orderItem) {
                $orderItem->delete();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function clear(Request $request)
{
    DB::beginTransaction();
    try {
        $orderId = $request->input('order_id');
        $order = Order::where('user_id', Auth::id())
                      ->where('status', 'pending')
                      ->first();
        $order->delete();
        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollBack();
        return false;
    }
}
}
