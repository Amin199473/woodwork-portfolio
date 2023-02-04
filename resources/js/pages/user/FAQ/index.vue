<template>
  <div style="background-color: rgb(235 230 231 / 88%)">
    <Parallax />
    <v-container class="mt-16">
      <p class="text-center text-h4" style="color: #c08c4d">FQA</p>
      <v-row>
        <v-col cols="12">
          <v-list style="background-color: rgb(235 230 231 / 88%)">
            <v-list-group
              style="background-color: #c08c4d"
              v-for="item in items"
              :key="item.title"
              v-model="item.active"
              :prepend-icon="item.active ? 'mdi-minus' : 'mdi-plus'"
              no-action
              class="rounded-l mb-4"
            >
              <template v-slot:activator>
                <v-list-item-content class="pl-4 white--text">
                  <v-list-item-title v-text="item.title"></v-list-item-title>
                </v-list-item-content>
              </template>

              <v-list-item
                class="white"
                v-for="child in item.items"
                :key="child.title"
              >
                <v-list-item-content>
                  <v-list-item-title v-text="child.title"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-group>
          </v-list>
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
  data() {
    return {
      items: [
        {
          active: true,
          items: [{ title: "List Item" }],
          title: "Attractions",
        },
        {
          items: [{ title: "Breakfast & brunch" }],
          title: "Dining",
        },
        {
          items: [{ title: "List Item" }],
          title: "Education",
        },
        {
          items: [{ title: "List Item" }],
          title: "Family",
        },
        {
          items: [{ title: "List Item" }],
          title: "Health",
        },
        {
          items: [{ title: "List Item" }],
          title: "Office",
        },
        {
          items: [{ title: "List Item" }],
          title: "Promotions",
        },
      ],
    };
  },
};
</script>

<style scoped>
</style>
