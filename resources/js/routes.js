import VueRouter from "vue-router";
import store from "./store";
const routes = [
    ////////////////Admin Routes///////////////
    {
        name: "dashboard",
        path: "/dashboard",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/index.vue"),
    },
    {
        path: "/dashboard/category",
        name: "category",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/category/index.vue"),
    },
    {
        path: "/dashboard/category/create",
        name: "categoryCreate",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/category/create.vue"),
    },
    {
        path: "/dashboard/category/edit/:id",
        name: "categoryEdit",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/category/edit.vue"),
    },
    {
        path: "/dashboard/post",
        name: "post",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/post/index.vue"),
    },
    {
        path: "/dashboard/post/create",
        name: "postCreate",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/post/create.vue"),
    },
    {
        path: "/dashboard/post/edit/:id",
        name: "postEdit",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/post/edit.vue"),
    },
    {
        path: "/dashboard/post/view/:id",
        name: "postView",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/post/view.vue"),
    },
    {
        path: "/dashboard/media",
        name: "media",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/media/index.vue"),
    },
    {
        path: "/dashboard/media/create",
        name: "mediaCreate",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/media/create.vue"),
    },

    {
        path: "/dashboard/slider",
        name: "slider",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/slider/index.vue"),
    },
    {
        path: "/dashboard/slider/create",
        name: "sliderCreate",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/slider/create.vue"),
    },
    {
        path: "/dashboard/slider/edit/:id",
        name: "sliderEdit",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/slider/edit.vue"),
    },

    {
        path: "/dashboard/member",
        name: "member",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/member/index.vue"),
    },
    {
        path: "/dashboard/member/create",
        name: "memberCreate",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/member/create.vue"),
    },
    {
        path: "/dashboard/member/edit/:id",
        name: "memberEdit",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/member/edit.vue"),
    },
    {
        path: "/dashboard/member/view/:id",
        name: "memberView",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/member/view.vue"),
    },

    {
        path: "/dashboard/project",
        name: "project",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/project/index.vue"),
    },
    {
        path: "/dashboard/project/create",
        name: "projectCreate",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/project/create.vue"),
    },
    {
        path: "/dashboard/project/edit/:id",
        name: "projectEdit",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/project/edit.vue"),
    },
    {
        path: "/dashboard/project/view/:id",
        name: "projectView",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/project/view.vue"),
    },

    {
        path: "/dashboard/testimonial",
        name: "testimonial",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/testimonial/index.vue"),
    },
    {
        path: "/dashboard/testimonial/create",
        name: "testimonialCreate",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/testimonial/create.vue"),
    },
    {
        path: "/dashboard/testimonial/edit/:id",
        name: "testimonialEdit",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/testimonial/edit.vue"),
    },

    {
        path: "/dashboard/user",
        name: "user",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/user/index.vue"),
    },
    {
        path: "/dashboard/user/create",
        name: "userCreate",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/user/create.vue"),
    },
    {
        path: "/dashboard/user/edit/:id",
        name: "userEdit",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/user/edit.vue"),
    },

    {
        path: "/dashboard/FAQ",
        name: "dashboardFAQ",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/FAQ/index.vue"),
    },
    {
        path: "/dashboard/FAQ/create",
        name: "FAQCreate",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/FAQ/create.vue"),
    },
    {
        path: "/dashboard/FAQ/edit/:id",
        name: "FAQEdit",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/FAQ/edit.vue"),
    },
    {
        path: "/dashboard/tickets",
        name: "tickets",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/tickets/index.vue"),
    },
    {
        path: "/dashboard/ticket/view/:id",
        name: "ticketView",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/tickets/view.vue"),
    },
    {
        path: "/dashboard/siteSetting",
        name: "siteSetting",
        meta: {
            layout: "AdminLayout",
            requireAdminAuth: true,
        },
        component: () => import("./pages/admin/setting/siteSetting.vue"),
    },
    ////////////User Routes/////////////

    {
        name: "",
        path: "/",
        meta: {
            layout: "UserLayout",
        },
        component: () => import("./pages/user/home/index.vue"),
    },
    {
        name: "adminlogin",
        path: "/admin/login",
        meta: {
            layout: "UserLayout",
            requireAdminAuth: false,
        },
        component: () => import("./pages/auth/adminLogin/index.vue"),
    },
    {
        name: "userlogin",
        path: "/user/login",
        meta: {
            layout: "UserLayout",
        },
        component: () => import("./pages/auth/userLogin/index.vue"),
    },
    {
        name: "userRegister",
        path: "/user/register",
        meta: {
            layout: "UserLayout",
        },
        component: () => import("./pages/auth/userRegister/index.vue"),
    },
    {
        name: "blog",
        path: "/blog",
        meta: {
            layout: "UserLayout",
        },
        component: () => import("./pages/user/blog/index.vue"),
    },
    {
        name: "postDetail",
        path: "/post/detail/:slug/:id",
        meta: {
            layout: "UserLayout",
        },
        component: () => import("./pages/user/blog/detail/index.vue"),
    },
    {
        name: "contantUs",
        path: "/contactUs",
        meta: {
            layout: "UserLayout",
        },
        component: () => import("./pages/user/contactUs/index.vue"),
    },
    {
        name: "aboutUs",
        path: "/aboutUs",
        meta: {
            layout: "UserLayout",
        },
        component: () => import("./pages/user/aboutUs/index.vue"),
    },
    {
        name: "FAQ",
        path: "/FAQ",
        meta: {
            layout: "UserLayout",
        },
        component: () => import("./pages/user/FAQ/index.vue"),
    },
    {
        name: "services",
        path: "/services",
        meta: {
            layout: "UserLayout",
        },
        component: () => import("./pages/user/services/index.vue"),
    },
    {
        name: "projects",
        path: "/projects",
        meta: {
            layout: "UserLayout",
        },
        component: () => import("./pages/user/project/index.vue"),
    },
    {
        name: "projectDetails",
        path: "/project/details/:id",
        meta: {
            layout: "UserLayout",
        },
        component: () => import("./pages/user/project/detail.vue"),
    },
    {
        name: "userProfile",
        path: "/user/profile/:userId",
        meta: {
            layout: "UserLayout",
            requireUserAuth: true,
        },
        component: () => import("./pages/user/profile/index.vue"),
    },
    {
        name: "ticketDetail",
        path: "/user/profile/ticket/:id/:subject",
        meta: {
            layout: "UserLayout",
            requireUserAuth: true,
        },
        component: () => import("./pages/user/profile/ticket/detail.vue"),
    },

    /////not found route////
    {
        path: "/:pathMatch(.*)*",
        name: "NotFound",
        meta: {
            layout: "AdminLayout",
        },
        component: () => import("./pages/admin/notFound/index.vue"),
    },
];

const router = new VueRouter({
    routes,
    mode: "history",
});

///////////////////////////// middleware ///////////////////////

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requireUserAuth)) {
        if (store.getters["userAuth/isLoggedIn"]) {
            next();
            return;
        }
        next("user/register");
    } else {
        next();
    }
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requireAdminAuth)) {
        if (store.getters["adminAuth/isLoggedIn"]) {
            return next();
        } else {
            return router.push("/admin/login");
        }
    } else {
        next();
    }
});

export default router;
