<template>
  <v-container>
    <v-card class="mx-auto" max-width="500">
      <v-img :src="avatar" height="300"></v-img>

      <v-card-title> {{ name }} </v-card-title>

      <v-card-actions>
        <v-btn color="orange lighten-2" text> بیوگرافی </v-btn>

        <v-spacer></v-spacer>

        <v-btn icon @click="show = !show">
          <v-icon>{{ show ? "mdi-chevron-up" : "mdi-chevron-down" }}</v-icon>
        </v-btn>
      </v-card-actions>

      <v-expand-transition>
        <div v-show="show">
          <v-divider></v-divider>

          <v-card-text>
            <div v-html="bio"></div>
          </v-card-text>
        </div>
      </v-expand-transition>
    </v-card>
  </v-container>
</template>

<script>
export default {
  created() {
    this.getMember();
  },
  data() {
    return {
      show: false,
      name: "",
      bio: "",
      avatar: "",
    };
  },
  methods: {
    getMember() {
      let token = localStorage.getItem("adminToken");
      let id = this.$route.params.id;
      axios
        .get(`/api/member/${id}`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let result = response.data.member;
          console.log(result);
          this.name = result.name;
          this.bio = result.bio;
          this.avatar = result.avatar;
        })
        .catch((error) => {});
    },
  },
};
</script>
