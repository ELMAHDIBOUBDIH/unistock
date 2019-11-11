/** Intials **/

// core JS files
require('./bootstrap');
require('./plugins/loaders/blockui.min.js');
require('./plugins/ui/slinky.min.js');
require('./plugins/ui/fab.min.js');
require('./plugins/ui/ripple.min.js');


//Theme files
require('./pages/dashboard.js');
require('vue-image-lightbox/dist/vue-image-lightbox.min.css')

window.Vue = require('vue');
window.Event = new Vue();


/*** Prototypes ***/

Vue.prototype.trans = (string, args) => {
	let value = _.get(window.trans, string, string);
	_.eachRight(args, (paramVal, paramKey) => {
		value = _.replace(value, `:${paramKey}`, paramVal);
	});
	return value;
};
Vue.prototype.Auth = window.App.user
Vue.prototype.locale = window.App.locale

/*** Tirth party component ***/

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import vueHeadful from 'vue-headful';
Vue.component('vue-headful', vueHeadful);

import Vuex from 'vuex'
Vue.use(Vuex)

import VuePureLightbox from 'vue-pure-lightbox'
Vue.component('vue-pure-lightbox', VuePureLightbox);

/*** Local component ***/

Vue.component('loading-spinner', require('./components/partials/LoadingSpinner.vue'));
Vue.component('loading-error', require('./components/partials/LoadingError.vue'));
Vue.component('confirmation', require('./components/partials/Confirmation.vue'));
Vue.component('notifications', require('./components/partials/Notifications.vue'));
Vue.component('filtering', require('./components/partials/Filtering.vue'));
Vue.component('sorting', require('./components/partials/Sorting.vue'));
Vue.component('vue-pagination', require('./components/partials/Pagination.vue'));
//Vue.component('toggle-status', 		require('./components/partials/ToggleStatus.vue'));
Vue.component('upload-image', require('./components/partials/UploadImage.vue'));

Vue.component('select2', require('./components/forms/Select2.vue'));
Vue.component('date-piker', require('./components/forms/DatePiker.vue'));
Vue.component('switchery', require('./components/forms/Switchery.vue'));

Vue.component('category-form', require('./components/category/Form.vue'));
Vue.component('compte-form', require('./components/compte/Form.vue'));
Vue.component('warehouse-form', require('./components/warehouse/Form.vue'));
Vue.component('customergroup-form', require('./components/customergroup/Form.vue'));
Vue.component('paymentmode-form', require('./components/paymentmode/Form.vue'));
Vue.component('brand-form', require('./components/brand/Form.vue'));
Vue.component('supplier-form', require('./components/supplier/Form.vue'));
Vue.component('user-form', require('./components/user/Form.vue'));
Vue.component('role-form', require('./components/role/Form.vue'));
Vue.component('customer-form', require('./components/customer/Form.vue'));
Vue.component('sale-form', require('./components/sale/Form.vue'));
Vue.component('purchase-form', require('./components/purchase/Form.vue'));
Vue.component('product-form', require('./components/product/Form.vue'));
Vue.component('warehouseproduct-form', require('./components/warehouseproduct/Form.vue'));

/*** Router ***/

const router = new VueRouter({
	mode: 'history',
	linkActiveClass: 'active',
	linkExactActiveClass: 'exact-active',
	routes: [{
			path: '/admin',
			component: require('./components/Index.vue')
		},
		//categories
		{
			path: '/admin/categories',
			component: require('./components/category/Index.vue')
		},

		{
			path: '/admin/categories/:id',
			component: require('./components/category/Index.vue')
		},
		//comptes
		{
			path: '/admin/comptes',
			component: require('./components/compte/Index.vue')
		},

		{
			path: '/admin/comptes/:id',
			component: require('./components/compte/Index.vue')
		},
		//warehouses
		{
			path: '/admin/warehouses',
			component: require('./components/warehouse/Index.vue')
		},

		{
			path: '/admin/warehouses/:id',
			component: require('./components/warehouse/Index.vue')
		},
		//paymentmodes
		{
			path: '/admin/paymentmodes',
			component: require('./components/paymentmode/Index.vue')
		},

		{
			path: '/admin/paymentmodes/:id',
			component: require('./components/paymentmode/Index.vue')
		},
		//customergroups
		{
			path: '/admin/customergroups',
			component: require('./components/customergroup/Index.vue')
		},

		{
			path: '/admin/customergroups/:id',
			component: require('./components/customergroup/Index.vue')
		},
		//brands
		{
			path: '/admin/brands',
			component: require('./components/brand/Index.vue')
		},

		{
			path: '/admin/brands/:id',
			component: require('./components/brand/Index.vue')
		},
		//suppliers
		{
			path: '/admin/suppliers',
			component: require('./components/supplier/Index.vue')
		},
		{
			path: '/admin/suppliers/create',
			component: require('./components/supplier/Create.vue')
		},
		{
			path: '/admin/suppliers/:id',
			component: require('./components/supplier/Show.vue')
		},
		{
			path: '/admin/suppliers/:id/edit',
			component: require('./components/supplier/Edit.vue')
		},
		//users
		{
			path: '/admin/users',
			component: require('./components/user/Index.vue')
		},
		{
			path: '/admin/users/create',
			component: require('./components/user/Create.vue')
		},
		{
			path: '/admin/users/:id',
			component: require('./components/user/Show.vue')
		},
		{
			path: '/admin/users/:id/edit',
			component: require('./components/user/Edit.vue')
		},

		//roles
		{
			path: '/admin/roles',
			component: require('./components/role/Index.vue')
		},
		{
			path: '/admin/roles/create',
			component: require('./components/role/Create.vue')
		},
		{
			path: '/admin/roles/:id',
			component: require('./components/role/Show.vue')
		},
		{
			path: '/admin/roles/:id/edit',
			component: require('./components/role/Edit.vue')
		},
		//customers
		{
			path: '/admin/customers',
			component: require('./components/customer/Index.vue')
		},
		{
			path: '/admin/customers/create',
			component: require('./components/customer/Create.vue')
		},
		{
			path: '/admin/customers/:id',
			component: require('./components/customer/Show.vue')
		},
		{
			path: '/admin/customers/:id/edit',
			component: require('./components/customer/Edit.vue')
		},
		//sales
		{
			path: '/admin/sales/quotations',
			component: require('./components/sale/Index.vue')
		},
		{
			path: '/admin/sales/orders',
			component: require('./components/sale/Index.vue')
		},
		{
			path: '/admin/sales/invoices',
			component: require('./components/sale/Index.vue')
		},
		{
			path: '/admin/sales/client-regulations',
			component: require('./components/sale/Index.vue')
		},
		{
			path: '/admin/sales/client-returns',
			component: require('./components/sale/Index.vue')
		},
		{
			path: '/admin/sales/create/:type',
			component: require('./components/sale/Create.vue')
		},
		{
			path: '/admin/sales/:id',
			component: require('./components/sale/Show.vue')
		},
		{
			path: '/admin/sales/:id/edit',
			component: require('./components/sale/Edit.vue')
		},
		//purchases
		{
			path: '/admin/purchases/orders',
			component: require('./components/purchase/Index.vue')
		},
		{
			path: '/admin/purchases/purchase-receives',
			component: require('./components/purchase/Index.vue')
		},
		{
			path: '/admin/purchases/bills',
			component: require('./components/purchase/Index.vue')
		},
		{
			path: '/admin/purchases/supplier-regulations',
			component: require('./components/purchase/Index.vue')
		},
		{
			path: '/admin/purchases/supplier-returns',
			component: require('./components/purchase/Index.vue')
		},
		{
			path: '/admin/purchases/orders-not-received',
			component: require('./components/purchase/Index.vue')
		},
		{
			path: '/admin/purchases',
			component: require('./components/purchase/Index.vue')
		},
		{
			path: '/admin/purchases/create/:type',
			component: require('./components/purchase/Create.vue')
		},
		{
			path: '/admin/purchases/:id',
			component: require('./components/purchase/Show.vue')
		},
		{
			path: '/admin/purchases/:id/edit',
			component: require('./components/purchase/Edit.vue')
		},

		//products
		{
			path: '/admin/products',
			component: require('./components/product/Index.vue')
		},
		{
			path: '/admin/products/create',
			component: require('./components/product/Create.vue')
		},
		{
			path: '/admin/products/:id',
			component: require('./components/product/Show.vue')
		},
		{
			path: '/admin/products/:id/edit',
			component: require('./components/product/Edit.vue')
		},
		//warehouseproducts
		{
			path: '/admin/warehouseproducts/create',
			component: require('./components/warehouseproduct/Create.vue')
		},
		{
			path: '/admin/warehouseproducts/:id',
			component: require('./components/warehouseproduct/Index.vue')
		},
		{
			path: '/admin/warehouseproducts/:id/edit',
			component: require('./components/warehouseproduct/Edit.vue')
		},
		//reports
		{
			path: '/admin/reports',
			component: require('./components/reports/Index.vue')
		},
		{
			path: '/admin/reports/purchaseorder',
			component: require('./components/reports/Purchaseorder.vue')
		},
		{
			path: '/admin/reports/receive',
			component: require('./components/reports/Receive.vue')
		},
		{
			path: '/admin/reports/purchasesbyitem',
			component: require('./components/reports/Purchasesbyitem.vue')
		},
		{
			path: '/admin/reports/billdetails',
			component: require('./components/reports/Billdetails.vue')
		},
		{
			path: '/admin/reports/purchasebyvendor',
			component: require('./components/reports/Purchasebyvendor.vue')
		},
		{
			path: '/admin/reports/paymentmade',
			component: require('./components/reports/Paymentmade.vue')
		},
		{
			path: '/admin/reports/salesorder',
			component: require('./components/reports/Salesorder.vue')
		},
		{
			path: '/admin/reports/invoice',
			component: require('./components/reports/Invoice.vue')
		},
		{
			path: '/admin/reports/payment',
			component: require('./components/reports/Payment.vue')
		},
		{
			path: '/admin/reports/salesbycustomer',
			component: require('./components/reports/Salesbycustomer.vue')
		},
		{
			path: '/admin/reports/salesbyitem',
			component: require('./components/reports/Salesbyitem.vue')
		},
		{
			path: '/admin/reports/salesbysp',
			component: require('./components/reports/Salesbysp.vue')
		},
		{
			path: '/admin/reports/customerbalance',
			component: require('./components/reports/Customerbalance.vue')
		},
		{
			path: '/admin/reports/productsales',
			component: require('./components/reports/Productsales.vue')
		},
		{
			path: '/admin/reports/productpurchase',
			component: require('./components/reports/Productpurchase.vue')
		},
		{
			path: '/admin/reports/inventory',
			component: require('./components/reports/Inventory.vue')
		},
		{
			path: '/admin/reports/inventoryvaluation',
			component: require('./components/reports/Inventoryvaluation.vue')
		},
		{
			path: '/admin/reports/fifocostlottracking',
			component: require('./components/reports/Fifocostlottracking.vue')
		},
		{
			path: '/admin/reports/warehouse',
			component: require('./components/reports/Warehouse.vue')
		},

	]
})
router.afterEach((to, from) => {
	//window.scroll(0, 0);
})

/*** Vuex ***/

const store = new Vuex.Store({
	state: {
		showSearchIcon: true,
		firstRequest: true,
		createArticle: {
			suggestion: 0
		},
	}
})

const app = new Vue({
	store: store,
	router,
}).$mount('#app')
