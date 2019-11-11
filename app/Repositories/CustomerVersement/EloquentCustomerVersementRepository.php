<?php

namespace App\Repositories\CustomerVersement;

use App\Repositories\EloquentRepository;
use App\CustomerVersement;
use Auth;

class EloquentCustomerVersementRepository extends EloquentRepository implements CustomerVersementRepository {

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
    public function __construct(CustomerVersement $model) {
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
        $item->n_versement = e($data['n_versement']);
        $item->date_v = e($data['date_v']);
        $item->valide = e($data['valide']);
        $item->solde = e($data['solde']);
        $item->versement = e($data['versement']);
        $item->reste = e($data['reste']);
        $item->id_mode = e($data['id_mode']);
        $item->id_compte = e($data['id_compte']);
        $item->n_cheque = e($data['n_cheque']);
        $item->note = e($data['note']);
        $item->ref_id = e($data['ref_id']);
        $item->customer_id = e($data['customer_id']);
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

        $item->n_versement = e($data['n_versement']);
        $item->date_v = e($data['date_v']);
        $item->valide = e($data['valide']);
        $item->solde = e($data['solde']);
        $item->versement = e($data['versement']);
        $item->reste = e($data['reste']);
        $item->id_mode = e($data['id_mode']);
        $item->id_compte = e($data['id_compte']);
        $item->n_cheque = e($data['n_cheque']);
        $item->note = e($data['note']);
        $item->ref_id = e($data['ref_id']);
        $item->customer_id = e($data['customer_id']);
        $item->save();

        return $item;
    }

}
