<template>
  <div>
    <h1 class="subheading grey--text ma-4">اپلود تصویر</h1>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container>
        <v-row>
          <v-col cols="8">
            <ValidationProvider rules="required|min:3" v-slot="{ errors }">
              <v-text-field
                v-model="name"
                label="نام"
                placeholder="نام"
                filled
                :error-messages="errors"
              ></v-text-field>
            </ValidationProvider>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="8">
            <ValidationProvider rules="required|mimes:image/jpeg,image/jpg,image/png,image/gif" v-slot="{ errors }">
              <v-file-input
                placeholder="اپلود عکس"
                @change="Preview_image"
                :error-messages="errors"
                :rules="imgValidate"
              >
              </v-file-input>
            </ValidationProvider>
            <v-img :src="url" height="300"></v-img>
          </v-col>
          <v-col cols="2">
            <v-btn
              class="mt-4 white--text font-weight-bold pink darken-1"
              @click="upload"
              :disabled="invalid"
            >
              ثبت کردن
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </ValidationObserver>
    <v-row justify="center"> </v-row>
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
  data() {
    return {
      image: "",
      url: "",
      name: "",
      imgValidate: [
        (value) => !!value || "اپلود عکس اجباری است",
        (value) =>
          !value || value.size < 2000000 || "سایز باید کمتر از 2 مگابایت باشد",
      ],
    };
  },
  methods: {
    Preview_image(event) {
      this.image = event;
      this.url = URL.createObjectURL(this.image);
      console.log(this.image);
    },
    async upload() {
      let token = localStorage.getItem("adminToken");
      await axios
        .post(
          `/api/media-image`,
          {
            image: this.image,
            name: this.name,
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
          this.url = "";
          this.name = "";
        })
        .catch((error) => {
          alerts.errorAlert("آپلود انجام نشد ");
        });
    },
  },
};
</script>
