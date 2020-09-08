<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 22.8.2020
 * Time: 13:29
 */

namespace App\Repositories;

use App\Contracts\StoreRepositoryInterface;
use App\Model\Store;
use Illuminate\Database\Eloquent\Model;

class StoreRepository implements StoreRepositoryInterface
{
    /**
     * @var Store
     */
    private $model;

    /**
     * StoreRepository constructor.
     * @param Store $model
     */
    public function __construct(Store $model)
    {
        $this->model = $model;
    }

    public function getAll(): object
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $store): Model
    {
        return $this->model->create($store);
    }

    public function update(array $store, int $id): Model
    {
        return $this->model->update($store, $id);
    }

    public function delete(int $id)
    {
    }
}
