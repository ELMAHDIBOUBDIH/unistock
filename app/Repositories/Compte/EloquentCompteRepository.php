<?php

namespace App\Repositories\Compte;

use App\Repositories\EloquentRepository;
use App\Compte;
use Auth;

class EloquentCompteRepository extends EloquentRepository implements CompteRepository {

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
    public function __construct(Compte $model) {
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

        $item->num = e($data['num']);
        $item->name = e($data['name']);
        $item->nature = e($data['nature']);
        $item->solde_init = e($data['solde_init']);

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
        
        $item->num = e($data['num']);
        $item->name = e($data['name']);
        $item->nature = e($data['nature']);
        $item->solde_init = e($data['solde_init']);
        $item->save();

        return $item;
    }

}
