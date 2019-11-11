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
								<router-link to="/admin/users" class="breadcrumb-item" exact>{{ trans('text.users')}}</router-link>
								<span class="breadcrumb-item active">{{ user.company_name}}</span>
							</div>
					</div>

					<div class="col">
							<div class="page-title">
								<h5>{{ trans('text.users')}}</h5>

							</div>
					</div>
					<div class="col">
							<div class="header-elements align-items-center">

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
								<h3>{{ user.company_name}}</h3>
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
		                                    <td>{{ user.company_name	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.first_name')}}</th>
		                                    <td>{{ user.first_name	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.last_name')}}</th>
		                                    <td>{{ user.last_name	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.gender')}}</th>
		                                    <td>{{ user.gender	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.birthday')}}</th>
		                                    <td>{{ user.birthday	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.tel')}}</th>
		                                    <td>{{ user.tel	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.fax')}}</th>
		                                    <td>{{ user.fax	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.address')}}</th>
		                                    <td>{{ user.address	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.email')}}</th>
		                                    <td>{{ user.email	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.image')}}</th>
		                                    <td>{{ user.image	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.qualification')}}</th>
		                                    <td>{{ user.qualification	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.recruitment_date')}}</th>
		                                    <td>{{ user.recruitment_date	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.password')}}</th>
		                                    <td>{{ user.password	}}</td>
		                                </tr>
		                                <tr>
		                                    <th scope="row">{{ trans('text.note')}}</th>
		                                    <td>{{ user.note	}}</td>
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
            user: {},
        };
    },
    methods: {
        getSupplier() {
            var self = this;
            axios.get('/api/users/' + self.$route.params.id)
                .then(function(response) {
                    self.user = response.data.employee;
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
