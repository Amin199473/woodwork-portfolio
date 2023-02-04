<template>
  <v-carousel
    cycle
    :height="xsAndsm() ? '400' : '600'"
    hide-delimiter-background
    show-arrows-on-hover
    hide-delimiters
  >
    <v-carousel-item v-for="(img, index) in images" :key="index">
      <v-img :src="img">
        <p
          class="
            subHeading
            text-center text-md-h4 text-xs-h6 text-sm-h6
            white--text
          "
        >
          کار چوبی سفارشی سازی بهترین متریال
        </p>
        <p class="text-md-h2 text-xs-h4 text-sm-h4 text-center white--text">
          کار چوبی آنتیک با نازل ترین قیمت و مدرن ترین طراحی ها
        </p>
        <v-row justify="center">
          <v-btn
            class="
              btn-readMore
              text-center text-xs-h4 text-sm-h4 text-md-h4
              my-8
            "
            elevation="24"
            v-if="xsAndsm()"
            x-small
          >
            بیشتر ببینید</v-btn
          >
          <v-btn
            class="
              btn-readMore
              text-center text-xs-h4 text-sm-h4 text-md-h4
              my-8
            "
            elevation="24"
            v-else
            x-large
          >
            بیشتر ببینید</v-btn
          >
        </v-row>
      </v-img>
    </v-carousel-item>
  </v-carousel>
</template>

<script>
export default {
  data() {
    return {
      images: [
        require("../../../../assets/images/slider-1.webp"),
        require("../../../../assets/images/slider-2.webp"),
        require("../../../../assets/images/slider-3.webp"),
      ],
      colors: [
        "indigo",
        "warning",
        "pink darken-2",
        "red lighten-1",
        "deep-purple accent-4",
      ],
      slides: ["First", "Second", "Third", "Fourth", "Fifth"],
    };
  },
  methods: {
    xsAndsm() {
      return this.$vuetify.breakpoint.xs || this.$vuetify.breakpoint.sm;
    },
  },
};
</script>


<style scoped>
.subHeading {
  padding-top: 150px;
}
.btn-readMore {
  background-color: black !important;
  color: antiquewhite !important;
  transition: background-color 1s;
}
.btn-readMore:hover {
  background-color: #c08c4d !important;
}
</style>
