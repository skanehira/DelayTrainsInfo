<template src="./watchList.html"></template>

<script>
export default {
  data() {
    return {
      watching: [],
      status: "現在平常運転中"
    };
  },
  created() {
    this.watching = this.getWatches();
  },
  methods: {
    // ウォッチリストから取得
    getWatches() {
      let data = this.$localStorage.get("watching");
      if (!data) {
        return [];
      }
      return JSON.parse(data);
    },
  }
};
</script>