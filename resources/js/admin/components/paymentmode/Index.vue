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
								<span  class="breadcrumb-item active">{{ trans('text.paymentmodes')}}</span>
							</div>
					</div>
					<div class="col">
							<div class="page-title text-right">
								<h5>{{ trans('text.paymentmodes')}}</h5>
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
					<div class="col-xl-7">
						<div class="card">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>{{ trans('text.name')}}</th>
											<th>{{ trans('text.description')}}</th>
											<th class="text-center" style="width: 20px;"></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(paymentmode, key, index) in paymentmodes">
											<td>{{paymentmode.id}}</td>
											<td>{{paymentmode.name}}</td>
											<td>{{paymentmode.description}}</td>
											<td class="text-center">
												<div class="list-icons">
													<div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a href="#" class="dropdown-item" @click.prevent="editPaymentmode(paymentmode, key)"><i class="icon-pencil4"></i> {{trans('text.edit-paymentmode')}}</a>
															<a href="#" class="dropdown-item" @click.prevent="deletePaymentmode(paymentmode.id, key)"><i class="icon-bin2"></i> {{trans('text.delete-paymentmode')}}</a>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="card-footer">
								<vue-pagination :pagination="paymentmodes" @paginate="getPaymentmodes()" :offset="4"></vue-pagination>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<paymentmode-form :action="'create'" :paymentmode="new_paymentmode" :paymentmodes="paymentmodes"></paymentmode-form>
					</div>
				</div>
			</section>
		</div>
	</div>

	<div id="edit_model" class="modal delet-modal fade form-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<paymentmode-form :action="'edit'" @edited="edited" :paymentmode="edit_paymentmode" :paymentmodes="paymentmodes"></paymentmode-form>
		</div>
		</div>
	</div>
</div>
<!-- /page content -->
</template>
<script>
const Errors = require('../../../errors.js');
export default {
	data() {
		return {
			errors: new Errors(),
			show_spinner: true,
			show_error: false,
			breadcrumbs: {},
			paymentmodes: {},
			new_paymentmode: {
				name: '',
				description: '',
			},
			edit_paymentmode: {
				key: '',
				id: '',
				name: '',
				description: '',
			},
		};
	},
	methods: {
		getPaymentmodes() {
			var self = this;
			var url = this.preparUrl();
			axios.get(url)
				.then((response) => {
					self.paymentmodes = response.data.payment_modes;
					self.breadcrumbs = response.data.breadcrumbs;
					self.show_spinner = false;
				})
				.catch((error) => {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
		preparUrl() {
			var base = '/api/paymentmodes?';
			var page = this.paymentmodes.current_page;
			if (page !== undefined) {
				base += 'page=' + page + '&';
			}
			var url = base.slice(0, -1);
			return url;
		},


		editPaymentmode(paymentmode, key) {
			this.edit_paymentmode.key = key;
			this.edit_paymentmode.id = paymentmode.id;
			this.edit_paymentmode.name = paymentmode.name;
			this.edit_paymentmode.description = paymentmode.description;
			$('#edit_model').modal('show');
		},
		edited(cat) {
			this.paymentmodes[this.edit_paymentmode.key].name = cat.name;
			this.paymentmodes[this.edit_paymentmode.key].description = cat.description;

			this.edit_paymentmode.id = '';
			this.edit_paymentmode.name = '';
			this.edit_paymentmode.description = '';
			$('#edit_model').modal('hide');
		},

		deletePaymentmode(id, key) {
			var self = this;
			console.log(id);
			console.log(key);
			Event.$off('confirmed');
			Event.$emit('confirm');
			Event.$on('confirmed', function() {
				self.confirmDalete(id, key);
			});
		},

		confirmDalete(id, key) {
			var self = this;
			axios.delete('/api/paymentmodes/' + id)
				.then(function(response) {
					self.$delete(self.paymentmodes, key)
					Event.$emit('notify', self.trans('text.paymentmode-deleted'), 'success', self.trans('text.success'));
				})
				.catch(function(error) {
					console.log(error);
					Event.$emit('notify', self.trans('text.paymentmode-not-deleted'), 'warning', self.trans('text.warning'));
				});
		},

	},
	mounted() {
		this.getPaymentmodes();
	}
}
</script>
