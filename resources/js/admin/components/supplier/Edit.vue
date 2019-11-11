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
								<router-link to="/admin/suppliers" class="breadcrumb-item" exact>{{ trans('text.suppliers')}}</router-link>
								<span class="breadcrumb-item active">{{ trans('text.edit-supplier')}}</span>
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
						<supplier-form :action="'edit'" :supplier="supplier"></supplier-form>
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
			supplier: {}
		};
	},
	methods: {
		editsupplier() {
			var self = this;
			axios.get('/api/suppliers/'+ self.$route.params.id+'/edit')
				.then(function(response) {
					self.supplier = response.data.supplier;
					self.show_spinner = false;
				})
				.catch(function(error) {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
	},
	mounted() {
		this.editsupplier();
	},
}
</script>
