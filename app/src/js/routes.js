import menu from '../components/menu/menu.vue';
import realTimeInfo from '../components/realTimeInfo/realTimeInfo.vue';
import trainList from '../components/trainList/trainList.vue';
import welcom from '../components/welcom/welcom.vue';
import watchList from '../components/watchList/watchList.vue';
import NotFound from '../components/NotFound/NotFound.vue';
import help from '../components/help/help.vue';

export default [
    { path: '/', component: menu },
    { path: '/top', component: menu },
    { path: '/welcom', component: welcom },
    { path: '/realTimeInfo', component: realTimeInfo },
    { path: '/trainList', component: trainList },
    { path: '/watchList', component: watchList },
    { path: '/help', component: help },
    { path: '*', component: NotFound }
]
