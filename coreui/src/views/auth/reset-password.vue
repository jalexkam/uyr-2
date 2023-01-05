<template>
  <div class="bg-login">
    <CContainer fluid>
      <CRow class="justify-content-center">
        <CCol lg="6">
          <div class="login_logoo">
            <img src="/images/uyr_logo.png" alt="Logo" width="200px" />
          </div>
        </CCol>
        <CCol lg="6" md="6" sm="9">
          <div class="log_head">
            <CButton class="home_button" :to="{ name: 'homepage' }">
              <vue-fontawesome icon="home" class="mr-2 my-0" size="1.1"></vue-fontawesome>
              Home
            </CButton>
          </div>
          <div class="login_section">
            <div class="login_form">
              <div class="text-center">
                <h2>Reset Password</h2>
                <!-- <p class="text-center">Enter your email Id that you used to register.<br/>We'll send you an email with a link to reset your password.</p> -->
              </div>
              <div class="l_form input_width">
                <form class="validate-form" @submit.prevent="submitResetPasswordForm" @keydown="form.onKeydown($event)">
                  <!-- <div class="p-relative"> -->
                    <div class="pos_relative">
                      <label>New Password</label>
                      <CInput v-model="form.password" name="password" placeholder="*******" type="password" autocomplete="" class="cust-form-cont mb-0"></CInput>
                      <small class="text-danger errorLogin posAbs" v-if="ajax_error.errors && ajax_error.errors.password">
                        <!-- <i class="fa fa-info-circle pr-1"></i> -->
                        <span>{{ajax_error.errors.password[0]}}</span>
                      </small>
                    </div>
                    <div class="pos_relative">
                      <label>Confirm Password</label>
                      <CInput v-model="form.password_confirmation" name="password_confirmation" placeholder="*******" type="password" autocomplete="" class="cust-form-cont mb-0"></CInput>
                      <small class="text-danger errorLogin posAbs" v-if="ajax_error.errors && ajax_error.errors.password_confirmation">
                        <!-- <i class="fa fa-info-circle pr-1"></i> -->
                        <span>{{ajax_error.errors.password_confirmation[0]}}</span>
                      </small>
                    </div>
                  <!-- </div> -->
                  <CRow>
                    <CCol col="12" class="text-center">
                      <CButton type="submit" class="submitbtn btn" :disabled="isActive"> <span v-if="isSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Reset Password</CButton>
                    </CCol>
                  </CRow>
                </form>
                <CRow>
                  <CCol col="12" class="text-center mt-2">
                    <div class="regi_here">
                      <p><router-link :to="{ name: 'login' }"> Login </router-link></p>
                    </div>
                  </CCol>
                </CRow>
              </div>
            </div>
          </div>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>

<script>
  import Vue from "vue";
  import { mapGetters, mapActions } from "vuex";
  import Form from "vform";
  import axios from "axios";
  import VueToast from "vue-toast-notification";
  import "vue-toast-notification/dist/theme-sugar.css";
  Vue.use(VueToast);

  export default {
    middleware: "guest",
    name: "Login",
    data() {
      return {
        user: [],
        form: new Form({ password: "", password_confirmation: "", key: "" }),
        isActive: false,
        isSpinner: false,
      };
    },

    created() {
      this.ajax_error.errors = [];
      if (this.$route.params.key != undefined) this.form.key = this.$route.params.key;
      this.fetchUser();
    },

    computed: {
      ...mapGetters("auth", ["ajax_error", "resetPasswordResult"]),
    },
    methods: {
      ...mapActions("auth", ["fetchUser", "resetPassword"]),

      async fetchUser() {
        try {
          const { data } = await axios.get("/api/get_user");
          this.user = data;
          if (this.user != "") {
            localStorage.setItem("is_login", "Yes");
            this.$router.push({ path: "dashboard" });
          } else {
            localStorage.removeItem("is_login");
          }
        } catch (e) {
          //commit(types.FETCH_USER_FAILURE);
        }
      },

      submitResetPasswordForm() {
        this.isActive = true;
        this.isSpinner = true;
        this.resetPassword(this.form)
          .then(() => {
            Vue.$toast.open({
              message: this.resetPasswordResult.data.message,
              type: this.resetPasswordResult.data.status,
              position: "top-right",
            });
            this.$router.push({ name: "login" }).catch(() => {});
          })
          .catch((error) => {
            this.isActive = false;
            this.isSpinner = false;
          });
      },
    },
  };
</script>
