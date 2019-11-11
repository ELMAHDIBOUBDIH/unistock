<template>
	<div class="card">
		<form role="form" @submit.prevent="storeProduct()">
			<div class="card-header">
				<h3 v-if="action == 'edit'" class="card-title">{{ trans('text.edit-warehouse-product')}}</h3>
				<h3 v-else class="card-title">{{ trans('text.add-warehouse-product')}}</h3>
			</div>
			<div class="card-body">
				<div class="form-group row">
					<label class="col-form-label">{{ trans('text.reference')}}</label>
					<input type="text" name="reference" class="form-control" v-model="warehouse_product.reference" @keydown='errors.clear("reference")'>
					<small class="form-text text-danger" v-if="errors.has('reference')">{{errors.get('reference')}}</small>
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
	props: ['action', 'warehouse_product', 'products', 'warehouses'],
	data() {
		return {
			errors: new Errors(),
		};
	},
	methods: {
        storeProduct() {
            var self = this;
            var data = this.warehouse_product;
            if (this.action == 'edit') {
                axios.put('/api/warehouseproducts/' + this.warehouse_product.id, data)
                    .then((response) => {
						self.$router.push('/admin/warehouseproducts/' + response.data.warehouse_product.id );
                        Event.$emit('notify', self.trans('text.product-edited'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.product-not-edited'), 'warning', self.trans('text.warning'));
                    });
            } else {
                axios.post('/api/warehouseproducts', data)
                    .then((response) => {
                        self.$router.push('/admin/warehouseproducts/' + response.data.warehouse_product.id );
                        Event.$emit('notify', self.trans('text.warehouseproduct-added'), 'success', self.trans('text.success'));
                    })
                    .catch((error) => {
                        self.errors.record(error);
                        Event.$emit('notify', self.trans('text.warehouseproduct-not-added'), 'warning', self.trans('text.warning'));
                    });
            }

        },
    },
}
</script>
