<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/** class BaseRepository
 * @package App\Repositories
 */


class CartRepository extends BaseRepository implements CartRepositoryInterface
{

    protected $model;

    public function __construct(Cart $model)
    {
        $this->model = $model;
    }
    public function getCartByUser()
    {
        return $this->model->where('user_id', Auth::id())->first();
    }

    public function createCart($payload){
        return $this->model->create($payload);
    }
    // public function addToCart($request, array $payload)
    // {
    //     $cart = $this->getOrCreateCart();

    //     $cartItem = $cart->items()->where('product_variant_id', $payload['product_variant_id'])->first();

    //     if ($cartItem) {
    //         $cartItem->quantity += $payload['quantity'];
    //         $cartItem->total = $cartItem->quantity * $cartItem->price;
    //         $cartItem->save();
    //     } else {
    //         $cart->items()->create([
    //             'product_variant_id' => $payload['product_variant_id'],
    //             'quantity' => $payload['quantity'],
    //             'price' => $payload['price'],
    //             'total' => $payload['quantity'] * $payload['price']
    //         ]);
    //     }
    // }

    // public function updateCart($itemId, array $payload)
    // {
    //     $cartItem = CartItem::findOrFail($itemId);
    //     $cartItem->quantity = $payload['quantity'];
    //     $cartItem->total = $cartItem->quantity * $cartItem->price;
    //     $cartItem->save();
    // }

    // public function removeFromCart($itemId)
    // {
    //     CartItem::destroy($itemId);
    // }

    // public function clearCart()
    // {
    //     $cart = $this->getCartByUser();
    //     if ($cart) {
    //         $cart->items()->delete();
    //     }
    // }

    // public function getTotal()
    // {
    //     $cart = $this->getCartByUser();
    //     return $cart ? $cart->items->sum('total') : 0;
    // }

    // public function getCartItemCount()
    // {
    //     $cart = $this->getCartByUser();
    //     return $cart ? $cart->items->sum('quantity') : 0;
    // }

    // private function getOrCreateCart()
    // {
    //     return Cart::firstOrCreate(['user_id' => Auth::id()]);
    // }
}
