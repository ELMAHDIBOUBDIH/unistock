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
								<router-link to="/admin/purchases" class="breadcrumb-item" exact> {{ trans('text.purchases')}}</router-link>
								<span class="breadcrumb-item active">{{ purchase.purchase_number}}</span>
							</div>
					</div>

					<div class="col">
							<div class="page-title text-right">
	<h5>{{ trans('text.purchases')}}</h5>
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
								<h3>{{ purchase.purchase_number}}</h3>
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
		                                    <th scope="row">{{ trans('text.purchase_number')}}</th>
		                                    <td>{{ purchase.purchase_number}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.type')}}</th>
		                                    <td>{{ purchase.type	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.date')}}</th>
		                                    <td>{{ purchase.date	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.total_tva')}}</th>
		                                    <td>{{ purchase.total_tva	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.total_ht')}}</th>
		                                    <td>{{ purchase.total_ht	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.total_ttc')}}</th>
		                                    <td>{{ purchase.total_ttc	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.remise')}}</th>
		                                    <td>{{ purchase.remise	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.valide')}}</th>
		                                    <td>{{ purchase.valide	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.note')}}</th>
		                                    <td>{{ purchase.note	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.ref_id')}}</th>
		                                    <td>{{ purchase.ref_id	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.supplier_id')}}</th>
		                                    <td>{{ purchase.supplier_id	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.employee_id')}}</th>
		                                    <td>{{ purchase.employee_id	}}</td>
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
            purchase: {},
        };
    },
    methods: {
        getPurchase() {
            var self = this;
            axios.get('/api/purchases/' + self.$route.params.id)
                .then(function(response) {
                    self.purchase = response.data.purchase;
                    self.show_spinner = false;
                })
                .catch(function(error) {
                    self.show_spinner = false;
                    self.show_error = error.response.status;
                });
        },
    },
    mounted() {
        this.getPurchase();
    },
    watch: {
        '$route'(to, from) {
            this.id = to.params.id;
            this.getPurchase();
        }
    }

}
</script>
