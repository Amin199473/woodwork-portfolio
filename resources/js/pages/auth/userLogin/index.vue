<template>
  <ValidationObserver ref="observer" v-slot="{ invalid }">
    <v-container fluid fill-height class="pa-16 bg-img">
      <v-layout align-center justify-center>
        <v-flex xs12 sm8 md6 lg6>
          <v-card class="elevation-12">
            <v-toolbar dark color="primary">
              <v-toolbar-title> فرم ورود</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <ValidationProvider rules="required|email" v-slot="{ errors }">
                <v-text-field
                  v-model.trim="email"
                  name="email"
                  label="ایمیل"
                  type="text"
                  placeholder="ایمیل"
                  reverse
                  :error-messages="errors"
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
                @click="login"
                type="submit"
                class="mt-4"
                color="primary"
                value="log in"
                :disabled="invalid"
                >ورود</v-btn
              >
              <p class="text-right text-h6">
                تاکنون ثبت نام نکرده اید؟
                <router-link class="a-style" to="/user/register">
                  ثبت نام کنید
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
  name: "Login",
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  data() {
    return {
      email: "",
      password: null,
      password_confirmation: null,
    };
  },
  methods: {
    login() {
      this.$store.dispatch("userAuth/userLogin", {
        email: this.email,
        password: this.password,
      });
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
