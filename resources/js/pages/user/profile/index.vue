<template>
  <div>
    <v-container class="py-16">
      <v-row>
        <v-col cols="12" md="4">
          <v-card class="mx-auto" width="300" tile>
            <v-list>
              <v-list-item>
                <v-row justify="center" class="my-4">
                  <v-avatar width="80" height="80" class="text-center mx-auto">
                    <v-img
                      class="rounded-circle"
                      :alt="name"
                      :src="avatar"
                    ></v-img>
                  </v-avatar>
                </v-row>
              </v-list-item>

              <v-list-item link>
                <v-list-item-content>
                  <v-list-item-title class="text-h6">
                    صنایع چوب نارگل
                  </v-list-item-title>
                  <v-list-item-subtitle
                    >nargolwood@gmail.com</v-list-item-subtitle
                  >
                </v-list-item-content>

                <v-list-item-action>
                  <v-icon>mdi-menu-down</v-icon>
                </v-list-item-action>
              </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list nav dense>
              <v-list-item-group v-model="selectedItem" color="primary">
                <v-list-item v-for="(item, i) in items" :key="i">
                  <v-list-item-icon>
                    <v-icon v-text="item.icon"></v-icon>
                  </v-list-item-icon>

                  <v-list-item-content>
                    <v-list-item-title
                      v-text="item.text"
                      @click="getComponet(item.component)"
                    >
                    </v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-card>
        </v-col>
        <v-col cols="12" md="8">
          <component :is="component"> </component>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>


<script>
import Info from "./components/info.vue";
import Ticket from "./components/ticket.vue";
import MyTicket from "./components/MyTicket.vue";
export default {
  components: {
    Info,
    Ticket,
    MyTicket,
  },
  created() {
    this.getUserDetail();
  },
  data: () => ({
    selectedItem: 0,
    avatar: null,
    name:"",
    component: "",
    items: [
      {
        text: "اطلاعات من",
        icon: "mdi-information",
        component: "Info",
      },
      {
        text: "تیکت",
        icon: "mdi-ticket",
        component: "Ticket",
      }, {
        text: "تیکت های من",
        icon: "mdi-ticket-account",
        component: "MyTicket",
      },
      { text: "نظرات", icon: "mdi-star", component: "" },
    ],
  }),
  methods: {
    getUserDetail() {
      let token = localStorage.getItem("userToken");
      axios
        .get(`/api/user/detail`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          let user = response.data;
          this.avatar = user.avatar;
          this.name = user.name;
        })
        .catch((error) => {});
    },
    getComponet(component) {
      return (this.component = component);
    },
  },
};
</script>


<style scoped>
</style>
