<?php

namespace App\Http\Controllers\Fontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductCatalogueRepository;
use App\Repositories\BannerRepository;

class HomeController extends Controller
{

    protected $productCatalogueRepository;
    protected $bannerRepository;

    public function __construct(
        ProductCatalogueRepository $productCatalogueRepository,
        BannerRepository $bannerRepository
    ) {
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->bannerRepository = $bannerRepository;
    }
    public function index(Request $request)
    {
        $productCatalogues = $this->productCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
        $banner = $this->bannerRepository->allWhere([
            ['publish', 1],
            ['location', 0]
        ]);
        $banner1 = $this->bannerRepository->allWhere([
            ['publish', 1],
            ['location', 1]
        ]);
        return view('fontend.index.home_index', compact('productCatalogues', 'banner', 'banner1'));
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
