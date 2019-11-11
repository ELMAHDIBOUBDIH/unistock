/** Intials **/

require('./bootstrap');
require('./main');
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

/*** Tirth party component ***/

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Vuex from 'vuex'
Vue.use(Vuex)

/*** Local component ***/
Vue.component('example-component', require('./components/ExampleComponent.vue'));


/*** Router ***/

const router = new VueRouter({
	mode: 'history',
	linkActiveClass: 'active',
	linkExactActiveClass: 'exact-active',
	routes: [
        {
			path: '/' ,
			component: require('./components/Index.vue')
		},
        {
			path: '/login' ,
			component: require('./components/auth/Login.vue')
		},
        {
			path: '/' ,
			component: require('./components/auth/Login.vue')
		},


	]
})
router.afterEach((to, from) => {
  //window.scroll(0, 0);
})

const app = new Vue({
  router
}).$mount('#app')
