<template src="./menu.html"></template>

<script>
export default {
  data() {
    return {
      menus: [
        { path: "trainList", text: "路線検索", icon: "el-icon-search" },
        { path: "watchList", text: "登録路線リスト", icon: "el-icon-tickets" },
        { path: "realTimeInfo", text: "リアルタイム", icon: "el-icon-time" }
      ]
    };
  },
  methods: {
    changePage(pageName) {
      this.$router.push("/" + pageName);
    }
  }
};
</script>