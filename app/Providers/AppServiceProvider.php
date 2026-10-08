<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\CartService;
use App\Repositories\ProductRepository;

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
        ProductRepository $productRepository,
    ): void
    {
        {
            // Sử dụng view composer để chia sẻ biến $cateMenu với mọi view
            View::composer('*', function ($view) use ($cartService) {
                $productInCart = $cartService->countProductIncart();

                $view->with('productInCart', $productInCart);
            });
            // keyword nổi bật product
            View::composer('*', function ($view) use ($productRepository) {
                $nameStand = $productRepository->getLimitOrder(
                    [],
                [
                    ['publish', 1],
                ],
                [
                    ['created_at', 'asc']
                ],
                3
            );

                $view->with('nameStand', $nameStand);
            });
        }
        // mặc định giá trị cho shcema 
        Schema::defaultStringLength(255);
    }
}
