<template>
  <div>
    <h1 class="subheading grey--text"> لیست اعضای تیم </h1>
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
          <v-avatar size="90">
            <img :src="item.avatar" />
          </v-avatar>
        </template>
        <template v-slot:[`item.status`]="{ item }">
          <v-chip color="green white--text" v-if="item.status"> فعال </v-chip>
          <v-chip color="red white--text" v-else> غیر فعال </v-chip>
        </template>
        <template v-slot:[`item.isImportant`]="{ item }">
          <v-icon color="green" dark right v-if="item.isImportant">
            mdi-thumb-up
          </v-icon>
          <v-icon color="red" dark right v-else> mdi-thumb-down </v-icon>
        </template>
        <template v-slot:[`item.featured`]="{ item }">
          <v-icon color="green" dark right v-if="item.featured">
            mdi-thumb-up
          </v-icon>
          <v-icon color="red" dark right v-else> mdi-thumb-down </v-icon>
        </template>
        <template v-slot:[`item.actions`]="{ item }">
          <v-icon color="blue" dense class="mr-2" @click="viewPost(item)">
            mdi-eye
          </v-icon>
          <v-icon color="green" dense class="mr-2" @click="editItem(item)">
            mdi-pencil
          </v-icon>
          <v-icon dense color="red" @click="deleteItem(item)">
            mdi-delete
          </v-icon>
        </template>
        <template v-slot:no-data>
          <v-btn color="primary" @click="getMembers"> موردی یافت نشد </v-btn>
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
      { text: "سن", value: "age" },
      { text: "سطح مهارت", value: "level" },
      { text: "میزان تجربه", value: "exprience" },
      { text: "مهارتها", value: "skills" },
      { text: "آواتار", value: "avatar" },
      { text: "عملیات", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      row: 0,
      id: "",
      name: "",
      age: "",
      bio: "",
      skills: "",
      level: "",
      exprience: "",
      avatar: "",
    },
    defaultItem: {
      row: 0,
      id: "",
      name: "",
      age: "",
      bio: "",
      skills: "",
      level: "",
      avatar: 0,
      exprience: "",
    },
  }),
  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  created() {
    this.getMembers();
  },
  methods: {
    async getMembers() {
      let token = localStorage.getItem("adminToken");
      await axios
        .get(`/api/member`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          console.log(response);
          let row = 0;
          response.data.members.map((member) => {
            this.desserts.push({
              row: ++row,
              id: member.id,
              name: member.name,
              age: member.age,
              bio: member.bio,
              avatar: member.avatar,
              skills: member.skills,
              level: member.level,
              exprience: member.exprience,
            });
          });
        })
        .catch((error) => {});
    },
    viewPost(item) {
      this.$router.push(`/dashboard/member/view/${item.id}`);
    },
    editItem(item) {
      this.$router.push(`/dashboard/member/edit/${item.id}`);
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
        .delete(`/api/member/${id}`, {
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
