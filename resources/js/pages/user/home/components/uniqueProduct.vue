<template>
  <div>
    <v-container style="margin-top: 100px">
      <p class="title text-uppercase text-center text-h3">محصولات منحصر بفرد</p>
      <v-tabs color="brown darken-1 accent-4" right>
        <v-tab v-for="category in categories" :key="category.id">{{
          category
        }}</v-tab>
        <v-tab-item v-for="n in 3" :key="n">
          <v-container class="container-bg">
            <template>
              <v-row>
                <v-col
                  v-for="project in projects"
                  :key="project.id"
                  cols="12"
                  sm="6"
                  md="3"
                  lg="3"
                >
                  <v-hover v-slot="{ hover }">
                    <router-link
                      class="a-style"
                      :to="{
                        name: 'projectDetails',
                        params: { id: project.id },
                      }"
                      ><v-card
                        :elevation="hover ? 12 : 2"
                        :class="{ 'on-hover': hover }"
                        class="rounded-xl"
                      >
                        <v-img :src="project.img" height="225px">
                          <v-card-title class="text-h6 white--text">
                            <v-row
                              class="fill-height flex-column"
                              justify="space-between"
                            >
                            </v-row>
                          </v-card-title>
                        </v-img>
                        <v-card-actions> </v-card-actions>
                        <p class="p-hover text-h5 pb-4 text-center black--text">
                          {{ project.name }}
                          <v-rating
                            background-color="warning lighten-1"
                            color="warning"
                            half-increments
                            length="5"
                            size="20"
                            :value="value"
                            hover
                          ></v-rating>
                        </p>
                      </v-card>
                    </router-link>
                  </v-hover>
                </v-col>
              </v-row>
            </template>
          </v-container>
        </v-tab-item>
      </v-tabs>
    </v-container>
    <v-container>
      <v-row justify="center">
        <router-link to="projects" class="a-style">
          <v-btn
            class="btn-viewAll d-flex justify-center mb-4"
            elevation="24"
            large
            x-large
            x-small
          >
            نمایش همه پروژه ها
          </v-btn>
        </router-link>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  created() {
    this.getProjectGalleries();
  },
  data: () => ({
    value: 3,
    icons: ["mdi-heart", "mdi-cart"],
    items: [
      {
        title: "New Releases",
        text: `It's New Release Friday`,
        subtext: "Newly released songs. Updated daily.",
        img: "https://images.unsplash.com/photo-1429514513361-8fa32282fd5f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3264&q=80",
      },
      {
        title: "Rock",
        text: "Greatest Rock Hits",
        subtext: "Lose yourself in rock tunes.",
        img: "https://images.unsplash.com/photo-1498038432885-c6f3f1b912ee?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80",
      },
      {
        title: "Mellow Moods",
        text: "Ambient Bass",
        subtext: "Chill beats to mellow you out.",
        img: "https://images.unsplash.com/photo-1542320868-f4d80389e1c4?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=3750&q=80",
      },
    ],
    transparent: "rgba(255, 255, 255, 0)",
    categories: [],
    projects: [],
    projectGalleries: [],
  }),
  methods: {
    async getProjectGalleries() {
      await axios
        .get(`/api/getProjectGalleries`, {})
        .then((response) => {
          response.data.projectGalleries.map((category) => {
            this.categories.push(category.name);

            category.projects.map((project) => {
              this.projects.push({
                id: project.id,
                name: project.name,
                img: project.galleries[0].image,
              });
            });
          });
        })
        .catch((error) => {});
    },
  },
};
</script>


<style scoped>
.title {
  color: #c08c4d;
}
.btn-viewAll {
  background-color: black !important;
  color: antiquewhite !important;
  transition: background-color 0.6s;
}
.btn-viewAll:hover {
  background-color: #c08c4d !important;
}
.container-bg {
  background-color: rgb(235 230 231 / 88%) !important;
}
.v-card {
  transition: opacity 0.4s ease-in-out;
}
.v-card:not(.on-hover) {
  opacity: 0.6;
}
.show-btns {
  color: rgba(255, 255, 255, 1) !important;
}
.theme--light.v-tabs > .v-tabs-bar {
  background-color: rgb(235 230 231 / 88%) !important;
}
.p-hover:hover {
  color: #c08c4d !important;
}
.a-style {
  text-decoration: none;
}
</style>
