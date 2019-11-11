<template>
<div class="card">
    <form role="form" @submit.prevent="storeProduct()">
        <div class="card-header bg-light">
            <h3 v-if="action == 'edit'" class="card-title">{{ trans('text.edit-product')}}</h3>
            <h3 v-else class="card-title">{{ trans('text.add-product')}}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.reference')}}</label>
                        <div class="col-lg-3">
                            <input type="text" name="reference" class="form-control" v-model="product.reference" @keydown='errors.clear("reference")'>
                            <small class="form-text text-danger" v-if="errors.has('reference')">{{errors.get('reference')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.designation')}}</label>
                        <div class="col-lg-6">
                            <input type="text" name="designation" class="form-control" v-model="product.designation" @keydown='errors.clear("designation")'>
                            <small class="form-text text-danger" v-if="errors.has('designation')">{{errors.get('designation')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.unit')}}</label>
                        <div class="col-lg-2">
                            <input type="text" name="unit" class="form-control" v-model="product.unit" @keydown='errors.clear("unit")'>
                            <small class="form-text text-danger" v-if="errors.has('unit')">{{errors.get('unit')}}</small>
                        </div>
                        <label class="col-lg-2 col-form-label text-right">{{ trans('text.cond')}}</label>
                        <div class="col-lg-2">
                            <input type="text" name="cond" class="form-control" v-model="product.cond" @keydown='errors.clear("cond")'>
                            <small class="form-text text-danger" v-if="errors.has('cond')">{{errors.get('cond')}}</small>
                        </div>
                        <label class="col-lg-2 col-form-label text-right">{{ trans('text.tva')}}</label>
                        <div class="col-lg-2">
                            <input type="text" name="tva" class="form-control" v-model="product.tva" @keydown='errors.clear("tva")' @input="onChange">
                            <small class="form-text text-danger" v-if="errors.has('tva')">{{errors.get('tva')}}</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.category')}}</label>
                        <div class="col-lg-4">
                            <select2 v-model="product.category_id" :options='categories' name='category_id'  ></select2>
                            <small class="form-text text-danger" v-if="errors.has('category')">{{errors.get('category')}}</small>
                        </div>

                        <label class="col-lg-2 col-form-label text-right">{{ trans('text.brand')}}</label>
                        <div class="col-lg-4">
                            <select2 v-model="product.brand_id" :options='brands' name='brand_id' ></select2>
                            <small class="form-text text-danger" v-if="errors.has('brand_id')">{{errors.get('brand_id')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.product_facturable')}}</label>
                        <div class="col-lg-4">
                            <switchery v-model="product.product_facturable" :checked='product.product_facturable != 0 ?true:false'  ></switchery>
                            <small class="form-text text-danger" v-if="errors.has('product_facturable')">{{errors.get('product_facturable')}}</small>
                        </div>

                        <label class="col-lg-2 col-form-label">{{ trans('text.product_perissable')}}</label>
                        <div class="col-lg-4">
                            <switchery v-model="product.product_perissable" color="#FF5722" @input="btnStatus" 
                            :checked='product.product_perissable != 0 ?true:false'></switchery>
                            <small class="form-text text-danger" v-if="errors.has('product_perissable')">{{errors.get('product_perissable')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.date_p')}}</label>
                        <div class="col-lg-4">
                            <date-piker v-model="product.date_p"  name="date_p" :disabled="product.product_perissable != 0 ?false:true" ></date-piker>
                            <small class="form-text text-danger" v-if="errors.has('date_p')">{{errors.get('date_p')}}</small>
                        </div>

                        <label class="col-lg-2 col-form-label">{{ trans('text.alert_p')}}</label>
                        <div class="col-lg-4">
                            <date-piker v-model="product.alert_p"  name="alert_p" :disabled="product.product_perissable != 0 ?false:true" v-value='product.alert_p' ></date-piker>
                            <small class="form-text text-danger" v-if="errors.has('alert_p')">{{errors.get('alert_p')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.etat')}}</label>
                        <div class="col-lg-4">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input v-model="product.etat" value="actif" type="radio" class="custom-control-input" name="custom-inline-radio" id="custom_radio_inline_actif" :checked='product.etat != 0 ?true:false'>
                                <label class="custom-control-label" for="custom_radio_inline_actif">{{ trans('text.actif')}}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input v-model="product.etat" value="sommeil" type="radio" class="custom-control-input" name="custom-inline-radio" id="custom_radio_inline_sommeil" :checked='product.etat != 0 ?true:false'>
                                <label class="custom-control-label" for="custom_radio_inline_sommeil">{{ trans('text.sommeil')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <upload-image @uploaded="imageUploaded" :nbr="1" :type="'products'" :image_path="product.image" :image_id="product.image_id"></upload-image>
                            <small class="form-text text-danger" v-if="errors.has('image')">{{errors.get('image')}}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('text.code_barre')}}</label>
                        <input type="text" name="code_barre" class="form-control" v-model="product.code_barre" @keydown='errors.clear("code_barre")'>
                        <small class="form-text text-danger" v-if="errors.has('code_barre')">{{errors.get('code_barre')}}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body bg-light">
            <h3>{{ trans('text.price-warehouse')}}</h3>
            <div class="row">
                <div class="col-md-6">
                    <h4>{{ trans('text.purchase-price')}}</h4>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.price_ht')}}</label>
                        <div class="col-lg-10">
                            <input type="text" name="ht" class="form-control" v-model="product.price_ht" @keydown='errors.clear("ht")' placeholder="0.00" @input="onChange" >
                            <small class="form-text text-danger" v-if="errors.has('ht')">{{errors.get('ht')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.price_ttc')}}</label>
                        <div class="col-lg-10">
                            <input type="text" name="price_ttc" class="form-control" v-model="product.price_ttc" @keydown='errors.clear("price_ttc")'  placeholder="0.00">
                            <small class="form-text text-danger" v-if="errors.has('price_ttc')">{{errors.get('price_ttc')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.pmp')}}</label>
                        <div class="col-lg-10">
                            <input type="text" name="pmp" class="form-control" v-model="product.pmp" @keydown='errors.clear("pmp")'   placeholder="0.00">
                            <small class="form-text text-danger" v-if="errors.has('pmp')">{{errors.get('pmp')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.last_price')}}</label>
                        <div class="col-lg-10">
                            <input type="text" name="last_price" class="form-control" v-model="product.last_price" @keydown='errors.clear("last_price")' placeholder="0.00">
                            <small class="form-text text-danger" v-if="errors.has('last_price')">{{errors.get('last_price')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.supplier')}}</label>
                        <div class="col-lg-10">
                            <select2 v-model="product.supplier_id" :options='suppliers' @selected='product.supplier_id'></select2>
                            <small class="form-text text-danger" v-if="errors.has('supplier')">{{errors.get('supplier')}}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>{{ trans('text.warehouse')}}</h4>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.qnt_initial')}}</label>
                        <div class="col-lg-10">
                            <input type="text" name="qnt_initial" class="form-control" v-model="product.qnt_initial" @keydown='errors.clear("qnt_initial")'  placeholder="0.00">
                            <small class="form-text text-danger" v-if="errors.has('qnt_initial')">{{errors.get('qnt_initial')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.alert_stock')}}</label>
                        <div class="col-lg-10">
                            <input type="text" name="alert_stock" class="form-control" v-model="product.alert_stock" @keydown='errors.clear("alert_stock")'  placeholder="0.00" >
                            <small class="form-text text-danger" v-if="errors.has('alert_stock')">{{errors.get('alert_stock')}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
          <h4>{{ trans('text.sale-price')}}</h4>
          <div class="table-responsive">
              <table class="table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>{{ trans('text.price_ht')}}</th>
                          <th>{{ trans('text.price_ttc')}}</th>
                          <th>{{ trans('text.marge')}}</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-for="group in groups">
                          <td>{{group.name}}</td>
                          <td><input type="text" class="form-control" v-model="prices.price_ht[group.id]" :name="'price_ht'+ group.id" @input="onChange(group.id)"></td>
                          <td><input type="text" class="form-control" v-model="prices.price_ttc[group.id]" :name="'price_ttc'+ group.id" @value="prices.price_ttc[group.id]" @input="onChange(group.id)"></td>
                          <td><input type="text" class="form-control" v-model="prices.marge[group.id]" :name="'marge'+ group.id" @input="onChange(group.id)" ></td>
                      </tr>
                  </tbody>
              </table>
          </div>
        </div>
        <div class="card-body bg-light">
            <h3>{{ trans('text.pack-price')}}</h3>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.pack')}}</label>
                <div class="col-lg-10">
                  <switchery v-model="product.pack" color="#FF9800"  :checked='product.pack != 0 ?true:false'></switchery>
                </div>
            </div>
        <div v-if="product.pack !=0">
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.qnt_pack')}}</label>
                <div class="col-lg-4">
                    <input type="number" name="qnt_pack" class="form-control" v-model="product.qnt_pack" @keydown='errors.clear("qnt_pack")' @input="onChange" >
                    <small class="form-text text-danger" v-if="errors.has('qnt_pack')">{{errors.get('qnt_pack')}}</small>
                </div>

                <label class="col-lg-2 col-form-label">{{ trans('text.price_pack')}}</label>
                <div class="col-lg-4">
                    <input type="number" name="price_pack" class="form-control" v-model="product.price_pack" @keydown='errors.clear("price_pack")'>
                    <small class="form-text text-danger" v-if="errors.has('price_pack')">{{errors.get('price_pack')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.price_unit_pack')}}</label>
                <div class="col-lg-4">
                    <input type="number" name="price_unit_pack" class="form-control" v-model="product.price_unit_pack" @keydown='errors.clear("price_unit_pack")' @input="onChange">
                    <small class="form-text text-danger" v-if="errors.has('price_unit_pack')">{{errors.get('price_unit_pack')}}</small>
                </div>
            </div>
        </div>

        </div>
        <div class="card-body">
          <div class="form-group row">
              <label class="col-lg-2 col-form-label">{{ trans('text.note')}}</label>
              <div class="col-lg-10">
                <textarea name="note" class="form-control" v-model="product.note" rows="3" @change='errors.clear("note")'></textarea>
                  <small class="form-text text-danger" v-if="errors.has('note')">{{errors.get('note')}}</small>
              </div>
          </div>
        </div>
        <div class="card-footer text-right">
            <button v-if="action == 'edit'" type="submit" class="btn btn-primary btn-sm ">{{ trans('text.update')}}</button>
            <button v-else type="submit" class="btn btn-primary btn-sm ">{{ trans('text.add')}}</button>
        </div>
    </form>
</div>
</template>
<script>
const Errors = require('../../../errors.js');
import {
    fr
} from 'vuejs-datepicker/dist/locale'
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';

export default {
    props: ['action', 'product', 'groups', 'brands', 'categories', 'suppliers','prices'],
    data() {
        return {
            errors: new Errors(),
            locale: fr,
            btnDisable: true,

        };
    },
    components: {
        Datepicker,
    },
    methods: {
        imageUploaded(image) {console.log(this.product.image);
            this.product.image = image;
        },

        toDate(date) {
             if (!date) {
                return null;
            } else {

                return moment(date).format('YYYY-MM-DD');
            }
        },


        storeProduct() {
            var self = this;
            var data = [this.product,this.prices];
            
            data[0].birthday = this.toDate(this.product.birthday);
            data[0].alert_p = this.toDate(data[0].alert_p);
            data[0].date_p = this.toDate(data[0].date_p);
            if (this.action == 'edit') {

                axios.put('/api/products/' + this.product.id , data)
                    .then((response) => {
                        self.$router.push('/admin/products/' + response.data.product.id);
                        Event.$emit('notify', self.trans('text.product-edited'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.product-not-edited'), 'warning', self.trans('text.warning'));
                    });
            } else {
               
                axios.post('/api/products', data)
                    .then((response) => {
                      
                        self.$router.push('/admin/products/' + response.data.product.id);
                        Event.$emit('notify', self.trans('text.product-added'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        console.log(error);
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.product-not-added'), 'warning', self.trans('text.warning'));
                    });
            }

        },
        onChange(id){
         var self = this;
         var  price_ht = this.prices.price_ht[id] ;
         var  marge = this.prices.marge[id] ;
         var  price_ttc = this.prices.price_ttc[id];
         var name = event.target.name ; 
         if (name ==='marge'+id && price_ht !=null ) {
            this.prices.price_ttc[id] =parseFloat(price_ht) + (parseFloat(price_ht) * (parseFloat(marge)/100));
         }
         if (name ==='price_ht'+id && marge !=null ) {
            console.log(marge);
            this.prices.price_ttc[id] =parseFloat(price_ht) + (parseFloat(price_ht) * (parseFloat(marge)/100));
         }
          if (name ==='price_ttc'+id  ) {
             console.log(this.prices.marge[id]);
            this.prices.marge[id] =(parseFloat(price_ttc) - parseFloat(price_ht)) * 100 / parseFloat(price_ht);
         }
          if (name ==='ht' || (name ==='tva' && this.product.price_ht !='')) {
            
            this.product.price_ttc =parseFloat(this.product.price_ht) + (parseFloat(this.product.price_ht) * (parseFloat(this.product.tva)/100));
         }
          if ((name ==='qnt_pack' && this.product.price_unit_pack!=null) || (name ==='price_unit_pack' && this.product.qnt_pack!=null) ) {
            
            this.product.price_pack =parseFloat(this.product.price_unit_pack) * parseFloat(this.product.qnt_pack);
         }

         
        },
         btnStatus(){
      if (this.product.product_perissable) {
         this.btnDisable = false;
     }else{
         this.btnDisable = true;
     }
     
      },
    },
}
</script>
