<template>
	<div class="card">
		<form role="form" @submit.prevent="storeBrand()">
		<div class="card-header">
			<h3 v-if="action == 'edit'" class="card-title">{{ trans('text.edit-brand')}}</h3>
			<h3 v-else class="card-title">{{ trans('text.add-brand')}}</h3>
		</div>
		<div class="card-body">
			<div class="form-group row">
					<label class="col-lg-2 col-form-label">{{ trans('text.name')}}</label>
					<div class="col-lg-10">
						<input type="text" name="name" class="form-control" v-model="brand.name" @keydown='errors.clear("name")'>
						<small class="form-text text-danger" v-if="errors.has('name')">{{errors.get('name')}}</small>
					</div>
			</div>
			<div class="form-group row">
					<label class="col-lg-2 col-form-label">{{ trans('text.description')}}</label>
					<div class="col-lg-10">
						<textarea  name="description" class="form-control" v-model="brand.description" rows="3"  @change='errors.clear("description")'></textarea>
						<small class="form-text text-danger" v-if="errors.has('description')">{{errors.get('description')}}</small>
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
	props: ['action', 'brand', 'brands'],
	data() {
		return {
			errors: new Errors(),
		};
	},
	methods: {
		storeBrand() {
			var self = this;
			var data = this.brand;
			if (this.action == 'edit') {
				axios.put('/api/brands/' + this.brand.id , data)
					.then((response) => {
						self.$emit('edited', response.data.brand);
						Event.$emit('notify', self.trans('text.brand-edited'), 'success', self.trans('text.success'));
					})
					.catch((error) => {
						self.errors.record(error);
						Event.$emit('notify', self.trans('text.brand-not-edited'), 'warning', self.trans('text.warning'));
					});
			} else {
				axios.post('/api/brands', data)
					.then((response) => {
							self.brands.push(response.data.brand);
							self.brand.name = '';
							self.brand.description = '';

						Event.$emit('notify', self.trans('text.brand-added'), 'success', self.trans('text.success'));
					})
					.catch((error) => {
						console.log(error);
						self.errors.record(error);
						Event.$emit('notify', self.trans('text.brand-not-added'), 'warning', self.trans('text.warning'));
					});
			}

		},
	},
}
</script>
