<?php

namespace App\Http\Controllers\Fontend;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Repositories\BannerRepository;
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
    protected $bannerRepository;
    protected $productCatalogueRepository;

    public function __construct(
        ShopService $shopService,
        ProductService $productService,
        PostRepository $postRepository,
        BannerRepository $bannerRepository,
        ProductCatalogueRepository $productCatalogueRepository,
    ) {
        $this->postRepository = $postRepository;
        $this->shopService = $shopService;
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
        $productSales = $this->productService->productSales();
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
            'postHomes',
            'productNew',
            'bannerHome1',
            'bannerHome2',
            'postHomeNews',
            'productSales',
            'productCatalogues',
            'productShopPriceMins',
        ));
    }

    public function faq()
    {
        return view('fontend.page_other.faq');
    }

    public function contact()
    {
        return view('fontend.page_other.contact');
    }

    public function contactSubmit(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Truyền dữ liệu vào mail dưới dạng chuỗi
        $contactData = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        // Chuyển đổi dữ liệu thành chuỗi (nếu cần)
        $contactDataString = json_encode($contactData);  // Biến các mảng thành chuỗi JSON

        // Gửi mail
        Mail::to('beecloudy2024@gmail.com')->send(new ContactMail($contactDataString));

        // Hiển thị thông báo và quay lại
        flash()->success('Cảm ơn bạn đã liên hệ');
        return redirect()->back();
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
