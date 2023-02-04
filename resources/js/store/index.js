import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);

import adminAuthModules from "./modules/auth/admin/index.js";
import userAuthModules from "./modules/auth/user/index.js";

const store = new Vuex.Store({
    modules: {
        adminAuth: adminAuthModules,
        userAuth: userAuthModules,
    },
});

export default store;
