<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Darryldecode\Cart\Facades\CartFacade as Cart;


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

    public function getCart()
    {
        return $this->cartRepository->getCartByUser();
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->input();
            $product = $this->productRepository->findById($payload['id'], ['productVariant']);
            $data = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $payload['quantity'],
                'price' => (isset($payload['del'])) ? $payload['del'] : $payload['price']

            ];
            if (isset($payload['attribute_id']) && $payload['attribute_id']) {
                $attributeId = sortAttributeId($payload['attribute_id']);
                $productVariant = $this->productVariantRepository->findVariant($attributeId, $product->id);
                $data['id'] = $product->id.'_'.$productVariant->id;
                $data['name'] = $productVariant->name;
                $data['price'] = $productVariant->price;
                $data['options'] = [
                    'attribute_id' => $payload['attribute_id'],
                ];
            }
            Cart::add($product);
            
            //  $cart = $this->cartRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    private function paginateSelect()
    {
        return [
            'id',
            'user_id',
            'create_at',
        ];
    }
}
