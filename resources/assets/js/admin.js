
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import axios from 'axios'
import App from './components/admin/rv.vue'
import router from './router/admin.js'
import Vuex from 'vuex'
import store from './store'
import hostSetting from './hostSetting'
import Fun from './fun'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import tree from './part/tree.vue'


Vue.prototype.$ajax = axios
Vue.use(Fun)
Vue.use(ElementUI)
Vue.use(Vuex)
Vue.component('tree',tree)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.host = hostSetting.host
const app = new Vue({
        el: '#app',
        router,
        store,
        template: '<App/>',
        render: h => h(App)
    }
);
