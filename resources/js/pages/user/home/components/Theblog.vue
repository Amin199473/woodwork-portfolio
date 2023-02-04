<template>
  <v-container style="margin-top: 150px">
    <v-row>
      <v-col cols="12" md="12">
        <p class="text-uppercase p-title text-center text-h6">الهام و بینش</p>
        <p class="text-h3 text-center">به مقالات عالی ما نگاهی بیندازید</p>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" md="4" v-for="post in posts" :key="post.id"
        ><v-card :loading="loading" class="mx-auto my-12" max-width="450">
          <template slot="progress">
            <v-progress-linear
              color="deep-purple"
              height="10"
              indeterminate
            ></v-progress-linear>
          </template>

          <v-img height="250" :src="post.image"></v-img>
          <p class="text-right text-h5 font-weight-bold pr-4 pt-4">
            {{ post.title }}
          </p>
          <v-card-text>
            <div>
              <p v-html="post.body.substring(0, 300)">....</p>
            </div>
          </v-card-text>

          <v-divider class="mx-4"></v-divider>

          <v-container>
            <v-row>
              <v-col cols="12" md="4">
                <v-icon large color="orange accent-1">
                  mdi-account-circle-outline
                </v-icon>
                <p class="d-inline">{{ post.author.name }}</p>
              </v-col>
              <v-col cols="12" md="8">
                <v-icon large color="orange accent-1">
                  mdi-calendar-month-outline
                </v-icon>
                <p class="d-inline">
                  {{ new Date(post.created_at).toLocaleDateString("fa-IR") }}
                </p>
              </v-col>
            </v-row>
          </v-container>

          <v-card-text>
            <v-chip-group
              v-model="selection"
              active-class="deep-purple accent-4 white--text"
              column
            >
            </v-chip-group>
          </v-card-text>

          <v-card-actions>
            <router-link
              style="text-decoration: none; color: white"
              :to="{
                name: 'postDetail',
                params: { slug: post.slug, id: post.id },
              }"
            >
              <v-btn class="btn-readMore" text> بیشتر بخوانید </v-btn>
            </router-link>
          </v-card-actions>
        </v-card></v-col
      >
    </v-row>
  </v-container>
</template>

<script>
export default {
  created() {
    this.getPosts();
  },
  data() {
    return {
      loading: false,
      selection: 1,
      posts: [],
    };
  },
  methods: {
    getPosts() {
      axios
        .get(`/api/post`)
        .then((result) => {
          this.posts = result.data.posts;
          console.log(this.posts);
        })
        .catch((err) => {});
    },
  },
};
</script>

<style scoped>
.p-title {
  color: rgb(184, 134, 77);
}
.btn-readMore {
  background-color: black !important;
  color: antiquewhite !important;
  transition: background-color 1s;
}
.btn-readMore:hover {
  background-color: #c08c4d !important;
}
</style>
