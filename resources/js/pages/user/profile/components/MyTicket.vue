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
        <template v-slot:[`item.actions`]="{ item }">
          <v-icon color="green" dense class="mr-2" @click="viewItem(item)">
            mdi-eye
          </v-icon>
        </template>
        <template v-slot:no-data>
          <v-btn color="primary" @click="getMyTickets"> موردی یافت نشد </v-btn>
        </template>
      </v-data-table>
    </v-container>
  </div>
</template>


<script>
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
      { text: "موضوع", value: "subject" },
      { text: "وضعیت پاسخ", value: "reply_status" },
      { text: "وضعیت", value: "status" },
      { text: "تاریخ", value: "created_at" },
      { text: "عملیات", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      row: 0,
      id: "",
      subject: "",
      status: "",
      user_id:"",
      reply_status: "",
      created_at: "",
    },
    defaultItem: {
      row: 0,
      id: "",
      subject: "",
      status: "",
      user_id:"",
      reply_status: "",
      created_at: "",
    },
  }),
  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  created() {
    this.getMyTickets();
  },
  methods: {
    async getMyTickets() {
      let token = localStorage.getItem("userToken");
      let user_id = this.$route.params.userId;
      await axios
        .get(`/api/myTickets/${user_id}`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          console.log(response);
          let row = 0;
          response.data.myTickets.map((ticket) => {
            this.desserts.push({
              row: ++row,
              id: ticket.id,
              user_id: ticket.user_id,
              subject: ticket.subject,
              status: ticket.status == "close" ? "بسته" : "باز",
              reply_status:ticket.reply_status == "pending" ? "درحال انتظار" : " پاسخ داده شده",
              created_at: new Date(ticket.created_at).toLocaleDateString("FA-IR") ,
            });
          });
        })
        .catch((error) => {});
    },
    viewItem(item) {
      let subject = item.subject.replace(" ", "-");
      console.log(subject);
      this.$router.push(`/user/profile/ticket/${item.user_id}/${subject}`);
    },
  },
};
</script>
