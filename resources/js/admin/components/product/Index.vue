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
								<span class="breadcrumb-item active">{{ trans('text.products')}}</span>
							</div>
					</div>
					<div class="col">
							<div class="page-title">
								<h5>{{ trans('text.products')}}</h5>
							</div>
					</div>
					<div class="col">
							<div class="header-elements align-items-center">
								<router-link to="/admin/products/create">
									<button class="btn bg-teal-400 btn-icon btn-sm">{{ trans('text.add-product')}}</button>
								</router-link>
								<div class="dropdown no-caret d-inline-block">
										<button class="btn bg-blue-800 btn-icon btn-sm dropdown-toggle " type="button" id="dropdownSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="icon-menu"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownSort">
												<a class="dropdown-item" href="#">{{ trans('text.import-products')}}</a>
												<a class="dropdown-item" href="#">{{ trans('text.export-products')}}</a>
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
				<filtering :filters='filters' :data='filters_data' @filter='filter'></filtering>
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead class="bg-light">
										<tr>
											<th style="width: 64px;"></th>
											<th>{{ trans('text.reference')}}</th>
											<th>{{ trans('text.code_barre')}}</th>
											<th>{{ trans('text.designation')}}</th>
											<th>{{ trans('text.category_name')}}</th>
											<th>{{ trans('text.brand_name')}}</th>
											<th>{{ trans('text.unit')}}</th>
											<th>{{ trans('text.cond')}}</th>
											<th>{{ trans('text.qnt_initial')}}</th>
											<th class="text-center" style="width: 20px;"></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(product, key, index) in products.data">
											<td class="listing-img">
													<img :src="'../uploads/products/xs/'+product.image" :alt="product.designation" :title="product.designation">
											</td>
											<td>
												<router-link :to="'/admin/products/' + product.id">{{product.reference}}</router-link>
											</td>
											<td>{{product.code_barre}}</td>
											<td>{{product.designation}}</td>
											<td>{{product.category_name}}</td>
											<td>{{product.brand_name}}</td>
											<td>{{product.unit}}</td>
											<td>{{product.cond}}</td>
											<td>{{product.qnt_initial}}</td>
											<td class="text-center">
												<div class="list-icons">
													<div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<router-link :to="'/admin/products/' + product.id +'/edit'" class="dropdown-item" @click.prevent="editProduct(product, key)"><i class="icon-pencil4"></i> {{trans('text.edit-product')}}</router-link>
															<a href="#" class="dropdown-item" @click.prevent="deleteProduct(product.id, key)"><i class="icon-bin2"></i> {{trans('text.delete-product')}}</a>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="card-footer">
								<vue-pagination :pagination="products" @paginate="getProducts()" :offset="4"></vue-pagination>
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
			products: {},
			show_spinner: true,
			show_error: false,
			url_base: '/api/products?',
			filters: {
						reference: '',
						designation: '',
						brand: '',
						category: '',
						etat: '',
						
			},
			filters_data: {
					categories: {},
					brands: {},
			},
			sorts: [
				'reference',
				'designation',
				'brand_id',
				'category_id',
				'etat',
				'created_at',
				'updated_at',
			],
		};
	},
	methods: {
		getProducts() {
			var self = this;
			var url = this.preparUrl();
			axios.get(url)
				.then((response) => {
					self.products = response.data.products;
					self.filters_data.categories = response.data.categories;
					self.filters_data.brands = response.data.brands;
					self.show_spinner = false;
				})
				.catch((error) => {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
		preparUrl() {
			var base = this.url_base;

			var page = this.products.current_page;

			if (page !== undefined) {
				base += 'page=' + page + '&';
			}
			var url = base.slice(0, -1);
			return url;
		},

		deleteProduct(id, key) {
			var self = this;
			Event.$off('confirmed');
			Event.$emit('confirm');
			Event.$on('confirmed', function() {
				self.confirmDalete(id, key);
			});
		},

		confirmDalete(id, key) {
			var self = this;
			axios.delete('/api/products/' + id)
				.then(function(response) {
					self.$delete(self.products.data, key)
					Event.$emit('notify', self.trans('text.product-deleted'), 'success', self.trans('text.success'));
				})
				.catch(function(error) {
					Event.$emit('notify', self.trans('text.product-not-deleted'), 'warning', self.trans('text.warning'));
				});
		},

		filter(string) {
				this.url_base = '/api/products' + string;
				
				this.getProducts();
		},

		sort(string) {
				this.url_base =  string;
				this.getProducts();
		},

	},
	mounted() {
		this.getProducts();
	},
}
</script>
