<template>
<div>
	<!-- Page header -->
	<vue-headful :title="trans('text.dashboard_title')" />
	<div class="page-header-secondary page-header-light">
		<div class="page-header-content">
			<div class="row">
					<div class="col">
							<div class="breadcrumb">
								<router-link to="/admin" class="breadcrumb-item" exact><i class="icon-home2 mr-2"></i> {{ trans('text.dashboard')}}</router-link>
								<span  class="breadcrumb-item active">{{ trans('text.warehouses')}}</span>
							</div>
					</div>
					<div class="col">
							<div class="page-title text-right">
								<h5>{{ trans('text.warehouses')}}</h5>

							</div>
					</div>
			</div>
		</div>
	</div>
	<!-- /page header -->

	<!-- Page content -->
	<div class="page-content">
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Content area -->
			<div v-if="show_spinner" class="loading-spinner">
				<loading-spinner/>
			</div>
			<div v-else-if="show_error" class="page-error">
				<loading-error :type="show_error" />
			</div>
			<section v-else class="content">
				<div class="row">
					<div class="col-xl-7">
						<div class="card">
							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th>#</th>
											<th>{{ trans('text.name')}}</th>
											<th>{{ trans('text.address')}}</th>
											<th class="text-center" style="width: 20px;"></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(warehouse, key, index) in warehouses.data">
											<td>{{warehouse.id}}</td>
											<td>
												<router-link :to="'/admin/warehouseproducts/' + warehouse.id">{{warehouse.name}}</router-link>
											</td>
											<td>{{warehouse.address}}</td>
											<td class="text-center">
												<div class="list-icons">
													<div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a href="#" class="dropdown-item" @click.prevent="editWarehouse(warehouse, key)"><i class="icon-pencil4"></i> {{trans('text.edit-warehouse')}}</a>
															<a href="#" class="dropdown-item" @click.prevent="deleteWarehouse(warehouse.id, key)"><i class="icon-bin2"></i> {{trans('text.delete-warehouse')}}</a>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="card-footer">
								<vue-pagination :pagination="warehouses" @paginate="getWarehouses()" :offset="4"></vue-pagination>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<warehouse-form :action="'create'" :warehouse="new_warehouse" :warehouses="warehouses.data"></warehouse-form>
					</div>
				</div>
			</section>
		</div>
	</div>

	<div id="edit_model" class="modal delet-modal fade form-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<warehouse-form :action="'edit'" @edited="edited" :warehouse="edit_warehouse" :warehouses="warehouses.data"></warehouse-form>
		</div>
		</div>
	</div>
</div>
<!-- /page content -->
</template>
<script>
const Errors = require('../../../errors.js');
export default {
	data() {
		return {
			errors: new Errors(),
			show_spinner: true,
			show_error: false,
			warehouses: {},
			new_warehouse: {
				name: '',
				address: '',
				note: '',
			},
			edit_warehouse: {
				key: '',
				id: '',
				name: '',
				address: '',
				note: '',
			},
		};
	},
	methods: {
		getWarehouses() {
			var self = this;
			var url = this.preparUrl();
			axios.get(url)
				.then((response) => {
					self.warehouses = response.data.warehouses;
					self.show_spinner = false;
				})
				.catch((error) => {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
		preparUrl() {
			var base = '/api/warehouses?';
			var page = this.warehouses.current_page;
			if (page !== undefined) {
				base += 'page=' + page + '&';
			}
			var url = base.slice(0, -1);
			return url;
		},


		editWarehouse(warehouse, key) {
			this.edit_warehouse.key = key;
			this.edit_warehouse.id = warehouse.id;
			this.edit_warehouse.name = warehouse.name;
			this.edit_warehouse.address = warehouse.address;
			this.edit_warehouse.note = warehouse.note;
			$('#edit_model').modal('show');
		},
		edited(cat) {
			this.warehouses.data[this.edit_warehouse.key].name = cat.name;
			this.warehouses.data[this.edit_warehouse.key].address = cat.address;
			this.warehouses.data[this.edit_warehouse.key].note = cat.note;

			this.edit_warehouse.id = '';
			this.edit_warehouse.name = '';
			this.edit_warehouse.address = '';
			this.edit_warehouse.note = '';
			$('#edit_model').modal('hide');
		},

		deleteWarehouse(id, key) {
			var self = this;
			console.log(id);
			console.log(key);
			Event.$off('confirmed');
			Event.$emit('confirm');
			Event.$on('confirmed', function() {
				self.confirmDalete(id, key);
			});
		},

		confirmDalete(id, key) {
			var self = this;
			axios.delete('/api/warehouses/' + id)
				.then(function(response) {
					self.$delete(self.warehouses.data, key)
					Event.$emit('notify', self.trans('text.warehouse-deleted'), 'success', self.trans('text.success'));
				})
				.catch(function(error) {
					console.log(error);
					Event.$emit('notify', self.trans('text.warehouse-not-deleted'), 'warning', self.trans('text.warning'));
				});
		},

	},
	mounted() {
		this.getWarehouses();
	}
}
</script>
