<template>
<div class="card">
    <form role="form" @submit.prevent="storeWarehouse()">
        <div class="card-header">
            <h3 v-if="action == 'edit'" class="card-title">{{ trans('text.edit-warehouse')}}</h3>
            <h3 v-else class="card-title">{{ trans('text.add-warehouse')}}</h3>
        </div>

        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.name')}}</label>
                <div class="col-lg-10">
                    <input type="text" name="name" class="form-control" v-model="warehouse.name" @keydown='errors.clear("name")'>
                    <small class="form-text text-danger" v-if="errors.has('name')">{{errors.get('name')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.address')}}</label>
                <div class="col-lg-10">
                    <textarea  name="address" class="form-control" v-model="warehouse.address" rows="3"  @change='errors.clear("address")'></textarea>
                    <small class="form-text text-danger" v-if="errors.has('address')">{{errors.get('address')}}</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{ trans('text.note')}}</label>
                <div class="col-lg-10">
                    <textarea  name="note" class="form-control" v-model="warehouse.note" rows="3"  @change='errors.clear("note")'></textarea>
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

export default {
    props: ['action', 'warehouse', 'warehouses'],
    data() {
        return {
            errors: new Errors(),
        };
    },
    methods: {
        storeWarehouse() {
            var self = this;
            var data = this.warehouse;
            if (this.action == 'edit') {
                axios.put('/api/warehouses/' + this.warehouse.id, data)
                    .then((response) => {
                        self.$emit('edited', response.data.warehouse);
                        Event.$emit('notify', self.trans('text.warehouse-edited'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.warehouse-not-edited'), 'warning', self.trans('text.warning'));
                    });
            } else {
                axios.post('/api/warehouses', data)
                    .then((response) => {
                        self.warehouses.push(response.data.warehouse);
                        self.warehouse.name = '';
                        self.warehouse.address = '';
                        self.warehouse.note = '';


                        Event.$emit('notify', self.trans('text.warehouse-added'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        console.log(error);
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.warehouse-not-added'), 'warning', self.trans('text.warning'));
                    });
            }

        },
    },
}
</script>
