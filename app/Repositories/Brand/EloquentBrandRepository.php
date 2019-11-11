<?php

namespace App\Repositories\Brand;

use App\Repositories\EloquentRepository;
use App\Brand;
use Auth;

class EloquentBrandRepository extends EloquentRepository implements BrandRepository {

    /**
     * The eloquent model instance.
     *
     * @var \App\Models\Incident
     */
    public $model;

    /**
     * Create a new eloquent incident repository instance.
     *
     * @param \App\Models\Incident $model
     */
    public function __construct(Brand $model) {
        $this->model = $model;
    }


    /**
     * Create a new model.
     *
     * @param int   $userId
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data) {

        $item = new $this->model;

        $item->name = $data['name'];
        $item->description = e($data['description']);
        $item->save();

        return $item;
    }

    /**
     * Update a model by id.
     *
     * @param int   $id
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($item, array $data) {

        $item->name = $data['name'];
        $item->description = e($data['description']);

        $item->save();
        return $item;
    }

}
