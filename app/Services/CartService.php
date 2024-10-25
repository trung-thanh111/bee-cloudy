<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ['cartItems', 'cartItems.productVariants', 'cartItems.productVariants.attributes', 'cartItems.products'],
            [
                ['user_id', Auth::id()],
            ]
        );
    }

    public function countProductIncart()
    {
        $carts = $this->cartRepository->all(
            ['cartItems', 'cartItems.productVariants', 'cartItems.productVariants.attributes', 'cartItems.products'],
            [
                ['user_id', Auth::id()],
            ]
        );
        $count = 0;
        if ($carts) {
            $cart = Cart::with('cartItems.products', 'cartItems.productVariants')->find($carts->id);
            foreach ($cart->cartItems as $item) {
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
            $cartByUser = Cart::firstOrCreate([
                'user_id' => Auth::id(),
            ]);
            $price = $product->del != 0 ? $product->del : $product->price;
            $data = [
                'cart_id' => $cartByUser->id,
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

            $cartItem = CartItem::where('cart_id', $cartByUser->id)
                ->where(function ($query) use ($product, $data) {
                    if ($data['product_variant_id']) {
                        $query->where('product_variant_id', $data['product_variant_id']);
                    } else {
                        $query->where('product_id', $product->id);
                    }
                })
                ->first();
            if ($cartItem) {
                $cartItem->quantity += $data['quantity'];
                $cartItem->save();
            } else {
                $cartItem = new CartItem();
                $cartItem->cart_id = $data['cart_id'];
                $cartItem->product_id = $data['product_id'];
                $cartItem->product_variant_id = $data['product_variant_id'];
                $cartItem->quantity = $data['quantity'];
                $cartItem->price = $data['price'];
                $cartItem->save();
            }
            // dd($cartItem);
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
                ['cartItems', 'cartItems.productVariants', 'cartItems.productVariants.attributes', 'cartItems.products'],
                [
                    ['user_id', Auth::id()],
                ]
            );
            if ($cart) {
                // loop qua các item trong giỏ hàng 
                foreach ($cart->cartItems as $item) {
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
            $cartItem = CartItem::whereHas('productVariants', function ($query) use ($id) {
                $query->where('product_variant_id', $id);
            })
                ->orWhereHas('products', function ($query) use ($id) {
                    $query->where('product_id', $id);
                })
                ->first();
            if ($cartItem) {
                $cartItem->delete();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function clear()
    {
        DB::beginTransaction();
        try {
            // $cartId = $request->input('cart_id');
            $cart = Cart::where('user_id', Auth::id())
                ->first();
            $cart->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
