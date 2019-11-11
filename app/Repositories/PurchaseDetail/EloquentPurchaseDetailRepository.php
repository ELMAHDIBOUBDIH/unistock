<?php

namespace App\Repositories\PurchaseDetail;

use App\Repositories\EloquentRepository;
use App\PurchaseDetail;
use Auth;

class EloquentPurchaseDetailRepository extends EloquentRepository implements PurchaseDetailRepository {

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
    public function __construct(PurchaseDetail $model) {
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
         $item->purchase_id  =  e($data['purchase_id']); 
         $item->product_id  =  e($data['product_id']); 
         $item->unit_price  =  e($data['unit_price']); 
         $item->quantity  =  e($data['quantity']); 
         $item->tva_rate  =  e($data['tva_rate']); 
         $item->montant_ttc  =  e($data['montant_ttc']); 
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
        
         $item->purchase_id  =  e($data['purchase_id']); 
         $item->product_id  =  e($data['product_id']); 
         $item->unit_price  =  e($data['unit_price']); 
         $item->quantity  =  e($data['quantity']); 
         $item->tva_rate  =  e($data['tva_rate']); 
         $item->montant_ttc  =  e($data['montant_ttc']);  
         $item->save();

        return $item;
    }

}
