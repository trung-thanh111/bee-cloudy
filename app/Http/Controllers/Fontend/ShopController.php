<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Repositories\ShopRepository;
use App\Repositories\ProductCatalogueRepository;
use App\Services\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $shopRepository;
    protected $shopService;
    protected $productCatalogueRepository;

    public function __construct(
        ShopRepository $shopRepository,
        ShopService $shopService,
        ProductCatalogueRepository $productCatalogueRepository
    ) {
        $this->shopRepository = $shopRepository;
        $this->shopService = $shopService;
        $this->productCatalogueRepository = $productCatalogueRepository;
    }
    public function index(Request $request)
    {   
        $productCatalogues = $this->productCatalogueRepository->all();
        $productShops = $this->shopService->paginate($request);
        return view('fontend.product.shop', compact(
            'productShops',
            'productCatalogues'
        ));
    }
}
