<template>
  <div style="background-color: rgb(235 230 231 / 88%)">
    <Parallax />
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-card
            style="background-color: rgb(235 230 231 / 88%)"
            elevation="24"
            class="mx-auto my-12"
          >
            <v-row justify="space-between">
              <v-col cols="12" sm="12" md="4" lg="4">
                <div class="bg-custom"></div>
                <v-img
                  class="img-1"
                  :src="require('../../../assets/images/about_01.webp')"
                  width="350"
                  height="260"
                ></v-img>
              </v-col>
              <v-col cols="12" sm="12" md="6" lg="8">
                <v-img
                  width="100"
                  height="100"
                  class="mx-auto text-center"
                  :src="require('../../../assets/images/icon_01_300x300.png')"
                ></v-img>
                <p class="text-h5 font-weight-bold text-center">
                  با صنایع چوب نارگل ایده های خود را به واقعیت نزدیک کنید
                </p>
                <p class="text-center px-8">
                  Donec sed lorem dapibus, posuere dui eget, molestie ante.
                  Vivamus aliquam gravida nibh, et aliquam risus fringilla
                  aliquam. Cras ornare ac sem ut malesuada.
                </p>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-card
            style="background-color: rgb(235 230 231 / 88%)"
            elevation="24"
            class="mx-auto my-12"
          >
            <v-row justify="sapce-between">
              <v-col cols="12" sm="12" md="8" lg="8">
                <v-img
                  width="100"
                  height="100"
                  class="mx-auto text-center"
                  :src="require('../../../assets/images/icon_02_300x300.webp')"
                ></v-img>
                <p class="text-h5 font-weight-bold text-center">
                  با صنایع چوب نارگل بهترین و به روز ترین دکوراسیون را پیاده
                  سازی کنید
                </p>
                <p class="text-center px-8">
                  Donec sed lorem dapibus, posuere dui eget, molestie ante.
                  Vivamus aliquam gravida nibh, et aliquam risus fringilla
                  aliquam. Cras ornare ac sem ut malesuada.
                </p>
              </v-col>
              <v-col cols="12" sm="12" md="4" lg="4">
                <div class="bg-custom"></div>
                <v-img
                  class="img-2"
                  :src="require('../../../assets/images/about_02.webp')"
                  width="350"
                  height="260"
                ></v-img>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-card
            style="background-color: rgb(235 230 231 / 88%)"
            elevation="24"
            class="mx-auto my-12"
          >
            <v-row>
              <v-col cols="12" sm="12" md="4" lg="4">
                <div class="bg-custom"></div>
                <v-img
                  class="img-1"
                  :src="require('../../../assets/images/about_03.webp')"
                  width="350"
                  height="260"
                ></v-img>
              </v-col>
              <v-col cols="12" sm="12" md="8" lg="8">
                <v-img
                  width="100"
                  height="100"
                  class="mx-auto text-center"
                  :src="require('../../../assets/images/icon_03_300x300.avif')"
                ></v-img>
                <p class="text-h5 font-weight-bold text-center">
                  نمونه کار های ما گواه کیفیت ماست
                </p>
                <p class="text-center px-8">
                  Donec sed lorem dapibus, posuere dui eget, molestie ante.
                  Vivamus aliquam gravida nibh, et aliquam risus fringilla
                  aliquam. Cras ornare ac sem ut malesuada.
                </p>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    <OurTeam />ّ
  </div>
</template>

<script>
import Parallax from "../sharedComponets/TheParallax.vue";
import OurTeam from "./components/OurTeam.vue";
export default {
  components: {
    Parallax,
    OurTeam,
  },
  data() {
    return {};
  },
  methods: {
    xsAndsm() {
      return this.$vuetify.breakpoint.xs || this.$vuetify.breakpoint.sm;
    },
  },
};
</script>

<style scoped>
.bg-custom {
  background-color: #c08c4d !important;
  height: 300px;
  width: 372px;
}
.bg-custom:hover {
  opacity: 0.6;
  transition: 0.4s;
}
.img-1 {
  position: absolute;
  left: 50px;
  bottom: 20px;
}
.img-2 {
  position: absolute;
  right: 50px;
  bottom: 20px;
}

@media only screen and (max-width: 800px) {
  .bg-custom {
    display: none;
  }
  .img-1 {
    display: none;

  }
  .img-2 {
    display: none;

  }
}
</style>
