<template>
  <v-container style="margin-top: -80px">
    <v-row>
      <v-col cols="12" sm="12" md="6" lg="6">
        <p class="text-right p1-title text-h4">
          ما با هم کار می کنیم تا با پیشبرد بهترین ایده های خود به شما کمک کنیم
          آینده ای بهتر خلق کنید
        </p>
        <p class="text-right text-h5" style="">
          ما این کار را با ساخت مواد بهتر و فرآیندهای متفکرانه بهتر انجام می
          دهیم که آنچه را که می توانید انجام دهید و نحوه انجام آن را تنظیم می
          کند.
        </p>
      </v-col>
      <v-col cols="12" sm="12" md="6" lg="6">
        <img :width="xsAndsm()?'350':'500'" style="margin-top:-50px" src="../../../../assets/images/custom-img.jpg.webp" alt="" />
      </v-col>
    </v-row>
    <v-row v-if="xsAndsm()">
      <v-col cols="12" sm="12" md="6" lg="6">
        <p class="text-right text-h5">
          لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
          از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون
        </p>
      </v-col>
      <v-col cols="12" sm="6" md="6" lg="6">
        <img :width="xsAndsm()?'350':'500'" style="margin-top:-50px" src="../../../../assets/images/custom-img.jpg.webp" alt=""
      /></v-col>
    </v-row>
    <v-row v-else>
      <v-col cols="12" sm="6" md="6" lg="6">
        <img :width="xsAndsm()?'350':'500'" style="margin-top:-50px" src="../../../../assets/images/custom-img.jpg.webp" alt=""
      /></v-col>
      <v-col cols="12" sm="12" md="6" lg="6">
        <p class="text-right text-h5">
          لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
          از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون
        </p>
      </v-col>
    </v-row>
  </v-container>
</template>


<script>
export default {
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
.p1-title {
  color: #b8864d;
  /* line-height: 1.8em;
  font-size: 30px; */
}
.p2-title {
  /* font-size: 30px;
  margin-top: 30px; */
  line-height: 1.8em;
}
</style>
