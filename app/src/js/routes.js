import menu from '../components/menu/menu.vue';
import delayInfo from '../components/delayInfo/delayInfo.vue';
import trainList from '../components/trainList/trainList.vue';
import about from '../components/about/about.vue';

export default [
	{ path: '/', component: menu },
	{ path: '/about', component: about},
	{ path: '/delayInfo', component: delayInfo },
	{ path: '/trainList', component: trainList },
]
