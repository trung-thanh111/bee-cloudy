<?php

namespace App\Http\Controllers\Fontend;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Repositories\BannerRepository;
use App\Repositories\ProductCatalogueRepository;

class HomeController extends Controller
{

    protected $productService;
    protected $bannerRepository;
    protected $productCatalogueRepository;

    public function __construct(
        ProductService $productService,
        BannerRepository $bannerRepository,
        ProductCatalogueRepository $productCatalogueRepository,
    ) {
        $this->productService = $productService;
        $this->bannerRepository = $bannerRepository;
        $this->productCatalogueRepository = $productCatalogueRepository;
    }
    public function index(Request $request)
    {
        $productCatalogues = $this->productCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
        $bannerHome1 = $this->bannerRepository->allWhere([
            ['publish', 1],
            ['location', 0]
        ]);
        $bannerHome2 = $this->bannerRepository->allWhere([
            ['publish', 1],
            ['location', 1]
        ]);
        $productNew = $this->productService->productNews();
        // dd($bannerHome1);
        return view('fontend.index.home_index', compact('productCatalogues', 'bannerHome1', 'bannerHome2', 'productNew'));
    }

    public function faq()
    {
        return view('fontend.page_other.faq');
    }

    public function contact()
    {
        return view('fontend.page_other.contact');
    }

    public function terms_and_conditions()
    {
        return view('fontend.page_other.terms_and_conditions');
    }

    public function return_and_warranty_policy()
    {
        return view('fontend.page_other.return_and_warranty_policy');
    }
    public function about_us()
    {
        return view('fontend.page_other.about_us');
    }
    public function security_center()
    {
        return view('fontend.page_other.security_center');
    }
}
