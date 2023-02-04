require("./bootstrap");
import Vue from "vue";
import router from "./routes";
import VueRouter from "vue-router";
import store from "./store/index.js";
import vuetify from "./vuetify"; //vuetify setup  configure
import CKEditor from 'ckeditor4-vue';
import MainComponent from "./pages/main.vue";
import VueZoomer from 'vue-zoomer'

Vue.use(VueZoomer)

Vue.component("main-component", MainComponent);

Vue.use(VueRouter);
Vue.use(CKEditor);
const app = new Vue({
    el: "#app",
    router,
    store,
    vuetify,
});
