<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 22.8.2020
 * Time: 03:11
 */

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface StoreRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function create(array $store): Model;

    public function update(array $store, int $id): Model;

    public function delete(int $id);
}
