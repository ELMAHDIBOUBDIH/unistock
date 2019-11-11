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
								<router-link to="/admin/products" class="breadcrumb-item" exact> {{ trans('text.products')}}</router-link>
								<span class="breadcrumb-item active">{{ trans('text.edit-product')}}</span>
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
						<product-form :action="'edit'" :product="product" :groups="groups" :brands="brands" :categories="categories" :suppliers="suppliers" :prices="prices"></product-form>
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
			product: {},
			groups: [],
			brands: [],
			categories: [],
			suppliers: [],

			prices:{},


		};
	},
	methods: {
		editproduct() {
			var self = this;
			axios.get('/api/products/'+ self.$route.params.id+'/edit')
				.then(function(response) {
					self.product = response.data.product;
					self.prices = response.data.prices;
					self.groups = response.data.CustomerGroup;
					self.brands = response.data.brands;
					self.categories = response.data.categories;
					self.suppliers = response.data.suppliers;
					self.show_spinner = false;
				})
				.catch(function(error) {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
		
	},
	mounted() {
		this.editproduct();

	},
}
</script>
