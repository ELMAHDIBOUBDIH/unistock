<?php

namespace App\Repositories\Purchase;

use App\Repositories\EloquentRepository;
use App\Purchase;
use Auth;

class EloquentPurchaseRepository extends EloquentRepository implements PurchaseRepository {

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
    public function __construct(Purchase $model) {
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
         $item->purchase_number  =  e($data['purchase_number']);
         $item->supplier_id  =  e($data['supplier_id']);
         $item->type  =  e($data['type']);
         $item->ref_id  =  e($data['ref_id']);
         $item->employee_id  =  e($data['employee_id']);
         $item->date  =  e($data['date']);
         $item->total_tva  =  e($data['total_tva']);
         $item->total_ht  =  e($data['total_ht']);
         $item->total_ttc  =  e($data['total_ttc']);
         $item->remise  =  e($data['remise']);
         $item->valide  =  e($data['valide']);
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


      $item->purchase_number  =  e($data['purchase_number']);
      $item->supplier_id  =  e($data['supplier_id']);
      $item->type  =  e($data['type']);
      $item->ref_id  =  e($data['ref_id']);
      $item->employee_id  =  e($data['employee_id']);
      $item->date  =  e($data['date']);
      $item->total_tva  =  e($data['total_tva']);
      $item->total_ht  =  e($data['total_ht']);
      $item->total_ttc  =  e($data['total_ttc']);
      $item->remise  =  e($data['remise']);
      $item->valide  =  e($data['valide']);
      $item->note  =  e($data['note']);

      $item->save();

      return $item;
    }

}
