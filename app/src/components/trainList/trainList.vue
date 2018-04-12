<template src="./trainList.html"></template>

<script>
    const DEFAULTPAGESIZE = 5;
    export default {
        data() {
            return {
                trainList: [],
                form: {
                    saerch: ""
                },
                currentPage :1,
                total: 0,
                pageSize: DEFAULTPAGESIZE
            };
        },
        created() {
            this.getList();
        },
        watch : {
            currentPage : function() {
                this.getList(this.form.search, this.currentPage);
            }
        },
        methods: {
            search () {
                this.currentPage = 1;
                this.getList(this.form.search);
            },
            async getList(query="", currentPage = 1, pageSize = DEFAULTPAGESIZE) {
                let offset = (currentPage -1) * pageSize;
                let limit = pageSize;

                await this.$axios.get("/trainList?" + "query=" + query + "&offset=" + offset + "&limit=" + limit).then(response => {
                    let watching = this.getWatches();
                    response.data.forEach(function (data, index) {
                        // ウォッチリストがある場合
                        if (watching.length) {
                            for (const watch of watching) {
                                if (watch.id === data.id) {
                                    response.data[index].watching = true;
                                }
                            }
                        }
                    });

                    this.trainList = response.data;
                    this.total = parseInt(response.headers["totalcount"], 10);
                });
            },
            // ウォッチリストに追加
            addWatch(target) {
                target.watching = true;
                let watching = this.getWatches();
                watching.push({id: target.id, name: target.name});
                this.setWatches(watching);

                this.$message({
                    type: 'success',
                    message: 'ウォッチリストに追加しました',
                    duration: 2500
                });
            },
            // ウォッチリストから除去
            deleteWatch(target) {
                target.watching = false;
                let watching = this.getWatches();

                if (watching.length) {
                    watching.some(function(currentData, index){
                        if (currentData.id == target.id) watching.splice(index, 1);
                    });
                }
                this.setWatches(watching);

                this.$message({
                    type: 'success',
                    message: 'ウォッチリストから削除しました',
                    duration: 2500
                });
            },
            // ウォッチリストから取得
            getWatches() {
                let data = this.$localStorage.get('watching');
                if  (!data) {
                    return [];
                }
                return JSON.parse(data);
            },
            // ウォッチリストに追加
            setWatches(target) {
                this.$localStorage.set('watching', JSON.stringify(target));
            }
        }
    }
</script>