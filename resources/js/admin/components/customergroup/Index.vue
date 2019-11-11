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
								<template v-for="breadcrumb in breadcrumbs">
									<router-link v-if="breadcrumb.url" :to="breadcrumb.url" class="breadcrumb-item" exact>{{breadcrumb.name}}</router-link>
									<span v-else class="breadcrumb-item active">{{breadcrumb.name}}</span>
								</template>
							</div>
					</div>
					<div class="col">
							<div class="page-title text-right">
								<h5>{{ trans('text.customergroups')}}</h5>
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
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>{{ trans('text.name')}}</th>
											<th>{{ trans('text.description')}}</th>
											<th class="text-center" style="width: 20px;"></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(customergroup, key, index) in customergroups">
											<td>{{customergroup.id}}</td>
											<td>{{customergroup.name}}</td>
											<td>{{customergroup.description}}</td>
											<td class="text-center">
												<div class="list-icons">
													<div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a href="#" class="dropdown-item" @click.prevent="editCustomergroup(customergroup, key)"><i class="icon-pencil4"></i> {{trans('text.edit-customergroup')}}</a>
															<a href="#" class="dropdown-item" @click.prevent="deleteCustomergroup(customergroup.id, key)"><i class="icon-bin2"></i> {{trans('text.delete-customergroup')}}</a>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="card-footer">
								<vue-pagination :pagination="customergroups" @paginate="getCustomergroups()" :offset="4"></vue-pagination>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<customergroup-form :action="'create'" :customergroup="new_customergroup" :customergroups="customergroups"></customergroup-form>
					</div>
				</div>
			</section>
		</div>
	</div>

	<div id="edit_model" class="modal delet-modal fade form-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<customergroup-form :action="'edit'" @edited="edited" :customergroup="edit_customergroup" :customergroups="customergroups"></customergroup-form>
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
			breadcrumbs: {},
			customergroups: {},
			new_customergroup: {
				name: '',
				description: '',
			},
			edit_customergroup: {
				key: '',
				id: '',
				name: '',
				description: '',
			},
		};
	},
	methods: {
		getCustomergroups() {
			var self = this;
			var url = this.preparUrl();
			axios.get(url)
				.then((response) => {
					self.customergroups = response.data.customergroups;
					self.breadcrumbs = response.data.breadcrumbs;
					self.show_spinner = false;
				})
				.catch((error) => {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
		preparUrl() {
			var base = '/api/customergroups?';
			var page = this.customergroups.current_page;
			if (page !== undefined) {
				base += 'page=' + page + '&';
			}
			var url = base.slice(0, -1);
			return url;
		},


		editCustomergroup(customergroup, key) {
			this.edit_customergroup.key = key;
			this.edit_customergroup.id = customergroup.id;
			this.edit_customergroup.name = customergroup.name;
			this.edit_customergroup.description = customergroup.description;
			$('#edit_model').modal('show');
		},
		edited(cat) {
			this.customergroups[this.edit_customergroup.key].name = cat.name;
			this.customergroups[this.edit_customergroup.key].description = cat.description;
			this.edit_customergroup.id = '';
			this.edit_customergroup.name = '';
			this.edit_customergroup.description = '';
			$('#edit_model').modal('hide');
		},

		deleteCustomergroup(id, key) {
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
			axios.delete('/api/customergroups/' + id)
				.then(function(response) {
					self.$delete(self.customergroups, key)
					Event.$emit('notify', self.trans('text.customergroup-deleted'), 'success', self.trans('text.success'));
				})
				.catch(function(error) {
					console.log(error);
					Event.$emit('notify', self.trans('text.customergroup-not-deleted'), 'warning', self.trans('text.warning'));
				});
		},

	},
	mounted() {
		this.getCustomergroups();
	}
}
</script>
