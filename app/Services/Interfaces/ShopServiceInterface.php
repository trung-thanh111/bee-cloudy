<?php 
namespace App\Services\Interfaces;

/**
 * interface UserServicesInterface
 * @package App\Services\Interfaces
 */
interface ShopServiceInterface {
    public function all();
    public function paginate($request);

}