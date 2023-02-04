<template>
  <div>
    <Parallax />
    <v-container style="margin-top: 100px">
      <v-row justify="space-between">
        <v-col cols="12" md="4">
          <v-zoomer
            pivot="image-center"
            :class="{ 'resize-image': !xsAndsm() }"
          >
            <img
              :src="url ? url : imgGalleries[0].image"
              style="object-fit: fill; width: 100%; height: 100%"
            />
          </v-zoomer>
          <v-row class="mt-4">
            <v-col
              cols="4"
              md="3"
              lg="3"
              v-for="(img, index) in imgGalleries"
              :key="index"
            >
              <v-img
                @click="changeImage(index)"
                class="rounded-lg"
                :src="img.image"
                width="80"
                :class="imgIndex == index ? 'img-border' : false"
              >
              </v-img>
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="12" md="6">
          <p class="text-h2 text-right">{{ project.name }}</p>
          <p class="text-right text-h6">
            {{ project.short_description }}
          </p>
          <div class="text-right mt-8">
            <v-chip
              v-for="(item, index) in material"
              :key="index"
              class="ma-2"
              color="brown lighten-1"
              text-color="white"
            >
              {{ item }}
            </v-chip>
          </div>
          <p class="text-right text-h4 mt-8">
            وضعیت: <span style="color: green"> {{ project.status }} </span>
          </p>
          <v-rating
            class="text-right mt-8"
            background-color="warning lighten-1"
            color="warning"
            half-increments
            length="5"
            size="30"
            :value="value"
            hover
          ></v-rating>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="12" class="mt-8">
          <v-card>
            <v-tabs
              v-model="tab"
              background-color="brown darken-2"
              centered
              dark
              icons-and-text
            >
              <v-tabs-slider></v-tabs-slider>
              <v-tab href="#tab-1">
                توضیحات
                <v-icon large>mdi-book</v-icon>
              </v-tab>
              <v-tab href="#tab-2">
                نظرات
                <v-icon large>mdi-comment-account-outline</v-icon>
              </v-tab>
              <v-tab href="#tab-3">
                نظر دهید
                <v-icon large>mdi-message</v-icon>
              </v-tab>
            </v-tabs>
            <v-tabs-items v-model="tab">
              <v-tab-item value="tab-1">
                <v-card flat>
                  <v-card-text
                    v-html="project.description"
                    class="text-h6 text-right"
                  >
                  </v-card-text>
                </v-card>
              </v-tab-item>

              <v-tab-item value="tab-2">
                <v-col cols="12" v-for="comment in comments" :key="comment.id">
                  <v-card
                    v-if="comment.replies != 0 || comment.parent_id == null"
                    class="mx-auto"
                    color="brown lighten-5"
                    dark
                  >
                    <v-card-title> </v-card-title>
                    <v-card-text
                      class="text-h5 text-right black--text font-weight-medium"
                    >
                      "{{ comment.comment }}"
                    </v-card-text>
                    <v-card-actions>
                      <v-list-item class="grow" v-if="comment.user">
                        <v-list-item-avatar color="grey darken-3">
                          <v-img
                            class="elevation-6"
                            alt=""
                            :src="comment.user.avatar"
                          ></v-img>
                        </v-list-item-avatar>

                        <v-list-item-content>
                          <v-list-item-title class="black--text">{{
                            comment.user.name
                          }}</v-list-item-title>
                        </v-list-item-content>

                        <v-row align="center" justify="end">
                          <v-btn
                            small
                            class="mx-4"
                            @click="replyComment(comment.id)"
                          >
                            <v-icon>mdi-plus</v-icon>
                          </v-btn>
                        </v-row>
                      </v-list-item>
                      <v-list-item class="grow" v-else>
                        <v-list-item-avatar color="grey darken-3">
                          <v-img
                            class="elevation-6"
                            alt=""
                            :src="comment.admin.avatar"
                          ></v-img>
                        </v-list-item-avatar>

                        <v-list-item-content>
                          <v-list-item-title class="black--text">{{
                            comment.admin.name
                          }}</v-list-item-title>
                        </v-list-item-content>

                        <v-row align="center" justify="end">
                          <v-btn
                            small
                            class="mx-4"
                            @click="replyComment(comment.id)"
                          >
                            <v-icon>mdi-plus</v-icon>
                          </v-btn>
                        </v-row>
                      </v-list-item>
                    </v-card-actions>

                    <!-- start replies -->
                    <v-card-text
                      v-for="(reply, index) in [comment.replies]"
                      :key="index"
                    >
                      <v-card class="mx-auto" color="brown lighten-5" dark>
                        <v-card-title> </v-card-title>
                        <v-card-text
                          class="
                            text-h5 text-right
                            black--text
                            font-weight-medium
                          "
                        >
                          "{{ reply.comment }}"
                        </v-card-text>

                        <v-card-actions>
                          <v-list-item class="grow" v-if="reply.user">
                            <v-list-item-avatar color="grey darken-3">
                              <v-img
                                class="elevation-6"
                                alt=""
                                :src="reply.user.avatar"
                              ></v-img>
                            </v-list-item-avatar>

                            <v-list-item-content>
                              <v-list-item-title class="black--text">{{
                                reply.user.name
                              }}</v-list-item-title>
                            </v-list-item-content>

                            <v-row align="center" justify="end">
                              <v-btn
                                small
                                class="mx-4"
                                @click="replyComment(reply.id)"
                              >
                                <v-icon>mdi-plus</v-icon>
                              </v-btn>
                            </v-row>
                          </v-list-item>

                          <v-list-item class="grow" v-else>
                            <v-list-item-avatar color="grey darken-3">
                              <v-img
                                class="elevation-6"
                                alt=""
                                :src="reply.admin.avatar"
                              ></v-img>
                            </v-list-item-avatar>

                            <v-list-item-content>
                              <v-list-item-title class="black--text">{{
                                reply.admin.name
                              }}</v-list-item-title>
                            </v-list-item-content>

                            <v-row align="center" justify="end">
                              <v-btn
                                small
                                class="mx-4"
                                @click="replyComment(reply.id)"
                              >
                                <v-icon>mdi-plus</v-icon>
                              </v-btn>
                            </v-row>
                          </v-list-item>
                        </v-card-actions>
                        <v-card-text></v-card-text>
                      </v-card>
                    </v-card-text>
                    <!-- end replies -->
                  </v-card>
                </v-col>
                <p class="text-h4 text-center mt-8" v-if="!(comments == [])">
                    نظری تاکنون ثبت نشده است
                </p>
              </v-tab-item>

              <v-tab-item value="tab-3">
                <ValidationObserver ref="observer" v-slot="{ invalid }">
                  <div class="comment-form pa-16">
                    <v-container>
                      <v-row>
                        <v-col cols="12">
                          <ValidationProvider
                            rules="required|min:3"
                            v-slot="{ errors }"
                          >
                            <v-textarea
                              v-model="comment"
                              outlined
                              name="input-7-4"
                              label="کامنت بگذارید"
                              :error-messages="errors"
                            ></v-textarea>
                          </ValidationProvider>
                          <v-btn
                            :disabled="invalid"
                            class="btn-readMore"
                            @click="leaveComment"
                          >
                            کامنت بگذارید
                          </v-btn>
                        </v-col>
                      </v-row>
                    </v-container>
                  </div>
                </ValidationObserver>
              </v-tab-item>
            </v-tabs-items>
          </v-card>
        </v-col>
      </v-row>

      <ValidationObserver ref="observer" v-slot="{ invalid }">
        <v-dialog
          v-model="dialog"
          transition="dialog-top-transition"
          max-width="600"
        >
          <template v-slot:default="dialog">
            <v-card>
              <v-toolbar color="primary" dark>پاسخ کامنت</v-toolbar>
              <v-card-text>
                <div class="text-h2 pa-12">
                  <v-row>
                    <v-col cols="12">
                      <ValidationProvider
                        rules="required|min:3"
                        v-slot="{ errors }"
                      >
                        <v-textarea
                          v-model="reply"
                          outlined
                          name="input-7-4"
                          label="پاسخ خود را ثبت کنید"
                          :error-messages="errors"
                        ></v-textarea>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                </div>
              </v-card-text>
              <v-card-actions class="justify-end">
                <v-btn
                  large
                  text
                  class="font-weight-medium text-h6"
                  @click="dialog.value = false"
                  >کنسل</v-btn
                >
                <v-btn
                  large
                  text
                  class="font-weight-medium text-h6"
                  @click="confirmReply"
                  :disabled="invalid"
                  >ثبت پاسخ</v-btn
                >
              </v-card-actions>
            </v-card>
          </template>
        </v-dialog>
      </ValidationObserver>
    </v-container>
  </div>
</template>

<script>
import Parallax from "../sharedComponets/TheParallax.vue";
import VueZoomer from "vue-zoomer";
import alerts from "../../../shared/alerts/index.js";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import ValidateRules from "../../../shared/validations/validateRules.js";
export default {
  components: {
    VZoomer: VueZoomer.Zoomer,
    VZoomerGallery: VueZoomer.Gallery,
    Parallax,
    ValidationProvider,
    ValidationObserver,
  },
  created() {
    this.$store.dispatch("userAuth/loadUser");
    this.$store.dispatch("adminAuth/loadAdmin");
    this.getProjectComments();
    this.getProjectDetail();
  },
  data() {
    return {
      project: {},
      isLoggedIn: this.$store.getters["userAuth/isLoggedIn"],
      value: 5,
      replies: [],
      dialog: false,
      parent_id: null,
      comment: "",
      reply: "",
      url: "",
      comments: [],
      tab: null,
      imgIndex: 0,
      imgGalleries: [{}],
      material: [],
    };
  },
  methods: {
    changeImage(index) {
      this.imgIndex = index;
      this.url = this.imgGalleries[index].image;
    },
    async getProjectDetail() {
      let project_id = this.$route.params.id;
      await axios
        .get(`/api/project/${project_id}`)
        .then((response) => {
          this.imgGalleries = response.data.galleries;
          this.project = response.data.project;
          this.material = response.data.project.material.split(",");
        })
        .catch((err) => {});
    },
    async leaveComment() {
      let userToken = localStorage.getItem("userToken");
      let adminToken = localStorage.getItem("adminToken");
      let project_id = this.$route.params.id;
      let userIsLoggedIn = this.$store.getters["userAuth/isLoggedIn"];
      let adminIsloggedIn = this.$store.getters["adminAuth/isLoggedIn"];
      if (userIsLoggedIn || adminIsloggedIn) {
        let user = this.$store.getters["userAuth/getUser"];
        let admin = this.$store.getters["adminAuth/getAdmin"];
        await axios
          .post(
            `/api/add/comment/to/project`,
            {
              user_id: user ? user.id : null,
              project_id: project_id,
              admin_id: admin ? admin.id : null,
              comment: this.comment,
              parent_id: this.parent_id,
            },
            {
              headers: {
                Authorization: userToken || adminToken,
              },
            }
          )
          .then((response) => {
            alerts.successAlert(response.data.message);
          })
          .catch((error) => {});
      } else {
        return this.$router.push("/user/login");
      }
    },
    replyComment(parent_id) {
      this.parent_id = parent_id;
      this.dialog = true;
    },
    async confirmReply() {
      let userToken = localStorage.getItem("userToken");
      let adminToken = localStorage.getItem("adminToken");
      let project_id = this.$route.params.id;
      let userIsLoggedIn = this.$store.getters["userAuth/isLoggedIn"];
      let adminIsloggedIn = this.$store.getters["adminAuth/isLoggedIn"];
      if (userIsLoggedIn || adminIsloggedIn) {
        let user = this.$store.getters["userAuth/getUser"];
        let admin = this.$store.getters["adminAuth/getAdmin"];
        await axios
          .post(
            `/api/add/comment/to/project`,
            {
              user_id: user ? user.id : null,
              project_id: project_id,
              admin_id: admin ? admin.id : null,
              comment: this.reply,
              parent_id: this.parent_id,
            },
            {
              headers: {
                Authorization: userToken || adminToken,
              },
            }
          )
          .then((response) => {
            alerts.successAlert(response.data.message);
          })
          .catch((error) => {});
      } else {
        return this.$router.push("/user/login");
      }
    },
    async getProjectComments() {
      let project_id = this.$route.params.id;
      await axios
        .get(`/api/project/comments/${project_id}`)
        .then((response) => {
          this.comments = response.data.comments;
        })
        .catch((error) => {});
    },
    xsAndsm() {
      return this.$vuetify.breakpoint.xs || this.$vuetify.breakpoint.sm;
    },
  },
};
</script>
<style scoped>
.bg {
  background-color: rgb(235 230 231 / 88%);
}
.img-border {
  border: 2px solid black;
}
.btn-readMore {
  background-color: black !important;
  color: antiquewhite !important;
  transition: background-color 2s;
}
.btn-readMore:hover {
  background-color: #c08c4d !important;
}
.resize-image {
  width: 500px;
  height: 500px;
}
</style>
