<?php

namespace App\Repositories\PriceProduct;

use App\Repositories\EloquentRepository;
use App\PriceProduct;
use App\Product;
use Auth;

class EloquentPriceProductRepository extends EloquentRepository implements PriceProductRepository {

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
    public function __construct(PriceProduct $model) {
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
        $item->marge = $data['marge'];
        $item->montant_ht = $data['montant_ht'];
        $item->montant_ttc = e($data['montant_ttc']);
        $item->product_id = $data['product_id'];
        $item->group_id = $data['group_id'];
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
        
        $item->marge = $data['marge'];
        $item->montant_ht = $data['montant_ht'];
        $item->montant_ttc = e($data['montant_ttc']);
        $item->product_id = $data['product_id'];
        $item->group_id = $data['group_id'];
        $item->save();

        return $item;
    }

}
