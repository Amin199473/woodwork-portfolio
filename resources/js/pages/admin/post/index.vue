<template>
  <div>
    <h1 class="subheading grey--text">لیست پست ها</h1>
    <v-container>
      <v-card>
        <v-card-title>
          <router-link class="a-style" to="/dashboard/post/create">
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
        <template v-slot:[`item.image`]="{ item }">
          <img
            :src="item.image"
            class="p-1"
            height="70"
            width="100"
            alt=""
          />
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
          <v-btn color="primary" @click="getPosts"> موردی یافت نشد </v-btn>
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
    search:"",
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
      { text: "دسته بندی", value: "category" },
      { text: "تصویر", value: "image" },
      { text: "وضعیت", value: "status" },
      { text: "مهم بودن", value: "isImportant" },
      { text: "ویژه بودن", value: "featured" },
      { text: "عملیات", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      row: 0,
      id: "",
      title: "",
      name: "",
      body: "",
      category: "",
      image: "",
      isImportant: 0,
      featured: 0,
      status: 0,
    },
    defaultItem: {
      row: 0,
      id: "",
      title: "",
      name: "",
      body: "",
      category: "",
      image: "",
      isImportant: 0,
      featured: 0,
      status: 0,
    },
  }),
  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  created() {
    this.getPosts();
  },
  methods: {
    async getPosts() {
      let token = localStorage.getItem("adminToken");
      await axios
        .get(`/api/post`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          console.log(response);
          let row = 0;
          response.data.posts.map((post) => {
            this.desserts.push({
              row: ++row,
              id: post.id,
              title: post.title,
              category: post.category.name,
              body: post.body,
              image: post.image,
              isImportant: post.isImportant,
              featured: post.featured,
              status: post.status,
            });
          });
        })
        .catch((error) => {});
    },
    viewPost(item){
      this.$router.push(`/dashboard/post/view/${item.id}`);

    },
    editItem(item) {
      this.$router.push(`/dashboard/post/edit/${item.id}`);
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
        .delete(`/api/post/${id}`, {
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
