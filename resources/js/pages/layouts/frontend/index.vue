<template>
  <v-app>
    <TheHeader />
    <v-main>
        <router-view></router-view>
    </v-main>
    <TheFooter />
  </v-app>
</template>

<script>
import TheFooter from "./TheFooter.vue";
import TheHeader from "./TheHeader.vue";
export default {
  components: {
    TheFooter,
    TheHeader,
  },
};
</script>
