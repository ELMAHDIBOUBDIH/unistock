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
								<router-link to="/admin/customers" class="breadcrumb-item" exact>{{ trans('text.customers')}}</router-link>
								<span class="breadcrumb-item active">{{ customer.company_name}}</span>
							</div>
					</div>
					<div class="col">
							<div class="page-title text-right">
								<h5>{{ trans('text.customers')}}</h5>
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
								<h3>{{ customer.company_name}}</h3>
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
		                                    <th scope="row">{{ trans('text.company_name')}}</th>
		                                    <td>{{ customer.company_name	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.first_name')}}</th>
		                                    <td>{{ customer.first_name	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.last_name')}}</th>
		                                    <td>{{ customer.last_name	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.gender')}}</th>
		                                    <td>{{ customer.gender	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.birthday')}}</th>
		                                    <td>{{ customer.birthday	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.tel')}}</th>
		                                    <td>{{ customer.tel	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.fax')}}</th>
		                                    <td>{{ customer.fax	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.address')}}</th>
		                                    <td>{{ customer.address	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.email')}}</th>
		                                    <td>{{ customer.email	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.image')}}</th>
		                                    <td>{{ customer.image	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.solde')}}</th>
		                                    <td>{{ customer.solde	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.solde_max')}}</th>
		                                    <td>{{ customer.solde_max	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.reg_com')}}</th>
		                                    <td>{{ customer.reg_com	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.mat_fisc')}}</th>
		                                    <td>{{ customer.mat_fisc	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.num_art')}}</th>
		                                    <td>{{ customer.num_art	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.bloque')}}</th>
		                                    <td>{{ customer.bloque	}}</td>
		                                </tr>
										<tr>
	                                        <th scope="row">{{ trans('text.group_name')}}</th>
	                                        <td>{{ customer.group_name	}}</td>
	                                    </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.note')}}</th>
		                                    <td>{{ customer.note	}}</td>
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
            customer: {},
        };
    },
    methods: {
        getCustomer() {
            var self = this;
            axios.get('/api/customers/' + self.$route.params.id)
                .then(function(response) {
                    self.customer = response.data.customer;
                    self.show_spinner = false;
                })
                .catch(function(error) {
                    self.show_spinner = false;
                    self.show_error = error.response.status;
                });
        },
    },
    mounted() {
        this.getCustomer();
    },
    watch: {
        '$route'(to, from) {
            this.id = to.params.id;
            this.getCustomer();
        }
    }

}
</script>
