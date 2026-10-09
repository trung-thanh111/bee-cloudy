<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    public $bindings = [
        '\App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',
        '\App\Repositories\Interfaces\AttributeCatalogueRepositoryInterface' => 'App\Repositories\AttributeCatalogueRepository',
        '\App\Repositories\Interfaces\AttributeRepositoryInterface' => 'App\Repositories\AttributeRepository',
        '\App\Repositories\Interfaces\ProductCatalogueRepositoryInterface' => 'App\Repositories\ProductCatalogueRepository',
        '\App\Repositories\Interfaces\BrandRepositoryInterface' => 'App\Repositories\BrandRepository',
        '\App\Repositories\Interfaces\ProductRepositoryInterface' => 'App\Repositories\ProductRepository',
        '\App\Repositories\Interfaces\ShopRepositoryInterface' => 'App\Repositories\ShopRepository',
        '\App\Repositories\Interfaces\PostCatalogueRepositoryInterface' => 'App\Repositories\PostCatalogueRepository',
        '\App\Repositories\Interfaces\PostRepositoryInterface' => 'App\Repositories\PostRepository',
        '\App\Repositories\Interfaces\CartRepositoryInterface' => 'App\Repositories\CartRepository',
        '\App\Repositories\Interfaces\WishlistRepositoryInterface' => 'App\Repositories\WishlistRepository',
        '\App\Repositories\Interfaces\OrderRepositoryInterface' => 'App\Repositories\OrderRepository',
        '\App\Repositories\Interfaces\UserCatalogueRepositoryInterface' => 'App\Repositories\UserCatalogueRepository',
        '\App\Repositories\Interfaces\BannerRepositoryInterface' => 'App\Repositories\BannerRepository',
        '\App\Repositories\Interfaces\PromotionRepositoryInterface' => 'App\Repositories\PromotionRepository',
    ];
    public function register(): void
    {
        foreach ($this->bindings as $key => $val) {
            $this->app->bind($key, $val);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
