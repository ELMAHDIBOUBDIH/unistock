<?php

namespace App\Repositories\Warehouse;

use App\Repositories\EloquentRepository;
use App\Warehouse;
use Auth;

class EloquentWarehouseRepository extends EloquentRepository implements WarehouseRepository {

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
    public function __construct(Warehouse $model) {
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
         $item->name  =  e($data['name']); 
         $item->address  =  e($data['address']); 
         $item->note  =  e($data['note']); 
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

         $item->name  =  e($data['name']); 
         $item->address  =  e($data['address']); 
         $item->note  =  e($data['note']); 
         $item->save();

        return $item;
    }

}
