<template>
  <div>
    <h1 class="subheading grey--text ma-4">ویرایش پروژه</h1>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-dialog v-model="dialogDelete" max-width="600px">
        <v-card>
          <v-card-title class="text-h5 text-center">
            آیا از حذف آیتم مورد نظر اطمینان دارید؟ آیتم قابل بازگردانی نیست
          </v-card-title>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="closeDelete">خیر</v-btn>
            <v-btn color="blue darken-1" text @click="deleteItemConfirm"
              >بله</v-btn
            >
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="4">
              <ValidationProvider rules="required|min:10" v-slot="{ errors }">
                <v-text-field
                  v-model="status"
                  label="وضعیت پروژه"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <ValidationProvider rules="required" v-slot="{ errors }">
                <v-select
                  v-model="category_id"
                  :items="categories"
                  item-text="name"
                  item-value="id"
                  label="دسته بندی"
                  filled
                  :error-messages="errors"
                ></v-select>
              </ValidationProvider>
              <ValidationProvider v-slot="{ errors }">
                <v-file-input
                  multiple
                  placeholder="تصاویر "
                  @change="Preview_image"
                  filled
                  :error-messages="errors"
                  :rules="imgValidate"
                >
                </v-file-input>
              </ValidationProvider>
              <v-row>
                <v-col cols="3" v-for="(url, index) in urls" :key="index">
                  <v-img
                    width="70"
                    height="70"
                    :src="url.image"
                    class="mb-4 rounded-lg"
                  ></v-img>
                  <v-icon color="red" @click="deleteItem(index)"
                    >mdi-bookmark-remove</v-icon
                  >
                </v-col>
              </v-row>
            </v-col>
            <v-col cols="12" md="8">
              <ValidationProvider rules="required" v-slot="{ errors }">
                <v-text-field
                  v-model="name"
                  label="عنوان پروژه"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <ValidationProvider rules="required" v-slot="{ errors }">
                <v-textarea
                  v-model="short_description"
                  filled
                  name="input-7-4"
                  label="توضیح کوتاه"
                  :error-messages="errors"
                ></v-textarea>
              </ValidationProvider>
              <ValidationProvider rules="required" v-slot="{ errors }">
                <v-combobox
                  v-model="material"
                  chips
                  clearable
                  label="چوب و متریال"
                  multiple
                  prepend-icon="mdi-filter-variant"
                  solo
                  reverse
                  return-object
                  class="mt-16"
                  filled
                  :error-messages="errors"
                ></v-combobox>
              </ValidationProvider>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12">
              <ckeditor
                v-model="description"
                :editorUrl="editorUrl"
                :config="editorConfig"
              ></ckeditor>
            </v-col>
          </v-row>
          <v-row justify="center" class="my-4">
            <v-btn
              color="success"
              :disabled="invalid"
              class="mr-4"
              @click="editProject"
            >
              ویرایش
            </v-btn>

            <v-btn color="warning" @click="reset" class="mr-4"> پاک کردن </v-btn>
            <router-link class="a-style" to="/dashboard/project">
              <v-btn color="purple" class="white--text"> مرحله قبل </v-btn>
            </router-link>
          </v-row>
        </v-form>
      </v-container>
    </ValidationObserver>
  </div>
</template>

<script>
import alerts from "../../../shared/alerts";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import ValidateRules from "../../../shared/validations/validateRules.js";

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  created() {
    this.getProject();
    this.getCategories();
  },
  data: () => ({
    bio: "<p>اعضای تیم</p>",
    editorConfig: {
      // The configuration of the editor.
    },
    editorUrl: "https://cdn.ckeditor.com/4.20.1/full/ckeditor.js",
    valid: true,
    dialogDelete: false,
    imageGallery_id: "",
    indexOfGallery: "",
    name: "",
    description: "",
    images: [],
    urls: [],
    status: "",
    categories: [],
    category_id: "",
    material: [],
    short_description: "",
    imgValidate: [
      (value) =>
        !!value || "اپلود عکس الزامی است و سایز باید کمتر از 2 مگابایت باشد",
    ],
  }),
  methods: {
    Preview_image(event) {
      this.images = event;
      this.images.forEach((image) => {
        this.urls.push({
          image: URL.createObjectURL(image),
        });
      });
    },

    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
    async getCategories() {
      let token = localStorage.getItem("adminToken");
      await axios
        .get(`/api/projectCategories`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          response.data.categories.map((item) => {
            this.categories.push({ id: item.id, name: item.name });
          });
        })
        .catch((error) => {});
    },
    getProject() {
      let token = localStorage.getItem("adminToken");
      let id = this.$route.params.id;
      axios
        .get(`/api/project/${id}`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let project = response.data.project;
          let galleries = response.data.galleries;
          this.category_id = project.category_id;
          this.name = project.name;
          this.status = project.status;
          this.material = project.material.split(",");
          this.short_description = project.short_description;
          this.description = project.description;
          galleries.map((gallery) => {
            this.urls.push({
              id: gallery.id,
              image: gallery.image,
            });
          });
        })
        .catch((error) => {});
    },
    editProject() {
      let token = localStorage.getItem("adminToken");
      let material = this.material.join();
      let id = this.$route.params.id;
      axios
        .post(
          `/api/edit/project/${id}`,
          {
            name: this.name,
            status: this.status,
            material: material,
            short_description: this.short_description,
            description: this.description,
            images: this.images,
            category_id: this.category_id,
          },
          {
            headers: {
              Authorization: token,
              "Content-Type": "multipart/form-data",
            },
          }
        )
        .then((response) => {
          alerts.successAlert(response.data.message);
        })
        .catch((error) => {
          alerts.errorAlert("پروژه با موفقیت ویرایش نشد");
        });
    },
    deleteItem(index) {
      this.indexOfGallery = index;
      this.dialogDelete = true;
    },

    async deleteItemConfirm() {
      this.imageGallery_id = this.urls[this.indexOfGallery].id;
      this.images.splice(this.indexOfGallery, 1);
      this.urls.splice(this.indexOfGallery, 1);
      if (this.imageGallery_id) {
        let token = localStorage.getItem("adminToken");
        axios
          .delete(`/api/delete/imageGallery/${this.imageGallery_id}`, {
            headers: {
              Authorization: token,
            },
          })
          .then((response) => {
            alerts.successAlert("تصویر با موفقیت حذف شد و قابل بازگردانی نیست");
          })
          .catch((error) => {});
      }

      this.closeDelete();
    },

    closeDelete() {
      this.dialogDelete = false;
    },
  },
};
</script>
