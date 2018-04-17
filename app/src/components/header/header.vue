<template src="./header.html"></template>

<script>
const OPEN_ICON = "el-icon-menu";
const CLOSE_ICON = "el-icon-close";
export default {
  data() {
    return {
      menus: {
        top: "トップ",
        trainList: "路線一覧",
        watchList: "ウォッチリスト",
        delayInfo: "遅延情報検索",
        about: "サイト作者について"
      },
      icon : OPEN_ICON,
    };
  },
  methods: {
    toPage(pageName) {
      this.$router.push("/" + pageName);
    },
    changeIcon(appears) {
      this.icon = appears ? CLOSE_ICON : OPEN_ICON;
    }
  }
};
</script>