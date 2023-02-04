<template>
  <div>
    <h1 class="subheading grey--text ma-4">لیست تصاویر</h1>
    <v-container>
      <v-row>
        <v-col
          v-for="image in images"
          :key="image.id"
          class="d-flex child-flex"
          cols="3"
        >
          <v-card>
            <v-img
              :src="image.image_path"
              :lazy-src="image.image_path"
              aspect-ratio="1"
              class="grey lighten-2"
              :alt="image.name"
              contain
            >
              <template v-slot:placeholder>
                <v-row class="fill-height ma-0" align="center" justify="center">
                  <v-progress-circular
                    indeterminate
                    color="grey lighten-5"
                  ></v-progress-circular>
                </v-row>
              </template>
            </v-img>
            <v-card-subtitle> {{ image.image_path }}</v-card-subtitle>
            <v-card-subtitle>
              <v-icon color="red" @click="deleteImage(image.id)">
                mdi-delete
              </v-icon>
            </v-card-subtitle>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    <v-row justify="center">
      <v-dialog v-model="dialog" persistent max-width="600px">
        <v-card>
          <v-card-title>
            <span class="text-h5"> حذف تصویر </span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <p class="text-center text-h5">
                ایا از حذف تصویر مورد نظر اطمینان دارید؟
              </p>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="deleteConfirm">
              تایید
            </v-btn>
            <v-btn color="blue darken-1" text @click="dialog = false">
              کنسل
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>

<script>
import alerts from "../../../shared/alerts";
export default {
  created() {
    this.getImages();
  },
  data() {
    return {
      id: "",
      images: [],
      name: "",
      serverUrl: "",
      dialog: false,
    };
  },
  methods: {
    async getImages() {
      let token = localStorage.getItem("adminToken");
      await axios
        .get(`/api/media-images`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let result = response.data.images;
          this.images = result;
        })
        .catch((error) => {});
    },
    deleteImage(id) {
      this.id = id;
      this.dialog = true;
    },
    deleteConfirm() {
      let token = localStorage.getItem("adminToken");
      axios
        .get(`/api/media-deleteImage/${this.id}`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let message = response.data.message;
          alerts.successAlert(message);
          this.dialog = false;
        })
        .catch((error) => {
          alerts.errorAlert(".حذف انجام نشد");
        });
    },
  },
};
</script>
