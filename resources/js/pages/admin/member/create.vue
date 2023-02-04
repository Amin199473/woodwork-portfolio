<template>
  <div>
    <h1 class="subheading grey--text ma-4">افزودن اعضای تیم</h1>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="4">
              <ValidationProvider rules="required" v-slot="{ errors }">
                <v-text-field
                  v-model="age"
                  :error-messages="errors"
                  label="سن"
                  filled
                ></v-text-field>
              </ValidationProvider>

              <ValidationProvider rules="required" v-slot="{ errors }">
                <v-text-field
                  v-model="level"
                  label="سطح مهارت"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>

              <ValidationProvider rules="required" v-slot="{ errors }">
                <v-text-field
                  v-model="exprience"
                  label="میزان تجربه"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>

              <ValidationProvider v-slot="{ errors }">
                <v-file-input
                  :error-messages="errors"
                  :rules="imgValidate"
                  placeholder="اپلود اواتار"
                  @change="Preview_image"
                >
                </v-file-input>
              </ValidationProvider>
              <v-img :src="url" class="mb-4"></v-img>

              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-combobox
                  v-model="skills"
                  chips
                  clearable
                  label="مهارت ها"
                  multiple
                  prepend-icon="mdi-filter-variant"
                  solo
                  reverse
                  return-object
                  :error-messages="errors"
                >
                </v-combobox>
              </ValidationProvider>
            </v-col>
            <v-col cols="12" md="8">

              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
              <v-text-field
                v-model="name"
                label="نام عضو"
                filled
                :error-messages="errors"
              ></v-text-field>
              </ValidationProvider>
              <ckeditor
                v-model="bio"
                :editor-url="editorUrl"
                :config="editorConfig"
              ></ckeditor>
            </v-col>
          </v-row>
          <v-row> </v-row>
          <v-row justify="center" class="my-4">
            <v-btn
              color="success"
              class="mr-4"
              :disabled="invalid"
              @click="addMember"
            >
              افزودن
            </v-btn>

            <v-btn color="warning" @click="reset"> پاک کردن </v-btn>
          </v-row>
        </v-form>
      </v-container>
    </ValidationObserver>
  </div>
</template>

<script>
import alerts from "../../../shared/alerts";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import ValidateRules from "../../../shared/validations/validateRules.js";

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  data: () => ({
    bio: "<p> بیوگرافی اعضای تیم</p>",
    editorConfig: {
      // The configuration of the editor.
    },
    editorUrl: "https://cdn.ckeditor.com/4.20.1/full/ckeditor.js",
    valid: true,
    name: "",
    age: "",
    skills: [],
    exprience: "",
    image: null,
    url: "",
    level: "",
    imgValidate: [
      (value) => !!value || "اپلود عکس اجباری است",
      (value) =>
        !value || value.size < 2000000 || "سایز باید کمتر از 2 مگابایت باشد",
    ],
  }),
  methods: {
    Preview_image(event) {
      this.image = event;
      this.url = URL.createObjectURL(this.image);
    },
    reset() {
      this.$refs.form.reset();
      this.image = null;
      this.url = null;
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
    addMember() {
      let token = localStorage.getItem("adminToken");
      let skills = this.skills.join();

      axios
        .post(
          `/api/member`,
          {
            name: this.name,
            age: this.age,
            level: this.level,
            exprience: this.exprience,
            bio: this.bio,
            skills: skills,
            avatar: this.image,
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
        .catch((error) => {
          alerts.errorAlert("پست با موفقیت ذخیره نشد");
        });
    },
  },
};
</script>
