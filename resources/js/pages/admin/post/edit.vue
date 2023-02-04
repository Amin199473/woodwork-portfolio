<template>
  <div>
    <h1 class="subheading grey--text ma-4">افزودن پست</h1>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="4">
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="seo_title"
                  label="عنوان سئو"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>

              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="meta_description"
                  label="توضیحات متا"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>

              <v-file-input
                filled
                placeholder="اپلود عکس"
                @change="Preview_image"
              >
              </v-file-input>
              <v-img :src="url" class="mb-4"></v-img>
              <ValidationProvider rules="min:3" v-slot="{ errors }">
                <v-combobox
                  v-model="meta_keywords"
                  chips
                  clearable
                  label="کلمات کلیدی"
                  multiple
                  prepend-icon="mdi-filter-variant"
                  solo
                  reverse
                  return-object
                  filled
                  :error-messages="errors"
                >
                </v-combobox>
              </ValidationProvider>

              <ValidationProvider rules="min:3" v-slot="{ errors }">
                <v-combobox
                  v-model="tags"
                  chips
                  clearable
                  label="تگ ها"
                  multiple
                  prepend-icon="mdi-filter-variant"
                  solo
                  reverse
                  return-object
                  filled
                  :error-messages="errors"
                >
                </v-combobox>
              </ValidationProvider>
              <v-switch
                class="text-right"
                v-model="isImportant"
                label="مهم بودن"
                color="primary"
                hide-details
              ></v-switch>
              <v-switch
                v-model="featured"
                label="ویژه بودن"
                color="primary"
                hide-details
              ></v-switch>
              <v-switch
                v-model="status"
                label="وضعیت "
                color="primary"
                hide-details
              ></v-switch>
            </v-col>
            <v-col cols="12" md="8">
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="title"
                  label="عنوان"
                  :error-messages="errors"
                  filled
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
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="12">
              <ckeditor
                v-model="body"
                :config="editorConfig"
                :editor-url="editorUrl"
              ></ckeditor>
            </v-col>
          </v-row>
          <v-row justify="center" class="my-4">
            <v-btn
              color="success"
              class="mr-4"
              :disabled="invalid"
              @click="editPost"
            >
              ویرایش
            </v-btn>

            <v-btn color="warning" @click="reset" class="mr-4"> پاک کردن </v-btn>
            <router-link class="a-style" to="/dashboard/post">
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
  data: () => ({
    body: "<p>Content of the editor.</p>",
    editorConfig: {
      // The configuration of the editor.
    },
    editorUrl: "https://cdn.ckeditor.com/4.20.1/full/ckeditor.js",
    valid: true,
    categories: [],
    category_id: "",
    title: "",
    seo_title: "",
    meta_description: "",
    meta_keywords: [],
    tags: [],
    body: "",
    isImportant: false,
    featured: false,
    status: false,
    image: "",
    url: "",
  }),
  created() {
    this.getCategories();
    this.getPost();
  },
  methods: {
    Preview_image(event) {
      this.image = event;
      this.url = URL.createObjectURL(this.image);
    },
    reset() {
      this.$refs.form.reset();
      this.image = null;
      this.url = null;
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },

    async getCategories() {
      let token = localStorage.getItem("adminToken");
      await axios
        .get(`/api/postCategories`, {
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
    async getPost() {
      let id = this.$route.params.id;
      let token = localStorage.getItem("adminToken");
      axios
        .get(`/api/post/${id}`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let result = response.data.post;

          this.title = result.title;
          this.body = result.body;
          this.seo_title = result.seo_title;
          this.meta_description = result.meta_description;
          this.meta_keywords = result.meta_keywords.split(",");
          result.tags.map((tag) => {
            this.tags.push(tag.name);
          });
          this.status = result.status;
          this.isImportant = result.isImportant;
          this.featured = result.featured;
          this.category_id = result.category_id;
          this.url = result.image;
        })
        .catch((error) => {
          //   alerts.errorAlert("پست با موفقیت ذخیره نشد");
        });
    },
    async editPost() {
      let token = localStorage.getItem("adminToken");
      let meta_keywords = this.meta_keywords.join();
      let tags = this.tags.join();
      let id = this.$route.params.id;

      await axios
        .post(
          `/api/edit/post/${id}`,
          {
            title: this.title,
            category_id: this.category_id,
            seo_title: this.seo_title,
            body: this.body,
            meta_description: this.meta_description,
            meta_keywords: meta_keywords,
            tags: tags,
            isImportant: this.isImportant ? 1 : 0,
            featured: this.featured ? 1 : 0,
            status: this.status ? 1 : 0,
            image: this.image,
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
          alerts.errorAlert("پست با موفقیت ذخیره نشد");
        });
    },
  },
};
</script>
