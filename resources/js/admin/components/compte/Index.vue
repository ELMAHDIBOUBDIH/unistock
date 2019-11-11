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
								<span  class="breadcrumb-item active">{{ trans('text.comptes')}}</span>
							</div>
					</div>
					<div class="col">
							<div class="page-title text-right">
								<h5>{{ trans('text.comptes')}}</h5>
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
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th>#</th>
											<th>{{ trans('text.num')}}</th>
											<th>{{ trans('text.name')}}</th>
											<th>{{ trans('text.nature')}}</th>
											<th>{{ trans('text.solde_init')}}</th>
											<th class="text-center" style="width: 20px;"></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(compte, key, index) in comptes">
											<td>{{compte.id}}</td>
											<td>{{compte.num}}</td>
											<td>{{compte.name}}</td>
											<td>{{compte.nature}}</td>
											<td>
												<h6 class="font-weight-semibold mb-0">{{compte.solde_init}}</h6></td>
											<td class="text-center">
												<div class="list-icons">
													<div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a href="#" class="dropdown-item" @click.prevent="editCompte(compte, key)"><i class="icon-pencil4"></i> {{trans('text.edit-compte')}}</a>
															<a href="#" class="dropdown-item" @click.prevent="deleteCompte(compte.id, key)"><i class="icon-bin2"></i> {{trans('text.delete-compte')}}</a>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="card-footer">
								<vue-pagination :pagination="comptes" @paginate="getComptes()" :offset="4"></vue-pagination>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<compte-form :action="'create'" :compte="new_compte" :comptes="comptes"></compte-form>
					</div>
				</div>
			</section>
		</div>
	</div>

	<div id="edit_model" class="modal delet-modal fade form-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<compte-form :action="'edit'" @edited="edited" :compte="edit_compte" :comptes="comptes"></compte-form>
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
			comptes: {},
			new_compte: {
				num: '',
				name: '',
				nature: '',
				solde_init: '',
			},
			edit_compte: {
				key: '',
				id: '',
				num: '',
				name: '',
				nature: '',
				solde_init: '',
			},
		};
	},
	methods: {
		getComptes() {
			var self = this;
			var url = this.preparUrl();
			axios.get(url)
				.then((response) => {
					self.comptes = response.data.comptes;
					self.breadcrumbs = response.data.breadcrumbs;
					self.show_spinner = false;
				})
				.catch((error) => {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
		preparUrl() {
			var base = '/api/comptes?';
			var page = this.comptes.current_page;
			if (page !== undefined) {
				base += 'page=' + page + '&';
			}
			var url = base.slice(0, -1);
			return url;
		},


		editCompte(compte, key) {
			this.edit_compte.key = key;
			this.edit_compte.id = compte.id;
			this.edit_compte.num = compte.num;
			this.edit_compte.name = compte.name;
			this.edit_compte.nature = compte.nature;
			this.edit_compte.solde_init = compte.solde_init;
			$('#edit_model').modal('show');
		},
		edited(cat) {
			this.comptes[this.edit_compte.key].num = cat.num;
			this.comptes[this.edit_compte.key].name = cat.name;
			this.comptes[this.edit_compte.key].nature = cat.nature;
			this.comptes[this.edit_compte.key].solde_init = cat.solde_init;

			this.edit_compte.id = '';
			this.edit_compte.num = '';
			this.edit_compte.name = '';
			this.edit_compte.nature = '';
			this.edit_compte.solde_init = '';
			$('#edit_model').modal('hide');
		},

		deleteCompte(id, key) {
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
			axios.delete('/api/comptes/' + id)
				.then(function(response) {
					self.$delete(self.comptes, key)
					Event.$emit('notify', self.trans('text.compte-deleted'), 'success', self.trans('text.success'));
				})
				.catch(function(error) {
					console.log(error);
					Event.$emit('notify', self.trans('text.compte-not-deleted'), 'warning', self.trans('text.warning'));
				});
		},

	},
	mounted() {
		this.getComptes();
	}
}
</script>
