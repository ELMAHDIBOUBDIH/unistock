<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use App\User;
use Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentUserRepository extends EloquentRepository implements UserRepository {

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
    public function __construct(User $model) {
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
        $item->email = $data['email'];
        $item->role = 'editor';
        $item->status = 1;
        $item->password = Hash::make($data['password']) ;

        $result = $item->save();

        return $result;
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
        $result = $item->update($data);
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
    public function changePassword($item, $password) {
        $item->password = Hash::make($password);
        $result['success'] = $item->save();
        return $result;
    }

    /**
     * Update a model by id.
     *
     * @param int   $id
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function changeRole($id, $role) {
        $item = $this->model->findOrFail($id);
        $item->role = $role;
        $item->save();
        return $item;
    }

}
