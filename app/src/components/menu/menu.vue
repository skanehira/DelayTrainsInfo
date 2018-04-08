<template src="./menu.html"></template>

<script>
  export default {
    data() {
      return {
        menus: {
          about : "注意",
          delayInfo : "遅延情報検索",
          trainList : "路線一覧"
        },
      };
    },
    methods: {
      toPage(pageName) {
        this.$router.push("/" + pageName);
      },
    }
  }
</script>