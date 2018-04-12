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
Vue.use(ElementUI, { locale });
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
    router,
    created: function() {
        this.showMessage();
    },
    methods: {
        // 初めてサイト来る方には注意のポップアップを表示
        showMessage() {
            let isVisited = this.$localStorage.get('isVisited');

            if (!isVisited) {
                let text = `
                    <h1>Delay Train's Info</h1>
                    <br>
                    このサイトは普段から使用している路線をウォッチして<br>
                    電車が遅延しているかどうかを知ることができます。<br>
                    <br>
                    一部の機能はTwitterAPIを使用していますが<br>
                    TwitterAPIの制限が厳しいため<br>
                    あまり一杯検索しないで下さいね。(切実)<br>
                    <br>
                    必要な時に、必要なだけをお願いします。<br>
                    <br>

                    こういった機能が欲しいという要望は<br>
                    そのうち何処かに書き込めるようにする予定です。<br>
                    <br>
                    それまではあなたの素晴らしいアイディアを<br>
                    ノートもしくは頭の中に書き留めておいて下さい。<br>
                    <br>
                    決して便利とはいえないかもしれないのですが<br>
                    それでも使ってみたいですか？<br>
                `

                this.$confirm(text, 'ようこそ', {
                    confirmButtonText: 'はい',
                    cancelButtonText: 'いいえ',
                    lockScroll: true,
                    dangerouslyUseHTMLString: true,
                    type: 'into'
                  }).then(() => { // はいの場合
                    this.$localStorage.set('isVisited', true);
                  }).catch(() => { // いいえの場合
                    location.href = "https://google.com"
                });
            }
        }
    }
});
