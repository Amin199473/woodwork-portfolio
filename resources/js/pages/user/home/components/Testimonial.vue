<template>
  <div>
    <v-container style="margin-top: 100px">
      <v-row>
        <v-col cols="12" sm="12" md="6" lg="6">
          <p class="text-h6 testimonial text-center">گواهی ها</p>
          <p class="text-h2 mb-16 text-center">نظرات مشتریان</p>

          <v-carousel hide-delimiters cycle :show-arrows="false">
            <v-carousel-item v-for="(item, i) in items" :key="i">
              <v-card
                class="mx-auto text--white brown darken-1"
                dark
                max-width="600"
              >
                <v-card-title>
                  <v-icon large left> mdi-twitter </v-icon>
                  <span class="text-h6 font-weight-light">Twitter</span>
                </v-card-title>

                <v-card-text
                  class="text-h5 font-weight-bold white--text text-right"
                >
                  لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                  استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و
                  مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                  تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                  کاربردی می باشد
                </v-card-text>

                <v-card-actions>
                  <v-list-item class="grow">
                    <v-list-item-avatar color="grey darken-3">
                      <v-img
                        class="elevation-6"
                        alt=""
                        src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                      ></v-img>
                    </v-list-item-avatar>

                    <v-list-item-content>
                      <v-list-item-title>Evan You</v-list-item-title>
                    </v-list-item-content>

                    <v-row align="center" justify="end">
                      <v-icon class="mr-1"> mdi-heart </v-icon>
                      <span class="subheading mr-2">256</span>
                      <span class="mr-1">·</span>
                      <v-icon class="mr-1"> mdi-share-variant </v-icon>
                      <span class="subheading">45</span>
                    </v-row>
                  </v-list-item>
                </v-card-actions>
              </v-card></v-carousel-item
            >
          </v-carousel>
        </v-col>
        <v-col cols="12" sm="12" md="6" lg="6">
          <v-img
            :src="require('../../../../assets/images/our_client_img_2.webp')"
            class="rounded-lg"
          >
          </v-img>
          <v-img
            :src="require('../../../../assets/images/our_client_img.webp')"
            class="second-img rounded-lg"
          >
          </v-img>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
export default {
  data() {
    return {
      model: 0,
      items: [
        {
          src: "https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg",
        },
        {
          src: "https://cdn.vuetifyjs.com/images/carousel/sky.jpg",
        },
        {
          src: "https://cdn.vuetifyjs.com/images/carousel/bird.jpg",
        },
        {
          src: "https://cdn.vuetifyjs.com/images/carousel/planet.jpg",
        },
      ],
    };
  },
};
</script>

<style scoped>
.testimonial {
  color: #c08c4d;
}
.second-img {
  position: absolute;
  left: 50%;
  bottom: 150px;
  margin: auto;
  object-fit: fill;
}

@media only screen and (max-width: 600px) {
  .second-img {
    position: absolute;
    left: 50%;
    bottom: 15px;
    margin: auto;
    object-fit: fill;
  }
}
</style>
