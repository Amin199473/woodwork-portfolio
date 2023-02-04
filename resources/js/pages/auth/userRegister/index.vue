<template>
  <ValidationObserver ref="observer" v-slot="{ invalid }">
    <v-container fluid fill-height class="pa-16 bg-img">
      <v-layout align-center justify-center>
        <v-flex xs12 sm8 md6 lg6>
          <v-card class="elevation-12">
            <v-toolbar dark color="primary">
              <v-toolbar-title> فرم ثبت نام</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  v-model.trim="name"
                  name="name"
                  label="نام"
                  type="text"
                  placeholder="نام"
                  reverse
                  :error-messages="errors"
                  required
                ></v-text-field>
              </ValidationProvider>

              <ValidationProvider rules="required|email" v-slot="{ errors }">
                <v-text-field
                  v-model.trim="email"
                  name="email"
                  label="ایمیل"
                  type="text"
                  placeholder="ایمیل"
                  :error-messages="errors"
                  reverse
                ></v-text-field>
              </ValidationProvider>
              
              <ValidationProvider
                rules="required|min:6|confirmed:password_confirmation"
                v-slot="{ errors }"
              >
                <v-text-field
                  v-model.trim="password"
                  name="password"
                  label="پسورد"
                  type="password"
                  placeholder="پسورد"
                  reverse
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>

              <ValidationProvider
                v-slot="{ errors }"
                vid="password_confirmation"
              >
                <v-text-field
                  v-model.trim="password_confirmation"
                  name="password"
                  label="تایید پسورد"
                  type="password"
                  placeholder="تایید پسورد"
                  reverse
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>

              <v-btn
                @click="register"
                type="submit"
                class="mt-4"
                color="primary"
                value="log in"
                reverse
                :disabled="invalid"
              >
                ثبت نام
              </v-btn>
              <p class="text-right text-h6">
                قبلا ثبت نام کرده اید؟
                <router-link class="a-style" to="/user/login">
                  وارد شوید
                </router-link>
              </p>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </ValidationObserver>
</template>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
import ValidateRules from "../../../shared/validations/validateRules.js";
export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  name: "register",
  data() {
    return {
      valid: false,
      name: "",
      email: "",
      password: null,
      password_confirmation: null,
    };
  },
  methods: {
    register() {
      this.$store.dispatch("userAuth/userRegister", {
        email: this.email,
        name: this.name,
        password: this.password,
        password_confirmation: this.password_confirmation,
      });
    },
    submit() {
      this.$refs.observer.validate();
    },
  },
};
</script>

<style scoped>
.bg-img {
  background-image: url("../../../assets/images/about_01.webp");
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.a-style {
  text-decoration: none;
  color: blue;
}
</style>
