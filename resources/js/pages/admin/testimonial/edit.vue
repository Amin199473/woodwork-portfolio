<template>
  <div>
    <h1 class="subheading grey--text ma-4">ویرایش گواهی</h1>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="4">
              <ValidationProvider v-slot="{ errors }">
                <v-file-input
                  :error-messages="errors"
                  :rules="imgValidate"
                  placeholder="اپلود عکس"
                  @change="Preview_image"
                >
                </v-file-input>
              </ValidationProvider>
              <v-img :src="url" class="mb-4 rounded-lg"></v-img>
            </v-col>
            <v-col cols="12" md="8">
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="customer_name"
                  label="عنوان"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <ckeditor v-model="description" :config="editorConfig"></ckeditor>
            </v-col>
          </v-row>
          <v-row justify="center" class="my-4">
            <v-btn
              color="success"
              :disabled="invalid"
              class="mr-4"
              @click="editSlider"
            >
              افزودن
            </v-btn>

            <v-btn color="warning" @click="reset" class="mr-4"> پاک کردن </v-btn>
            <router-link class="a-style" to="/dashboard/testimonial">
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
    this.getTestimonial();
  },
  data: () => ({
    description: "",
    editorConfig: {
      // The configuration of the editor.
    },
    valid: true,
    customer_name: "",
    image: null,
    url: "",
    imgValidate: [
      (value) =>
        !!value || "اپلود عکس الزامی است و سایز باید کمتر از 1 مگابایت باشد",
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

    getTestimonial() {
      let token = localStorage.getItem("adminToken");
      let id = this.$route.params.id;
      axios
        .get(`/api/testimonial/${id}`, {
          headers: {
            Authorization: token,
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          let result = response.data.testimonial;
          this.customer_name = result.customer_name;
          this.description = result.description;
          this.url = result.image;
        })
        .catch((error) => {});
    },

    editSlider() {
      let token = localStorage.getItem("adminToken");
      let id = this.$route.params.id;
      axios
        .post(
          `/api/edit/testimonial/${id}`,
          {
            customer_name: this.customer_name,
            description: this.description,
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
          alerts.errorAlert("گواهی با موفقیت ذخیره نشد");
        });
    },
  },
};
</script>
