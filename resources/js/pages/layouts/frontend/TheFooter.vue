<template>
  <div style="background-color: rgb(235 230 231 / 88%); padding-top: 130px">
    <v-container>
      <v-row>
        <v-col cols="12" sm="12" md="3" lg="3">
          <router-link class="anchor-style" to="/"><p>صفحه نخست</p></router-link>
          <router-link class="anchor-style" to="/blog"><p>وبلاگ</p></router-link>
          <router-link class="anchor-style" to="/contactUs"><p>تماس با ما </p></router-link>
          <router-link class="anchor-style" to="/aboutUs"><p>درباره ما</p></router-link>
        </v-col>
        <v-col cols="12" sm="12" md="3" lg="3">
          <router-link class="anchor-style" to="/user/register"><p>ورود/ثبت نام</p></router-link>
          <router-link class="anchor-style" to="/"><p>اعضای تیم</p></router-link>
          <router-link class="anchor-style" to="/FAQ"><p>سوالات متداول</p></router-link>
          <router-link class="anchor-style" to="/projects"><p> محصولات </p></router-link>
        </v-col>
        <v-col cols="12" sm="12" md="3" lg="3">
          <div class="icon d-inline">
            <i class="fa fa-instagram" aria-hidden="true"></i>
            <i class="fa fa-whatsapp" aria-hidden="true"></i>
            <i class="fa fa-telegram" aria-hidden="true"></i>
          </div>

          <div class="d-flex flex-column mb-4">
            <div style="margin-top: 40px">
              <i class="fa fa-address-book" aria-hidden="true"></i>58 A, East
              Madison Street,
            </div>
            <div>
              <i class="fa fa-phone" aria-hidden="true"></i>(+0000) 123-456-7890
            </div>
            <div>
              <i class="fa fa-envelope" aria-hidden="true"></i>gmail@gmail.com
            </div>
          </div>
        </v-col>
        <v-col cols="12" sm="12" md="3" lg="3">
          <p style="font-size: 18px" class="text-right">
            آخرین اخبار، رویدادها و موارد دیگر را دریافت کنید
          </p>
          <v-text-field
            label="ایمیل"
            placeholder="ایمیل"
            filled
            rounded
            dense
          ></v-text-field>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <p class="text-center mt-8">© تمام حقوق مادی و معنوی این وبسایت متعلق به صنایع چوب نارگل میباشد</p>
    </v-container>
  </div>
</template>

<script>
export default {
  data: () => ({
    icons: ["mdi-facebook", "mdi-twitter", "mdi-linkedin", "mdi-instagram"],
  }),
};
</script>

<style scoped>
.fa {
  background-color: black;
  color: #c08c4d;
  font-size: 20px;
  margin-right: 10px;
  border: 2px solid;
  border-radius: 50%;
  padding: 10px;
}
.fa:hover {
  color: rgb(248, 238, 238);
  background-color: #c08c4d;
}
.anchor-style{
  text-decoration: none;
  color: black;
  transition: 0.3s;
}
.anchor-style:hover{
  color: #c08c4d;
}
</style>
