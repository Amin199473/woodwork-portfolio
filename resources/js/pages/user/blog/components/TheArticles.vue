<template>
  <div>
    <v-container style="margin-top: 100px">
      <v-row>
        <!-- start recent articles -->
        <v-col cols="12" sm="12" md="4" lg="4">
          <p class="p-recent text-h4"> مقالات اخیر </p>
          <v-divider class="border"></v-divider>
          <v-row>
            <v-col cols="12" md="6"
              ><v-img
                class="rounded-lg mt-4"
                width="150"
                height="100"
                contain
                :src="require('../../../../assets/images/blog_03_470x.webp')"
              ></v-img>
            </v-col>
            <v-col cols="12" sm="12" md="8" lg="8">
              <span class="text-h6 p-title">
                The Best Way To Frame A House’s With
              </span>
              <p>Aatues cum sociis natoque penatibus et</p>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="6"
              ><v-img
                class="rounded-lg mt-4"
                width="150"
                height="100"
                contain
                :src="require('../../../../assets/images/blog_03_470x.webp')"
              ></v-img>
            </v-col>
            <v-col cols="12" md="6">
              <span class="text-h6 p-title">
                The Best Way To Frame A House’s With
              </span>
              <p>Aatues cum sociis natoque penatibus et</p>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="6"
              ><v-img
                class="rounded-lg mt-4"
                width="150"
                height="100"
                contain
                :src="require('../../../../assets/images/blog_03_470x.webp')"
              ></v-img>
            </v-col>
            <v-col cols="12" md="6">
              <span class="text-h6 p-title">
                The Best Way To Frame A House’s With
              </span>
              <p>Aatues cum sociis natoque penatibus et</p>
            </v-col>
          </v-row>
        </v-col>
        <!-- End reccent articles -->

        <!-- start articles -->
        <v-col cols="12" md="8">
          <v-row>
            <v-col cols="12" md="6">
              <div class="img-hover">
                <v-img
                  class="rounded-lg mt-4 img-hover"
                  contain
                  :src="require('../../../../assets/images/blog_03_470x.webp')"
                ></v-img>
              </div>
              <p class="text-h4 mt-10 p-title">
                The Best Way To Frame A House’s With
              </p>
              <v-container>
                <v-row>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-account-circle-outline
                    </v-icon>
                    <p class="d-inline">By Amin</p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-calendar-month-outline
                    </v-icon>
                    <p class="d-inline">
                      {{ new Date().getFullYear() }}-{{ new Date().getMonth() }}
                    </p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-comment-text-multiple-outline
                    </v-icon>
                    <p class="d-inline">1</p>
                  </v-col>
                </v-row>
              </v-container>
              <v-divider></v-divider>
            </v-col>
            <v-col cols="12" md="6">
              <div class="img-hover">
                <v-img
                  class="rounded-lg mt-4 img-hover"
                  contain
                  :src="require('../../../../assets/images/blog_03_470x.webp')"
                ></v-img>
              </div>
              <p class="text-h4 mt-10 p-title">
                The Best Way To Frame A House’s With
              </p>
              <v-container>
                <v-row>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-account-circle-outline
                    </v-icon>
                    <p class="d-inline">By Amin</p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-calendar-month-outline
                    </v-icon>
                    <p class="d-inline">
                      {{ new Date().getFullYear() }}-{{ new Date().getMonth() }}
                    </p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-comment-text-multiple-outline
                    </v-icon>
                    <p class="d-inline">1</p>
                  </v-col>
                </v-row>
              </v-container>
              <v-divider></v-divider>
            </v-col>
            <v-col cols="12" md="6">
              <div class="img-hover">
                <v-img
                  class="rounded-lg mt-4 img-hover"
                  contain
                  :src="require('../../../../assets/images/blog_03_470x.webp')"
                ></v-img>
              </div>
              <p class="text-h4 mt-10 p-title">
                The Best Way To Frame A House’s With
              </p>
              <v-container>
                <v-row>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-account-circle-outline
                    </v-icon>
                    <p class="d-inline">By Amin</p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-calendar-month-outline
                    </v-icon>
                    <p class="d-inline">
                      {{ new Date().getFullYear() }}-{{ new Date().getMonth() }}
                    </p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-comment-text-multiple-outline
                    </v-icon>
                    <p class="d-inline">1</p>
                  </v-col>
                </v-row>
              </v-container>
              <v-divider></v-divider>
            </v-col>
            <v-col cols="12" md="6">
              <div class="img-hover">
                <v-img
                  class="rounded-lg mt-4 img-hover"
                  contain
                  :src="require('../../../../assets/images/blog_03_470x.webp')"
                ></v-img>
              </div>
              <p class="text-h4 mt-10 p-title">
                The Best Way To Frame A House’s With
              </p>
              <v-container>
                <v-row>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-account-circle-outline
                    </v-icon>
                    <p class="d-inline">By Amin</p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-calendar-month-outline
                    </v-icon>
                    <p class="d-inline">
                      {{ new Date().getFullYear() }}-{{ new Date().getMonth() }}
                    </p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-comment-text-multiple-outline
                    </v-icon>
                    <p class="d-inline">1</p>
                  </v-col>
                </v-row>
              </v-container>
              <v-divider></v-divider>
            </v-col>
            <v-col cols="12" md="6">
              <div class="img-hover">
                <v-img
                  class="rounded-lg mt-4 img-hover"
                  contain
                  :src="require('../../../../assets/images/blog_03_470x.webp')"
                ></v-img>
              </div>
              <p class="text-h4 mt-10 p-title">
                The Best Way To Frame A House’s With
              </p>
              <v-container>
                <v-row>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-account-circle-outline
                    </v-icon>
                    <p class="d-inline">By Amin</p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-calendar-month-outline
                    </v-icon>
                    <p class="d-inline">
                      {{ new Date().getFullYear() }}-{{ new Date().getMonth() }}
                    </p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-comment-text-multiple-outline
                    </v-icon>
                    <p class="d-inline">1</p>
                  </v-col>
                </v-row>
              </v-container>
              <v-divider></v-divider>
            </v-col>
            <v-col cols="12" md="6">
              <div class="img-hover">
                <v-img
                  class="rounded-lg mt-4 img-hover"
                  contain
                  :src="require('../../../../assets/images/blog_03_470x.webp')"
                ></v-img>
              </div>
              <p class="text-h4 mt-10 p-title">
                The Best Way To Frame A House’s With
              </p>
              <v-container>
                <v-row>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-account-circle-outline
                    </v-icon>
                    <p class="d-inline">By Amin</p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-calendar-month-outline
                    </v-icon>
                    <p class="d-inline">
                      {{ new Date().getFullYear() }}-{{ new Date().getMonth() }}
                    </p>
                  </v-col>
                  <v-col cols="12" md="4">
                    <v-icon large color="orange accent-1">
                      mdi-comment-text-multiple-outline
                    </v-icon>
                    <p class="d-inline">1</p>
                  </v-col>
                </v-row>
              </v-container>
              <v-divider></v-divider>
            </v-col>
          </v-row>
        </v-col>
        <!-- End articles -->
      </v-row>
    </v-container>
  </div>
</template>
<script>
export default {};
</script>


<style scoped>
.p-recent {
  color: #c08c4d;
}
.border {
  border-color: black;
  border-width: 2px !important;
}
.p-title:hover {
  color: #c08c4d;
  transition: 0.6s;
}

.img-hover:hover {
  opacity: 0.5;
  background-color: #c08c4d !important;
  transition: 2s;
}
</style>
