<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/** class BaseRepository
 * @package App\Repositories
 */


class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{

    protected $model;

    public function __construct(Banner $model)
    {
        $this->model = $model;
    }

    public function update(string $id = '', array $payload = [])
    {
        // tim theo ban ghi k can quan he K truyen ralation
        $model = $this->findById($id);
        if ($model) {
            $model->update($payload);
            return $model->fresh();
        }
        return false;
    }
}
