<template>
  <v-container>
    <h1>تیکت های من</h1>
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
                  v-if="ticket.status == 'open'"
                  @click="replyTicket(ticket.id, ticket.subject)"
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
        <v-btn class="btn-readMore" @click="closeTicket"> بستن تیکت </v-btn>
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
import alerts from "../../../../shared/alerts/index.js";
export default {
  created() {
    this.getMyTickets();
  },
  data() {
    return {
      tickets: [],
      reply: "",
      dialog: false,
      parent_id: null,
      admin_id: null,
      subject: "",
    };
  },
  methods: {
    async getMyTickets() {
      let token = localStorage.getItem("userToken");
      let userId = this.$route.params.id;
      let subject = this.$route.params.subject;
      await axios
        .get(`/api/get/ticket/replies/${userId}/${subject}`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          console.log(response.data.myTickets);
          this.tickets = response.data.myTickets;
        })
        .catch((err) => {});
    },

    replyTicket(parent_id, subject) {
      this.parent_id = parent_id;
      this.subject = subject;
      this.dialog = true;
    },
    confirmReply() {
      let token = localStorage.getItem("userToken");
      let user_id = this.$route.params.userId;
      axios
        .post(
          `/api/add/ticket`,
          {
            user_id: user_id,
            admin_id: this.admin_id,
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
          alerts.successAlert("پاسخ شما با موفقیت ثبت شد در انتظار بمانید");
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
