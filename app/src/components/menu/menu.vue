<template src="./menu.html"></template>

<script>
export default {
  data() {
    return {
      menus: {
        trainList: "路線一覧",
        watchList: "ウォッチリスト",
        delayInfo: "遅延情報検索",
        about: "サイト作者について"
      }
    };
  },
  methods: {
    toPage(pageName) {
      this.$router.push("/" + pageName);
    }
  }
};
</script>