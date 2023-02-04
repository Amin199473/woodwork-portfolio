import { userlogOut, userlogIn } from "../../../../shared/utilities/auth";
import alerts from "../../../../shared/alerts";
import router from "../../../../routes";

export default {
    namespaced: true,
    state() {
        return {
            userStatus: "",
            userIsLoggedIn: localStorage.getItem("userIsLoggedIn") || false,
            user: {},
            userToken: localStorage.getItem("userToken") || "",
        };
    },
    mutations: {
        setUser(state, payload) {
            state.user = payload;
        },
        setUserLoggedIn(state, payload) {
            state.userIsLoggedIn = payload;
        },
        authSuccess(state, userToken) {
            state.userStatus = "success";
            state.userToken = userToken;
        },
        logout(state) {
            state.userStatus = "";
            state.userToken = "";
        },
    },
    actions: {
        async userRegister({ commit }, payload) {
            await axios
                .post(`/api/user-register/`, payload)
                .then((response) => {
                    console.log(response.data);
                    const userToken =
                        "Bearer " + response.data.token.original.access_token;
                    const user = response.data.user;
                    localStorage.setItem("userToken", userToken);
                    // axios.defaults.headers.common["Authorization"] = userToken;
                    commit("setUser", user);
                    commit("setUserLoggedIn", true);
                    commit("authSuccess", userToken);
                    userlogIn();
                    router.push(`/user/profile/${user.id}`);
                    alerts.successAlert("ثبت نام با موفقیت انجام شد");
                })
                .catch((error) => {
                    localStorage.removeItem("userToken");
                    alerts.errorAlert("لطفا دوباره تلاش کنید");
                });
        },
        async userLogin({ commit }, payload) {
            await axios
                .post(`/api/user-login/`, payload)
                .then((response) => {
                    const userToken = "Bearer " + response.data.access_token;
                    const user = response.data.user;
                    localStorage.setItem("userToken", userToken);
                    // axios.defaults.headers.common["Authorization"] = userToken;
                    commit("setUser", user);
                    commit("setUserLoggedIn", true);
                    commit("authSuccess", userToken);
                    router.push(`/user/profile/${user.id}`);
                    userlogIn();
                    alerts.successAlert("ورود باموفقیت انجام شد");
                })
                .catch((error) => {
                    localStorage.removeItem("userToken");
                    alerts.errorAlert("ایمیل یا پسورد اشتباه است");
                });
        },
        async loadUser({ commit }) {
            let token = localStorage.getItem("userToken");
            await axios
                .get(`/api/user/detail`, {
                    headers: {
                        Authorization: token,
                    },
                })
                .then((response) => {
                    commit("setUser", response.data);
                })
                .catch((error) => {});
        },
        async userLogout({ commit }) {
            await axios
                .post(`/api/user-logout`)
                .then((response) => {
                    console.log(response);
                    commit("setuser", {});
                    commit("setuserLoggedIn", false);
                    commit("logout");
                    userlogOut();
                    localStorage.removeItem("userToken");
                    delete axios.defaults.headers.common["Authorization"];
                })
                .catch((error) => {});
        },
    },
    getters: {
        // isLoggedIn: (state) => !!state.userToken,
        isLoggedIn(state) {
            return !!state.userToken;
        },

        // authStatus: (state) => state.userStatus,
        authSuccess(state) {
            return state.userStatus;
        },

        // getUser: (state) => state.user,
        getUser(state) {
            return state.user;
        },
    },
};
