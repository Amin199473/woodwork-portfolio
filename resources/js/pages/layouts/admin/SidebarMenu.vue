<template>
  <v-list>
    <v-list-item>
      <v-list-item-icon>
        <v-icon>mdi-home</v-icon>
      </v-list-item-icon>
      <v-list-item-title>
        <router-link
          style="text-decoration: none; color: inherit"
          :to="{ name: 'dashboard' }"
          >داشبورد</router-link
        >
      </v-list-item-title>
    </v-list-item>
    <v-list-group
      v-for="item in items"
      :key="item.title"
      :prepend-icon="item.action"
      no-action
    >
      <template v-slot:activator>
        <v-list-item-content>
          <v-list-item-title v-text="item.title"></v-list-item-title>
        </v-list-item-content>
      </template>

      <v-list-item v-for="child in item.items" :key="child.title">
        <v-list-item-content>
          <v-list-item-title>
            <router-link
              style="text-decoration: none; color: inherit"
              :to="{ name: child.link }"
            >
              {{ child.title }}
            </router-link>
          </v-list-item-title>
        </v-list-item-content>
        <v-icon>{{ child.icon }}</v-icon>
      </v-list-item>
    </v-list-group>
  </v-list>
</template>

<script>
export default {
  data: () => ({
    items: [
      {
        action: "mdi-ticket",
        items: [
          { title: "افزودن", icon: "mdi-plus-outline", link: "categoryCreate" },
          {
            title: "لیست دسته بندی ها",
            icon: "mdi-file-outline",
            link: "category",
          },
        ],
        title: "دسته بندی",
      },
      {
        action: "mdi-post",
        active: true,
        items: [
          { title: "افزودن", icon: "mdi-plus-outline", link: "postCreate" },
          { title: "لیست پست ها", icon: "mdi-file-outline", link: "post" },
        ],
        title: "پست ها",
      },
      {
        action: "mdi-library",
        active: true,
        items: [
          {
            title: "اپلود کردن",
            icon: "mdi-plus-outline",
            link: "mediaCreate",
          },
          { title: "تصاویر", icon: "mdi-file-outline", link: "media" },
        ],
        title: "رسانه ها",
      },
      {
        action: "mdi-image-check",
        active: true,
        items: [
          {
            title: "افزودن",
            icon: "mdi-plus-outline",
            link: "sliderCreate",
          },
          { title: "اسلایدرها", icon: "mdi-file-outline", link: "slider" },
        ],
        title: "اسلایدر",
      },
      {
        action: "mdi-microsoft-teams",
        active: true,
        items: [
          { title: "افزودن", icon: "mdi-plus-outline", link: "memberCreate" },
          { title: "لیست اعضا", icon: "mdi-file-outline", link: "member" },
        ],
        title: "اعضای تیم",
      },
      {
        action: "mdi-office-building",
        active: true,
        items: [
          { title: "افزودن", icon: "mdi-plus-outline", link: "projectCreate" },
          { title: "لیست پروژه ها", icon: "mdi-file-outline", link: "project" },
        ],
        title: "پروژه ها",
      },
      {
        action: "mdi-comment-quote-outline",
        active: true,
        items: [
          {
            title: "افزودن",
            icon: "mdi-plus-outline",
            link: "testimonialCreate",
          },
          {
            title: "لیست گواهی ها",
            icon: "mdi-file-outline",
            link: "testimonial",
          },
        ],
        title: "گواهی ها",
      },

      {
        action: "mdi-account-badge-outline",
        active: true,
        items: [
          {
            title: "افزودن",
            icon: "mdi-plus-outline",
            link: "userCreate",
          },
          {
            title: "لیست کابران",
            icon: "mdi-file-outline",
            link: "user",
          },
          {
            title: "تیکت ها",
            icon: "mdi-ticket",
            link: "tickets",
          }
        ],
        title: "مدیریت کابران",
      },

      {
        action: "mdi-chat-question",
        active: true,
        items: [
          {
            title: "افزودن",
            icon: "mdi-plus-outline",
            link: "FAQCreate",
          },
          {
            title: "لیست سوالات",
            icon: "mdi-file-outline",
            link: "dashboardFAQ",
          },
        ],
        title: "سوالات متداول",
      },
      {
        action: "mdi-archive-settings-outline",
        active: true,
        items: [
          {
            title: "تنظیمات رسانه و آدرس",
            icon: "mdi-folder-information-outline",
            link: "siteSetting",
          },
        ],
        title: "تنظیمات سایت",
      },
    ],
  }),
};
</script>
