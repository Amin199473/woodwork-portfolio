<template>
  <div>
    <h1 class="subheading grey--text ma-4">افزودن پروژه</h1>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="4">
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
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
                  :error-messages="errors"
                ></v-select>
              </ValidationProvider>
              <ValidationProvider>
                <v-file-input
                  multiple
                  placeholder="تصاویر "
                  @change="Preview_image"
                  :rules="imgValidate"
                >
                </v-file-input>
              </ValidationProvider>
              <v-row>
                <v-col cols="3" v-for="(url, index) in urls" :key="index">
                  <v-img
                    width="70"
                    height="70"
                    :src="url"
                    class="mb-4 rounded-lg"
                  ></v-img>
                  <v-icon color="red" @click="removeImage(index)"
                    >mdi-bookmark-remove</v-icon
                  >
                </v-col>
              </v-row>
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
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
                  :error-messages="errors"
                ></v-combobox>
              </ValidationProvider>
            </v-col>
            <v-col cols="12" md="8">
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="name"
                  label="عنوان پروژه"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <ValidationProvider rules="required|min:10" v-slot="{ errors }">
                <v-text-field
                  v-model="short_desctiption"
                  label="توضیح کوتاه"
                  filled
                  :error-messages="errors"
                ></v-text-field>
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
              @click="addProject"
            >
              افزودن
            </v-btn>
            <v-btn color="warning" @click="reset"> پاک کردن </v-btn>
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
    this.getCategories();
  },
  data: () => ({
    bio: "<p>اعضای تیم</p>",
    editorConfig: {
      // The configuration of the editor.
    },
    editorUrl: "https://cdn.ckeditor.com/4.20.1/full/ckeditor.js",
    valid: true,
    name: "",
    description: "",
    images: [],
    urls: [],
    status: "",
    categories: [],
    category_id: "",
    material: "",
    short_desctiption: "",
    imgValidate: [
      (value) =>
        !!value || "اپلود عکس الزامی است و سایز باید کمتر از 1 مگابایت باشد",
    ],
  }),
  methods: {
    Preview_image(event) {
      this.images = event;
      this.images.forEach((image) => {
        this.urls.push(URL.createObjectURL(image));
      });
    },
    removeImage(index) {
      this.images.splice(index, 1);
      this.urls.splice(index, 1);
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
    addProject() {
      let token = localStorage.getItem("adminToken");
      let material = this.material.join();
      axios
        .post(
          `/api/project`,
          {
            category_id: this.category_id,
            name: this.name,
            material: material,
            status: this.status,
            short_desctiption: this.short_desctiption,
            description: this.description,
            images: this.images,
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
          alerts.errorAlert("پروژه با موفقیت ایجاد نشد");
        });
    },
  },
};
</script>
