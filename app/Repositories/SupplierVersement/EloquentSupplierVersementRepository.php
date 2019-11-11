<?php

namespace App\Repositories\SupplierVersement;

use App\Repositories\EloquentRepository;
use App\SupplierVersement;
use Auth;

class EloquentSupplierVersementRepository extends EloquentRepository implements SupplierVersementRepository {

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
    public function __construct(SupplierVersement $model) {
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
        $item->date = e($data['date']);
        $item->valide = e($data['valide']);
        $item->solde = e($data['solde']);
        $item->versement = e($data['versement']);
        $item->reste = e($data['reste']);
        $item->id_mode = e($data['id_mode']);
        $item->id_compte = e($data['id_compte']);
        $item->n_cheque = e($data['n_cheque']);
        $item->note = e($data['note']);
        $item->ref_id = e($data['ref_id']);
        $item->supplier_id = e($data['supplier_id']);
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
        $item->date = e($data['date']);
        $item->valide = e($data['valide']);
        $item->solde = e($data['solde']);
        $item->versement = e($data['versement']);
        $item->reste = e($data['reste']);
        $item->id_mode = e($data['id_mode']);
        $item->id_compte = e($data['id_compte']);
        $item->n_cheque = e($data['n_cheque']);
        $item->note = e($data['note']);
        $item->ref_id = e($data['ref_id']);
        $item->supplier_id = e($data['supplier_id']);
        $item->save();

        return $item;
    }

}
