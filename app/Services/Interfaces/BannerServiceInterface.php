<?php

namespace App\Services\Interfaces;

/**
 * interface UserServicesInterface
 * @package App\Services\Interfaces
 */
interface BannerServiceInterface
{
    public function all();
    public function paginate($request);
    public function create($request);
    public function update($id, $request);
    public function destroy($id);
}
