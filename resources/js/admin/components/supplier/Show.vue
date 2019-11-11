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
								<router-link to="/admin/suppliers" class="breadcrumb-item" exact>{{ trans('text.suppliers')}}</router-link>
								<span class="breadcrumb-item active">{{ supplier.company_name}}</span>
							</div>
					</div>

					<div class="col">
							<div class="page-title text-right">
								<h5>{{ trans('text.suppliers')}}</h5>
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
								<h3>{{ supplier.company_name}}</h3>
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
		                                    <td>{{ supplier.company_name	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.first_name')}}</th>
		                                    <td>{{ supplier.first_name	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.last_name')}}</th>
		                                    <td>{{ supplier.last_name	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.gender')}}</th>
		                                    <td>{{ supplier.gender	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.birthday')}}</th>
		                                    <td>{{ supplier.birthday	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.tel')}}</th>
		                                    <td>{{ supplier.tel	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.fax')}}</th>
		                                    <td>{{ supplier.fax	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.address')}}</th>
		                                    <td>{{ supplier.address	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.email')}}</th>
		                                    <td>{{ supplier.email	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.image')}}</th>
		                                    <td>{{ supplier.image	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.solde')}}</th>
		                                    <td>{{ supplier.solde	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.solde_max')}}</th>
		                                    <td>{{ supplier.solde_max	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.reg_com')}}</th>
		                                    <td>{{ supplier.reg_com	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.mat_fisc')}}</th>
		                                    <td>{{ supplier.mat_fisc	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.num_art')}}</th>
		                                    <td>{{ supplier.num_art	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.bloque')}}</th>
		                                    <td>{{ supplier.bloque	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.note')}}</th>
		                                    <td>{{ supplier.note	}}</td>
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
            supplier: {},
        };
    },
    methods: {
        getSupplier() {
            var self = this;
            axios.get('/api/suppliers/' + self.$route.params.id)
                .then(function(response) {
                    self.supplier = response.data.supplier;
                    self.show_spinner = false;
                })
                .catch(function(error) {
                    self.show_spinner = false;
                    self.show_error = error.response.status;
                });
        },
    },
    mounted() {
        this.getSupplier();
    },
    watch: {
        '$route'(to, from) {
            this.id = to.params.id;
            this.getSupplier();
        }
    }

}
</script>
