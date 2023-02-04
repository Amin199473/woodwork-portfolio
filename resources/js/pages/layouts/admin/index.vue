<template>
  <v-app>
    <nav-bar></nav-bar>
    <v-main>
        <router-view></router-view>
    </v-main>
    <the-footer></the-footer>
  </v-app>
</template>

<script>
import TheFooter from "./TheFooter.vue";
import NavBar from "./NavBar.vue";
export default {
  components: {
    TheFooter,
    NavBar,
  },
};
</script>
