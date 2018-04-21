<template src="./header.html"></template>

<script>
const OPEN_ICON = "el-icon-menu";
const CLOSE_ICON = "el-icon-close";
export default {
  data() {
    return {
      menus: {
        top: "トップ",
        help: "使いかた",
        trainList: "路線検索",
        watchList: "登録路線リスト",
        realTimeInfo: "リアルタイム",
      },
      icon : OPEN_ICON,
    };
  },
  methods: {
    toPage(pageName) {
      this.$router.push("/" + pageName);
    },
    changeIcon(closed) {
      this.icon = closed ? CLOSE_ICON : OPEN_ICON;
    }
  }
};
</script>