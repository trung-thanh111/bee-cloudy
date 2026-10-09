<?php
namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;

class ProductController extends Controller
{
    protected $productRepository;
    protected $productVariantRepository;

    public function __construct(
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
    ) {
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
    }

    
    public function loadVariant(Request $request){
        //bắt attribute id và product_id của sản phẩm đc chọn và sort nhỏ -> lớn
        $get = $request->input();
        $attributeId = $get['attribute_id'];
        $attributeId = sortAttributeId( $attributeId);
        //tim kiếm variant 
        $productVariant = $this->productVariantRepository->findVariant($attributeId, $get['product_id']);
        return response()->json([
            'productVariant' => $productVariant
        ]);

    }
}
