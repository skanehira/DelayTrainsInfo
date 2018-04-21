<template src="./watchList.html"></template>

<script>
export default {
  data() {
    return {
      noData: false,
      loading: true,
      watching: []
    };
  },
  created() {
    this.getWatches();
  },
  methods: {
    // ウォッチリストから取得
    async getWatches() {
      let watchList = this.getWatchesFromStorage();

      if (watchList === null || watchList.length === 0) {
        // 一覧を非表示にする
        this.loading = true;
        this.noData = true;
        return;
      }

      let paramater = {};

      for (const key in watchList) {
        paramater[key] = watchList[key].name;
      }

      await this.$axios
        .get("/getWatchTrainInfo", {
          params: paramater
        })
        .then(response => {
          this.watching = response.data;
          this.loading = false;
        });
    },
    // ウォッチリストから取得
    getWatchesFromStorage() {
      let data = this.$localStorage.get("watching");
      if (!data) {
        return [];
      }
      return JSON.parse(data);
    },
    // ウォッチリストから除去
    deleteWatch(target) {
      let watching = this.getWatchesFromStorage();

      if (watching.length) {
        watching.some(function(currentData, index) {
          if (currentData.name == target.name) watching.splice(index, 1);
        });

        this.setWatches(watching);
        
        // リスト更新
        this.getWatches();

        this.$message({
          type: "success",
          message: "登録路線から削除しました",
          duration: 2500
        });
      }
    },
    // ウォッチリストに追加
    setWatches(target) {
      this.$localStorage.set("watching", JSON.stringify(target));
    }
  }
};
</script>