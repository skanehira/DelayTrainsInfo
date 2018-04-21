<template src="./welcom.html"></template>

<script>
export default {
    methods: {
        toTop() {
            this.$localStorage.set('isVisited', true);
            this.$router.push("/top");
        },
        leave() {
            location.href = "https://google.com";
        }
    }
}
</script>