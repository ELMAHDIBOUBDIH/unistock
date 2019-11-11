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
                        <span class="breadcrumb-item active">{{ trans('text.reports')}}</span>
                    </div>
                </div>
                <div class="col">
                    <div class="page-title text-right">
                        <h5>{{ trans('text.reports')}}</h5>
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
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="icon-cube3"></i>
                                {{ trans('text.purchases')}}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/purchaseorder" class="text-primary">{{ trans('text.purchaseorder-report')}}</router-link>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/receive" class="text-primary">{{ trans('text.receive-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/purchasebyvendor" class="text-primary">{{ trans('text.purchasebyvendor-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/purchasesbyitem" class="text-primary">{{ trans('text.purchasesbyitem-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/billdetails" class="text-primary">{{ trans('text.billdetails-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/paymentmade" class="text-primary">{{ trans('text.paymentmade-report')}}</router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="icon-cube3"></i>
                                {{ trans('text.sales')}}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/salesorder" class="text-primary">{{ trans('text.salesorder-report')}}</router-link>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/invoice" class="text-primary">{{ trans('text.invoice-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/payment" class="text-primary">{{ trans('text.payment-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/salesbycustomer" class="text-primary">{{ trans('text.salesbycustomer-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/salesbyitem" class="text-primary">{{ trans('text.salesbyitem-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/salesbysp" class="text-primary">{{ trans('text.salesbysp-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/customerbalance" class="text-primary">{{ trans('text.customerbalance-report')}}</router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="icon-cube3"></i>
                                {{ trans('text.inventory')}}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/productsales" class="text-primary">{{ trans('text.productsales-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/productpurchase" class="text-primary">{{ trans('text.productpurchase-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/inventory" class="text-primary">{{ trans('text.inventory-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/inventoryvaluation" class="text-primary">{{ trans('text.inventoryvaluation-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/fifocostlottracking" class="text-primary">{{ trans('text.fifocostlottracking-report')}}</router-link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <router-link to="/admin/reports/warehouse" class="text-primary">{{ trans('text.warehouse-report')}}</router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
            show_spinner: true,
            show_error: false,
        };
    },
    methods: {


    },
    mounted() {
        this.show_spinner = false;
    }
}
</script>
