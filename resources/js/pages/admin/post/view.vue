<template>
  <div>
    <v-container>
      <v-card class="mx-auto my-12" max-width="1000">
        <template slot="progress">
          <v-progress-linear
            color="deep-purple"
            height="10"
            indeterminate
          ></v-progress-linear>
        </template>

        <v-img height="500" aspect-ratio="1.7" :src="image"></v-img>

        <v-card-title>{{ title }}</v-card-title>

        <v-card-text>
          <div class="font-weight-bold" v-html="body"></div>
        </v-card-text>

        <v-divider class="mx-4"></v-divider>

        <v-card-title>تگ ها</v-card-title>

        <v-card-text>
          <v-chip-group active-class="deep-purple accent-4 white--text" column>
            <v-chip v-for="tag in tags" :key="tag.id">{{ tag.name }}</v-chip>
          </v-chip-group>
        </v-card-text>

        <v-card-title>کلمات کلیدی</v-card-title>
        <v-card-text>
          <v-chip-group active-class="deep-purple accent-4 white--text" column>
            <v-chip v-for="(item, index) in meta_keywords" :key="index" >{{ item }}</v-chip>
          </v-chip-group>
        </v-card-text>

        <v-card-title>توضیحات متا</v-card-title>
        <v-card-text>
          <v-chip-group active-class="deep-purple accent-4 white--text" column>
            <v-chip >{{ meta_description }}</v-chip>
          </v-chip-group>
        </v-card-text>

        <v-card-title>عنوان سئو</v-card-title>
        <v-card-text>
          <v-chip-group active-class="deep-purple accent-4 white--text" column>
            <v-chip >{{ meta_description }}</v-chip>
          </v-chip-group>
        </v-card-text>
      </v-card>
    </v-container>
  </div>
</template>

<script>
export default {
  created() {
    this.getPost();
  },
  data() {
    return {
      title: "",
      image: "",
      category: "",
      fearuted: 0,
      isImportant: 0,
      status: 0,
      tags: [],
      meta_description: "",
      seo_title: "",
      meta_keywords: [],
      body: "",
    };
  },
  methods: {
    async getPost() {
      let id = this.$route.params.id;
      let token = localStorage.getItem("adminToken");
      axios
        .get(`/api/post/${id}`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let result = response.data.post;

          console.log(response.data.post);

          this.title = result.title;
          this.body = result.body;
          this.seo_title = result.seo_title;
          this.meta_description = result.meta_description;
          this.meta_keywords = result.meta_keywords.split(",");
          result.tags.map((tag) => {
            this.tags.push({
              id: tag.id,
              name: tag.name,
            });
          });
          this.status = result.status;
          this.isImportant = result.isImportant;
          this.featured = result.featured;
          this.category_id = result.category_id;
          this.image = result.image;
        })
        .catch((error) => {
          //   alerts.errorAlert("پست با موفقیت ذخیره نشد");
        });
    },
  },
};
</script>
