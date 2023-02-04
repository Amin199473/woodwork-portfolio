<template>
  <div>
    <v-container style="margin-top: 100px">
      <v-row justify="space-between">
        <v-col cols="12" sm="12" md="6" lg="6">
          <p class="text-uppercase about-us text-center">درباره ما</p>
          <p class="text-h3 text-center">ما دیدگاه‌ها را به آثار هنری تغییر می‌دهیم</p>
          <div class="mt-16">
            <h3 class="mb-4 text-right"> بهترین قیمت </h3>
            <p class="text-right">
              لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
              استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
              در ستون و سطرآنچنان که لازم استلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
              استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
              در ستون و سطرآنچنان که لازم است
            </p>
          </div>
          <div class="my-16">
            <h3 class="mb-4 text-right">مدرن وسفارشی</h3>
            <p class="text-right">
              لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
              استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
              در ستون و سطرآنچنان که لازم استلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
              استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
              در ستون و سطرآنچنان که لازم است
            </p>
          </div>
          <v-btn class="btn-readMore" elevation="24" large x-large x-small
            > بیشتر بدانید </v-btn
          >
        </v-col>
        <v-col cols="12" sm="12" md="6" lg="6">
          <v-img
            class="rounded-lg"
            :src="require('../../../../assets/images/About_us_img.webp')"
          >
          </v-img>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
export default {};
</script>

<style scoped>

.about-us {
  color: #c08c4d;
}
.btn-readMore {
  background-color: black !important;
  color: antiquewhite !important;
  transition: background-color 2s;
}
.btn-readMore:hover {
  background-color: #c08c4d !important;
}
</style>
