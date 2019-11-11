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
								<router-link to="/admin/users" class="breadcrumb-item" exact>{{ trans('text.users')}}</router-link>
								<span class="breadcrumb-item active">{{ trans('text.edit-user')}}</span>
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
						<user-form :action="'edit'" :user="user"></user-form>
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
			user: {}
		};
	},
	methods: {
		edituser() {
			var self = this;
			axios.get('/api/users/'+ self.$route.params.id+'/edit')
				.then(function(response) {
					self.user = response.data.employee;
					self.show_spinner = false;
				})
				.catch(function(error) {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
	},
	mounted() {
		this.edituser();
	},
}
</script>
