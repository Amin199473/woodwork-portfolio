<template>
  <div>
    <h1 class="subheading grey--text">لیست اسلایدرها</h1>
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
        <template v-slot:[`item.image`]="{ item }">
          <img :src="item.image" class="p-1" height="70" width="100" alt="" />
        </template>

        <template v-slot:[`item.status`]="{ item }">
          <v-chip color="green white--text" v-if="item.status"> فعال </v-chip>
          <v-chip color="red white--text" v-else> غیر فعال </v-chip>
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
          <v-btn color="primary" @click="getCategories"> موردی یافت نشد </v-btn>
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
      { text: "عنوان", value: "title" },
      { text: "عنوان فرعی", value: "subtitle" },
      { text: "تصویر", value: "image" },
      { text: "وضعیت", value: "status" },
      { text: "محتوای دکمه", value: "button" },
      { text: "لینک دکمه", value: "link_button" },
      { text: "عملیات", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      row: 0,
      id: "",
      title: "",
      subtitle: "",
      button: "",
      link_button: "",
      image: "",
      status: 0,
    },
    defaultItem: {
      row: 0,
      id: "",
      title: "",
      subtitle: "",
      button: "",
      link_button: "",
      image: "",
      status: 0,
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
        .get(`/api/slider`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          console.log(response);
          let row = 0;
          response.data.sliders.map((slider) => {
            this.desserts.push({
              row: ++row,
              id: slider.id,
              title: slider.title,
              subtitle: slider.subtitle,
              button: slider.button,
              link_button: slider.link_button,
              image: slider.image,
              status: slider.status,
            });
          });
        })
        .catch((error) => {});
    },
    editItem(item) {
      this.$router.push(`/dashboard/slider/edit/${item.id}`);
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
        .delete(`/api/slider/${id}`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
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
