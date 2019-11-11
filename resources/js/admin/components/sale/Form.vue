<template>
<div class="card">
    <form role="form" @submit.prevent="storeSale()">
        <div class="card-header text-center">
            <h3 v-if="action == 'edit'" class="card-title">{{ trans('text.edit-sale')}}</h3>
            <h3 v-else class="card-title">{{ trans('text.add-' + sale.type)}}</h3>
        </div>
        <div class="card-body bg-light border-top-grey-100 border-top-1 pt-3 ">
            <div class="row">
                <div class="col">
                    <div class="form-part border-1 border-blue-700 bg-white p-2">
                        <h3>{{ trans('text.piece-info')}}</h3>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">{{ trans('text.sale_number')}}</label>
                            <div class="col-lg-9">
                                <input type="text" name="sale_number" class="form-control" v-model="sale.sale_number" @keydown='errors.clear("sale_number")'>
                                <small class="form-text text-danger" v-if="errors.has('sale_number')">{{errors.get('sale_number')}}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">{{ trans('text.ref_id')}}</label>
                            <div class="col-lg-9">
                                <input type="text" name="ref_id" class="form-control" v-model="sale.ref_id" @keydown='errors.clear("ref_id")' disabled>
                                <small class="form-text text-danger" v-if="errors.has('ref_id')">{{errors.get('ref_id')}}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">{{ trans('text.date')}}</label>
                            <div class="col-lg-9">
                                <input type="date" name="date" class="form-control" v-model="sale.date" @keydown='errors.clear("date")'>
                                <small class="form-text text-danger" v-if="errors.has('date')">{{errors.get('date')}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-part border-1 border-green-700 bg-white p-2 clearfix">
                        <h3>{{ trans('text.customer')}}</h3>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">{{ trans('text.customer')}}</label>
                            <div class="col-lg-9">
                                <model-list-select :list="customers" option-value="id" :custom-text="customerDisplayText" v-model="customer_id" :placeholder="trans('text.search-customer')" @searchchange="searchCustomer"> </model-list-select>
                                <small class="form-text text-danger" v-if="errors.has('customer_id')">{{errors.get('customer_id')}}</small>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary pull-right " @click='addItem()'>{{ trans('text.add-customer')}}</button>
                    </div>
                    <div class="text-center mt-3">
                        {{selected_customer.address}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-xs table-bordered mb-1">
                <thead class="bg-light text-center">
                    <tr>
                        <th style="width: 45%">{{ trans('text.designation')}}</th>
                        <th style="width: 10%">{{ trans('text.quantity')}}</th>
                        <th style="width: 10%">{{ trans('text.price_ht')}}</th>
                        <th style="width: 10%">{{ trans('text.tax')}}</th>
                        <th style="width: 10%">{{ trans('text.amount_ht')}}</th>
                        <th style="width: 15%">{{ trans('text.amount_ttc')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for='item in items'>
                        <td>
                            {{item.product.designation}}
                            <model-list-select v-if="!item.product.designation" :list="products" option-value="id" :custom-text="optionDisplayText" v-model="item.product" :placeholder="trans('text.search-product')" @searchchange="searchProduct">
                            </model-list-select>
                        </td>
                        <td class="text-right">
                            <input type="number" name="quantity" step=".01" class="form-control" v-model="item.quantity">
                        </td>
                        <td class="text-right">{{item.product.price_ht}}</td>
                        <td class="text-right">{{item.product.tva}}</td>
                        <td class="text-right">{{multiply(item.product.price_ht, item.quantity )}}</td>
                        <td class="bg-light text-right">{{multiply(item.product.price_ttc, item.quantity )}}</td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-sm alpha-blue text-blue-800 border-blue-600 legitRipple" @click='addItem()'>{{ trans('text.add-item')}}</button>
        </div>

        <div class="card-body bg-light">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.valide')}}</label>
                        <div class="col-lg-5">
                            <switchery v-model="sale.valide"></switchery>
                            <small class="form-text text-danger" v-if="errors.has('valide')">{{errors.get('valide')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">{{ trans('text.note')}}</label>
                        <div class="col-lg-10">
                            <textarea name="note" class="form-control" v-model="sale.note" rows="3" @change='errors.clear("note")'></textarea>
                            <small class="form-text text-danger" v-if="errors.has('note')">{{errors.get('note')}}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row p-2  border-bottom-grey-100 border-bottom-1">
                        <div class="col-md-6">{{ trans('text.remise')}}</div>
                        <div class="col-md-6">
                            <input type="text" checked name="remise" class="form-control" v-model="sale.remise" @keydown='errors.clear("remise")'>
                            <small class="form-text text-danger" v-if="errors.has('remise')">{{errors.get('remise')}}</small>
                        </div>
                    </div>
                    <div class="row p-2  border-bottom-grey-100 border-bottom-1 font-weight-bold">
                        <div class="col-md-6">{{ trans('text.total_ht')}}</div>
                        <div class="col-md-6 text-right">{{total_ht}}</div>
                    </div>
                    <div class="row p-2  border-bottom-grey-100 border-bottom-1 font-weight-bold">
                        <div class="col-md-6">{{ trans('text.total_tva')}}</div>
                        <div class="col-md-6 text-right">{{total_tva}}</div>
                    </div>
                    <div class="row p-2  border-bottom-grey-100 border-bottom-1 font-weight-bold">
                        <div class="col-md-6">{{ trans('text.total_ttc')}}</div>
                        <div class="col-md-6 text-right">{{total_ttc}}</div>
                    </div>
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
import {
    ModelListSelect
} from 'vue-search-select'


export default {
    props: ['action', 'sale'],
    data() {
        return {
            errors: new Errors(),
            locale: fr,
            items: [],
            customer_id: '',
            selected_customer: '',
            products: [],
            customers: [],
        };
    },
    components: {
        Datepicker,
        ModelListSelect
    },
    computed: {
        total_ht: function() {
            var total_ht = 0;
            for (var i = 0; i < this.items.length; i++) {
              if (this.items[i].product.price_ht) {
                total_ht +=  parseFloat(this.items[i].product.price_ht) ;
              }
            }
            return total_ht.toFixed(2)
        },
        total_tva: function() {
          var total_tva = 0;
          for (var i = 0; i < this.items.length; i++) {
            if (this.items[i].product.price_ht) {
              total_tva +=  parseFloat(this.items[i].product.price_ttc) - parseFloat(this.items[i].product.price_ht) ;
            }
          }
          return total_tva.toFixed(2)
        },
        total_ttc: function() {
          var total_ttc = 0;
          for (var i = 0; i < this.items.length; i++) {
            if (this.items[i].product.price_ttc) {
              total_ttc +=  parseFloat(this.items[i].product.price_ttc) ;
            }
          }
          return total_ttc.toFixed(2)
        }
    },
    methods: {
        imageUploaded(image) {
            this.sale.image = image;
        },
        multiply(x, y) {
            if (x && y) {
                return Math.round(x * y * 100) / 100;
            } else {
                return 0;
            }
        },
        addItem() {
            var item = {
                product: {},
                designation: 'select product',
                quantity: '1.00',
                pu: '10',
                discount: '10%',
                amount: '10'
            }
            this.items.push(item);
        },
        searchProduct(searchText) {
            var self = this;
            axios.get(`/api/products/search?q=` + searchText)
                .then(response => {
                    self.products = response.data.resluts
                })
                .catch(error => {
                    console.log(error)
                })
        },
        searchCustomer(searchText) {
            var self = this;
            axios.get(`/api/customers/search?q=` + searchText)
                .then(response => {
                    self.customers = response.data.resluts
                })
                .catch(error => {
                    console.log(error)
                })
        },

        optionDisplayText(product) {
            return product.designation
        },
        customerDisplayText(customer) {
            return customer.first_name + ' ' + customer.last_name
        },

        toDate(date) {
            if (!date) {
                return null;
            } else {
                return moment(date).format('YYYY-MM-DD HH:mm:ss');
            }
        },

        storeSale() {
            var self = this;
            var data = this.sale;
            data.birthday = this.toDate(this.sale.birthday);

            if (this.action == 'edit') {
                axios.put('/api/sales/' + this.sale.id, data)
                    .then((response) => {
                        self.$router.push('/admin/sales/' + response.data.sale.id);
                        Event.$emit('notify', self.trans('text.sale-edited'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.sale-not-edited'), 'warning', self.trans('text.warning'));
                    });
            } else {
                axios.post('/api/sales', data)
                    .then((response) => {
                        self.$router.push('/admin/sales/' + response.data.sale.id);
                        Event.$emit('notify', self.trans('text.sale-added'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        console.log(error);
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.sale-not-added'), 'warning', self.trans('text.warning'));
                    });
            }

        },
    },
    watch: {
        customer_id: function(customer_id) {
            for (var i = 0; i < this.customers.length; i++) {
                if (this.customers[i].id === customer_id) {
                    this.selected_customer = this.customers[i];
                }
            }
        },
    }
}
</script>
