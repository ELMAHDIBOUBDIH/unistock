<template>
	<div class="card">
		<form role="form" @submit.prevent="storeCustomergroup()">
		<div class="card-header">
			<h3 v-if="action == 'edit'" class="card-title">{{ trans('text.edit-customergroup')}}</h3>
			<h3 v-else class="card-title">{{ trans('text.add-customergroup')}}</h3>
		</div>
		<div class="card-body">
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">{{ trans('text.name')}}</label>
					<div class="col-lg-10">
						<input type="text" name="name" class="form-control" v-model="customergroup.name" @keydown='errors.clear("name")'>
						<small class="form-text text-danger" v-if="errors.has('name')">{{errors.get('name')}}</small>
				</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">{{ trans('text.description')}}</label>
					<div class="col-lg-10">
						<textarea  name="description" class="form-control" v-model="customergroup.description" rows="3"  @change='errors.clear("description")'></textarea>
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
	props: ['action', 'customergroup', 'customergroups'],
	data() {
		return {
			errors: new Errors(),
		};
	},
	methods: {
		storeCustomergroup() {
			var self = this;
			var data = this.customergroup;
			if (this.action == 'edit') {
				axios.put('/api/customergroups/' + this.customergroup.id , data)
					.then((response) => {
						self.$emit('edited', response.data.customergroup);
						Event.$emit('notify', self.trans('text.customergroup-edited'), 'success', self.trans('text.success'));
					})
					.catch((error) => {
						self.errors.record(error);
						Event.$emit('notify', self.trans('text.customergroup-not-edited'), 'warning', self.trans('text.warning'));
					});
			} else {
				axios.post('/api/customergroups', data)
					.then((response) => {
							self.customergroups.push(response.data.customergroup);
							self.customergroup.name = '';
							self.customergroup.description = '';
						Event.$emit('notify', self.trans('text.customergroup-added'), 'success', self.trans('text.success'));
					})
					.catch((error) => {
						self.errors.record(error);
						Event.$emit('notify', self.trans('text.customergroup-not-added'), 'warning', self.trans('text.warning'));
					});
			}

		},
	},
}
</script>
