<template>
  <div>
    <h1 class="subheading grey--text ma-4">افزودن گواهی</h1>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="4">
              <ValidationProvider v-slot="{ errors }">
                <v-file-input
                  placeholder="اپلود عکس"
                  @change="Preview_image"
                  :error-messages="errors"
                  :rules="imgValidate"
                >
                </v-file-input>
              </ValidationProvider>
              <v-img
                :src="url"
                class="mb-4 rounded-lg"
                width="200"
                height="200"
              ></v-img>
            </v-col>
            <v-col cols="12" md="8">
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  :error-messages="errors"
                  v-model="customer_name"
                  label="عنوان"
                  filled
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
              @click="addTestimonial"
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
  data: () => ({
    description: "<p>محتوای گواهی </p>",
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
    addTestimonial() {
      let token = localStorage.getItem("adminToken");
      axios
        .post(
          `/api/testimonial`,
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
