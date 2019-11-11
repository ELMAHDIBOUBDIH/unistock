<?php

namespace App\Repositories\Customer;

use App\Repositories\EloquentRepository;
use App\Customer;
use Auth;

class EloquentCustomerRepository extends EloquentRepository implements CustomerRepository {

    /**
     * The eloquent model instance.
     *
     * @var \App\Models\Incident
     */
    public  $model;

    /**
     * Create a new eloquent incident repository instance.
     *
     * @param \App\Models\Incident $model
     */
    public function __construct(Customer $model) {
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
         $item->group_id  =  e($data['group_id']); 
         $item->first_name  =  e($data['first_name']); 
         $item->last_name  =  e($data['last_name']); 
         $item->gender  =  e($data['gender']); 
         $item->birthday  =  e($data['birthday']); 
         $item->tel  =  e($data['tel']); 
         $item->fax  =  e($data['fax']); 
         $item->address  =  e($data['address']); 
         $item->email  =  e($data['email']); 
         $item->image  =  e($data['image']); 
         $item->solde  =  e($data['solde']); 
         $item->solde_max  =  e($data['solde_max']); 
         $item->reg_com  =  e($data['reg_com']); 
         $item->mat_fisc  =  e($data['mat_fisc']); 
         $item->Num_art  =  e($data['num_art']); 
         $item->bloque  =  e($data['bloque']); 
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
         
         $item->group_id  =  e($data['group_id']); 
         $item->company_name  =  e($data['company_name']); 
         $item->first_name  =  e($data['first_name']); 
         $item->last_name  =  e($data['last_name']); 
         $item->gender  =  e($data['gender']); 
         $item->birthday  =  e($data['birthday']); 
         $item->tel  =  e($data['tel']); 
         $item->fax  =  e($data['fax']); 
         $item->address  =  e($data['address']); 
         $item->email  =  e($data['email']); 
         $item->image  =  e($data['image']); 
         $item->solde  =  e($data['solde']); 
         $item->solde_max  =  e($data['solde_max']); 
         $item->reg_com  =  e($data['reg_com']); 
         $item->mat_fisc  =  e($data['mat_fisc']); 
         $item->Num_art  =  e($data['num_art']); 
         $item->bloque  =  e($data['bloque']); 
         $item->note  =  e($data['note']);    
         $item->save();

        return $item;
    }
    /**
     * search a model by ref , category,etat,brand,.
     *
     * @param string   $category
     * @param string $etat
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function search_filter(array $data) {

       $query = $this->model;
             
       if (isset($data['customer']) ) {

        $query = $query->Where('first_name','like', '%'. $data['customer'].'%')

        ->orWhere('last_name'  ,'like', '%'.$data['customer'].'%');

      }

      if (isset($data['company_name']) ) {

        $query = $query->Where('company_name' ,'like', '%'.$data['company_name'].'%');
         
      }
      if(isset($data['bloque'])){
       
        $query = $query->Where(['bloque'  => (int) $data['bloque']]);

      }
      if(isset($data['solde'])){
       
        $query = $query->Where('solde',$data['signe'],(float) $data['solde']);

      }
      if(isset($data['group'])){
       
        $query = $query->Where('group_id',$data['signe'],(float) $data['group']);

      }
     
     if (isset($data['sort'])) {
        return $query = $query->orderBy($data['sort'], $data['direction'])->paginate(13);
       }
       else
       {
        return $query->orderBy('id', 'desc')->paginate(13);
       }     
  }

}
