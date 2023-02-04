<template>
  <div class="bg">
    <Parallax />
    <v-container style="margin-top: 100px">
      <v-row>
        <v-col cols="12" md="4">
          <p class="text-h4 p-title">دسته بندی ها</p>
          <v-divider class="divider"></v-divider>
          <v-list style="background-color: rgb(235 230 231 / 88%)">
            <v-list-group
              style="background-color: #c08c4d"
              v-for="category in categories"
              :key="category.name"
              v-model="category.active"
              :prepend-icon="category.active ? 'mdi-minus' : 'mdi-plus'"
              no-action
              class="rounded-l mb-4"
            >
              <template v-slot:activator>
                <v-list-item-content class="pl-4 white--text">
                  <v-list-item-title v-text="category.name"></v-list-item-title>
                </v-list-item-content>
              </template>

              <v-list-item
                class="white"
                v-for="project in category.projects"
                :key="project.title"
              >
                <v-list-item-content>
                  <router-link
                    class="a-style black--text"
                    :to="{
                      name: 'projectDetails',
                      params: { id: project.id },
                    }"
                  >
                    <v-list-item-title v-text="project.name"></v-list-item-title
                  ></router-link>
                </v-list-item-content>
              </v-list-item>
            </v-list-group>
          </v-list>
          <p class="text-h4 p-title mt-16">محصولاتی دیگر</p>
          <v-card>
            <v-carousel
              :continuous="false"
              :cycle="cycle"
              :show-arrows="true"
              delimiter-icon="mdi-minus"
              height="350"
            >
              <v-carousel-item v-for="(item, i) in randProject" :key="i">
                <v-img :src="item.galleries[0].image" height="350"> </v-img>
              </v-carousel-item>
            </v-carousel>
          </v-card>
        </v-col>
        <v-col cols="12" md="8">
          <v-row class="fill-height" align="center" justify="center">
            <template v-for="(project, i) in projects">
              <v-col :key="i" cols="3" md="4">
                <v-hover v-slot="{ hover }">
                  <v-card
                    :elevation="hover ? 12 : 2"
                    :class="{ 'on-hover': hover }"
                  >
                    <v-img :src="project.galleries[0].image" height="250">
                      <v-expand-transition>
                        <div
                          v-if="hover"
                          class="
                            d-flex
                            transition-fast-in-fast-out
                            darken-2
                            v-card--reveal
                            text-h2
                            white--text
                          "
                          style="height: 100%"
                        ></div>
                      </v-expand-transition>
                    </v-img>
                  </v-card>
                </v-hover>
              </v-col>
            </template>
          </v-row>
          <div class="text-center">
            <v-pagination
              v-model="pagination.current"
              :length="pagination.total"
              @input="onPageChange"
            ></v-pagination>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import Parallax from "../sharedComponets/TheParallax.vue";
export default {
  components: {
    Parallax,
  },

  created() {
    this.projectPaginate();
    this.getPojectCategories();
    this.getRandProjects();
  },
  data() {
    return {
      pagination: {
        current: 1,
        total: 0,
      },
      projects: [],
      categories: [],
      colors: [
        "green",
        "secondary",
        "yellow darken-4",
        "red lighten-2",
        "orange darken-1",
      ],
      cycle: true,
      randProject: [],
    };
  },
  methods: {
    async projectPaginate() {
      await axios
        .get(`/api/project?page=${this.pagination.current}`)
        .then((response) => {
          let result = response.data.projects;
          console.log(result);
          this.projects = result.data;
          this.pagination.current = result.current_page;
          this.pagination.total = result.last_page;
        })
        .catch((err) => {});
    },
    onPageChange() {
      this.projectPaginate();
    },
    async getPojectCategories() {
      await axios
        .get(`/api/projectCategories`)
        .then((response) => {
          this.categories = response.data.categories;
          console.log(result);
        })
        .catch((err) => {});
    },
    async getRandProjects() {
      await axios
        .get(`/api/getRandProject`)
        .then((response) => {
          this.randProject = response.data.randProject;
          console.log(result);
        })
        .catch((err) => {});
    },
  },
};
</script>


<style scoped>
.p-title {
  color: #c08c4d;
}
.divider {
  border-width: 1px !important;
  border-color: black !important;
  background-color: black;
}
.bg {
  background-color: rgb(235 230 231 / 88%);
}
.v-card {
  transition: 0.4s ease-in-out;
}
.v-card:not(.on-hover) {
  background: #000;
}
.on-hover:hover {
  scale: 1.1;
  transition: 1s;
}
</style>
