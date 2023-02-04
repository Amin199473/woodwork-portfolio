<template>
  <div>
    <h1 class="subheading grey--text ma-4">ویرایش اسلایدر</h1>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="4">
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="subtitle"
                  label="عنوان فرعی"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="button"
                  label="محتوای دکمه"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>

              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="link_button"
                  label="لینک دکمه"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>

              <ValidationProvider>
                <v-file-input
                  filled
                  placeholder="اپلود عکس"
                  :rules="imgValidate"
                  @change="Preview_image"
                >
                </v-file-input>
              </ValidationProvider>
              <v-img :src="url" class="mb-4"></v-img>
              <v-switch
                v-model="status"
                label="وضعیت "
                color="primary"
                hide-details
              ></v-switch>
            </v-col>
            <v-col cols="12" md="8">
              <v-text-field v-model="title" label="عنوان" filled></v-text-field>
              <ckeditor v-model="body" :config="editorConfig"></ckeditor>
            </v-col>
          </v-row>
          <v-row justify="center" class="my-4">
            <v-btn
              color="success"
              class="mr-4"
              :disabled="invalid"
              @click="editSlider"
            >
              افزودن
            </v-btn>

            <v-btn color="warning" @click="reset" class="mr-4"> پاک کردن </v-btn>
            <router-link class="a-style" to="/dashboard/slider">
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
    this.getSlier();
  },
  data: () => ({
    body: "",
    editorConfig: {
      // The configuration of the editor.
    },
    valid: true,
    title: "",
    subtitle: "",
    button: "",
    link_button: "",
    status: false,
    image: null,
    url: "",
    imgValidate: [
      (value) => !!value || "اپلود عکس اجباری است",
      (value) =>
        !value || value.size < 2000000 || "سایز باید کمتر از 2 مگابایت باشد",
    ],
  }),
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

    getSlier() {
      let token = localStorage.getItem("adminToken");
      let id = this.$route.params.id;
      axios
        .get(`/api/slider/${id}`, {
          headers: {
            Authorization: token,
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          let result = response.data.slider;
          console.log(response);
          this.title = result.title;
          this.subtitle = result.subtitle;
          this.button = result.button;
          this.link_button = result.link_button;
          this.body = result.body;
          this.url = result.image;
          this.status = result.status;
        })
        .catch((error) => {});
    },

    editSlider() {
      let token = localStorage.getItem("adminToken");
      let id = this.$route.params.id;
      axios
        .post(
          `/api/edit/slider/${id}`,
          {
            title: this.title,
            subtitle: this.subtitle,
            button: this.button,
            link_button: this.link_button,
            image: this.image,
            status: this.status ? 1 : 0,
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
          alerts.errorAlert("اسلایدر با موفقیت ذخیره نشد");
        });
    },
  },
};
</script>
