<template>
	<div class="card">
		<form role="form" @submit.prevent="storeCategory()">
		<div class="card-header">
			<h3 v-if="action == 'edit'" class="card-title">{{ trans('text.edit-category')}}</h3>
			<h3 v-else class="card-title">{{ trans('text.add-category')}}</h3>
		</div>
		<div class="card-body">
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">{{ trans('text.name')}}</label>
					<div class="col-lg-10">
						<input type="text" name="name" class="form-control" v-model="category.name" @keydown='errors.clear("name")'>
						<small class="form-text text-danger" v-if="errors.has('name')">{{errors.get('name')}}</small>
				</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">{{ trans('text.description')}}</label>
					<div class="col-lg-10">
						<textarea  name="description" class="form-control" v-model="category.description" rows="3"  @change='errors.clear("description")'></textarea>
						<small class="form-text text-danger" v-if="errors.has('description')">{{errors.get('description')}}</small>
				</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-2 col-form-label">{{ trans('text.parent')}}</label>
					<div class="col-lg-10">
						<select name="parent_id" v-model="category.parent_id" class="form-control"  @change='errors.clear("parent_id")'>
							<option value="" selected ></option>
							<option v-for="cat in all_categories" v-if="cat.id !== category.id" :value="cat.id">{{cat.name}}</option>
						</select>
						<small class="form-text text-danger" v-if="errors.has('parent_id')">{{errors.get('parent_id')}}</small>
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
	props: ['action', 'category', 'all_categories', 'categories'],
	data() {
		return {
			errors: new Errors(),
		};
	},
	methods: {
		storeCategory() {
			var self = this;
			var data = this.category;
			if (this.action == 'edit') {
				axios.put('/api/categories/' + this.category.id , data)
					.then((response) => {
						self.$emit('edited', response.data.category);
						Event.$emit('notify', self.trans('text.category-edited'), 'success', self.trans('text.success'));
					})
					.catch((error) => {
						self.errors.record(error);
						Event.$emit('notify', self.trans('text.category-not-edited'), 'warning', self.trans('text.warning'));
					});
			} else {
				
				axios.post('/api/categories', data)
					.then((response) => {
							if (response.data.category.parent_id) {
								if (self.$router.currentRoute.path == '/admin/categories/' +  response.data.category.parent_id) {
									self.categories.push(response.data.category);
								} else {
									self.$router.push('/admin/categories/' +  response.data.category.parent_id);
								}
							} else {
								if (self.$router.currentRoute.path == '/admin/categories') {
									self.categories.push(response.data.category);
								} else {
									self.$router.push('/admin/categories' );
								}
							}
							self.category.name = '';
							self.category.description = '';
							self.category.parent_id	 = '';


						Event.$emit('notify', self.trans('text.category-added'), 'success', self.trans('text.success'));
					})
					.catch((error) => {
						console.log(error);
						self.errors.record(error);
						Event.$emit('notify', self.trans('text.category-not-added'), 'warning', self.trans('text.warning'));
					});
			}

		},
	},
}
</script>
