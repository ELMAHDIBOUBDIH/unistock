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
								<span class="breadcrumb-item active">{{ trans('text.suppliers')}}</span>
							</div>
					</div>
					<div class="col">
							<div class="page-title">
									<h5>{{ trans('text.suppliers')}}</h5>
							</div>
					</div>

					<div class="col">
							<div class="header-elements align-items-center">
								<router-link to="/admin/suppliers/create">
									<button class="btn bg-teal-400 btn-icon btn-sm">{{ trans('text.add-supplier')}}</button>
								</router-link>
								<div class="dropdown no-caret d-inline-block">
										<button class="btn bg-blue-800 btn-icon btn-sm dropdown-toggle " type="button" id="dropdownSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="icon-menu"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownSort">
												<a class="dropdown-item" href="#">{{ trans('text.import-suppliers')}}</a>
												<a class="dropdown-item" href="#">{{ trans('text.export-suppliers')}}</a>
												<a class="dropdown-item" href="#">{{ trans('text.refresh')}}</a>
												<a class="dropdown-item" href="#">{{ trans('text.settings')}}</a>
										</div>
								</div>
								<sorting :sorts='sorts' :url='url_base' @sort='sort'></sorting>
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
				<filtering :filters='filters' @filter='filter'></filtering>

				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th>#</th>
											<th>{{ trans('text.reg_com')}}</th>
											<th>{{ trans('text.company_name')}}</th>
											<th>{{ trans('text.name')}}</th>
											<th>{{ trans('text.solde')}}</th>
											<th>{{ trans('text.email')}}</th>
											<th>{{ trans('text.status')}}</th>
											<th class="text-center" style="width: 20px;"></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(supplier, key, index) in suppliers.data">
											<td>{{supplier.id}}</td>
											<th>
												<router-link :to="'/admin/suppliers/' + supplier.id">{{supplier.reg_com}}</router-link>
											</th>
											<td>{{supplier.company_name}}</td>
											<td>{{supplier.first_name}} {{supplier.last_name}}</td>
											<td>
												<h6 class="font-weight-semibold mb-0">{{supplier.solde}}</h6>
											</td>
											<td>{{supplier.email}}</td>
											<td >
												<span v-if="supplier.bloque" class="badge bg-danger">{{ trans('text.blocked')}}</span>
                                                <span v-else class="badge bg-blue">{{ trans('text.active')}}</span>
                                            </td>
											<td class="text-center">
												<div class="list-icons">
													<div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<router-link :to="'/admin/suppliers/' + supplier.id +'/edit'" class="dropdown-item" @click.prevent="editSupplier(supplier, key)"><i class="icon-pencil4"></i> {{trans('text.edit-supplier')}}</router-link>
															<a href="#" class="dropdown-item" @click.prevent="deleteSupplier(supplier.id, key)"><i class="icon-bin2"></i> {{trans('text.delete-supplier')}}</a>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="card-footer">
								<vue-pagination :pagination="suppliers" @paginate="getSuppliers()" :offset="4"></vue-pagination>
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
			suppliers: {},
			show_spinner: true,
			show_error: false,
			url_base: '/api/suppliers?',
			filters: {
					supplier:'',
					bloque:'',
					company_name:'',
					solde:'',
					signe:'='
			},
			sorts: [
				'first_name',
				'last_name',
				'company_name',
				'created_at',
				'updated_at',
			],
		};
	},
	methods: {
		getSuppliers() {
			var self = this;
			var url = this.preparUrl();
			axios.get(url)
				.then((response) => {
					self.suppliers = response.data.suppliers;
					self.show_spinner = false;
				})
				.catch((error) => {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
		preparUrl() {
			var base = this.url_base;

			var page = this.suppliers.current_page;

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
			axios.delete('/api/suppliers/' + id)
				.then(function(response) {
					self.$delete(self.suppliers.data, key)
					Event.$emit('notify', self.trans('text.supplier-deleted'), 'success', self.trans('text.success'));
				})
				.catch(function(error) {
					Event.$emit('notify', self.trans('text.supplier-not-deleted'), 'warning', self.trans('text.warning'));
				});
		},

		filter(string) {
				this.url_base = '/api/suppliers' + string;
				this.getSuppliers();
		},

		sort(string) {
				this.url_base =  string;
				this.getSuppliers();
		},

	},
	mounted() {
		this.getSuppliers();
	},
}
</script>
