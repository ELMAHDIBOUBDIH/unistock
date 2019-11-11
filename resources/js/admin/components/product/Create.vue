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
								<span class="breadcrumb-item active">{{ trans('text.add-product')}}</span>
							</div>
					</div>
					<div class="col">
							<div class="page-title text-right">
									<h5>{{ trans('text.products')}}</h5>
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
						<product-form :action="'create'" :product="product" :groups="groups" :brands="brands" :categories="categories" :suppliers="suppliers" :prices="prices"></product-form>
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
			groups: [],
			brands: [],
			categories: [],
			suppliers: [],
			product: {
				reference: '',
				designation: '',
				code_barre: '',
				unit: '',
				cond: '',
				tva: '0',
				product_facturable: true,
				product_perissable: false,
				date_p: null,
				alert_p: null,
				etat: '1',
				image: 'default.jpg',
				price_ht: '',
				price_ttc: '',
				last_price: '0',
				pmp: '0',
				qnt_initial: '',
				alert_stock: '',
				pack: false,
				qnt_pack: '0',
				price_pack: '0',
				price_unit_pack: '0',
				note: '',
				brand_id: '',
				category_id: '',
				supplier_id: '',
			},

			prices: {
					price_ht:[],
					price_ttc:[],
					marge:[],
				}
		};
	},
	methods: {
		ceateproduct() {
			var self = this;

			axios.get('/api/products/create')
				.then(function(response) {
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
		this.ceateproduct();
	},
}
</script>
