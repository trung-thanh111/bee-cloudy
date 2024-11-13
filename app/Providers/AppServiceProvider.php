<?php

namespace App\Providers;

use App\Repositories\BrandRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\CartService;
use App\Repositories\ProductRepository;
use App\Repositories\ProductCatalogueRepository;
use App\Repositories\PostCatalogueRepository;
use App\Repositories\WishlistRepository;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    // Khởi tạo mảng services cần ràng buộc
    public $bindings = [
        // Cấu hình cặp key-value cho các binding của services
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Services\Interfaces\AttributeCatalogueServiceInterface' => 'App\Services\AttributeCatalogueService',
        'App\Services\Interfaces\AttributeServiceInterface' => 'App\Services\AttributeService',
        'App\Services\Interfaces\ProductCatalogueServiceInterface' => 'App\Services\ProductCatalogueService',
        'App\Services\Interfaces\BrandServiceInterface' => 'App\Services\BrandService',
        'App\Services\Interfaces\ProductServiceInterface' => 'App\Services\ProductService',
        'App\Services\Interfaces\ShopServiceInterface' => 'App\Services\ShopService',
        'App\Services\Interfaces\PostCatalogueServiceInterface' => 'App\Services\PostCatalogueService',
        'App\Services\Interfaces\PostServiceInterface' => 'App\Services\PostService',
        'App\Services\Interfaces\CartServiceInterface' => 'App\Services\CartService',
        'App\Services\Interfaces\WishlistServiceInterface' => 'App\Services\WishlistService',
        'App\Services\Interfaces\OrderServiceInterface' => 'App\Services\OrderService',
        'App\Services\Interfaces\UserCatalogueServiceInterface' => 'App\Services\UserCatalogueService',
        'App\Services\Interfaces\BannerServiceInterface' => 'App\Services\BannerService',
        'App\Services\Interfaces\PromotionServiceInterface' => 'App\Services\PromotionService',
    ];

    public function register(): void
    {
        // Lặp qua các phần tử ràng buộc trong mảng bindings
        foreach ($this->bindings as $key => $val) {
            // Thực hiện bind (ràng buộc) giữa interface và implementation
            $this->app->bind($key, $val);
        }

        // Đăng ký ràng buộc cho repositories thông qua AppRepositoryProvider
        $this->app->register(AppRepositoryProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(
        CartService $cartService,
        WishlistRepository $wishlistRepository,
        ProductRepository $productRepository,
        ProductCatalogueRepository $productCatalogueRepository,
        BrandRepository $brandRepository,
        PostCatalogueRepository $postCatalogueRepository,
    ): void {
        View::composer('*', function ($view) use (
            $cartService,
            $wishlistRepository,
            $productRepository,
            $productCatalogueRepository,
            $brandRepository,
            $postCatalogueRepository,
        ) {
            // Số lượng sản phẩm trong giỏ hàng
            $productInCart = $cartService->countProductIncart();
            $nameStand = $productRepository->getLimitOrder(
                [],
                [['publish', 1]],
                [['created_at', 'asc']],
                3
            );

            $productCategories = $productCatalogueRepository->getWithCondition(
                [
                    'childrenReference'
                ],
                [
                    ['parent_id', 'is', null],
                    ['publish', '=', 1],
                ]
            );
            $brandHeaders = $brandRepository->allWhere([['publish', '=', 1]]);

            // -- // 
            $postCatalogueHeaders = $postCatalogueRepository->allWhere([['publish', '=', 1]]);
            // -- //

            $wishlists = $wishlistRepository->allWhere([
                ['user_id', '=', Auth::id()],
                ['deleted_at', '=', null]
            ]);

            $wishlist = [
                'product_ids' => $wishlists->pluck('product_id')->toArray(),
                'variant_ids' => $wishlists->pluck('product_variant_id')->toArray()
            ];
            $productInWishlist = array_merge($wishlist['product_ids'], $wishlist['variant_ids']);


            $view->with([
                'productInCart' => $productInCart,
                'nameStand' => $nameStand,
                'productCategories' => $productCategories,
                'brandHeaders' => $brandHeaders,
                'postCatalogueHeaders' => $postCatalogueHeaders,
                'productInWishlist' => $productInWishlist,
            ]);
        });

        // mặc định giá trị cho shcema 
        Schema::defaultStringLength(255);
    }
}
