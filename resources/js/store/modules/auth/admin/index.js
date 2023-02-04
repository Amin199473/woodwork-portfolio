import { adminlogOut, adminlogIn } from "../../../../shared/utilities/auth";
import alerts from "../../../../shared/alerts";
import router from "../../../../routes";
export default {
    namespaced: true,
    state() {
        return {
            adminStatus: "",
            adminIsLoggedIn: localStorage.getItem("adminIsLoggedIn") || false,
            admin: {},
            adminToken: localStorage.getItem("adminToken") || "",
        };
    },
    mutations: {
        setAdmin(state, payload) {
            state.admin = payload;
        },
        setAdminLoggedIn(state, payload) {
            state.adminIsLoggedIn = payload;
        },
        authSuccess(state, adminToken) {
            state.adminStatus = "success";
            state.adminToken = adminToken;
        },
        logout(state) {
            state.adminStatus = "";
            state.adminToken = "";
        },
    },
    actions: {
        async adminLogin({ commit }, payload) {
            await axios
                .post(`/api/admin-login/`, payload)
                .then((response) => {
                    const adminToken = "Bearer " + response.data.access_token;
                    const admin = response.data.admin;
                    localStorage.setItem("adminToken", adminToken);
                    axios.defaults.headers.common["Authorization"] = adminToken;
                    commit("setAdmin", admin);
                    commit("setAdminLoggedIn", true);
                    commit("authSuccess", adminToken);
                    adminlogIn();
                    router.push("/dashboard");
                    alerts.successAlert("ورود باموفقیت انجام شد");
                })
                .catch((error) => {
                    localStorage.removeItem("adminToken");
                    alerts.errorAlert("ایمیل یا پسورد اشتباه است");
                });
        },
        async loadAdmin({ commit }) {
            let token = localStorage.getItem("adminToken");
            await axios
                .get(`/api/admin-me`, {
                    headers: {
                        Authorization: token,
                    },
                })
                .then((response) => {
                    commit("setAdmin", response.data);
                })
                .catch((error) => {});
        },
        async adminLogout({ commit }) {
            await axios
                .post(`/api/admin-logout`)
                .then((response) => {
                    console.log(response);
                    commit("setAdmin", {});
                    commit("setAdminLoggedIn", false);
                    commit("logout");
                    adminlogOut();
                    localStorage.removeItem("adminToken");
                    delete axios.defaults.headers.common["Authorization"];
                })
                .catch((error) => {});
        },
    },
    getters: {
        // isLoggedIn: (state) => !!state.adminToken,
        isLoggedIn(state) {
            return !!state.adminToken;
        },

        // authStatus: (state) => state.adminStatus,
        authSuccess(state) {
            return state.adminStatus;
        },

        // getUser: (state) => state.admin,
        getAdmin(state) {
            return state.admin;
        },
    },
};
