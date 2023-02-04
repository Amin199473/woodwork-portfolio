<template>
  <div>
    <h1 class="subheading grey--text">لیست کابران</h1>
    <v-container>
      <v-data-table
        :headers="headers"
        :items="desserts"
        sort-by="calories"
        class="elevation-1"
      >
        <template v-slot:[`item.avatar`]="{ item }">
          <img
            :src="item.avatar"
            class="p-1 rounded-circle"
            height="70"
            width="100"
            alt=""
          />
        </template>
        <template v-slot:[`item.status`]="{ item }">
          <v-chip v-if="item.status == 'close'" color="red"> بسته </v-chip>
          <v-chip v-else color="green"> باز </v-chip>
        </template>
        <template v-slot:[`item.reply_status`]="{ item }">
          <v-chip v-if="item.reply_status == 'pending'" color="warning">
            درحال انتظار
          </v-chip>
          <v-chip v-else color="green"> پاسخ داده شده </v-chip>
        </template>
        <template v-slot:[`item.actions`]="{ item }">
          <v-icon color="green" dense class="mr-2" @click="viewItem(item)">
            mdi-eye
          </v-icon>
        </template>
        <template v-slot:no-data>
          <v-btn color="primary" @click="getTickets"> موردی یافت نشد </v-btn>
        </template>
      </v-data-table>
    </v-container>
  </div>
</template>


<script>
import alerts from "../../../shared/alerts/index";
export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "ردیف",
        align: "start",
        sortable: false,
        value: "row",
      },
      { text: "کاربر", value: "name" },
      { text: "ایمیل", value: "email" },
      { text: "موضوع", value: "subject" },
      { text: "وضعیت پاسخ", value: "reply_status" },
      { text: "وضعیت", value: "status" },
      { text: "تاریخ", value: "create_at" },
      { text: "عملیات", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      row: 0,
      id: "",
      name: "",
      email: "",
      subject: "",
      status: "",
      reply_status: "",
      create_at: "",
    },
    defaultItem: {
      row: 0,
      id: "",
      name: "",
      email: "",
      subject: "",
      status: "",
      reply_status: "",
      create_at: "",
    },
  }),
  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  created() {
    this.getTickets();
  },
  methods: {
    async getTickets() {
      let token = localStorage.getItem("adminToken");
      await axios
        .get(`/api/all/tickets`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          console.log(response);
          let row = 0;
          response.data.tickets.map((ticket) => {
            this.desserts.push({
              row: ++row,
              id: ticket.id,
              name: ticket.user.name,
              email: ticket.user.email,
              subject: ticket.subject,
              status: ticket.status,
              reply_status: ticket.reply_status,
              create_at: ticket.create_at,
            });
          });
        })
        .catch((error) => {});
    },
    viewItem(item) {
      this.$router.push(`/dashboard/ticket/view/${item.id}`);
    },
  },
};
</script>
