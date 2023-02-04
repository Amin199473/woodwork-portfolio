<template>
  <div class="team">
    <h1 class="subheading grey--text">داشبورد</h1>
    <v-container>
      <v-layout row wrap>
        <v-flex sm6 xs12 md6 lg3>
          <v-card class="ma-3">
            <v-list-item>
              <v-list-item-avatar tile class="mt-n7">
                <v-sheet color="green" width="80" height="80" elevation="10">
                  <v-icon dark>mdi-account</v-icon>
                </v-sheet>
              </v-list-item-avatar>
              <v-list-item-content>
                <div class="overline text-right">کاربران</div>
                <v-list-item-title class="headline mb-1 text-right"
                  >523614</v-list-item-title
                >
              </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>
            <v-card-actions>
              <v-icon text class="ma-2">mdi-account-badge</v-icon>
              <div class="overline">Iyad</div>
            </v-card-actions>
          </v-card>
        </v-flex>
        <v-flex sm6 xs12 md6 lg3>
          <v-card class="ma-3">
            <v-list-item>
              <v-list-item-avatar tile class="mt-n7">
                <v-sheet color="#F44336" width="80" height="80" elevation="10">
                  <v-icon dark>mdi-youtube-subscription</v-icon>
                </v-sheet>
              </v-list-item-avatar>
              <v-list-item-content>
                <div class="overline text-right"> مقالات </div>
                <v-list-item-title class="headline mb-1 text-right"
                  >+700</v-list-item-title
                >
              </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>
            <v-card-actions>
              <v-icon text class="ma-2">mdi-youtube-subscription</v-icon>
            </v-card-actions>
          </v-card>
        </v-flex>
        <v-flex sm6 xs12 md6 lg3>
          <v-card class="ma-3">
            <v-list-item>
              <v-list-item-avatar tile class="mt-n7">
                <v-sheet color="#03A9F4" width="80" height="80" elevation="10">
                  <v-icon dark>mdi-cart</v-icon>
                </v-sheet>
              </v-list-item-avatar>
              <v-list-item-content>
                <div class="overline text-right">سفارشات</div>
                <v-list-item-title class="headline mb-1 text-right"
                  >$34,245</v-list-item-title
                >
              </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>
            <v-card-actions>
              <v-icon text class="ma-2">mdi-cart</v-icon>
            </v-card-actions>
          </v-card>
        </v-flex>
        <v-flex sm6 xs12 md6 lg3>
          <v-card class="ma-3">
            <v-list-item>
              <v-list-item-avatar tile class="mt-n7">
                <v-sheet color="#FFC107" width="80" height="80" elevation="10">
                  <v-icon dark>mdi-folder-account</v-icon>
                </v-sheet>
              </v-list-item-avatar>
              <v-list-item-content>
                <div class="overline text-right"> پروژه ها </div>
                <v-list-item-title class="headline mb-1 text-right"
                  >1730</v-list-item-title
                >
              </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>
            <v-card-actions>
              <v-icon text class="ma-2">mdi-folder-account</v-icon>
            </v-card-actions>
          </v-card>
        </v-flex>
        <v-flex xs12 sm6 md4 lg3 v-for="person in team" :key="person.name">
          <v-card class="text-center ma-3">
            <v-responsive class="pt-4">
              <v-avatar size="100" class="red lighten-2">
                <img :src="person.avatar" alt="" />
              </v-avatar>
            </v-responsive>
            <v-card-text>
              <div class="subheading">{{ person.name }}</div>
              <div class="grey--text">{{ person.role }}</div>
            </v-card-text>
            <v-card-actions>
              <v-btn outlined color="orange">
                <v-icon small left>mdi-message-bulleted</v-icon>
                <span>Message</span>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
// @ is an alias to /src
export default {
  name: "team",
  components: {},
  data: () => ({
    team: [
      { name: "Iyad", role: "web developer", avatar: "images/img1.png" },
      { name: "Reda", role: "Graphic designer", avatar: "images/img2.png" },
      { name: "Zineb", role: "web developer", avatar: "images/img3.png" },
      { name: "Hu TechGroup", role: "Desktop developer", avatar: "images/img4.png" },
    ],
  }),
};
</script>
