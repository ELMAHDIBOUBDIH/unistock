<?php

namespace App\Repositories\PaymentMode;

use App\Repositories\EloquentRepository;
use App\PaymentMode;
use Auth;

class EloquentPaymentModeRepository extends EloquentRepository implements PaymentModeRepository {

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
    public function __construct(PaymentMode $model) {
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
