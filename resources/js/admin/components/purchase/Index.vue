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
								<span class="breadcrumb-item active">{{ trans('text.purchases')}}</span>
							</div>
					</div>
					<div class="col">
							<div class="page-title">
								<h5>{{ trans('text.purchases')}}</h5>
							</div>
					</div>
					<div class="col">
							<div class="header-elements align-items-center">
								<div class="dropdown no-caret d-inline-block">
										<button class="btn bg-blue-800 btn-icon btn-sm dropdown-toggle " type="button" id="dropdownSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="icon-menu"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownSort">
												<a class="dropdown-item" href="#">{{ trans('text.import-purchases')}}</a>
												<a class="dropdown-item" href="#">{{ trans('text.export-purchases')}}</a>
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
											<th>{{ trans('text.purchase_number')}}</th>
											<th>{{ trans('text.date')}}</th>
											<th>{{ trans('text.supplier')}}</th>
											<th>{{ trans('text.total_ht')}}</th>
											<th>{{ trans('text.total_tva')}}</th>
											<th>{{ trans('text.total_ttc')}}</th>
											<th class="text-center" style="width: 20px;"></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(purchase, key, index) in purchases.data">
											<td>{{purchase.id}}</td>
											<td>
												<router-link :to="'/admin/purchases/' + purchase.id">{{purchase.purchase_number}}</router-link>
											</td>
											<td>{{purchase.date}}</td>
											<td>{{purchase.supplier_name}}</td>
											<td>{{purchase.total_ht}}</td>
											<td>{{purchase.total_tva}}</td>
											<td>{{purchase.total_ttc}}</td>
											<td class="text-center">
												<div class="list-icons">
													<div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<router-link :to="'/admin/purchases/' + purchase.id +'/edit'" class="dropdown-item" @click.prevent="editPurchase(purchase, key)"><i class="icon-pencil4"></i> {{trans('text.edit-purchase')}}</router-link>
															<a href="#" class="dropdown-item" @click.prevent="deletePurchase(purchase.id, key)"><i class="icon-bin2"></i> {{trans('text.delete-purchase')}}</a>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="card-footer">
								<vue-pagination :pagination="purchases" @paginate="getPurchases()" :offset="4"></vue-pagination>
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
			purchases: {},
			show_spinner: true,
			show_error: false,
			url_base: this.$route.path.replace("admin", "api") + '?',
			filters: {
						supplier: '',
						daterange : {},
						user: '',
			},
			sorts: [
				'purchase_number',
				'date',
			],
		};
	},
	methods: {
		getPurchases() {
			var self = this;
			var url = this.preparUrl();
			axios.get(url)
				.then((response) => {
					self.purchases = response.data.purchases;
					self.show_spinner = false;
				})
				.catch((error) => {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
		preparUrl() {
			var base = this.url_base;

			var page = this.purchases.current_page;

			if (page !== undefined) {
				base += 'page=' + page + '&';
			}
			var url = base.slice(0, -1);
			return url;
		},

		deletePurchase(id, key) {
			var self = this;
			Event.$off('confirmed');
			Event.$emit('confirm');
			Event.$on('confirmed', function() {
				self.confirmDalete(id, key);
			});
		},

		confirmDalete(id, key) {
			var self = this;
			axios.delete('/api/purchases/' + id)
				.then(function(response) {
					self.$delete(self.purchases.data, key)
					Event.$emit('notify', self.trans('text.purchase-deleted'), 'success', self.trans('text.success'));
				})
				.catch(function(error) {
					Event.$emit('notify', self.trans('text.purchase-not-deleted'), 'warning', self.trans('text.warning'));
				});
		},
		filter(string) {
				this.url_base = this.$route.path.replace("admin", "api") + string;
				this.getPurchases();
		},

		sort(string) {
				this.url_base =  string;
				this.getPurchases();
		},

	},
	mounted() {
		this.getPurchases();
	},
	watch: {
			'$route'(to, from) {
					this.url_base = to.path.replace("admin", "api") + '?';
					this.getPurchases();
			}
	}
}
</script>
