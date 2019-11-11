<?php

namespace App\Repositories\Product;

use App\Repositories\EloquentRepository;
use App\Repositories\PriceProduct\PriceProductRepository;
use App\Repositories\CustomerGroup\CustomerGroupRepository;
use App\Product;
use Auth;
use Illuminate\Support\Facades\DB;

class EloquentProductRepository extends EloquentRepository implements ProductRepository {

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
    public function __construct(Product $model ,PriceProductRepository $price_product,CustomerGroupRepository $CustomerGroup) {
        $this->model = $model;
        $this->price_product =  $price_product;
        $this->CustomerGroup =  $CustomerGroup;
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

       $product = $data[0];
       $prices = $data[1];
       $item = new $this->model;
       $item->category_id      =  e($product['category_id']); 
       $item->supplier_id      =  e($product['supplier_id']); 
       $item->brand_id         =  e($product['brand_id']); 
       $item->reference        =  e($product['reference']); 
       $item->designation      =  e($product['designation']); 
       $item->code_barre       =  e($product['code_barre']); 
       $item->unit             =  e($product['unit']); 
       $item->cond             =  e($product['cond']); 
       $item->tva              =  e($product['tva']); 
       $item->product_facturable  =  $product['product_facturable']; 
       $item->product_perissable  =  $product['product_perissable']; 
       $item->date_p           =     $product['date_p']; 
       $item->alert_p          =     $product['alert_p']; 
       $item->etat             =  e($product['etat']); 
       $item->image            =  e($product['image']);  
       $item->price_ht         =  e($product['price_ht']); 
       $item->price_ttc        =  e($product['price_ttc']); 
       $item->last_price       =  e($product['last_price']); 
       $item->pmp              =  e($product['pmp']); 
       $item->qnt_initial      =  e($product['qnt_initial']); 
       $item->alert_stock      =  e($product['alert_stock']); 
       $item->pack             =  $product['pack']; 
       $item->qnt_pack         =  e($product['qnt_pack']); 
       $item->price_pack       =  e($product['price_pack']); 
       $item->price_unit_pack  =  e($product['price_unit_pack']); 
       $item->note             =  e($product['note']); 
   
       $item->save();

       $product_id  = $this->model->select('id')->orderBy('id', 'desc')->first();
    
        for ($i=1; $i < count($prices['price_ht']) ; $i++) { 

          if(!(is_null($prices['price_ht'][$i]) && is_null($prices['price_ttc'][$i])))  {
            $this->
           $price_product = new $this->price_product->model;
           $price_product->montant_ht    = $prices['price_ht'][$i] ;
           $price_product->montant_ttc   = $prices['price_ttc'][$i] ;
           $price_product->product_id    = $product_id['id'] ;
           $price_product->group_id      = $i;
           $price_product->save();
          }
        }
       
      
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
      
       $product = $data[0];
       $prices = $data[1];
       $item->category_id      =  e($product['category_id']); 
       $item->supplier_id      =  e($product['supplier_id']); 
       $item->brand_id         =  e($product['brand_id']); 
       $item->reference        =  e($product['reference']); 
       $item->designation      =  e($product['designation']); 
       $item->code_barre       =  e($product['code_barre']); 
       $item->unit             =  e($product['unit']); 
       $item->cond             =  e($product['cond']); 
       $item->tva              =  e($product['tva']); 
       $item->product_facturable  =  $product['product_facturable']; 
       $item->product_perissable  =  $product['product_perissable']; 
       $item->date_p           =     $product['date_p']; 
       $item->alert_p          =     $product['alert_p']; 
       $item->etat             =  e($product['etat']); 
       $item->image            =  e($product['image']);  
       $item->price_ht         =  e($product['price_ht']); 
       $item->price_ttc        =  e($product['price_ttc']); 
       $item->last_price       =  e($product['last_price']); 
       $item->pmp              =  e($product['pmp']); 
       $item->qnt_initial      =  e($product['qnt_initial']); 
       $item->alert_stock      =  e($product['alert_stock']); 
       $item->pack             =  $product['pack']; 
       $item->qnt_pack         =  e($product['qnt_pack']); 
       $item->price_pack       =  e($product['price_pack']); 
       $item->price_unit_pack  =  e($product['price_unit_pack']); 
       $item->note             =  e($product['note']);

       $item->save();

        for ($i=1; $i < count($prices['price_ht']) ; $i++) { 

          if(!(is_null($prices['price_ht'][$i]) && is_null($prices['price_ttc'][$i])))  {

           $price_product =$this->price_product->model->where([['product_id',$item->id],['group_id',$i]])->first();
           if($price_product['id'] == null){

              $price_product = new $this->price_product->model;
              $price_product->product_id    = $item->id ;  
           }
          
              
          
              $price_product->montant_ht    = $prices['price_ht'][$i] ;
              $price_product->montant_ttc   = $prices['price_ttc'][$i] ;
              $price_product->group_id      = $i;
              $price_product->save();
           
          }
        }
       
      
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
    public function search_input(array $data) {

       $query = $this->model;
      
       if (isset($data['reference']) ) {

        $query = $query->Where(['reference' =>  $data['reference']]);

      }

       if (isset($data['designation']) ) {

        $query = $query->Where('designation'  ,'like', '%'.$data['designation'].'%');

       }   

      if (isset($data['category']) ) {

        $query = $query->Where(['category_id'  =>  $data['category']]);
         
      }
      if(isset($data['etat'])){
       
        $query = $query->Where(['etat'  => (int) $data['etat']]);

      }
      if(isset($data['brand'])){

        $query = $query->where(['brand_id'  =>  $data['brand']]);

      }


       if (isset($data['sort'])) {

          $query = $query->orderBy($data['sort'], $data['direction'])->paginate(13);

       } else
       {
        return $query->orderBy('id', 'desc')->paginate(13);
       }        
    

        
  }
    
}
