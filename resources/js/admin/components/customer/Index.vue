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
                        <span class="breadcrumb-item active">{{ trans('text.customers')}}</span>
                    </div>
                </div>
                <div class="col">
                    <div class="page-title">
                        <h5>{{ trans('text.customers')}}</h5>
                    </div>
                </div>
                <div class="col">
                    <div class="header-elements align-items-center">
                        <router-link to="/admin/customers/create">
                            <button class="btn bg-teal-400 btn-icon btn-sm">{{ trans('text.add-customer')}}</button>
                        </router-link>
                        <div class="dropdown no-caret d-inline-block">
                            <button class="btn bg-blue-800 btn-icon btn-sm dropdown-toggle " type="button" id="dropdownSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-menu"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownSort">
                                <a class="dropdown-item" href="#">{{ trans('text.import-customers')}}</a>
                                <a class="dropdown-item" href="#">{{ trans('text.export-customers')}}</a>
                                <a class="dropdown-item" href="#">{{ trans('text.refresh')}}</a>
                                <a class="dropdown-item" href="#">{{ trans('text.settings')}}</a>
                            </div>
                        </div>
												<sorting :sorts='sorts' :url='url_base' @sort='sort'></sorting>
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
                <loading-spinner />
            </div>
            <div v-else-if="show_error" class="page-error">
                <loading-error :type="show_error" />
            </div>
            <section v-else class="content">
                <filtering :filters='filters' :data='filters_data' @filter='filter'></filtering>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr class="bg-light text-uppercase">
                                            <th>#</th>
                                            <th>{{ trans('text.reg_com')}}</th>
                                            <th>{{ trans('text.name')}}</th>
                                            <th>{{ trans('text.company_name')}}</th>
                                            <td>{{ trans('text.group')}}</td>
                                            <th>{{ trans('text.solde')}}</th>
                                            <th>{{ trans('text.email')}}</th>
                                            <th>{{ trans('text.status')}}</th>
                                            <th class="text-center" style="width: 20px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(customer, key, index) in customers.data">
                                            <td>{{customer.id}}</td>
                                            <td>
                                                <router-link :to="'/admin/customers/' + customer.id">
                                                    {{customer.reg_com}}
                                                </router-link>
                                            </td>
                                            <td>{{customer.first_name}} {{customer.last_name}}</td>
                                            <td>{{customer.company_name}}</td>
                                            <td>{{customer.group}}</td>
                                            <td>
                                                <h6 class="font-weight-semibold mb-0">{{customer.solde}}</h6>
                                            </td>
                                            <td>{{customer.email}}</td>
                                            <td>
                                                <span v-if="customer.bloque" class="badge bg-danger">{{ trans('text.blocked')}}</span>
                                                <span v-else class="badge bg-blue">{{ trans('text.active')}}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <div class="list-icons-item dropdown">
                                                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <router-link :to="'/admin/customers/' + customer.id +'/edit'" class="dropdown-item" @click.prevent="editCustomer(customer, key)"><i class="icon-pencil4"></i> {{trans('text.edit-customer')}}</router-link>
                                                            <a href="#" class="dropdown-item" @click.prevent="deleteCustomer(customer.id, key)"><i class="icon-bin2"></i> {{trans('text.delete-customer')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <vue-pagination :pagination="customers" @paginate="getCustomers()" :offset="4"></vue-pagination>
                            </div>
                        </div>
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
            customers: {},
            show_spinner: true,
            show_error: false,
            url_base: '/api/customers?',
            filters: {
                customer_name:'',
                company_name: '',
                bloque: '',
                customer_group: 0,
                solde:'',
                signe:'='
            },
            filters_data: {
                customer_groups: {},
            },
            sorts: [
							
                            'first_name',
                            'last_name',
							'company_name',
                            'solde',
                            'group_id',
							'created_at',
							'updated_at',
						],
        };
    },
    methods: {
        getCustomers() {
            var self = this;
            var url = this.preparUrl();
            axios.get(url)
                .then((response) => {
                    self.customers = response.data.customers;
                    self.filters_data.customer_groups = response.data.CustomerGroups;
                    self.show_spinner = false;
                })
                .catch((error) => {
                    self.show_spinner = false;
                    self.show_error = error.response.status;
                });
        },

        preparUrl() {
            var base = this.url_base;
            var page = this.customers.current_page;
            if (page !== undefined) {
                base += 'page=' + page + '&';
            }
            var url = base.slice(0, -1);
            return url;
        },

        deleteCustomer(id, key) {
            var self = this;
            Event.$off('confirmed');
            Event.$emit('confirm');
            Event.$on('confirmed', function() {
                self.confirmDalete(id, key);
            });
        },

        confirmDalete(id, key) {
            var self = this;
            axios.delete('/api/customers/' + id)
                .then(function(response) {
                    self.$delete(self.customers.data, key)
                    Event.$emit('notify', self.trans('text.customer-deleted'), 'success', self.trans('text.success'));
                })
                .catch(function(error) {
                    Event.$emit('notify', self.trans('text.customer-not-deleted'), 'warning', self.trans('text.warning'));
                });
        },

        filter(string) {
            this.url_base = '/api/customers' + string;
            this.getCustomers();
        },

        sort(string) {
						this.url_base =  string;
            this.getCustomers();
        },
    },
    mounted() {
        this.getCustomers();
    },
}
</script>
