<template>
  <div>
    <h1 class="subheading grey--text">لیست کابران </h1>
    <v-container>
      <v-data-table
        :headers="headers"
        :items="desserts"
        sort-by="calories"
        class="elevation-1"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialogDelete" max-width="350px">
              <v-card>
                <v-card-title class="text-h5 text-center">
                  آیا از حذف این آیتم اطمینان دارید؟
                </v-card-title>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="closeDelete"
                    >خیر</v-btn
                  >
                  <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                    >بله</v-btn
                  >
                  <v-spacer></v-spacer>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>
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
          <v-icon color="green" dense class="mr-2" @click="editItem(item)">
            mdi-pencil
          </v-icon>
          <v-icon dense color="red" @click="deleteItem(item)">
            mdi-delete
          </v-icon>
        </template>
        <template v-slot:no-data>
          <v-btn color="primary" @click="getUsers"> موردی یافت نشد </v-btn>
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
      { text: "نام", value: "name" },
      { text: "ایمیل", value: "email" },
      { text: "اواتار", value: "avatar" },
      { text: "عملیات", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      row: 0,
      id: "",
      name: "",
      email: "",
      avatar: "",
    },
    defaultItem: {
       row: 0,
      id: "",
      name: "",
      email: "",
      avatar: "",
    },
  }),
  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  created() {
    this.getUsers();
  },
  methods: {
    async getUsers() {
      let token = localStorage.getItem("adminToken");
      await axios
        .get(`/api/getUsers`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          console.log(response);
          let row = 0;
          response.data.users.map((user) => {
            this.desserts.push({
              row: ++row,
              id: user.id,
              name: user.name,
              email: user.email,
              avatar: user.avatar,
            });
          });
        })
        .catch((error) => {});
    },
    editItem(item) {
      this.$router.push(`/dashboard/user/edit/${item.id}`);
    },
    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
    async deleteItemConfirm() {
      let token = localStorage.getItem("adminToken");
      let id = this.editedItem.id;
      await axios
        .delete(`/api/user/${id}`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          console.log(response);
          alerts.successAlert(response.data.message);
        })
        .catch((error) => {
          alerts.errorAlert("حذف انجام نشد");
        });

      this.desserts.splice(this.editedIndex, 1);
      this.closeDelete();
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
  },
};
</script>
