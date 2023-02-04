<template>
  <div style="background-color: rgb(235 230 231 / 88%)">
    <Parallax />
    <v-container style="margin-top: 120px">
      <v-row>
        <v-col cols="12" md="8">
          <p class="p-title text-h3">Low costs and high quality</p>
          <p class="text-h6">
            Donec sed lorem dapibus, posuere dui eget, molestie ante. Vivamus
            aliquam gravida nibh, et aliquam risus fringilla aliquam. Cras
            ornare ac sem ut malesuada. Nulla ut sodales magna.
          </p>
          <p></p>
          <v-row class="mt-16">
            <v-col cols="12" md="2">
              <v-icon class="icon">mdi-cube-scan</v-icon>
            </v-col>
            <v-col cols="12" md="10">
              <p class="text-h4">Creating ideas for better living</p>
              <p>
                Runc consequat nibh ut pretium vestibulum. Nulla facilisi. Cras
                porttitor lacus dolor, quis tincidunt nisl vestibulum at. Mauris
                tristique diam ex, eget dignissim enim scelerisque non.
              </p>
            </v-col>
            <v-col cols="12" md="2">
              <v-icon class="icon">mdi-clock-check-outline</v-icon>
            </v-col>
            <v-col cols="12" md="10">
              <p class="text-h4">Creating ideas for better living</p>
              <p>
                Runc consequat nibh ut pretium vestibulum. Nulla facilisi. Cras
                porttitor lacus dolor, quis tincidunt nisl vestibulum at. Mauris
                tristique diam ex, eget dignissim enim scelerisque non.
              </p>
            </v-col>
            <v-col cols="12" md="2">
              <v-icon class="icon">mdi-wrench</v-icon>
            </v-col>
            <v-col cols="12" md="10">
              <p class="text-h4">Creating ideas for better living</p>
              <p>
                Runc consequat nibh ut pretium vestibulum. Nulla facilisi. Cras
                porttitor lacus dolor, quis tincidunt nisl vestibulum at. Mauris
                tristique diam ex, eget dignissim enim scelerisque non.
              </p>
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="12" md="4">
          <v-img
            contain
            :src="require('../../../assets/images/ser_05_600x.webp')"
          ></v-img>
        </v-col>
      </v-row>
      <v-row class="mt-16">
        <v-col cols="12" md="8">
          <v-img
            class="rounded-lg img-scale"
            :src="require('../../../assets/images/service-1_970x.webp')"
          ></v-img>
        </v-col>
        <v-col cols="12" md="4">
          <v-img
            height="275"
            class="rounded-lg img-scale mb-4"
            :src="require('../../../assets/images/ser_03.webp')"
          ></v-img>
          <v-img
            height="275"
            class="rounded-lg img-scale"
            :src="require('../../../assets/images/ser_05_600x.webp')"
          ></v-img>
        </v-col>
      </v-row>
      <v-row justify="center">
        <v-col cols="12">
          <p class="text-center text-h6 mt-8">
            Aenean maximus dui venenatis, suscipit neque vitae, vestibulum
            neque. Etiam tempor facilisis turpis et condimentum. Sed pharetra
            erat sed metus ornare, ac dapibus enim mattis. Duis nec odio eu enim
            luctus volutpat at sit amet purus. Phasellus consectetur fringilla
            enim, ut suscipit dolor gravida sed. Duis nec vehicula mi. Nunc non
            dolor eget quam pharetra suscipit a nec justo. Cras sollicitudin
            cursus interdum. Sed mollis odio a magna lobortis pulvinar.
          </p>
        </v-col>
        <v-btn class="btn-readMore"> show more </v-btn>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import Parallax from "../sharedComponets/TheParallax.vue";
export default {
  components: {
    Parallax,
  },
};
</script>


<style scoped>
.p-title {
  color: #c08c4d;
}
.icon {
  font-size: 60px;
  border: 2px solid #c08c4d;
  background-color: #c08c4d;
  border-radius: 5px;
  color: white;
  transform: rotate(45deg);
}
.img-scale:hover {
  scale: 1.05;
  transition: 1s;
  background-color: #c08c4d;
  opacity: 0.5;
}

.btn-readMore {
  background-color: black !important;
  color: antiquewhite !important;
  transition: background-color 2s;
}
.btn-readMore:hover {
  background-color: #c08c4d !important;
}
</style>
