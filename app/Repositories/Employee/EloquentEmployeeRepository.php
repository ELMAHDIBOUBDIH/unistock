<?php

namespace App\Repositories\Employee;

use App\Repositories\EloquentRepository;
use App\Employee;
use Auth;

class EloquentEmployeeRepository extends EloquentRepository implements EmployeeRepository {

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
    public function __construct(Employee $model) {
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

         $item->company_name  =  e($data['company_name']); 
         $item->first_name  =  e($data['first_name']); 
         $item->last_name  =  e($data['last_name']); 
         $item->gender  =  e($data['gender']); 
         $item->birthday  =  e($data['birthday']); 
         $item->tel  =  e($data['tel']); 
         $item->fax  =  e($data['fax']); 
         $item->email  =  e($data['email']); 
         $item->address  =  e($data['address']); 
         $item->image  =  e($data['image']); 
         $item->qualification  =  e($data['qualification']); 
         $item->recruitment_date  =  e($data['recruitment_date']); 
         $item->password  =  e($data['password']); 
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
      
         $item->company_name  =  e($data['company_name']); 
         $item->first_name  =  e($data['first_name']); 
         $item->last_name  =  e($data['last_name']); 
         $item->gender  =  e($data['gender']); 
         $item->birthday  =  e($data['birthday']); 
         $item->tel  =  e($data['tel']); 
         $item->fax  =  e($data['fax']); 
         $item->email  =  e($data['email']); 
         $item->address  =  e($data['address']); 
         $item->image  =  e($data['image']); 
         $item->qualification  =  e($data['qualification']); 
         $item->recruitment_date  =  e($data['recruitment_date']); 
         $item->password  =  e($data['password']); 
         $item->note  =  e($data['note']); 
         $item->save();

        return $item;
    }

}
