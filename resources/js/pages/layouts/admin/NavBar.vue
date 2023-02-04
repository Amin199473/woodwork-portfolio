<template>
  <div id="inspire">
    <v-app-bar app class="brown darken-3">
      <v-app-bar-nav-icon
        class="white--text"
        @click="drawer = !drawer"
      ></v-app-bar-nav-icon>
      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon color="white">mdi-bell</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon color="white">mdi-email</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon color="white">mdi-magnify</v-icon>
      </v-btn>
      <v-toolbar-title class="white--text">صنایع چوب نارگل</v-toolbar-title>
    </v-app-bar>

    <v-navigation-drawer v-model="drawer" app class="sidebar-color">
      <template v-slot:prepend>
        <v-list-item two-line>
          <v-list-item-avatar>
            <img src="https://randomuser.me/api/portraits/women/81.jpg" />
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title class="white--text"
              >Jane Smith</v-list-item-title
            >
            <v-list-item-subtitle class="white--text"
              >Logged In</v-list-item-subtitle
            >
          </v-list-item-content>
        </v-list-item>
      </template>
      <v-divider></v-divider>
      <SidebarMenu />
    </v-navigation-drawer>
  </div>
</template>

<script>
import SidebarMenu from "./SidebarMenu.vue";
export default {
  components: {
    SidebarMenu,
  },
  data: () => ({ drawer: null }),
};
</script>
<style >
.sidebar-color {
  background-color: #684234!important;
}
</style>
