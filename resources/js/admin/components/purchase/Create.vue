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
								<router-link to="/admin/purchases" class="breadcrumb-item" exact> {{ trans('text.purchases')}}</router-link>
								<span class="breadcrumb-item active">{{ trans('text.add-' + purchase.type)}}</span>
							</div>
					</div>
					<div class="col">
							<div class="page-title text-right">
								<h5>{{ trans('text.purchases')}}</h5>
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
					<div class="col-xl-12 mx-auto">
						<purchase-form :action="'create'" :products="products" :purchase="purchase" :suppliers="suppliers"></purchase-form>
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
			suppliers: [],
			purchase: {
				purchase_number: '',
				type: this.$route.params.type,
				date: '',
				total_tva: '',
				total_ht: '',
				total_ttc: '',
				remise: '',
				valide: '',
				note: '',
				ref_id: '',
				supplier_id: '',
				employee_id: 1,
			},
			products: {}
		};
	},
	methods: {
		ceatePurchase() {
			var self = this;

			axios.get('/api/purchases/create')
				.then(function(response) {
					self.suppliers = response.data.suppliers;
					self.purchase.purchase_number = response.data.purchase.purchase_number;
					self.products = response.data.products;
					self.show_spinner = false;
				})
				.catch(function(error) {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},

	},
	mounted() {
		this.ceatePurchase();console.log(this.purchase);
	},
	watch: {
		'$route' (to, from) {
			this.purchase.type = to.params.type;
			this.ceatePurchase();
		}
	}
}
</script>
