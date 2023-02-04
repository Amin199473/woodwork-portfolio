<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar dark color="primary">
            <v-toolbar-title> فرم ورود</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-text-field
              v-model="email"
              name="email"
              label="ایمیل"
              type="text"
              placeholder="ایمیل"
            ></v-text-field>

            <v-text-field
              v-model="password"
              name="password"
              label="پسورد"
              type="password"
              placeholder="پسورد"
            ></v-text-field>
            <v-btn
              @click="login"
              type="submit"
              class="mt-4"
              color="primary"
              value="log in"
              >ورود</v-btn
            >
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    login() {
      this.$store.dispatch("adminAuth/adminLogin", {
        email: this.email,
        password: this.password,
      });
    },
  },
};
</script>
