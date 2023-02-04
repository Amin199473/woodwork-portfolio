<template>
  <div>
    <v-app-bar height="90" app class="brown lighten-5 pl-12">
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-spacer></v-spacer>
      <v-row>
        <v-col md="6" lg="6">
          <v-avatar color="primary" size="60"></v-avatar>
        </v-col>
        <v-col md="6" lg="6">
          <div class="pt-2">
            <div class="d-sm-inline-flex">
              <v-icon :class="{ 'icon-color': true, 'icon-size': !xsAndsm() }"
                >mdi-account-circle</v-icon
              >
              <v-icon :class="{ 'icon-color': true, 'icon-size': !xsAndsm() }"
                >mdi-cart</v-icon
              >
              <v-icon :class="{ 'icon-color': true, 'icon-size': !xsAndsm() }"
                >mdi-home-search</v-icon
              >
            </div>
          </div>
        </v-col>
      </v-row>
    </v-app-bar>

    <v-navigation-drawer
      right
      v-model="drawer"
      temporary
      app
      fixed
      class="sidabar-color"
    >
      <template v-slot:prepend>
        <v-list>
          <router-link class="a-style" to="/">
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-home</v-icon>
              </v-list-item-icon>
              <v-list-item-title class="a-style">صفحه اصلی</v-list-item-title>
            </v-list-item>
          </router-link>

          <router-link class="a-style" to="/user/register">
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-account-switch</v-icon>
              </v-list-item-icon>
              <v-list-item-title class="a-style">
                ورود/ثبت نام
              </v-list-item-title>
            </v-list-item>
          </router-link>

          <router-link class="a-style" to="/blog">
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-library</v-icon>
              </v-list-item-icon>
              <v-list-item-title class="a-style">وبلاگ</v-list-item-title>
            </v-list-item>
          </router-link>

          <v-list-group prepend-icon="mdi-office-building">
            <template v-slot:activator>
              <v-list-item-title class="a-style">پروژه ها</v-list-item-title>
            </template>
            <v-list-group no-action sub-group>
              <template v-slot:activator>
                <v-list-item>
                  <v-list-item-title class="a-style">درب</v-list-item-title>
                </v-list-item>
              </template>
            </v-list-group>
          </v-list-group>

          <router-link class="a-style" to="/contactUs">
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-contacts</v-icon>
              </v-list-item-icon>
              <v-list-item-title class="a-style">تماس با ما</v-list-item-title>
            </v-list-item>
          </router-link>

          <router-link class="a-style" to="/aboutUs">
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-book-information-variant</v-icon>
              </v-list-item-icon>
              <v-list-item-title class="a-style">درباره ما</v-list-item-title>
            </v-list-item>
          </router-link>

          <router-link class="a-style" to="/aboutUs">
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-microsoft-teams</v-icon>
              </v-list-item-icon>
              <v-list-item-title class="a-style"> اعضای تیم </v-list-item-title>
            </v-list-item>
          </router-link>

          <router-link class="a-style" to="/FAQ">
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-chat-question</v-icon>
              </v-list-item-icon>
              <v-list-item-title class="a-style"
                >سوالات متداول</v-list-item-title
              >
            </v-list-item>
          </router-link>
        </v-list>
      </template>
      <v-divider></v-divider>
    </v-navigation-drawer>
    <v-layout class="scroll-y" align-center justify-center>
      <v-flex xs12>
        <v-btn
          v-scroll="onScroll"
          v-show="fab"
          fab
          dark
          fixed
          bottom
          right
          color="primary"
          @click="toTop"
        >
          <v-icon>mdi-arrow-up</v-icon>
        </v-btn>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
export default {
  data() {
    return {
      drawer: false,
      fab: false,
    };
  },
  methods: {
    xsAndsm() {
      return this.$vuetify.breakpoint.xs || this.$vuetify.breakpoint.sm;
    },
    onScroll(e) {
      if (typeof window === "undefined") return;
      const top = window.pageYOffset || e.target.scrollTop || 0;
      this.fab = top > 20;
    },
    toTop() {
      this.$vuetify.goTo(0);
    },
  },
};
</script>
<style >
.sidabar-color {
  background-color: #f0eae8 !important;
}
.icon-color {
  color: black;
  transition: 0.4s;
}
.icon-color:hover {
  color: #c08c4d !important;
}
.icon-size {
  font-size: 40px !important;
}
.a-style {
  text-decoration: none;
  color: black;
}
.a-style:hover {
  color: #c08c4d !important;
}
</style>
