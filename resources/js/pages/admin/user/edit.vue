<template>
  <div>
    <h1 class="subheading grey--text ma-4">ویرایش کاربر</h1>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="6">
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  label="نام کاربری"
                  placeholder="نام کار بری"
                  filled
                  v-model="name"
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
            </v-col>
            <v-col cols="12" md="6">
              <ValidationProvider rules="required|email" v-slot="{ errors }">
                <v-text-field
                  label="ایمیل"
                  placeholder="ایمیل"
                  filled
                  v-model="email"
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="4"
              ><v-select
                :items="items"
                label="جنسیت"
                filled
                v-model="gender"
              ></v-select
            ></v-col>
            <v-col cols="12" md="4">
              <ValidationProvider rules="numeric" v-slot="{ errors }">
                <v-text-field
                  label="سن"
                  placeholder="سن"
                  filled
                  v-model="age"
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
            </v-col>
            <v-col cols="12" md="4">
              <ValidationProvider rules="numeric" v-slot="{ errors }">
                <v-text-field
                  label="موبایل"
                  placeholder="موبایل"
                  filled
                  v-model="mobile"
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="4">
              <v-text-field
                label="تاریخ تولد"
                placeholder="تاریخ تولد"
                filled
                v-model="birthDate"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="4">
              <ValidationProvider v-slot="{ errors }">
                <v-file-input
                  v-model="avatar"
                  label="آواتار"
                  filled
                  prepend-icon="mdi-account"
                  @change="Preview_image"
                  :error-messages="errors"
                  :rules="imgValidate"
                ></v-file-input>
              </ValidationProvider>
            </v-col>
            <v-col cols="12" md="4">
              <v-img
                :src="url"
                class="mb-4 rounded-circle"
                width="100"
                height="100"
              ></v-img>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="6">
              <ValidationProvider
                rules="required|min:6|confirmed:password_confirmation"
                v-slot="{ errors }"
              >
                <v-text-field
                  filled
                  v-model.trim="password"
                  name="password"
                  label="پسورد"
                  type="password"
                  placeholder="پسورد"
                  reverse
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
            </v-col>
            <v-col cols="12" md="6">
              <ValidationProvider
                v-slot="{ errors }"
                vid="password_confirmation"
              >
                <v-text-field
                  filled
                  v-model.trim="password_confirmation"
                  name="password"
                  label="تایید پسورد"
                  type="password"
                  placeholder="تایید پسورد"
                  reverse
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="address"
                label="آدرس"
                placeholder="ادرس"
                filled
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12">
              <v-textarea
                v-model="bio"
                filled
                name="input-7-4"
                label="بیوگرافی"
              ></v-textarea>
            </v-col>
          </v-row>
          <v-row justify="center" class="my-4">
            <v-btn
              color="success"
              :disabled="invalid"
              class="mr-4"
              @click="editUser"
            >
              ویرایش
            </v-btn>

            <v-btn color="warning" @click="reset" class="mr-4">
              پاک کردن
            </v-btn>
            <router-link class="a-style" to="/dashboard/user">
              <v-btn color="purple" class="white--text"> مرحله قبل </v-btn>
            </router-link>
          </v-row>
        </v-form>
      </v-container>
    </ValidationObserver>
  </div>
</template>

<script>
import alerts from "../../../shared/alerts/index.js";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import ValidateRules from "../../../shared/validations/validateRules.js";

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  created() {
    this.getUser();
  },
  data: () => ({
    valid: true,
    items: ["آقا", "خانم", "دیگر"],
    url: null,
    avatar: null,
    userId: "",
    name: "",
    email: "",
    gender: "",
    age: "",
    mobile: "",
    birthDate: "",
    address: "",
    bio: "",
    password: "",
    password_confirmation: "",
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
    async getUser() {
      let id = this.$route.params.id;
      let token = localStorage.getItem("adminToken");
      axios
        .get(`/api/getUser/${id}`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let user = response.data.user;
          console.log(user);
          this.userId = user.id;
          this.name = user.name;
          this.email = user.email;
          this.address = user.address;
          this.age = user.age;
          this.gender = user.gender;
          this.mobile = user.mobile;
          this.birthDate = user.birthDate;
          this.url = user.avatar;
          this.bio = user.bio;
        })
        .catch((error) => {});
    },
    async editUser() {
      let id = this.$route.params.id;
      let token = localStorage.getItem("adminToken");

      await axios
        .post(
          `/api/user/updateByAdmin/${id}`,
          {
            name: this.name,
            email: this.email,
            age: this.age,
            address: this.address,
            avatar: this.avatar,
            bio: this.bio,
            birthDate: this.birthDate,
            gender: this.gender,
            mobile: this.mobile,
            password_confirmation: this.password_confirmation,
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
          alerts.errorAlert("ویرایش انجام نشد");
        });
    },
  },
};
</script>
