<template>
  <div>
    <v-container>
      <v-row>
        <v-col cols="12" md="12">
          <div class="comment-form">
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="subject"
                    label="موضوع"
                    placeholder="موضوع"
                    filled
                  ></v-text-field>
                  <v-textarea
                    v-model="message"
                    outlined
                    name="input-7-4"
                    label="تیکت"
                  ></v-textarea>
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12" md="2">
                  <v-btn class="btn-readMore" @click="addTicket">
                    ثبت تیکت
                  </v-btn>
                </v-col>
              </v-row>
            </v-container>
          </div>
        </v-col>
      </v-row>
      <v-dialog
        v-model="dialog"
        transition="dialog-top-transition"
        max-width="600"
      >
        <template v-slot:default="dialog">
          <v-card>
            <v-toolbar color="primary" dark>پاسخ تیکت</v-toolbar>
            <v-card-text>
              <div class="text-h2 pa-12">
                <v-row>
                  <v-col cols="12">
                    <v-textarea
                      v-model="reply"
                      outlined
                      name="input-7-4"
                      label="پاسخ خود را ثبت کنید"
                    ></v-textarea>
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
                >ثبت پاسخ</v-btn
              >
            </v-card-actions>
          </v-card>
        </template>
      </v-dialog>
    </v-container>
  </div>
</template>

<script>
import alerts from "../../../../shared/alerts/index.js";
export default {
  created() {
    this.$store.dispatch("userAuth/loadUser");
  },
  data() {
    return {
      dialog: false,
      parent_id: null,
      message: "",
      reply: "",
      allowComment: false,
      isLoggedIn: false,
      subject: "",
    };
  },
  methods: {
    async addTicket() {
      let token = localStorage.getItem("userToken");
      let user = this.$store.getters["userAuth/getUser"];
      await axios
        .post(
          `/api/add/ticket`,
          {
            user_id: user.id,
            subject: this.subject,
            message: this.message,
            status: "open",
            reply_status: "pending",
            parent_id: this.parent_id,
          },
          {
            headers: {
              Authorization: token,
            },
          }
        )
        .then((response) => {
          alerts.successAlert(response.data.message);
        })
        .catch((error) => {});
    },
    replyTicket(parent_id) {
      this.parent_id = parent_id;
      this.dialog = true;
    },
    async confirmReply() {
      let token = localStorage.getItem("userToken");
      let postId = this.$route.params.id;
      let user = this.$store.getters["userAuth/getUser"];
      await axios
        .post(
          `/api/add/comment`,
          {
            user_id: user.id,
            post_id: postId,
            comment: this.reply,
            parent_id: this.parent_id,
          },
          {
            headers: {
              Authorization: token,
            },
          }
        )
        .then((response) => {
          alerts.successAlert(response.data.message);
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
</style>
