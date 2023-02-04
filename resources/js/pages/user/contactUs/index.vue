<template>
  <div style="background-color: rgb(235 230 231 / 88%)">
    <Parallax />

    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <v-container style="margin-top: 100px">
        <v-row>
          <v-col cols="12" sm="12" md="6" lg="6">
            <div class="border text-center">
              <i class="fa fa-phone bore" aria-hidden="true"></i>
              <p class="text-h4 font-weight-bold mt-8 p-hover">تلفن</p>
              <p>
                <span class="text-h6 font-weight-bold">Toll-Free:</span> 0000 -
                123 - 456789 <br />
                <span class="text-h6 font-weight-bold">Fax:</span> 0000 - 123 -
                456789
              </p>
            </div>
            <div class="border text-center">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <p class="text-h4 font-weight-bold mt-8 p-hover">ایمیل</p>
              <p>
                <span class="text-h6 p-hover">info@example.com</span> <br />
                <span class="text-h6 p-hover">support@example.com</span>
              </p>
            </div>
            <div class="border text-center">
              <i class="fa fa-telegram" aria-hidden="true"></i>
              <p class="text-h4 font-weight-bold mt-8 p-hover">آدرس</p>
              <span class="text-h6 p-hover"
                >No: 58 A, East Madison Street, Baltimore, MD, USA 4508</span
              >
            </div>
          </v-col>
          <v-col cols="12" md="6">
            <ValidationProvider rules="required|min:3" v-slot="{ errors }">
              <v-text-field
                reverse
                color="brown darken-1"
                label="نام"
                placeholder="نام"
                outlined
                dense
                v-model.trim="form.name"
                :error-messages="errors"
              ></v-text-field>
            </ValidationProvider>

            <ValidationProvider rules="required|email" v-slot="{ errors }">
              <v-text-field
                reverse
                color="brown darken-1"
                label="ایمیل"
                placeholder="ایمیل"
                outlined
                dense
                v-model.trim="form.email"
                :error-messages="errors"
              ></v-text-field>
            </ValidationProvider>

            <ValidationProvider
              :rules="{
                required: true,
                regex:
                  /(0|\+98)?([ ]|-|[()]){0,2}9[1|2|3|4]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/gi,
              }"
              v-slot="{ errors }"
            >
              <v-text-field
                reverse
                color="brown darken-1"
                label="شماره موبایل"
                placeholder="شماره موبایل"
                outlined
                dense
                v-model.trim="form.phone"
                :error-messages="errors"
              ></v-text-field>
            </ValidationProvider>

            <ValidationProvider rules="required|min:6" v-slot="{ errors }">
              <v-text-field
                reverse
                color="brown darken-1"
                label="موضوع"
                placeholder="موضوع"
                outlined
                dense
                v-model="form.subject"
                :error-messages="errors"
              ></v-text-field>
            </ValidationProvider>

            <ValidationProvider rules="required|min:10" v-slot="{ errors }">
              <v-textarea
                color="brown darken-1"
                outlined
                name="input-7-4"
                label="پیام"
                v-model="form.message"
                :error-messages="errors"
              ></v-textarea>
            </ValidationProvider>

            <v-btn
              :disabled="invalid"
              class="btn-readMore"
              @click="submitContactForm"
            >
              ثبت پیام
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </ValidationObserver>
  </div>
</template>

<script>
import Parallax from "../sharedComponets/TheParallax.vue";
import alerts from "../../../shared/alerts/index.js";
import { ValidationProvider, ValidationObserver } from "vee-validate";
// import ValidateRules from "../../../shared/validations/validateRules.js";
export default {
  components: {
    Parallax,
    ValidationProvider,
    ValidationObserver,
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
        subject: "",
        message: "",
      },
    };
  },
  methods: {
    submitContactForm() {
      let token = localStorage.getItem("userToken");
      let form = this.form;
      axios
        .post(
          `/api/contactUs`,
          { form },
          {
            headers: {
              Authorization: token,
            },
          }
        )
        .then((response) => {
          alerts.successAlert(response.data.message);
        })
        .catch((err) => {});
    },
  },
};
</script>

<style scoped>
.btn-readMore {
  background-color: black !important;
  color: antiquewhite !important;
  transition: background-color 0.6s;
}
.btn-readMore:hover {
  background-color: #c08c4d !important;
}
.border {
  border: 2px solid black;
  padding: 100px 100px;
  margin-bottom: 25px;
}
.border:hover {
  border-color: #c08c4d;
  transition: 0.5s;
}
.fa {
  font-size: 30px;
  border: 2px solid black;
  background-color: black;
  color: white;
  padding: 15px;
  border-radius: 5px;
}
.fa:hover {
  border-color: #c08c4d;
  background-color: #c08c4d;
  transition: 0.5s;
}
.p-hover:hover {
  transition: 0.5s;
  color: #c08c4d;
}
</style>
