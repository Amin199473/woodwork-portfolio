<template>
  <v-container>
    <h1 class="subheading grey--text">پاسخ تیکت</h1>
    <v-row>
      <v-col cols="12" v-for="ticket in tickets" :key="ticket.id">
        <v-card class="mx-auto" color="brown lighten-5" dark>
          <v-card-title>
            <v-chip class="ma-2" color="success" label>
              {{ ticket.subject }}
            </v-chip>
            <v-chip
              class="ma-2"
              color="primary"
              label
              v-if="ticket.admin_id == null"
            >
              <v-icon left> mdi-account-circle-outline </v-icon>
              {{ ticket.user.name }}
            </v-chip>
            <v-chip class="ma-2" color="primary" label v-else>
              <v-icon left> mdi-account-circle-outline </v-icon>
              {{ ticket.admin.name }}
            </v-chip>
            <v-chip
              class="ma-2"
              color="success"
              label
              v-if="ticket.reply_status == 'answered'"
            >
              <v-icon left> mdi-list-status </v-icon>
              پاسخ داد شده
            </v-chip>
            <v-chip class="ma-2" color="error" label v-else>
              <v-icon left> mdi-list-status </v-icon>
              درانتظار پاسخ
            </v-chip>
            <v-chip
              class="ma-2"
              color="success"
              label
              v-if="ticket.status == 'open'"
            >
              <v-icon left> mdi-open-in-app </v-icon>
              تیکت باز است
            </v-chip>
            <v-chip class="ma-2" color="error" label v-else>
              <v-icon left> mdi-list-status </v-icon>
              تیکت بسته
            </v-chip>
          </v-card-title>
          <v-card-text
            class="text-h5 text-right black--text font-weight-medium"
          >
            "{{ ticket.message }}"
          </v-card-text>
          <v-card-actions>
            <v-list-item class="grow">
              <v-list-item-content>
                <v-list-item-title class="black--text">
                  <v-icon large color="orange accent-1"> mdi-calendar </v-icon>
                  <p class="d-inline">
                    {{
                      new Date(ticket.created_at).toLocaleDateString("FA-IR")
                    }}
                  </p>
                </v-list-item-title>
              </v-list-item-content>

              <v-row align="center" justify="end">
                <v-btn
                  small
                  class="mx-4"
                  @click="
                    replyTicket(ticket.id, ticket.user_id, ticket.subject)
                  "
                  v-if="ticket.status == 'open'"
                >
                  <v-icon>mdi-plus</v-icon>
                </v-btn>
              </v-row>
            </v-list-item>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
    <v-row justify="center">
      <v-col cols="12" md="2">
        <v-btn class="btn-readMore mr-4" @click="closeTicket">
          بستن تیکت
        </v-btn>
      </v-col>
      <v-col cols="12" md="2">

        <router-link class="a-style" to="/dashboard/tickets">
          <v-btn color="purple" class="white--text"> مرحله قبل </v-btn>
        </router-link>
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
</template>

<script>
import alerts from "../../../shared/alerts/index.js";
export default {
  created() {
    this.$store.dispatch("adminAuth/loadAdmin");
    this.getTicket();
  },
  data() {
    return {
      dialog: "",
      tickets: [],
      user_id: "",
      reply: "",
      ticket: {},
    };
  },
  methods: {
    async getTicket() {
      let token = localStorage.getItem("adminToken");
      let id = this.$route.params.id;
      await axios
        .get(`/api/ticket/view/${id}`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let tickets = response.data.tickets;
          console.log(tickets);
          this.tickets = tickets;
        })
        .catch((error) => {});
    },
    replyTicket(parent_id, user_id, subject) {
      this.parent_id = parent_id;
      this.user_id = user_id;
      this.subject = subject;
      this.dialog = true;
    },
    confirmReply() {
      let token = localStorage.getItem("adminToken");
      let admin = this.$store.getters["adminAuth/getAdmin"];
      axios
        .post(
          `/api/add/ticket`,
          {
            user_id: this.user_id,
            admin_id: admin.id,
            subject: this.subject,
            message: this.reply,
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
          alerts.successAlert("پاسخ با موفقیت به این تیکت داده شد");
        })
        .catch((error) => {});
      this.dialog = false;
    },
    closeTicket() {
      let token = localStorage.getItem("adminToken");
      this.tickets.find(function (ticket, index) {
        if (ticket.parent_id == null) {
          let user_id = ticket.user_id;
          let subject = ticket.subject;
          axios
            .post(
              `/api/closeTicket`,
              {
                user_id: user_id,
                subject: subject,
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
        }
      });
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
