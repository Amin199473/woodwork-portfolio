<template>
  <div  style="background-color: rgb(235 230 231 / 88%);">
    <Slider />
    <v-main>
      <IntroContent />
      <v-spacer></v-spacer>
      <Product />
      <v-spacer></v-spacer>
      <Tools />
      <v-spacer></v-spacer>
      <Design />
      <v-spacer></v-spacer>
      <AboutUs />
      <v-spacer></v-spacer>
      <UniqueProduct />
      <v-spacer></v-spacer>
      <Blog />
      <v-spacer></v-spacer>
      <Testimonial />
    </v-main>
  </div>
</template>
<script>
import Slider from "./components/slider.vue";
import IntroContent from "./components/introContent.vue";
import Product from "./components/FeaturedProduct.vue";
import Design from "./components/designProdutct.vue";
import AboutUs from "./components/aboutUs.vue";
import UniqueProduct from "./components/uniqueProduct.vue";
import Testimonial from "./components/Testimonial.vue";
import Tools from "./components/Tools.vue";
import Blog from "./components/Theblog.vue";
export default {
  components: {
    Slider,
    IntroContent,
    Product,
    Design,
    AboutUs,
    UniqueProduct,
    Testimonial,
    Tools,
    Blog,
  },
  created(){
// console.log(this.$vuetify.breakpoint.sm);
  },
  data() {
    return { fab: false };
  },
  methods: {
    onScroll(e) {
      if (typeof window === "undefined") return;
      const top = window.pageYOffset || e.target.scrollTop || 0;
      this.fab = top > 20;
    },
    toTop() {
      this.$vuetify.goTo(0);
    },
  },
};
</script>
