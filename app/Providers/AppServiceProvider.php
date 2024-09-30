<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        // mặc định giá trị cho shcema 
        Schema::defaultStringLength(255);
    }
}
