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
								<h5>{{ trans('text.categories')}}</h5>
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
											<th>{{ trans('text.name')}}</th>
											<th>{{ trans('text.description')}}</th>
											<th>{{ trans('text.products-count')}}</th>
											<th class="text-center" style="width: 20px;"></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(category, key, index) in categories.data">
									
											<td>{{category.id}}</td>
											<td>
												<router-link :to="'/admin/categories/' + category.id">{{category.name}}</router-link>
											</td>
											<td>{{category.description | subStr  }}</td>
											<td>
												<h6 class="font-weight-semibold mb-0">{{category.products_count }}</h6></td>
											<td class="text-center">
												<div class="list-icons">
													<div class="list-icons-item dropdown">
														<a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a href="#" class="dropdown-item" @click.prevent="editCategory(category, key)"><i class="icon-pencil4"></i> {{trans('text.edit-category')}}</a>
															<a href="#" class="dropdown-item" @click.prevent="deleteCategory(category.id, key)"><i class="icon-bin2"></i> {{trans('text.delete-category')}}</a>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="card-footer">
								<vue-pagination :pagination="categories" @paginate="getCategories()" :offset="4"></vue-pagination>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<category-form :action="'create'" :categories="categories.data" :all_categories="all_categories" :category="new_category"></category-form>
					</div>
				</div>
			</section>
		</div>
	</div>

	<div id="edit_model" class="modal delet-modal fade form-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<category-form :action="'edit'" @edited="edited" :categories="categories.data" :all_categories="all_categories" :category="edit_category"></category-form>
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
			new_category: {
				name: '',
				description: '',
				parent_id: '',
			},
			edit_category: {
				key: '',
				id: '',
				name: '',
				description: '',
				parent_id: '',
			},
			breadcrumbs: {},
			categories: {},
			all_categories: {},
			id: this.$route.params.id,
			show_spinner: true,

			show_error: false,
		};
	},
	methods: {
		getCategories() {
			var self = this;
			var url = this.preparUrl();
			axios.get(url)
				.then((response) => {

					this.categories = response.data.categories;
					self.breadcrumbs = response.data.breadcrumbs;
					self.all_categories = response.data.all_categories;
					self.show_spinner = false;
				})
				.catch((error) => {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},

		
		preparUrl() {
			if (this.id) {
				var base = '/api/categories/' + this.id + '?';
			} else {
				var base = '/api/categories?';
			}

			var page = this.categories.current_page;

			if (page !== undefined) {
				base += 'page=' + page + '&';
			}
			var url = base.slice(0, -1);
			return url;
		},

		deleteCategory(id, key) {
			var self = this;
			Event.$off('confirmed');
			Event.$emit('confirm');

			Event.$on('confirmed', function() {
				self.confirmDalete(id, key);
			});
		},
		editCategory(category, key) {
			this.edit_category.key = key;
			this.edit_category.id = category.id;
			this.edit_category.name = category.name;
			this.edit_category.description = category.description;
			this.edit_category.parent_id= category.parent_id;
			$('#edit_model').modal('show');
		},
		edited(cat) {
			if (cat.parent_id !== this.categories.data[this.edit_category.key].parent_id) {
				if (cat.parent_id) {
					this.$router.push('/admin/categories/' + cat.parent_id);
				} else {
					this.$router.push('/admin/categories');
				}
			} else {
				this.categories.data[this.edit_category.key].name = cat.name;
				this.categories.data[this.edit_category.key].description = cat.description;
				this.categories.data[this.edit_category.key].parent_id = cat.parent_id;
			}

			this.edit_category.id = '';
			this.edit_category.name = '';
			this.edit_category.description = '';
			this.edit_category.parent_id= '';
			$('#edit_model').modal('hide');
		},

		confirmDalete(id, key) {
			var self = this;
			axios.delete('/api/categories/' + id)
				.then(function(response) {
					self.$delete(self.categories.data, key)
					Event.$emit('notify', self.trans('text.category-deleted'), 'success', self.trans('text.success'));
				})
				.catch(function(error) {
					Event.$emit('notify', self.trans('text.category-not-deleted'), 'warning', self.trans('text.warning'));
				});
		},

	},
	mounted() {
		this.getCategories();
	},
	watch: {
		'$route' (to, from) {
			this.id = to.params.id;
			this.getCategories();
		}
	},
	filters: {
  
  	      subStr: function(string) {
    	     return string.substring(0,15) + '...';
    	     }
        }
}
</script>
