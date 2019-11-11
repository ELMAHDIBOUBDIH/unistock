<?php

namespace App\Repositories\WarehouseOutput;

use App\Repositories\EloquentRepository;
use App\WarehouseOutput;
use Auth;

class EloquentWarehouseOutputRepository extends EloquentRepository implements WarehouseOutputRepository {

    /**
     * The eloquent model instance.
     *
     * @var \App\Models\Incident
     */
    protected $model;

    /**
     * Create a new eloquent incident repository instance.
     *
     * @param \App\Models\Incident $model
     */
    public function __construct(WarehouseOutput $model) {
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
        $item->title = $data['title'];
        $item->slug = $data['slug'];
        $item->text = e($data['text']);
        $item->status = $data['status'];
        $item->question()->associate($data['question_id']);
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
    public function update($id, array $data) {
        $item = $this->model->findOrFail($id);

        $item->title = $data['title'];
        $item->slug = $data['slug'];
        $item->text = e($data['text']);
        $item->status = $data['status'];
        $item->save();

        return $item;
    }

}
