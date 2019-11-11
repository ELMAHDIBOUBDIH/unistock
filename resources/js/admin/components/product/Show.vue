<template>
  <div>
    <!-- Page header -->
    <vue-headful :title="trans('text.dashboard_title')"/>
    <div class="page-header-secondary page-header-light">
      <div class="page-header-content">
        <div class="row">
          <div class="col">
            <div class="breadcrumb">
              <router-link to="/admin" class="breadcrumb-item" exact>
                <i class="icon-home2 mr-2"></i>
                {{ trans('text.dashboard')}}
              </router-link>
              <router-link
                to="/admin/products"
                class="breadcrumb-item"
                exact
              >{{ trans('text.products')}}</router-link>
              <span class="breadcrumb-item active">{{ product.designation}}</span>
            </div>
          </div>
          <div class="col">
            <div class="page-title text-right">
              <h5>{{ trans('text.products')}}</h5>
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
          <loading-error :type="show_error"/>
        </div>
        <section v-else class="content">
          <div class="row">
            <div class="col-xl-12">
              <div class="card">
                <div class="card-body p-0">
                  <div class="row">
                    <div class="col-md-3 pr-0">
                      <div class="card-left">
                        <div class="card-left-header">{{trans('text.all-products')}}</div>
                        <ul class="list-group">
                          <li
                            v-for="(product, key, index) in products.data"
                            class="list-group-item"
                            :class="{active : product.id == $route.params.id}"
                          >
                            <div class="d-flex">
                              <img
                                :src="'../../uploads/products/xs/'+product.image"
                                :alt="product.designation"
                                :title="product.designation"
                              >
                              <router-link
                                :to="'/admin/products/' + product.id"
                              >{{product.designation}}</router-link>
                            </div>
                          </li>
                        </ul>
                        <div class="card-left-footer">
                          <vue-pagination
                            :pagination="products"
                            @paginate="getProducts()"
                            :offset="4"
                          ></vue-pagination>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-9 pl-0">
                      <div class="card-right">
                        <div class="card-right-header bg-white p-3">{{ product.designation}}</div>
                        <div class="card-right-body">
                          <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item">
                              <a
                                href="#bottom-tab1"
                                class="nav-link active"
                                data-toggle="tab"
                              >{{trans('text.primary-details')}}</a>
                            </li>
                            <li class="nav-item">
                              <a
                                href="#bottom-tab3"
                                class="nav-link"
                                data-toggle="tab"
                              >{{trans('text.sale-information')}}</a>
                            </li>
                            <li class="nav-item">
                              <a
                                href="#bottom-tab4"
                                class="nav-link"
                                data-toggle="tab"
                              >{{trans('text.warehouse-information')}}</a>
                            </li>
                            <li class="nav-item">
                              <a
                                href="#bottom-tab5"
                                class="nav-link"
                                data-toggle="tab"
                              >{{trans('text.pack-information')}}</a>
                            </li>
                          </ul>
                          <div class="tab-content p-3">
                            <div class="tab-pane fade show active" id="bottom-tab1">
                              <div class="row">
                                <div class="col-md-8">
                                  <table class="table table-striped">
                                    <tbody>
                                      <tr scope="row">
                                        <th>{{trans('text.code_barre')}}</th>
                                        <td>{{ product.code_barre }}</td>
                                      </tr>
                                      <tr>
                                        <th class="w-180">{{ trans('text.reference')}}</th>
                                        <td>{{ product.reference}}</td>
                                      </tr>
                                      <tr>
                                        <th>{{ trans('text.designation')}}</th>
                                        <td>{{ product.designation}}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">{{ trans('text.unit')}}</th>
                                        <td>{{ product.unit }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">{{ trans('text.cond')}}</th>
                                        <td>{{ product.cond }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">{{ trans('text.tva')}}</th>
                                        <td>{{ product.tva }} %</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">{{ trans('text.product_facturable')}}</th>
                                        <td
                                          v-if="product.product_facturable !=0"
                                        >{{ trans('text.facturable') }}</td>
                                        <td v-else>{{ trans('text.non_facturable') }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">{{ trans('text.product_perissable')}}</th>
                                        <td
                                          v-if="product.product_perissable !=0"
                                        >{{ trans('text.perissable') }}</td>
                                        <td v-else>{{ trans('text.non_perissable') }}</td>
                                      </tr>
                                      <tr v-if="product.product_perissable !=0">
                                        <th scope="row">{{ trans('text.date_p')}}</th>
                                        <td>{{ product.date_p }}</td>
                                      </tr>
                                      <tr v-if="product.product_perissable !=0">
                                        <th scope="row">{{ trans('text.alert_p')}}</th>
                                        <td>{{ product.alert_p }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">{{ trans('text.etat')}}</th>
                                        <td v-if="product.etat !=0">{{ trans('text.etat_actif') }}</td>
                                        <td v-else>{{ trans('text.etat_non_actif') }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">{{ trans('text.brand')}}</th>
                                        <td>{{ product.brand_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">{{ trans('text.category')}}</th>
                                        <td>{{ product.category_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">{{ trans('text.supplier')}}</th>
                                        <td>{{ product.supplier_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">{{ trans('text.note')}}</th>
                                        <td>{{ product.note }}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="col-md-4">
                                  <div class="item-image">
                                    <img
                                      :src="'../../uploads/products/lg/'+product.image"
                                      class="img-fluid rounded"
                                      :alt="product.designation"
                                      :title="product.designation"
                                    >
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="bottom-tab3">
                              <table class="table table-striped">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ trans('text.price_ht')}}</th>
                                    <td>{{ product.price_ht }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ trans('text.price_ttc')}}</th>
                                    <td>{{ product.price_ttc }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ trans('text.last_price')}}</th>
                                    <td>{{ product.last_price }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ trans('text.pmp')}}</th>
                                    <td>{{ product.pmp }}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="tab-pane fade" id="bottom-tab4">
                              <table class="table table-striped">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ trans('text.qnt_initial')}}</th>
                                    <td>{{ product.qnt_initial }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">{{ trans('text.alert_stock')}}</th>
                                    <td>{{ product.alert_stock }}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="tab-pane fade" id="bottom-tab5">
                              <table class="table table-striped">
                                <tbody>
                                  <tr>
                                    <th scope="row">{{ trans('text.pack')}}</th>
                                    <td v-if="product.pack !=0">{{ trans('text.yes')}}</td>
                                    <td v-else>{{ trans('text.no')}}</td>
                                  </tr>
                                  <tr v-if="product.pack !=0">
                                    <th scope="row">{{ trans('text.qnt_pack')}}</th>
                                    <td>{{ product.qnt_pack }}</td>
                                  </tr>
                                  <tr v-if="product.pack !=0">
                                    <th scope="row">{{ trans('text.price_pack')}}</th>
                                    <td>{{ product.price_pack }}</td>
                                  </tr>
                                  <tr v-if="product.pack !=0">
                                    <th scope="row">{{ trans('text.price_unit_pack')}}</th>
                                    <td>{{ product.price_unit_pack }}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
import styles from "vue-pure-lightbox/dist/VuePureLightbox.css";
export default {
  data() {
    return {
      show_spinner: true,
      show_error: false,
      product: {},
      products: {}
    };
  },
  methods: {
    getProduct() {
      var self = this;
      axios
        .get("/api/products/" + self.$route.params.id)
        .then(function(response) {
          self.product = response.data.product;
          self.products = response.data.products;
          self.show_spinner = false;
        })
        .catch(function(error) {
          self.show_spinner = false;
          self.show_error = error.response.status;
        });
    }
  },
  mounted() {
    this.getProduct();
  },
  watch: {
    $route(to, from) {
      this.id = to.params.id;
      this.getProduct();
    }
  }
};
</script>