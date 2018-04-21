<template src="./realTimeInfo.html"></template>

<script>
export default {
  data() {
    return {
      form: {
        search: ""
      }
    };
  },
  methods: {
    async search() {
      await this.$axios
        .get("/getDelayInfo", {
          paramas: {
            query: this.form.search
          }
        })
        .then(response => {
          console.log(response.data);
        });
    }
  }
};
</script>
