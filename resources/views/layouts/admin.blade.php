<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta rel="stylesheet" href="https://unpkg.com/vue-pure-lightbox/dist/vue-pure-lightbox.css">

	<title>{{trans('admin.dashboard_title')}}</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/icons/icomoon/styles.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/icons/fontawesome/styles.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/admin_' .config('unistock.version') . '.css') }}">
  <script>
      window.App = {!! json_encode([
              'csrfToken' => csrf_token(),
      ]) !!};
  </script>
  <style>
	  footer {
    position: fixed;
    height: 100px;
    bottom: 0;
    width: 100%;
}
  </style>
</head>

<body>
  <div id="app">
	<!-- Page header -->
	<div class="page-header page-header-dark">

		<!-- Main navbar -->
		<div class="navbar navbar-main navbar-expand-md navbar-dark border-transparent shadow-0">
			<div class="navbar-brand wmin-0 mr-5">
				<a href="index.html" class="d-inline-block">
					<img src="{{ asset('images/logo_light.png') }}" alt="">
				</a>
			</div>

			<div class="d-md-none">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
					<i class="icon-tree5"></i>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="navbar-mobile">
				<ul class="navbar-nav ml-md-3">
					<li class="nav-item dropdown dropdown-user">
						<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
							<i class="icon-folder"></i>
							<span>{{trans('text.dossier')}}</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item"><i class="icon-folder"></i> {{trans('text.dossier')}}</a>
						</div>
					</li>
				</ul>
				<ul class="navbar-nav ml-md-auto">
					<li class="nav-item dropdown dropdown-user">
						<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
							<img src="{{ asset('images/placeholders/placeholder.jpg') }}" class="rounded-circle" alt="">
							<span>{{trans('text.name')}}</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item"><i class="icon-user-plus"></i> {{trans('text.my-profile')}}</a>
							<a href="#" class="dropdown-item"><i class="icon-cog5"></i> {{trans('text.account-settings')}}</a>
							<a href="#" class="dropdown-item"><i class="icon-switch2"></i> {{trans('text.logout')}}</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!-- /main navbar -->
		<!-- Secondary navbar -->
		<div class="navbar navbar-secondary navbar-expand-md navbar-dark  border-0 shadow-0">
			<div class="d-md-none w-100">
				<button type="button" class="navbar-toggler d-flex align-items-center w-100" data-toggle="collapse" data-target="#navbar-navigation">
					<i class="icon-menu-open mr-2"></i>
					{{trans('text.main-navigation')}}
				</button>
			</div>
			<div class="navbar-collapse collapse" id="navbar-navigation">
				<ul class="navbar-nav navbar-nav-highlight">
					<li class="nav-item">
						<router-link to="/admin" class="navbar-nav-link active">
							<i class="icon-home4 mr-2"></i>
							{{trans('text.dashboard')}}
						</router-link>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
							<i class="icon-box mr-2"></i>
							{{trans('text.produit')}}
						</a>
						<div class="dropdown-menu">
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/products"><i class="icon-align-center-horizontal"></i>{{trans('text.products-all')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/products/create"><i class="icon-add"></i></router-link>
							</div>
							<router-link class="dropdown-item" to="/admin/products-categories"><i class="icon-align-center-horizontal"></i>{{trans('text.products-categories')}}</router-link>
							<router-link class="dropdown-item" to="/admin/products-warehouses"><i class="icon-align-center-horizontal"></i>{{trans('text.products-warehouses')}}</router-link>
							<router-link class="dropdown-item" to="/admin/products-brands"><i class="icon-align-center-horizontal"></i>{{trans('text.products-brands')}}</router-link>
							<router-link class="dropdown-item" to="/admin/products-adjustments"><i class="icon-align-center-horizontal"></i>{{trans('text.products-adjustments')}}</router-link>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cart mr-2"></i>
							{{trans('text.purchases')}}
						</a>
						<div class="dropdown-menu">
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/purchases/orders"><i class="icon-cart"></i>{{trans('text.orders')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/purchases/create/order"><i class="icon-add"></i></router-link>
							</div>
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/purchases/purchase-receives"><i class="icon-file-check2"></i>{{trans('text.purchase-receives')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/purchases/create/purchase-receive"><i class="icon-add"></i></router-link>
							</div>
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/purchases/bills"><i class="icon-file-empty2"></i>{{trans('text.bill')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/purchases/create/bill"><i class="icon-add"></i></router-link>
							</div>
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/purchases/supplier-regulations"><i class="icon-cash4"></i>{{trans('text.supplier-regulations')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/purchases/create/supplier-regulation"><i class="icon-add"></i></router-link>
							</div>
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/purchases/supplier-returns"><i class="icon-arrow-left7"></i>{{trans('text.supplier-returns')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/purchases/create/supplier-return"><i class="icon-add"></i></router-link>
							</div>
								<router-link class="dropdown-item"  to="/admin/purchases/orders-not-received"><i class="icon-file-minus2"></i>{{trans('text.orders-not-received')}}</router-link>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
							<i class="icon-stats-growth mr-2"></i>
							{{trans('text.sales')}}
						</a>
						<div class="dropdown-menu">
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/sales/quotations"><i class="icon-clipboard6"></i>{{trans('text.quotations')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/sales/create/quotation"><i class="icon-add"></i></router-link>
							</div>
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/sales/orders"><i class="icon-cart"></i>{{trans('text.orders')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/sales/create/order"><i class="icon-add"></i></router-link>
							</div>
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/sales/invoices"><i class="icon-file-empty2"></i>{{trans('text.invoice')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/sales/create/invoice"><i class="icon-add"></i></router-link>
							</div>
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/sales/client-regulations"><i class="icon-cash4"></i>{{trans('text.client-regulations')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/sales/create/client-regulation"><i class="icon-add"></i></router-link>
							</div>
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/sales/client-returns"><i class="icon-arrow-right7"></i>{{trans('text.client-returns')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/sales/create/client-return"><i class="icon-add"></i></router-link>
							</div>
						</div>
					</li>
					<li class="nav-item">
						<router-link to="/admin/reports" class="navbar-nav-link">
							<i class="icon-file-stats mr-2"></i>
							{{trans('text.reports')}}
						</router-link>
					</li>
				</ul>

				<ul class="navbar-nav navbar-nav-highlight ml-md-auto">
					<li class="nav-item dropdown">
						<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
							<i class="icon-address-book2 mr-2"></i>
							<span class="d-md-none ml-2">{{trans('text.contacts')}}</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/suppliers"><i class="fa fa-industry"></i>{{trans('text.suppliers')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/suppliers/create"><i class="icon-add"></i></router-link>
							</div>
							<div class="dropdown-item-group">
								<router-link class="dropdown-item"  to="/admin/customers"><i class="icon-store"></i>{{trans('text.customers')}}</router-link>
								<router-link class="dropdown-item dropdown-item-right-btn"  to="/admin/customers/create"><i class="icon-add"></i></router-link>
							</div>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cog3"></i>
							<span class="d-md-none ml-2">{{trans('text.settings')}}</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<router-link class="dropdown-item"  to="/admin/organization-profile"><i class="icon-tree6"></i>{{trans('text.organization-profile')}}</router-link>
							<router-link class="dropdown-item"  to="/admin/users"><i class="icon-users2"></i>{{trans('text.users-roles')}}</router-link>
							<div class="dropdown-divider"></div>
							<router-link class="dropdown-item"  to="/admin/categories"><i class="icon-drawer3"></i>{{trans('text.categories')}}</router-link>
							<router-link class="dropdown-item"  to="/admin/brands"><i class="icon-price-tags"></i>{{trans('text.brands')}}</router-link>
							<router-link class="dropdown-item"  to="/admin/customergroups"><i class="icon-users4"></i> {{trans('text.group-client')}}</router-link>
							<router-link class="dropdown-item"  to="/admin/warehouses"><i class="icon-home7"></i>{{trans('text.warehouses')}}</router-link>
							<router-link class="dropdown-item"  to="/admin/comptes"><i class="fa fa-bank"></i> {{trans('text.comptes')}}</router-link>
							<router-link class="dropdown-item"  to="/admin/paymentmodes"><i class="icon-credit-card2"></i> {{trans('text.mode-paiement')}}</router-link>
							<div class="dropdown-divider"></div>
							<router-link class="dropdown-item"  to="/admin/currencies"><i class="icon-coin-euro"></i>{{trans('text.currencies')}}</router-link>
							<router-link class="dropdown-item"  to="/admin/taxes"><i class="icon-percent"></i>{{trans('text.taxes')}}</router-link>
							<router-link class="dropdown-item"  to="/admin/templates"><i class="icon-files-empty2"></i>{{trans('text.templates')}}</router-link>
							<router-link class="dropdown-item"  to="/admin/email-templates"><i class="icon-mail-read"></i>{{trans('text.email-templates')}}</router-link>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!-- /secondary navbar -->


		<!-- Floating menu -->
		<ul class="fab-menu fab-menu-absolute fab-menu-top-right" data-fab-toggle="click">
			<li>
				<a class="fab-menu-btn btn bg-pink-300 btn-float rounded-round btn-icon">
					<i class="fab-icon-open icon-plus3"></i>
					<i class="fab-icon-close icon-cross2"></i>
				</a>

				<ul class="fab-menu-inner">
					<li>
						<div data-fab-label="{{trans('text.creer-devis')}}">
							<a href="#" class="btn btn-light rounded-round btn-icon btn-float">
								<i class=" icon-file-text2"></i>
							</a>
						</div>
					</li>
					<li>
						<div data-fab-label="{{trans('text.ajouter-produit')}}">
							<a href="#" class="btn btn-light rounded-round btn-icon btn-float">
								<i class="icon-box"></i>
							</a>
						</div>
					</li>
				</ul>
			</li>
		</ul>
		<!-- /floating menu -->

	</div>
	<!-- /page header -->


	<router-view></router-view>


	<!-- Footer -->
	<div class="navbar navbar-expand-lg navbar-light  fixed-bottom ">
		<div class="text-center d-lg-none w-100">
			<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
				<i class="icon-unfold mr-2"></i>
				Footer
			</button>
		</div>

		<div class="navbar-collapse collapse" id="navbar-footer">
			<span class="navbar-text">
				footer-text
			</span>

			<ul class="navbar-nav ml-lg-auto">
				<li class="nav-item"><a href="#" class="navbar-nav-link" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
				<li class="nav-item"><a href="#" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
			</ul>
		</div>
	</div>

	@include('includes.notifications')
	<!-- /footer -->
  </div>

  <script src="{{ asset('js/trans/'.LaravelLocalization::getCurrentLocale().'/admin.js') }}"></script>
  <script src="{{ asset('js/admin_' .config('unistock.version') . '.js') }}"></script>

  <script src="{{ asset('js/plugins/visualization/d3/d3.min.js') }}"></script>
  <script src="{{ asset('js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
  <script src="{{ asset('js/plugins/forms/styling/switchery.min.js') }}"></script>
  <script src="{{ asset('js/plugins/moment.min.js') }}"></script>
  <script src="{{ asset('js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
  <script src="{{ asset('js/plugins/pickers/daterangepicker.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

</body>
</html>
