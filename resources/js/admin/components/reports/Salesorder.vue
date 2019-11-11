<template>
<div>
	<!-- Page header -->
	<vue-headful :title="trans('text.dashboard_title')" />
	<div class="page-header-secondary page-header-light">
		<div class="page-header-content border-bottom-1 border-bottom-grey">
			<div class="row">
				<div class="col">
					<div class="breadcrumb">
						<router-link to="/admin" class="breadcrumb-item" exact><i class="icon-home2 mr-2"></i> {{ trans('text.dashboard')}}</router-link>
                        <router-link to="/admin/reports" class="breadcrumb-item" exact> {{ trans('text.reports')}}</router-link>
						<span class="breadcrumb-item active">{{ trans('text.salesorder-report')}}</span>
					</div>
				</div>
                <div class="col">
					<div class="page-title">
						<h5>{{ trans('text.salesorder-report')}}</h5>
					</div>
				</div>
				<div class="col">
					<div class="header-elements">
						<button class="btn bg-teal-400 btn-icon btn-sm"><i class="icon-printer2 mr-2"></i>{{ trans('text.print')}}</button>
						<div class="dropdown d-inline-block">
							<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-share2 mr-2"></i>{{ trans('text.export-as')}}
                          </button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="#">{{ trans('text.PDF')}}</a>
								<a class="dropdown-item" href="#">{{ trans('text.CSV')}}</a>
								<a class="dropdown-item" href="#">{{ trans('text.XLS')}}</a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
        <filtering :filters='filters' @filter='filter'></filtering>
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
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header">
								<i class="icon-cube3"></i> {{ trans('text.sales-orders')}}
							</div>
                            <div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr class="bg-light">
											<th>{{ trans('text.date')}}</th>
											<th>{{ trans('text.order')}}</th>
											<th>{{ trans('text.vendor')}}</th>
											<th>{{ trans('text.reference')}}</th>
											<th>{{ trans('text.qty-ordered')}}</th>
											<th>{{ trans('text.amount')}}</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(item, key, index) in report_items.data">
											<td>{{item.date}}</td>
											<td>{{item.order}}</td>
											<td>{{item.vendor}}</td>
											<td>{{item.reference}}</td>
											<td>{{item.qty_ordered}}</td>
											<td>{{item.amount}}</td>
										</tr>
									</tbody>
								</table>
							</div>
                            <div class="card-footer">
								<vue-pagination :pagination="report_items" @paginate="getReport()" :offset="4"></vue-pagination>
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
            filters:{
                daterange : {},
            },
            url_base: '/api/reports/salesorder?',
            report_items: {},
		};
	},
	methods: {

        getReport() {
			var self = this;
			var url = this.preparUrl();
			axios.get(url)
				.then((response) => {
					self.report_items = response.data.report_items;
					self.show_spinner = false;
				})
				.catch((error) => {
					self.show_spinner = false;
					self.show_error = error.response.status;
				});
		},
		preparUrl() {
			var base = this.url_base;

			var page = this.report_items.current_page;

			if (page !== undefined) {
				base += 'page=' + page + '&';
			}
			var url = base.slice(0, -1);
			return url;
		},
        filter(string){
            this.url_base = '/api/reports/salesorder' + string;
            this.getReport();
        },
	},
	mounted() {
        this.getReport();
	}
}
</script>
