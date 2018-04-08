import Vue from 'vue';
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/ja';
import VueRouter from 'vue-router';
import axios from 'axios';
import routes from './routes';
import VueLocalStorage from 'vue-localstorage';
import 'element-ui/lib/theme-chalk/index.css';
import '../css/index.css';
// コンポーネント
import menu from '../components/menu/menu.vue';
import header from '../components/header/header.vue'

Vue.use(VueRouter);
Vue.use(ElementUI, {locale});
Vue.use(VueLocalStorage);

// 全コンポーネントでaxiosを使用できる様にprototypeに登録
Vue.prototype.$axios = axios.create({
	headers: {
	  'ContentType': 'application/json',
	  'X-Requested-With': 'XMLHttpRequest'
	},
	responseType: 'json'
});

const router = new VueRouter({
  routes: routes
});

const app = new Vue({
	el: '#app',
	components: {
		'headers': header,
	},
	router
});
