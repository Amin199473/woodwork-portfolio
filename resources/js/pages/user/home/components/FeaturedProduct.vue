<template>
  <div>
    <v-container class="pa-4 text-center">
      <p class="text-h6" style="color: #b8864d;">
        به صنایع چوب نارگل خوش آمدید
      </p>
      <p class="text-h2 mb-10">محصولات ویژه</p>
      <v-row class="fill-height" align="center" justify="center">
        <template v-for="(item, i) in items">
          <v-col :key="i" cols="10" sm="4" md="3" lg="3">
            <v-hover v-slot="{ hover }">
              <v-card
                :elevation="hover ? 12 : 2"
                :class="{ 'on-hover': hover }"
              >
                <v-img :src="item.img" height="225px">
                  <v-expand-transition>
                    <div
                      v-if="hover"
                      class="
                        d-flex
                        transition-fast-in-fast-out
                        darken-2
                        v-card--reveal
                        text-h2
                        white--text
                      "
                      style="height: 100%"
                    ></div>
                  </v-expand-transition>
                </v-img>
              </v-card>
            </v-hover>
          </v-col>
        </template>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  data: () => ({
    icons: ["mdi-heart", "mdi-cart"],
    items: [
      {
        title: "New Releases",
        img: require("../../../../assets/images/woodenpro1_600x.webp"),
      },
      {
        title: "Rock",
        img: require("../../../../assets/images/woodenpro2_600x.webp"),
      },
      {
        title: "Mellow Moods",
        img: require("../../../../assets/images/woodenpro3_600x.webp"),
      },
      {
        title: "New Releases",
        img: require("../../../../assets/images/woodenpro4_600x.webp"),
      },
      {
        title: "Rock",
        img: require("../../../../assets/images/woodenpro5_600x.webp"),
      },
      {
        title: "Mellow Moods",
        img: require("../../../../assets/images/woodenpro6_600x.webp"),
      },
      {
        title: "Mellow Moods",
        img: require("../../../../assets/images/woodenpro6_600x.webp"),
      },
      {
        title: "Mellow Moods",
        img: require("../../../../assets/images/woodenpro4_600x.webp"),
      },
    ],
    transparent: "rgba(255, 255, 255, 0)",
  }),
};
</script>

<style scoped>
.v-card {
  transition: opacity 0.4s ease-in-out;
}
.v-card:not(.on-hover) {
  opacity: 0.5;
  background: #000;
}
.on-hover:hover {
  scale: 1.1;
  transition: 1s;
}
.show-btns {
  color: rgb(137, 35, 35) !important;
}
</style>
