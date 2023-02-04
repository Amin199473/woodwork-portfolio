<template>
  <component :is="layout"> </component>
</template>

<script>
import AdminLayout from "./layouts/admin/index.vue";
import UserLayout from "./layouts/frontend/index.vue";
export default {
  components: {
    AdminLayout,
    UserLayout,
  },
  computed: {
    layout() {
      if (this.$route.meta.layout == "AdminLayout") {
        return "AdminLayout";
      }
      return "UserLayout";
    },
  },
};
</script>
