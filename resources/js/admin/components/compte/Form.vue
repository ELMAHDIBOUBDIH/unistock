<template>
<div class="card">
    <form role="form" @submit.prevent="storeCategory()">
        <div class="card-header">
            <h3 v-if="action == 'edit'" class="card-title">{{ trans('text.edit-compte')}}</h3>
            <h3 v-else class="card-title">{{ trans('text.add-compte')}}</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.num')}}</label>
                <div class="col-lg-10">
                    <input type="text" name="num" class="form-control" v-model="compte.num" @keydown='errors.clear("num")'>
                    <small class="form-text text-danger" v-if="errors.has('num')">{{errors.get('num')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.name')}}</label>
                <div class="col-lg-10">
                    <input type="text" name="name" class="form-control" v-model="compte.name" @keydown='errors.clear("name")'>
                    <small class="form-text text-danger" v-if="errors.has('name')">{{errors.get('name')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.nature')}}</label>
                <div class="col-lg-10">
                    <select class="form-control" name="nature" v-model="compte.nature">
                        <option value="caisse">caisse</option>
                        <option value="banque">banque</option>
                    </select>
                    <small class="form-text text-danger" v-if="errors.has('nature')">{{errors.get('nature')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.solde_init')}}</label>
                <div class="col-lg-10">
                    <input type="number" name="solde_init" class="form-control" v-model="compte.solde_init" @keydown='errors.clear("solde_init")'>
                    <small class="form-text text-danger" v-if="errors.has('solde_init')">{{errors.get('solde_init')}}</small>
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

export default {
    props: ['action', 'compte', 'comptes'],
    data() {
        return {
            errors: new Errors(),
        };
    },
    methods: {
        storeCategory() {
            var self = this;
            var data = this.compte;
            if (this.action == 'edit') {
                axios.put('/api/comptes/' + this.compte.id, data)
                    .then((response) => {
                        self.$emit('edited', response.data.compte);
                        Event.$emit('notify', self.trans('text.compte-edited'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.compte-not-edited'), 'warning', self.trans('text.warning'));
                    });
            } else {
                axios.post('/api/comptes', data)
                    .then((response) => {
                        self.comptes.push(response.data.compte);
                        self.compte.num = '';
                        self.compte.name = '';
                        self.compte.nature = '';
                        self.compte.solde_init = '';


                        Event.$emit('notify', self.trans('text.compte-added'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        console.log(error);
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.compte-not-added'), 'warning', self.trans('text.warning'));
                    });
            }

        },
    },
}
</script>
