<template>
  <div>
    <h1 class="subheading grey--text ma-4">تنظیمات سایت</h1>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="3">
              <ValidationProvider rules="min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="instagram"
                  label="لینک اینستاگرام"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <ValidationProvider rules="min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="telegram"
                  label="لینک تلگرام"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <ValidationProvider rules="min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="facebook"
                  label="لینک فیس بوک"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <ValidationProvider rules="min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="whatsapp"
                  label="لینک واتساپ"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <ValidationProvider rules="min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="linkedin"
                  label="لینک لینکدین"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <ValidationProvider rules="min:3" v-slot="{ errors }">
              <v-file-input
                placeholder="اپلود لوگو سایت"
                @change="Preview_image"
                :error-messages="errors"
              >
              </v-file-input>
              </ValidationProvider>
              <v-img :src="url" class="mb-4 rounded-circle" width="150"></v-img>
            </v-col>
            <v-col cols="12" md="8">
              <ValidationProvider rules="min:3" v-slot="{ errors }">
              <v-text-field
                v-model="title"
                label="عنوان سایت"
                filled
                :error-messages="errors"
              ></v-text-field>
              </ValidationProvider>

              <ValidationProvider rules="min:3" v-slot="{ errors }">
              <v-text-field
                v-model="address"
                label="آدرس سایت"
                filled
                :error-messages="errors"
              ></v-text-field>
              </ValidationProvider>
              <ValidationProvider rules="email|min:3" v-slot="{ errors }">
              <v-text-field
                v-model="email"
                label="ایمیل سایت"
                filled
                :error-messages="errors"
              ></v-text-field>
              </ValidationProvider>

              <ValidationProvider rules="min:3" v-slot="{ errors }">
              <v-text-field
                v-model="phone_number_1"
                label="شماره تماس 1"
                filled
                :error-messages="errors"
              ></v-text-field>
              </ValidationProvider>
              <ValidationProvider rules="min:3" v-slot="{ errors }">
              <v-text-field
                v-model="phone_number_2"
                label="شماره تماس 2"
                filled
                :error-messages="errors"
              ></v-text-field>
              </ValidationProvider>
            </v-col>
          </v-row>
          <v-row justify="center" class="my-4">
            <v-btn
              color="success"
              class="mr-4"
              :disabled="invalid"
              @click="saveSetting"
            >
              ذخیره کردن
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
    valid: true,
    linkedin: "",
    telegram: "",
    facebook: "",
    instagram: "",
    whatsapp: "",
    title: "",
    email: "",
    address: "",
    phone_number_1: "",
    phone_number_2: "",
    image: null,
    url: "",
    rules: [
      (value) =>
        !value ||
        value.size < 1000000 ||
        "سایز اپلود بید کمتر از 1 مگابایت باشد"
    ],
  }),
  created() {
    this.getSiteSetting();
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

    async getSiteSetting() {
      let token = localStorage.getItem("adminToken");
      await axios
        .get(`/api/getSiteSetting`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let setting = response.data.setting;
          this.title = setting.title;
          this.address = setting.address;
          this.email = setting.email;
          this.phone_number_1 = setting.phone_number_1;
          this.phone_number_2 = setting.phone_number_2;
          this.instagram = setting.instagram;
          this.facebook = setting.facebook;
          this.linkedin = setting.linkedin;
          this.telegram = setting.telegram;
          this.whatsapp = setting.whatsapp;
          this.url = setting.logo;
        })
        .catch((error) => {});
    },
    saveSetting() {
      let token = localStorage.getItem("adminToken");

      axios
        .post(
          `/api/saveSiteSetting`,
          {
            title: this.title,
            address: this.address,
            email: this.email,
            phone_number_1: this.phone_number_1,
            phone_number_2: this.phone_number_2,
            facebook: this.facebook,
            instagram: this.instagram,
            whatsapp: this.whatsapp,
            telegram: this.telegram,
            linkedin: this.linkedin,
            logo: this.image,
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
          alerts.errorAlert("تنظیمات ذخیره نشد");
        });
    },
  },
};
</script>
