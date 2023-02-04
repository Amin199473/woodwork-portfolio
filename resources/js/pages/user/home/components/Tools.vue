<template>
  <div>
    <v-container style="margin-top: 100px">
      <p
        class="text-h3 text-uppercase text-center mb-10 p-tools-title"
        color="red"
      >
        ابزارهایی که ما استفاده میکنیم
      </p>
      <v-row>
        <v-col cols="6" sm="6" md="3" lg="3">
          <v-img
            :src="require('../../../../assets/images/shop002_2000x.webp')"
          ></v-img>
          <p class="p-tools">الوار چوب</p>
        </v-col>
        <v-col cols="6" sm="6" md="3" lg="3">
          <v-img
            :src="require('../../../../assets/images/shop003_1_600x.webp')"
          ></v-img>
          <p class="p-tools">مته برقی</p>
        </v-col>
        <v-col cols="6" sm="6" md="3" lg="3">
          <v-img
            :src="require('../../../../assets/images/shop01_2000x.webp')"
          ></v-img>
          <p class="p-tools">ابزار پلانکینگ</p>
        </v-col>
        <v-col cols="6" sm="6" md="3" lg="3">
          <v-img
            :src="require('../../../../assets/images/shop02_600x.webp')"
          ></v-img>
          <p class="p-tools">متر اندازه گیری</p>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="6" sm="6" md="3" lg="3">
          <v-img
            :src="require('../../../../assets/images/shop04_600x.webp')"
          ></v-img>
          <p class="p-tools">مته برای وودلند</p>
        </v-col>
        <v-col cols="6" sm="6" md="3" lg="3">
          <v-img
            :src="require('../../../../assets/images/shop05_600x.webp')"
          ></v-img>
          <p class="p-tools">کادر بندی مربع</p>
        </v-col>
        <v-col cols="6" sm="6" md="3" lg="3">
          <v-img
            :src="require('../../../../assets/images/shop08_2000x.webp')"
          ></v-img>
          <p class="p-tools"> چکش چوبی </p>
        </v-col>
        <v-col cols="6" sm="6" md="3" lg="3">
          <v-img
            :src="require('../../../../assets/images/shop03_600x.webp')"
          ></v-img>
          <p class="p-tools"> دستکش نجار </p>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.p-tools-title {
  color: rgb(184, 134, 77);
}
.p-tools {
  text-align: center;
  font-size: 30px;
  font-weight: 500;
  margin-top: 15px;
}
</style>
