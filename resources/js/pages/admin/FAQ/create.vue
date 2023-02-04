<template>
  <div>
    <h1 class="subheading grey--text ma-4">افزودن سوالات متدول</h1>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="12">
              <ValidationProvider rules="required|min:3" v-slot="{ errors }">
                <v-text-field
                  v-model="question"
                  label="ایجاد سوال"
                  filled
                  :error-messages="errors"
                ></v-text-field>
              </ValidationProvider>
              <ckeditor
                v-model="reply"
                :editor-url="editorUrl"
                :config="editorConfig"
                palceholder="پاسخ"
              ></ckeditor>
            </v-col>
          </v-row>
          <v-row justify="center" class="my-4">
            <v-btn
              color="success"
              :disabled="invalid"
              class="mr-4"
              @click="addFAQ"
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
    body: "<p>Content of the editor.</p>",
    editorConfig: {
      // The configuration of the editor.
    },
    editorUrl: "https://cdn.ckeditor.com/4.20.1/full/ckeditor.js",
    valid: true,
    question: "",
    reply: "پاسخ",
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
    addFAQ() {
      let token = localStorage.getItem("adminToken");
      axios
        .post(
          `/api/FAQ/add`,
          {
            question: this.question,
            reply: this.reply,
          },
          {
            headers: {
              Authorization: token,
            },
          }
        )
        .then((response) => {
          alerts.successAlert(response.data.message);
        })
        .catch((error) => {
          alerts.errorAlert("سوالات متداول با موفقیت ذخیره نشد");
        });
    },
  },
};
</script>
