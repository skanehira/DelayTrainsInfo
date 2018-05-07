<template src="./realTimeInfo.html"></template>

<script>
export default {
  data() {
    return {
      form: {
        search: ""
      },
      originalTweets: [],
      tweets: [],
      page: 0,
      limit: 5,
    };
  },
  methods: {
    async search() {
      if (this.form.search === "") {
        alert("路線名を入力して下さい");
        return false;
      };

      let loading = this.$loading({
          lock: true,
          text: '検索中…',
          spinner: 'el-icon-loading',
          background: 'rgba(0, 0, 0, 0.7)'
      });

      await this.$axios
        .get("/getRealTimeInfo", {
          params: {
            query: this.form.search
          }
        })
        .then(response => {
          this.originalTweets = response.data;
          this.page = 0;
          this.tweets = response.data.slice(this.page, this.limit);
          this.page += this.limit;
        })
        .catch(error => {
          this.tweets = [];
          alert(error.response.data.message);
        });

        loading.close();
    },
    fetch() {
      // push.applyを使用した場合
      // 新たなobjectが作成されのでvue側に反映されないためコピーを使用する
      let tmp = this.tweets.concat();
      Array.prototype.push.apply(tmp, this.originalTweets.slice(this.page, this.page + this.limit));
      this.tweets = tmp;
      this.page += this.limit;
    },
    infiniteScroll(event) {
      // スクロールの現在位置 + 親（.scroll-container）の高さ >= スクロール内のコンテンツの高さ
      if (event.target.scrollTop + event.target.offsetHeight >= event.target.scrollHeight) {
        this.fetch();
      }
    }
  }
};
</script>
