<template>
<!-- Filter toolbar -->
<div class="navbar navbar-expand-lg navbar-light navbar-component rounded">
	<div class="text-center d-lg-none w-100">
		<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-filter">
		<i class="icon-unfold mr-2"></i>
		{{ trans('text.filters')}}
		</button>
	</div>
	<div class="navbar-collapse collapse" id="navbar-filter">
		<span class="navbar-text font-weight-semibold mr-3">
			{{ trans('text.filter')}}:
		</span>
		<ul class="navbar-nav flex-wrap">
			<li v-if='filters.company_name  != undefined' class="nav-item d-flex">
				<label class="filter-form-label">{{ trans('text.company_name')}}</label>
				<input type="text" name="company_name" class="form-control filter-form-control " v-model="filters.company_name">
			</li>
			<li v-if='filters.customer_name  != undefined' class="nav-item d-flex">
					<label class="filter-form-label">{{ trans('text.customer')}}</label>
					<input type="text" name="customer_name" class="form-control filter-form-control " v-model="filters.customer_name">
		    </li>
			<li v-if='filters.supplier  != undefined' class="nav-item d-flex">
					<label class="filter-form-label">{{ trans('text.supplier')}}</label>
					<input type="text" name="supplier" class="form-control filter-form-control " v-model="filters.supplier">
		    </li>
			<li v-if='filters.solde  != undefined' class="nav-item d-flex">
				<label class="filter-form-label">{{ trans('text.solde')}}</label>
				<select name="signe" v-model="filters.signe" class="form-control filter-form-control">
					<option value="=">{{ trans('text.egal')}}</option>
					<option value=">">{{ trans('text.superieur')}}</option>
					<option value="<">{{trans('text.inferieur')}}</option>
					<option value=">=">{{trans('text.superieur_ou_egal')}}</option>
					<option value="<=">{{trans('text.inferieur_ou_egal')}}</option>
				</select>
				<input type="text" name="solde" class="form-control filter-form-control " v-model="filters.solde">
			</li>
			<li v-if='filters.reference  != undefined' class="nav-item d-flex">
				<label class="filter-form-label">{{ trans('text.reference')}}</label>
				<input type="text" name="reference" class="form-control filter-form-control " v-model="filters.reference">
			</li>
			<li v-if='filters.designation  != undefined' class="nav-item d-flex">
				<label class="filter-form-label">{{ trans('text.designation')}}</label>
				<input type="text" name="designation" class="form-control filter-form-control " v-model="filters.designation">
			</li>
			<li v-if='filters.customer_group  != undefined' class="nav-item d-flex">
				<label class="filter-form-label">{{ trans('text.group')}}</label>
				<select name="customer_group" v-model="filters.customer_group" class="form-control filter-form-control">
					<option value="0"></option>
					<option v-for="customer_group in data.customer_groups" :value="customer_group.id">{{customer_group.name}}</option>
				</select> </li>
				
				<li v-if='filters.customer  != undefined' class="nav-item d-flex">
					<label class="filter-form-label">{{ trans('text.customer')}}</label>
					<model-list-select :list="customers" option-value="id" :custom-text="customerDisplayText" v-model="filters.customer" :placeholder="trans('text.search-customer')" @searchchange="searchCustomer"> </model-list-select>
				</li>
				<li v-if='filters.user  != undefined' class="nav-item d-flex">
					<label class="filter-form-label">{{ trans('text.user')}}</label>
					<model-list-select :list="users" option-value="id" :custom-text="userDisplayText" v-model="filters.user" :placeholder="trans('text.search-user')" @searchchange="searchUser"> </model-list-select>
				</li>
				<li v-if='filters.category  != undefined' class="nav-item d-flex">
					<label class="filter-form-label">{{ trans('text.category')}}</label>
					<select name="category" v-model="filters.category" class="form-control filter-form-control">
						<option value=""></option>
						<option v-for="category in data.categories" :value="category.id">{{category.name}}</option>
					</select> 
				</li>
					<li v-if='filters.brand  != undefined' class="nav-item d-flex">
						<label class="filter-form-label">{{ trans('text.brand')}}</label>
						<select name="brand" v-model="filters.brand" class="form-control filter-form-control">
							<option value=""></option>
							<option v-for="brand in data.brands" :value="brand.id">{{brand.name}}</option>
						</select> 
					</li>
						<li v-if='filters.bloque  != undefined' class="nav-item d-flex">
							<label class="filter-form-label">{{ trans('text.bloque')}}</label>
							<select name="bloque" v-model="filters.bloque" class="form-control  filter-form-control">
								<option value=""></option>
								<option value="non-bloque">{{trans('text.active')}}</option>
								<option value="bloque">{{trans('text.blocked')}}</option>
							</select> 
						</li>
							<li v-if='filters.etat  != undefined' class="nav-item d-flex">
								<label class="filter-form-label">{{ trans('text.etat')}}</label>
								<select name="etat" v-model="filters.etat" class="form-control  filter-form-control">
									<option value=""></option>
									<option value="actif">{{trans('text.actif')}}</option>
									<option value="sommeil">{{trans('text.sommeil')}}</option>
								</select> </li>
								<li v-if='filters.daterange  != undefined' class="nav-item d-flex">
									<label class="filter-form-label">{{ trans('text.date')}}</label>
									<button v-if='filters.daterange' type="button" class="btn btn-outline bg-info mr-2 pr-5 text-info border-info daterange-ranges-filter btn-sm dropdown-toggle">
									<i class="icon-calendar5 mr-2"></i>
									<span></span>
								</button> </li>
							</ul>
							<button class="btn bg-orange btn-icon btn-sm ml-md-auto" @click="$emit('filter', string())"><i class="icon-filter4 mr-2"></i>{{ trans('text.filter')}}</button>
						</div>
					</div>
					</template>
					<script>
					import {
					ModelListSelect
					} from 'vue-search-select'
					export default {
						props: {
							filters: '',
							data: ''
						},
						data() {
								return {
										customers: [],
										suppliers: [],
										users: [],
								};
						},
						components: {
								ModelListSelect
						},
						methods: {
							searchCustomer(searchText) {
									var self = this;
									axios.get(`/api/customers/search?q=` + searchText)
											.then(response => {
													self.customers = response.data.resluts
											})
											.catch(error => {
													console.log(error)
											})
							},
							customerDisplayText(customer) {
									return customer.first_name + ' ' + customer.last_name
							},
							searchSupplier(searchText) {
									var self = this;
									axios.get(`/api/suppliers/search?q=` + searchText)
											.then(response => {
													self.suppliers = response.data.resluts
											})
											.catch(error => {
													console.log(error)
											})
							},
							supplierDisplayText(supplier) {
									return supplier.first_name + ' ' + supplier.last_name
							},
							searchUser(searchText) {
									var self = this;
									axios.get(`/api/users/search?q=` + searchText)
											.then(response => {
													self.users = response.data.resluts
											})
											.catch(error => {
													console.log(error)
											})
							},
							userDisplayText(user) {
									return user.first_name + ' ' + user.last_name
							},
							string: function() {
								var str = '?';
								if (this.filters.daterange && this.filters.daterange.start) {
									str += 'date_start=' + this.filters.daterange.start + '&';
								}
								if (this.filters.daterange && this.filters.daterange.end) {
									str += 'date_end=' + this.filters.daterange.end + '&';
								}
								if (this.filters.bloque == 'bloque') {
									str += 'bloque=1&';
								}
								if (this.filters.bloque == 'non-bloque') {
									str += 'bloque=0&';
								}
								if (this.filters.etat == 'actif') {
									str += 'etat=1&';
								}
								if (this.filters.etat == 'sommeil') {
									str += 'etat=0&';
								}
								if (this.filters.customer_group && this.filters.customer_group != 0) {
									str += 'group=' + this.filters.customer_group + '&';
									str += 'signe=' + this.filters.signe + '&';
								}
								if (this.filters.company_name && this.filters.company_name != '') {
									str += 'company_name=' + this.filters.company_name + '&';
								}
								if (this.filters.solde && this.filters.solde != '') {
									str += 'solde=' + this.filters.solde + '&';
									str += 'signe=' + this.filters.signe + '&';
								}
								if (this.filters.reference && this.filters.reference != '') {
									str += 'reference=' + this.filters.reference + '&';
								}
								if (this.filters.designation && this.filters.designation != '') {
									str += 'designation=' + this.filters.designation + '&';
								}
								if (this.filters.category && this.filters.category != '') {
									str += 'category=' + this.filters.category + '&';
								}
								if (this.filters.brand && this.filters.brand != '') {
									str += 'brand=' + this.filters.brand + '&';
								}
								if (this.filters.customer && this.filters.customer != '') {
									str += 'customer=' + this.filters.customer + '&';
								}
								if (this.filters.supplier && this.filters.supplier != '') {
									str += 'supplier=' + this.filters.supplier + '&';
								}
								if (this.filters.customer_name && this.filters.customer_name != '') {
									str += 'customer=' + this.filters.customer_name + '&';
								}
								if (this.filters.user && this.filters.user != '') {
									str += 'user=' + this.filters.user + '&';
								}
								return str;
							},
						},
						mounted() {
							var self = this;
							$(document).ready(function() {
								_componentDaterangeW(self);
							});
						}
					};
					var _componentDaterangeW = function(self) {
						if (!$().daterangepicker) {
							console.warn('Warning - daterangepicker.js is not loaded.');
							return;
						}
						var ranges = {};
						ranges[self.trans('text.today')] = [moment(), moment()];
						ranges[self.trans('text.yesterday')] = [moment().subtract(1, 'days'), moment().subtract(1, 'days')];
						ranges[self.trans('text.last-7-days')] = [moment().subtract(6, 'days'), moment()];
						ranges[self.trans('text.last-30-days')] = [moment().subtract(29, 'days'), moment()];
						ranges[self.trans('text.this-month')] = [moment().startOf('month'), moment().endOf('month')];
						ranges[self.trans('text.last-month')] = [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')];
						// Initialize
						$('.daterange-ranges-filter').daterangepicker({
								startDate: moment().subtract(29, 'days'),
								endDate: moment(),
								minDate: '01/01/2015',
								maxDate: '12/31/2019',
								dateLimit: {
									days: 60
								},
								ranges: ranges,
								opens: $('html').attr('dir') == 'rtl' ? 'right' : 'left',
								applyClass: 'btn-sm bg-indigo-400 btn-block',
								cancelClass: 'btn-sm btn-light btn-block',
								locale: {
									format: 'MM/DD/YYYY',
									direction: $('html').attr('dir') == 'rtl' ? 'rtl' : 'ltr'
								}
							},
							function(start, end) {
								$('.daterange-ranges-filter span').html(start.format('MMMM D') + ' - ' + end.format('MMMM D'));
								self.filters.daterange.end = end.format('YYYY-MM-DD');
								self.filters.daterange.start = start.format('YYYY-MM-DD');
							}
						);
						$('.daterange-ranges-filter span').html(moment().subtract(29, 'days').format('MMMM D') + ' - ' + moment().format('MMMM D'));
					};
					</script>