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
								<span class="breadcrumb-item active">{{ trans('text.users')}}</span>
							</div>
					</div>
					<div class="col">
							<div class="page-title">
								<h5>{{ trans('text.users')}}</h5>
							</div>
					</div>
					<div class="col">
							<div class="header-elements align-items-center">
								<router-link to="/admin/users/create">
									<button class="btn bg-teal-400 btn-icon btn-sm">{{ trans('text.add-user')}}</button>
								</router-link>
								<router-link to="/admin/roles">
									<button class="btn bg-info btn-icon btn-sm">{{ trans('text.roles')}}</button>
								</router-link>
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
					<div class="col-xl-12">
						<div class="card">
							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th>#</th>
											<th>{{ trans('text.company_name')}}</th>
											<th>{{ trans('text.first_name')}}</th>
											<th>{{ trans('text.last_name')}}</th>
											<th>{{ trans('text.email')}}</th>
											<th class="text-center" style="width: 20px;"></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(user, key, index) in users.data">
											<td>{{user.id}}</td>
											<td>
												<router-link :to="'/admin/users/' + user.id">{{user.company_name}}</router-link>
											</td>
											<td>{{user.first_name}}</td>
											<td>{{user.last_name}}</td>
											<td>{{user.email}}</td>
											<td class="text-center">
												<div class="list-icons">
													<div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<router-link :to="'/admin/users/' + user.id +'/edit'" class="dropdown-item" @click.prevent="editSupplier(user, key)"><i class="icon-pencil4"></i> {{trans('text.edit-user')}}</router-link>
															<a href="#" class="dropdown-item" @click.prevent="deleteSupplier(user.id, key)"><i class="icon-bin2"></i> {{trans('text.delete-user')}}</a>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="card-footer">
								<vue-pagination :pagination="users" @paginate="getSuppliers()" :offset="4"></vue-pagination>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!-- /page content -->
</template>
<script>
export default {
	data() {
		return {
			users: {},
			show_spinner: true,
			show_error: false,
		};
	},
	methods: {
		getSuppliers() {
			var self = this;
			var url = this.preparUrl();
			axios.get(url)
				.then((response) => {
					self.users = response.data.employees;
					self.show_spinner = false;
				})
				.catch((error) => {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
		preparUrl() {
			var base = '/api/users?';

			var page = this.users.current_page;

			if (page !== undefined) {
				base += 'page=' + page + '&';
			}
			var url = base.slice(0, -1);
			return url;
		},

		deleteSupplier(id, key) {
			var self = this;
			Event.$off('confirmed');
			Event.$emit('confirm');
			Event.$on('confirmed', function() {
				self.confirmDalete(id, key);
			});
		},

		confirmDalete(id, key) {
			var self = this;
			axios.delete('/api/users/' + id)
				.then(function(response) {
					self.$delete(self.users.data, key)
					Event.$emit('notify', self.trans('text.user-deleted'), 'success', self.trans('text.success'));
				})
				.catch(function(error) {
					Event.$emit('notify', self.trans('text.user-not-deleted'), 'warning', self.trans('text.warning'));
				});
		},

	},
	mounted() {
		this.getSuppliers();
	},
}
</script>
