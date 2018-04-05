import Vue from 'vue';
import ElementUI, { Menu } from 'element-ui';
import locale from 'element-ui/lib/locale/lang/ja';
import 'element-ui/lib/theme-chalk/index.css';
import VueRouter from 'vue-router';
import routes from './routes';
import menu from '../components/menu/menu.vue';

Vue.use(VueRouter);
Vue.use(ElementUI, {locale});

const router = new VueRouter({
  routes: routes
});

const app = new Vue({
	el: '#app',
	components: {
		'topmenu': menu,
	},
	router
});
