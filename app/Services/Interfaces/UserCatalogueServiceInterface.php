<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

/**
 * @package 
 *
 */

interface UserCatalogueServiceInterface
{
    public function paginate($request);
    public function create($request);
    public function update($slug, $request);
    public function destroy($id);
    public function userCatalogueAll();
}
