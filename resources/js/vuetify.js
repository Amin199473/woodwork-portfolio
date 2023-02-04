import Vue from "vue";
import Vuetify from "vuetify";
import "font-awesome/css/font-awesome.min.css";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: "#3f51b5",
                secondary: "#696969",
                accent: "#8c9eff",
                error: "#b71c1c",
            },
        },
    },
    icons: {
        iconfont: "mdi" || "fa" || "fa4" || "faSvg",
    },
    breakpoint: {
        thresholds: {
            xs: 340,
            sm: 540,
            md: 800,
            lg: 1280,
        },
        scrollBarWidth: 24,
    },
});
