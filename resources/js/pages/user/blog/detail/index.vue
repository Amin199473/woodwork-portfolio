<template>
  <div style="background-color: rgb(235 230 231 / 88%)">
    <Parallax />
    <v-container class="mt-16">
      <v-row>
        <v-col cols="12" sm="12" md="12">
          <v-img width="1020" :src="image"></v-img>
          <p class="text-h4 mt-8">
            {{ title }}
          </p>
          <div>
            <v-icon large color="orange accent-1">
              mdi-comment-text-multiple-outline
            </v-icon>
            <p class="d-inline">{{ commentCount }} نظرات</p>
          </div>
          <v-row align="center" class="py-8" justify="start">
            <v-icon class="mr-1" color="green" @click="likePost">
              mdi-thumb-up
            </v-icon>
            <span class="subheading mr-2 black--text">{{ likedCount }}</span>

            <v-icon class="mr-1" color="red" @click="dislikePost">
              mdi-thumb-down
            </v-icon>
            <span class="subheading black--text">{{ dislikedCount }}</span>
          </v-row>
          <div v-html="body"></div>
          <div class="mt-16">
            <v-icon large color="orange accent-1">
              mdi-comment-text-multiple-outline
            </v-icon>
            <p class="d-inline">{{ commentCount }} نظرات</p>
          </div>
          <ValidationObserver ref="observer" v-slot="{ invalid }">
            <div class="comment-form">
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
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" md="2">
                    <v-btn
                      :disabled="invalid"
                      class="btn-readMore"
                      @click="leaveComment"
                    >
                      ثبت نظر
                    </v-btn>
                  </v-col>
                  <v-col cols="12" md="10">
                    <p class="tex-right text-h4" v-if="!isLoggedIn">
                      برای ثبت نظر باید
                      <router-link class="router-link" to="/user/register"
                        >ثبت نام</router-link
                      >
                      یا به حساب کاری خود
                      <router-link class="router-link" to="/user/login"
                        >ورود</router-link
                      >
                      کنید
                    </p>
                  </v-col>
                </v-row>
              </v-container>
            </div>
          </ValidationObserver>
          <v-row class="my-10">
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
                  v-for="(reply, index) in comment.replies"
                  :key="index"
                >
                  <v-card class="mx-auto" color="brown lighten-5" dark>
                    <v-card-title> </v-card-title>
                    <v-card-text
                      class="text-h5 text-right black--text font-weight-medium"
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
          </v-row>
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
import Parallax from "../../sharedComponets/TheParallax.vue";
import alerts from "../../../../shared/alerts/index.js";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import ValidateRules from "../../../../shared/validations/validateRules.js";
export default {
  components: {
    Parallax,
    ValidationProvider,
    ValidationObserver,
  },
  created() {
    this.$store.dispatch("userAuth/loadUser");
    this.$store.dispatch("adminAuth/loadAdmin");
    this.getPostDetail();
    this.getPostComments();
    this.likeAndDislikes();
  },
  data() {
    return {
      dialog: false,
      parent_id: null,
      comment: "",
      reply: "",
      allowComment: false,
      isLoggedIn: this.$store.getters["userAuth/isLoggedIn"],
      first: "",
      email: "",
      image: "",
      author: "",
      bio: "",
      body: "",
      tags: [],
      category: "",
      title: "",
      authorAvatar: "",
      comments: [],
      commentCount: "",
      likedCount: "",
      dislikedCount: "",
    };
  },
  methods: {
    getPostDetail() {
      let postId = this.$route.params.id;
      axios
        .get(`/api/post/${postId}`)
        .then((result) => {
          let post = result.data.post;
          this.image = post.image;
          this.title = post.title;
          this.body = post.body;
          this.author = post.author.name;
          this.bio = post.author.bio;
          this.category = post.category.name;
          this.authorAvatar = post.author.avatar;
        })
        .catch((err) => {});
    },
    async leaveComment() {
      let userToken = localStorage.getItem("userToken");
      let adminToken = localStorage.getItem("adminToken");
      let post_id = this.$route.params.id;
      let userIsLoggedIn = this.$store.getters["userAuth/isLoggedIn"];
      let adminIsloggedIn = this.$store.getters["adminAuth/isLoggedIn"];
      if (userIsLoggedIn || adminIsloggedIn) {
        let user = this.$store.getters["userAuth/getUser"];
        let admin = this.$store.getters["adminAuth/getAdmin"];
        await axios
          .post(
            `/api/add/comment/to/post`,
            {
              user_id: user ? user.id : null,
              post_id: post_id,
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
      let post_id = this.$route.params.id;
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
              post_id: post_id,
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
    async getPostComments() {
      let postId = this.$route.params.id;
      await axios
        .get(`/api/post/comments/${postId}`)
        .then((response) => {
          console.log(response.data.comments);
          this.comments = response.data.comments;
          this.commentCount = response.data.commentCount;
        })
        .catch((error) => {});
    },
    async likePost() {
      let userToken = localStorage.getItem("userToken");
      let post_id = this.$route.params.id;
      let userIsLoggedIn = this.$store.getters["userAuth/isLoggedIn"];
      if (userIsLoggedIn) {
        let user = this.$store.getters["userAuth/getUser"];
        await axios
          .post(
            `/api/like/post`,
            {
              user_id: user.id,
              post_id: post_id,
            },
            {
              headers: {
                Authorization: userToken,
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
    async dislikePost() {
      let userToken = localStorage.getItem("userToken");
      let post_id = this.$route.params.id;
      let userIsLoggedIn = this.$store.getters["userAuth/isLoggedIn"];
      if (userIsLoggedIn) {
        let user = this.$store.getters["userAuth/getUser"];
        await axios
          .post(
            `/api/dislike/post`,
            {
              user_id: user.id,
              post_id: post_id,
            },
            {
              headers: {
                Authorization: userToken,
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
    async likeAndDislikes() {
      let post_id = this.$route.params.id;
      await axios
        .get(`/api/countLikes/${post_id}`)
        .then((response) => {
          console.log(response.data);
          this.likedCount = response.data.likedCount;
          this.dislikedCount = response.data.dislikedCount;
        })
        .catch((error) => {});
    },
  },
};
</script>

<style scoped>
.btn-readMore {
  background-color: black !important;
  color: antiquewhite !important;
  transition: background-color 1s;
}
.btn-readMore:hover {
  background-color: #c08c4d !important;
}
.router-link {
  text-decoration: none;
}
</style>
