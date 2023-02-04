<template>
  <div>
    <v-container style="margin-top: 100px">
      <p class="text-center text-h4" style="color: #c08c4d"> نجاران با تجربه و ماهر </p>
      <p class="text-center text-h3 mb-4"> اعضای تیم </p>
      <v-row>
        <v-col cols="12" sm="6" md="4" lg="4">
          <v-hover v-slot="{ hover }">
            <v-card class="mx-auto" color="grey lighten-4" max-width="600">
              <v-img
                :src="require('../../../../assets/images/Team_img_1_800x.webp')"
              >
                <v-expand-transition>
                  <div
                    v-if="hover"
                    class="
                      d-flex
                      transition-fast-in-fast-out
                      orange
                      darken-2
                      v-card--reveal
                      text-h2
                      white--text
                    "
                    style="height: 100%"
                  >

                  </div>
                </v-expand-transition>
              </v-img>
              <v-card-text class="pt-6" style="position: relative">
                <v-btn
                  absolute
                  color="orange"
                  class="white--text"
                  fab
                  large
                  right
                  top
                >
                  <v-icon>mdi-grease-pencil</v-icon>
                </v-btn>
                <div class="font-weight-light grey--text text-h6 mb-2">
                  For the perfect meal
                </div>
                <h3 class="text-h4 font-weight-light orange--text mb-2">
                  QW cooking utensils
                </h3>
                <div class="font-weight-light text-h6 mb-2">
                  Our Vintage kitchen utensils delight any chef.<br />
                  Made of bamboo by hand
                </div>
              </v-card-text>
            </v-card>
          </v-hover>
        </v-col>
        <v-col cols="12" sm="6" md="4" lg="4">
          <v-hover v-slot="{ hover }">
            <v-card class="mx-auto" color="grey lighten-4" max-width="600">
              <v-img
                :src="require('../../../../assets/images/Team_img_2_800x.webp')"
              >
                <v-expand-transition>
                  <div
                    v-if="hover"
                    class="
                      d-flex
                      transition-fast-in-fast-out
                      orange
                      darken-2
                      v-card--reveal
                      text-h2
                      white--text
                    "
                    style="height: 100%"
                  >

                  </div>
                </v-expand-transition>
              </v-img>
              <v-card-text class="pt-6" style="position: relative">
                <v-btn
                  absolute
                  color="orange"
                  class="white--text"
                  fab
                  large
                  right
                  top
                >
                  <v-icon>mdi-grease-pencil</v-icon>
                </v-btn>
                <div class="font-weight-light grey--text text-h6 mb-2">
                  For the perfect meal
                </div>
                <h3 class="text-h4 font-weight-light orange--text mb-2">
                  QW cooking utensils
                </h3>
                <div class="font-weight-light text-h6 mb-2">
                  Our Vintage kitchen utensils delight any chef.<br />
                  Made of bamboo by hand
                </div>
              </v-card-text>
            </v-card>
          </v-hover>
        </v-col>
        <v-col cols="12" sm="6" md="4" lg="4">
          <v-hover v-slot="{ hover }">
            <v-card class="mx-auto" color="grey lighten-4" max-width="600">
              <v-img
                :src="require('../../../../assets/images/Team_img_3_800x.webp')"
              >
                <v-expand-transition>
                  <div
                    v-if="hover"
                    class="
                      d-flex
                      transition-fast-in-fast-out
                      orange
                      darken-2
                      v-card--reveal
                      text-h2
                      white--text
                    "
                    style="height: 100%"
                  >

                  </div>
                </v-expand-transition>
              </v-img>
              <v-card-text class="pt-6" style="position: relative">
                <v-btn
                  absolute
                  color="orange"
                  class="white--text"
                  fab
                  large
                  right
                  top
                >
                  <v-icon>mdi-grease-pencil</v-icon>
                </v-btn>
                <div class="font-weight-light grey--text text-h6 mb-2">
                  For the perfect meal
                </div>
                <h3 class="text-h4 font-weight-light orange--text mb-2">
                  QW cooking utensils
                </h3>
                <div class="font-weight-light text-h6 mb-2">
                  Our Vintage kitchen utensils delight any chef.<br />
                  Made of bamboo by hand
                </div>
              </v-card-text>
            </v-card>
          </v-hover>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>


<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}
</style>
