<?php

namespace App\Repositories;

use App\Models\Attribute;
use App\Repositories\Interfaces\AttributeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface {
    
    protected $model;

    public function __construct(Attribute $model) {
        $this->model = $model;
    }
    public function searchAttributes(string $keyword = '', array $option = [])
    {                                       
        // mối quan hệ n-n với bảng attribute_catalogue
        return $this->model->whereHas('attributeCatalogues', function ($query) use ($option) {
            $query->where('attribute_catalogue_id', $option['attributeCatalogueId']);
        })->where('name', 'like', '%' . $keyword . '%')
        ->orWhere('slug', 'like', '%' . $keyword . '%')
        ->get();
    }

    public function findAttributeByIdArray($attributeArray = []){
        return $this->model->select([
            'attributes.id',
            'attributes.image',
            'attributes.name',
            'attributes.attribute_catalogue_id',
        ])
        // đk whereIn tìn kiếm id trong một mảng chứa id
        ->where('publish', 1)
        ->whereIn('attributes.id', $attributeArray)
        ->get();
    }
    
    
}

