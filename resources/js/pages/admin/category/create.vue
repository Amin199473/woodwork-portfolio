<template>
  <div>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container>
        <v-form ref="form" v-model="valid" lazy-validation>
          <ValidationProvider rules="required|min:3" v-slot="{ errors }">
            <v-text-field
              v-model="name"
              :counter="3"
              label="نام"
              filled
              :error-messages="errors"
            >
            </v-text-field>
          </ValidationProvider>
          <v-select
            filled
            v-model="selectModel"
            :items="model_type"
            :rules="[(v) => !!v || ' یک مدل را انتخاب کنید']"
            label="مدل مرتبط"
          ></v-select>

          <v-select
            filled
            v-model="parent"
            :items="categories"
            item-text="name"
            item-value="id"
            label="دسته پدر"
            return-object
          ></v-select>

          <v-btn
            color="success"
            class="mr-4"
            :disabled="invalid"
            @click="addCategory"
          >
            افزودن
          </v-btn>

          <v-btn color="warning" class="mr-4" @click="reset"> پاک کردن </v-btn>
          <router-link class="a-style" to="/dashboard/category">
            <v-btn color="purple" class="white--text"> مرحله قبل </v-btn>
          </router-link>
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
    valid: true,
    categories: [],
    name: "",
    parent: null,
    model_type: ["پست ها", "پروژه ها"],
    selectModel: null,
  }),
  created() {
    this.getCategories();
  },
  methods: {
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },

    async getCategories() {
      let token = localStorage.getItem("adminToken");
      await axios
        .get(`/api/category`, {
          headers: {
            Authorization: token,
          },
        })
        .then((response) => {
          response.data.categories.map((item) => {
            this.categories.push({ id: item.id, name: item.name });
          });
        })
        .catch((error) => {});
    },
    addCategory() {
      let token = localStorage.getItem("adminToken");
      axios
        .post(
          `/api/category`,
          {
            name: this.name,
            parent_id: this.parent ? this.parent.id : null,
            parent_name: this.parent ? this.parent.name : null,
            model_type: this.selectModel,
          },
          {
            headers: {
              Authorization: token,
            },
          }
        )
        .then((response) => {
          alerts.successAlert("دسته بندی با موفقیت اضافه شد");
        })
        .catch((error) => {
          alerts.errorAlert("دسته بندی با موفقیت اضافه نشد");
        });
    },
  },
};
</script>
<style scoped>
.a-style {
  text-decoration: none;
}
</style>
