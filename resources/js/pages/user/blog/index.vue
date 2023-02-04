<template>
  <div style="background-color: rgb(235 230 231 / 88%)">
    <TheParallax />
    <v-spacer></v-spacer>
    <Articles />
  </div>
</template>
<script>
import TheParallax from "../sharedComponets/TheParallax.vue";
import Articles from "./components/TheArticles.vue";
export default {
  components: {
    TheParallax,
    Articles,
  },
};
</script>


<style scoped>
</style>
