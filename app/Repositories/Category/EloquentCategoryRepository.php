<?php

namespace App\Repositories\Category;

use App\Repositories\EloquentRepository;
use App\Category;
use Auth;

class EloquentCategoryRepository extends EloquentRepository implements CategoryRepository {

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
    public function __construct(Category $model) {
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
        $item->parente()->associate($data['parent_id']);
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
        $item->parente()->associate($data['parent_id']);

        $item->save();

        return $item;
    }

}
