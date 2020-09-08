<?php

namespace App\Http\Controllers\api\v1;

use App\Contracts\StoreRepositoryInterface;
use App\Core\BaseController;
use App\Http\Requests\Store\StoreRequest;
use App\Http\Requests\Store\UpdateRequest;
use App\Repositories\StoreRepository;
use Illuminate\Http\JsonResponse;

class StoreController extends BaseController
{
    /**
     * @var StoreRepository
     */
    private $store;

    /**
     * StoreController constructor.
     * @param StoreRepositoryInterface $store
     */
    public function __construct(StoreRepositoryInterface $store)
    {
        $this->store = $store;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $store = $this->store->getAll();

        return $this->ok($store);
    }


    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $store = $this->store->create($request->input());

        return $this->ok($store);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->store->getById($id);

        if (empty($data)) {
            return $this->fail(
                __('global.record_not_found'),
                '',
                404
            );
        }

        return $this->ok($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param  int $id
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $this->store->getById($id);

        if (empty($data)) {
            return $this->fail(
                __('global.record_not_found'),
                '',
                404
            );
        }

        $store = $this->store->update($request->input(), $id);

        return $this->ok($store);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     */
    public function destroy($id)
    {
        //
    }
}
