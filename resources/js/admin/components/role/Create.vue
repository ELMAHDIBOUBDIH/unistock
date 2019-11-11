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
								<router-link to="/admin/roles" class="breadcrumb-item" exact>{{ trans('text.roles')}}</router-link>
								<span class="breadcrumb-item active">{{ trans('text.add-role')}}</span>
							</div>
					</div>
					<div class="col">
							<div class="page-title text-right">
								<h5>{{ trans('text.roles')}}</h5>
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
						<role-form :action="'create'" :role="role"></role-form>
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
			role: {
				company_name: '',
				first_name: '',
				last_name: '',
				gender: '',
				birthday: '',
				tel: '',
				fax: '',
				address: '',
				email: '',
				image: '',

				qualification: '',
				recruitment_date: '',
				password: '',

				note: '',
			}
		};
	},
	methods: {
		ceaterole() {
			var self = this;

			axios.get('/api/roles/create')
				.then(function(response) {
					self.show_spinner = false;
				})
				.catch(function(error) {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},

	},
	mounted() {
		this.ceaterole();
	},
}
</script>
