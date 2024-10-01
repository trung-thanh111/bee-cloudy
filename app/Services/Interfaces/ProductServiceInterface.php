<?php 
namespace App\Services\Interfaces;

/**
 * interface UserServicesInterface
 * @package App\Services\Interfaces
 */
interface ProductServiceInterface {
    public function all();
    public function paginate($request);
    public function create($request);
    public function update($slug, $request);
    public function destroy($id);
    public function formatJson($request, $inputName);

}