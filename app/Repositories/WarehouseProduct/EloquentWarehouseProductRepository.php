<?php

namespace App\Repositories\WarehouseProduct;

use App\Repositories\EloquentRepository;
use App\WarehouseProduct;
use Auth;

class EloquentWarehouseProductRepository extends EloquentRepository implements WarehouseProductRepository {

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
    public function __construct(WarehouseProduct $model) {
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

         $item->warehouse_id  =  e($data['warehouse_id']); 
         $item->product_id  =  e($data['product_id']); 
         $item->quantity  =  e($data['quantity']); 
         $item->quantity_reserved  =  e($data['quantity_reserved']); 
         $item->zone  =  e($data['zone']); 
         $item->shelf  =  e($data['shelf']); 
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
         $item->warehouse_id  =  e($data['warehouse_id']); 
         $item->product_id  =  e($data['product_id']); 
         $item->quantity  =  e($data['quantity']); 
         $item->quantity_reserved  =  e($data['quantity_reserved']); 
         $item->zone  =  e($data['zone']); 
         $item->shelf  =  e($data['shelf']); 
         $item->note  =  e($data['note']); 
      
        $item->save();

        return $item;
    }

}
