<template>
  <div>
    <h1 class="subheading grey--text">لیست دسته بندی ها</h1>
    <v-container>
      <v-card>
        <v-card-title>
          <router-link class="a-style" to="/dashboard/category/create">
            <v-btn color="primary" elevation="2"> آیتم جدید </v-btn>
          </router-link>
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="جستجو"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
        <v-data-table
          :search="search"
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
          <template v-slot:[`item.actions`]="{ item }">
            <v-icon color="green" dense class="mr-2" @click="editItem(item)">
              mdi-pencil
            </v-icon>
            <v-icon dense color="red" @click="deleteItem(item)">
              mdi-delete
            </v-icon>
          </template>
          <template v-slot:no-data>
            <v-btn color="primary" @click="getCategories">
              موردی یافت نشد
            </v-btn>
          </template>
        </v-data-table>
      </v-card>
    </v-container>
  </div>
</template>


<script>
import alerts from "../../../shared/alerts/index";
export default {
  data: () => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "ردیف",
        align: "start",
        sortable: false,
        value: "row",
      },
      { text: "عنوان", value: "name" },
      { text: "دسته پدر", value: "parent_name" },
      { text: "مدل مرتبط", value: "model_type" },
      { text: "عملیات", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      id: "",
      name: "",
      model_type: "",
      parent_name: "",
      row: 0,
    },
    defaultItem: {
      id: "",
      name: "",
      model_type: "",
      parent_name: "",
      row: 0,
    },
  }),
  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  created() {
    this.getCategories();
  },
  methods: {
    async getCategories() {
      let token = localStorage.getItem("adminToken");
      await axios
        .get(`/api/category`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let row = 0;
          response.data.categories.map((category) => {
            this.desserts.push({
              id: category.id,
              row: ++row,
              name: category.name,
              parent_name: category.parent_name
                ? category.parent_name
                : "ندارد",
              model_type: category.model_type,
            });
          });
        })
        .catch((error) => {});
    },
    editItem(item) {
      console.log(item);
      this.$router.push(`/dashboard/category/edit/${item.id}`);
    },
    deleteItem(item) {
      console.log(item);
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
    async deleteItemConfirm() {
      let token = localStorage.getItem("adminToken");
      let id = this.editedItem.id;
      await axios
        .delete(`/api/category/${id}`, {
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
<style scoped>
.a-style {
  text-decoration: none;
}
</style>
