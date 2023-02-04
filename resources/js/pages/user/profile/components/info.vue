<template>
  <div>
    <v-container>
      <v-row>
        <v-col cols="12" md="6"
          ><v-text-field
            label="نام کاربری"
            placeholder="نام کار بری"
            filled
            v-model="name"
          ></v-text-field
        ></v-col>
        <v-col cols="12" md="6">
          <v-text-field
            label="ایمیل"
            placeholder="ایمیل"
            filled
            v-model="email"
          ></v-text-field
        ></v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="4"
          ><v-select
            :items="items"
            label="جنسیت"
            filled
            v-model="gender"
          ></v-select
        ></v-col>
        <v-col cols="12" md="4"
          ><v-text-field
            label="سن"
            placeholder="سن"
            filled
            v-model="age"
          ></v-text-field
        ></v-col>
        <v-col cols="12" md="4"
          ><v-text-field
            label="موبایل"
            placeholder="موبایل"
            filled
            v-model="mobile"
          ></v-text-field
        ></v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="4">
          <v-text-field
            label="تاریخ تولد"
            placeholder="تاریخ تولد"
            filled
            v-model="birthDate"
          ></v-text-field>
        </v-col>
        <v-col cols="12" md="4">
          <v-file-input
            v-model="avatar"
            label="آواتار"
            filled
            prepend-icon="mdi-account"
            @change="Preview_image"
          ></v-file-input>
        </v-col>
        <v-col cols="12" md="4">
          <v-img
            :src="url"
            class="mb-4 rounded-circle"
            width="100"
            height="100"
          ></v-img>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="6">
          <v-text-field
            label="پسورد"
            placeholder="پسورد"
            filled
            v-model="password"
            type="password"
          ></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field
            label="تکرار پسورد"
            placeholder="تکرار پسورد"
            filled
            v-model="passwordConfirmation"
            type="password"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-text-field
            v-model="address"
            label="آدرس"
            placeholder="ادرس"
            filled
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-textarea
            v-model="bio"
            filled
            name="input-7-4"
            label="بیوگرافی"
          ></v-textarea>
        </v-col>
      </v-row>
      <v-row justify="center">
        <v-btn elevation="24" x-large @click="editProfile">ویرایش کنید</v-btn>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import alerts from "../../../../shared/alerts/index.js";
export default {
  created() {
    this.getUserDetail();
  },
  data() {
    return {
      items: ["آقا", "خانم", "دیگر"],
      url: null,
      avatar: null,
      userId: "",
      name: "",
      email: "",
      gender: "",
      age: "",
      mobile: "",
      birthDate: "",
      address: "",
      bio: "",
      password: "",
      passwordConfirmation: "",
    };
  },
  methods: {
    Preview_image(event) {
      this.avatar = event;
      this.url = URL.createObjectURL(this.avatar);
    },
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
          this.userId = user.id;
          this.name = user.name;
          this.email = user.email;
          this.address = user.address;
          this.age = user.age;
          this.gender = user.gender;
          this.mobile = user.mobile;
          this.birthDate = user.birthDate;
          this.url = user.avatar;
          this.bio = user.bio;
        })
        .catch((error) => {});
    },
    editProfile() {
      let token = localStorage.getItem("userToken");
      axios
        .post(
          `/api/user/profile/update/${this.userId}`,
          {
            name: this.name,
            email: this.email,
            age: this.age,
            address: this.address,
            avatar: this.avatar,
            bio: this.bio,
            birthDate: this.birthDate,
            gender: this.gender,
            mobile: this.mobile,
          },
          {
            headers: {
              Authorization: token,
              "Content-Type": "multipart/form-data",
            },
          }
        )
        .then((response) => {
          alerts.successAlert(response.data.message);
        })
        .catch((error) => {});
    },
  },
};
</script>

<style scoped>
</style>
