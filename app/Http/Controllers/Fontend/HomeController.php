<?php

namespace App\Http\Controllers\Fontend;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Repositories\BannerRepository;
use App\Repositories\BrandRepository;
use App\Repositories\PostRepository;
use App\Repositories\ProductCatalogueRepository;
use App\Services\PostService;
use App\Services\ShopService;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    protected $shopService;
    protected $productService;
    protected $postRepository;
    protected $brandRepository;
    protected $bannerRepository;
    protected $productCatalogueRepository;

    public function __construct(
        ShopService $shopService,
        ProductService $productService,
        PostRepository $postRepository,
        BrandRepository $brandRepository,
        BannerRepository $bannerRepository,
        ProductCatalogueRepository $productCatalogueRepository,
    ) {
        $this->postRepository = $postRepository;
        $this->shopService = $shopService;
        $this->productService = $productService;
        $this->bannerRepository = $bannerRepository;
        $this->brandRepository = $brandRepository;
        $this->productCatalogueRepository = $productCatalogueRepository;
    }
    public function index(Request $request)
    {
        $productCatalogues = $this->productCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
        $brands = $this->brandRepository->allWhere([
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
        $productSales = $this->productService->productSales();
        $productSupperSales = $this->productService->productSupperSales();
        $productShopPriceMins = $this->shopService->productShopPriceMins();
        $postHomes = $this->postRepository->getLimitOrder(
            ['users'],
            [
                ['publish', 1],
                ['outstanding', 1],
            ],
            [
                ['created_at', 'asc'],
            ],
            []

        );
        $postHomeNews = $this->postRepository->getLimitOrder(
            ['users'],
            [
                ['publish', 1],
            ],
            [
                ['created_at', 'desc'],
            ],
            []

        );
        // dd($postHomes);
        return view('fontend.index.home_index', compact(
            'brands',
            'postHomes',
            'productNew',
            'bannerHome1',
            'bannerHome2',
            'postHomeNews',
            'productSales',
            'productCatalogues',
            'productSupperSales',
            'productShopPriceMins',
        ));
    }

    public function faq()
    {
        return view('fontend.page_other.faq');
    }

    public function showForm()
    {
        return view('fontend.page_other.contact');
    }

    public function send(Request $request)
    {
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Gửi email với dữ liệu form
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactMail($validated));

        return back()->with('success', 'Your message has been sent successfully!');
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
