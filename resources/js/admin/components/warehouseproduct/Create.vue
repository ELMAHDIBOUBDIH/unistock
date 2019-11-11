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
								<h5>{{ trans('text.warehouseproducts')}}</h5>

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
						<warehouseproduct-form :action="'create'" :warehouse_product="warehouse_product" :products="products" :warehouses="warehouses"></warehouseproduct-form>
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
			show_spinner: true,
			show_error: false,
			breadcrumbs: [],
			products: [],
			warehouses: [],
			warehouse_product: {
				quantity: '',
				quantity_reserved: '',
				zone: '',
				shelf: '',
				note: '',
				product_id: '',
				warehouse_id: '',
			}
		};
	},
	methods: {
		ceateproduct() {
			var self = this;

			axios.get('/api/warehouseproducts/create')
				.then(function(response) {
					self.breadcrumbs = response.data.breadcrumbs;
					self.products = response.data.products;
					self.warehouses = response.data.warehouses;
					self.show_spinner = false;
				})
				.catch(function(error) {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},

	},
	mounted() {
		this.ceateproduct();
	},
}
</script>
