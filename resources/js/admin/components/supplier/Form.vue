<template>
<div class="card">
    <form role="form" @submit.prevent="storeSupplier()">
        <div class="card-header">
            <h3 v-if="action == 'edit'" class="card-title">{{ trans('text.edit-supplier')}}</h3>
            <h3 v-else class="card-title">{{ trans('text.add-supplier')}}</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.company_name')}}</label>
                <div class="col-lg-10">
                    <input type="text" name="company_name" class="form-control" v-model="supplier.company_name" @keydown='errors.clear("company_name")'>
                    <small class="form-text text-danger" v-if="errors.has('company_name')">{{errors.get('company_name')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.name')}}</label>
                <div class="col-lg-5">
                    <input type="text" name="first_name" :placeholder="trans('text.first_name')" class="form-control" v-model="supplier.first_name" @keydown='errors.clear("first_name")'>
                    <small class="form-text text-danger" v-if="errors.has('first_name')">{{errors.get('first_name')}}</small>
                </div>
                <div class="col-lg-5">
                    <input type="text" name="last_name" :placeholder="trans('text.last_name')" class="form-control" v-model="supplier.last_name" @keydown='errors.clear("last_name")'>
                    <small class="form-text text-danger" v-if="errors.has('last_name')">{{errors.get('last_name')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.gender')}}</label>
                <div class="col-lg-2">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="radioMale" name="gender" value="male" v-model="supplier.gender" class="custom-control-input">
                        <label class="custom-control-label" for="radioMale">{{ trans('text.male')}}</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="radiofemale" name="gender" value="female" v-model="supplier.gender" class="custom-control-input">
                        <label class="custom-control-label" for="radiofemale">{{ trans('text.female')}}</label>
                    </div>
                    <small class="form-text text-danger" v-if="errors.has('gender')">{{errors.get('gender')}}</small>
                </div>
                <label class="col-lg-2 col-form-label">{{ trans('text.birthday')}}</label>
                <div class="col-lg-2">
                    <input type="date" name="birthday" class="form-control" v-model="supplier.birthday" @keydown='errors.clear("birthday")'>
                    <small class="form-text text-danger" v-if="errors.has('birthday')">{{errors.get('birthday')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.email')}}</label>
                <div class="col-lg-10">
                    <input type="text" name="email" class="form-control" v-model="supplier.email" @keydown='errors.clear("email")'>
                    <small class="form-text text-danger" v-if="errors.has('email')">{{errors.get('email')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.tel')}}</label>
                <div class="col-lg-5">
                    <input type="text" name="tel" class="form-control" v-model="supplier.tel" @keydown='errors.clear("tel")'>
                    <small class="form-text text-danger" v-if="errors.has('tel')">{{errors.get('tel')}}</small>
                </div>
                <label class="col-lg-1 col-form-label">{{ trans('text.fax')}}</label>
                <div class="col-lg-4">
                    <input type="text" name="fax" class="form-control" v-model="supplier.fax" @keydown='errors.clear("fax")'>
                    <small class="form-text text-danger" v-if="errors.has('fax')">{{errors.get('fax')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.address')}}</label>
                <div class="col-lg-10">
                    <textarea name="address" class="form-control" v-model="supplier.address" rows="2" @change='errors.clear("address")' maxlength="50"></textarea>
                    <small class="form-text text-danger" v-if="errors.has('address')">{{errors.get('address')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.solde')}}</label>
                <div class="col-lg-5">
                    <input type="text" name="solde" class="form-control" v-model="supplier.solde" @keydown='errors.clear("solde")'>
                    <small class="form-text text-danger" v-if="errors.has('solde')">{{errors.get('solde')}}</small>
                </div>
                <label class="col-lg-1 col-form-label">{{ trans('text.solde_max')}}</label>
                <div class="col-lg-4">
                    <input type="text" name="solde_max" class="form-control" v-model="supplier.solde_max" @keydown='errors.clear("solde_max")'>
                    <small class="form-text text-danger" v-if="errors.has('solde_max')">{{errors.get('solde_max')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.reg_com')}}</label>
                <div class="col-lg-2">
                    <input type="text" name="reg_com" class="form-control" v-model="supplier.reg_com" @keydown='errors.clear("reg_com")'>
                    <small class="form-text text-danger" v-if="errors.has('reg_com')">{{errors.get('reg_com')}}</small>
                </div>
                <label class="col-lg-2 col-form-label">{{ trans('text.mat_fisc')}}</label>
                <div class="col-lg-2">
                    <input type="text" name="mat_fisc" class="form-control" v-model="supplier.mat_fisc" @keydown='errors.clear("mat_fisc")'>
                    <small class="form-text text-danger" v-if="errors.has('mat_fisc')">{{errors.get('mat_fisc')}}</small>
                </div>
                <label class="col-lg-2 col-form-label">{{ trans('text.num_art')}}</label>
                <div class="col-lg-2">
                    <input type="text" name="num_art" class="form-control" v-model="supplier.num_art" @keydown='errors.clear("num_art")'>
                    <small class="form-text text-danger" v-if="errors.has('num_art')">{{errors.get('num_art')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.note')}}</label>
                <div class="col-lg-10">
                    <textarea name="note" class="form-control" v-model="supplier.note" rows="3" @change='errors.clear("note")'></textarea>
                    <small class="form-text text-danger" v-if="errors.has('note')">{{errors.get('note')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" v-model="supplier.bloque" id="bloqueCheck">
                        <label class="custom-control-label" for="bloqueCheck">{{ trans('text.bloque')}}</label>
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

export default {
    props: ['action', 'supplier'],
    data() {
        return {
            errors: new Errors(),
            locale: fr,
        };
    },
    components: {
        Datepicker,
    },
    methods: {
        imageUploaded(image) {
            this.supplier.image = image;
        },

        toDate(date) {
            if (!date) {
                return null;
            } else {
                return moment(date).format('YYYY-MM-DD HH:mm:ss');
            }
        },

        storeSupplier() {
            var self = this;
            var data = this.supplier;
            data.birthday = this.toDate(this.supplier.birthday);

            if (this.action == 'edit') {
                axios.put('/api/suppliers/' + this.supplier.id, data)
                    .then((response) => {
                        self.$router.push('/admin/suppliers/' + response.data.supplier.id);
                        Event.$emit('notify', self.trans('text.supplier-edited'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.supplier-not-edited'), 'warning', self.trans('text.warning'));
                    });
            } else {
                axios.post('/api/suppliers', data)
                    .then((response) => {
                        self.$router.push('/admin/suppliers/' + response.data.supplier.id);
                        Event.$emit('notify', self.trans('text.supplier-added'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        console.log(error);
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.supplier-not-added'), 'warning', self.trans('text.warning'));
                    });
            }

        },
    },
}
</script>
