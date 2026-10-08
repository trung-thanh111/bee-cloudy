<?php

namespace App\Http\Controllers\Fontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductCatalogueRepository;

class HomeController extends Controller
{

    protected $productCatalogueRepository;

    public function __construct(
    ProductCatalogueRepository $productCatalogueRepository
    ) 
    {
        $this->productCatalogueRepository = $productCatalogueRepository;
    }
    public function index(Request $request)
    {   
        $productCatalogues = $this->productCatalogueRepository->all();
        return view('fontend.index.home_index', compact(
            'productCatalogues'
        ));
    }
}
