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
								<router-link to="/admin/sales" class="breadcrumb-item" exact> {{ trans('text.sales')}}</router-link>
								<span class="breadcrumb-item active">{{ sale.sale_number}}</span>
							</div>
					</div>
					<div class="col ">
							<div class="page-title">
								<h5>{{ trans('text.sales')}}</h5>
							</div>
					</div>
					<div class="col">
							<div class="header-elements align-items-center">
								<router-link to="/admin/sales/create">
									<button class="btn bg-teal-400 btn-icon btn-sm">{{ trans('text.add-sale')}}</button>
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
						<div class="card">
							<div class="card-header">
								<h3>{{ sale.sale_number}}</h3>
							</div>
							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th style="width: 10%;" scope="col"></th>
		                                    <th scope="col"></th>
										</tr>
									</thead>
									<tbody>
		                                <tr>
		                                    <th scope="row">{{ trans('text.sale_number')}}</th>
		                                    <td>{{ sale.sale_number}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.type')}}</th>
		                                    <td>{{ sale.type	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.date')}}</th>
		                                    <td>{{ sale.date	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.total_tva')}}</th>
		                                    <td>{{ sale.total_tva	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.total_ht')}}</th>
		                                    <td>{{ sale.total_ht	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.total_ttc')}}</th>
		                                    <td>{{ sale.total_ttc	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.remise')}}</th>
		                                    <td>{{ sale.remise	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.valide')}}</th>
		                                    <td>{{ sale.valide	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.note')}}</th>
		                                    <td>{{ sale.note	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.ref_id')}}</th>
		                                    <td>{{ sale.ref_id	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.customer_id')}}</th>
		                                    <td>{{ sale.customer_id	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.employee_id')}}</th>
		                                    <td>{{ sale.employee_id	}}</td>
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
            sale: {},
        };
    },
    methods: {
        getSale() {
            var self = this;
            axios.get('/api/sales/' + self.$route.params.id)
                .then(function(response) {
                    self.sale = response.data.sale;
                    self.show_spinner = false;
                })
                .catch(function(error) {
                    self.show_spinner = false;
                    self.show_error = error.response.status;
                });
        },
    },
    mounted() {
        this.getSale();
    },
    watch: {
        '$route'(to, from) {
            this.id = to.params.id;
            this.getSale();
        }
    }

}
</script>
