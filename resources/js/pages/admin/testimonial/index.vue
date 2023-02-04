<template>
  <div>
    <h1 class="subheading grey--text">لیست گواهی ها</h1>
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
          <img :src="item.image" class="p-1 rounded-lg" height="70" width="100" alt="" />
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
          <v-btn color="primary" @click="getTestimonial"> موردی یافت نشد </v-btn>
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
      { text: "عنوان", value: "customer_name" },
      { text: "تصویر", value: "image" },
      ,
      { text: "عملیات", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      row: 0,
      id: "",
      customer_name: "",
      image: "",
    },
    defaultItem: {
      row: 0,
      id: "",
      customer_name: "",
      image: "",
    },
  }),
  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  created() {
    this.getTestimonial();
  },
  methods: {
    async getTestimonial() {
      let token = localStorage.getItem("adminToken");
      await axios
        .get(`/api/testimonial`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let row = 0;
          response.data.testimonials.map((testimonial) => {
            this.desserts.push({
              row: ++row,
              id: testimonial.id,
              customer_name: testimonial.customer_name,
              image: testimonial.image,
            });
          });
        })
        .catch((error) => {});
    },
    editItem(item) {
      this.$router.push(`/dashboard/testimonial/edit/${item.id}`);
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
        .delete(`/api/testimonial/${id}`, {
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
