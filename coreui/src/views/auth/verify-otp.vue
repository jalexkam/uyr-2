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
            <router-link :to="{ name: 'homepage' }">
              <CButton class="home_button">
                <vue-fontawesome icon="home" class="mr-2 my-0" size="1.1"></vue-fontawesome>
                Home
              </CButton>
            </router-link>
          </div>
          <div class="gif_check_animation" v-if="otpSentFlag">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
            <h2>OTP Sent</h2>
            <p class="text-center">A One Time Password(OTP) has been sent to your registered Email Id</p>
          </div>

          <div class="login_section">
            <div class="login_form otp_form" v-if="show">
              <h2>Please Enter the OTP to Verify Your Account</h2>
              <p>OTP is sent to your registered email Id</p>
              <div class="l_form">
                <CForm class="validate-form" @submit.prevent="validateotp" @keydown="form.onKeydown($event)">
                  <CRow class="justify-content-center">
                    <CCol md="10">
                      <v-otp-input class="otp_section" inputClasses="otp-input" :numInputs="6" separator=" " :shouldAutoFocus="true" @on-complete="handleOnComplete" @on-change="handleOnChange" />
                    </CCol>
                    <CCol md="10" class="text-center">
                      <CButton :disabled="isbtnDisabled" type="submit" class="submitbtn btn"><span v-if="isSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Validate OTP</CButton>
                      <!-- <div class="resent_link mt-3" @click="show=!show">
                        <a href="#">Resend OTP ?</a>
                      </div> -->
                    </CCol>
                  </CRow>
                </CForm>
              </div>
            </div>
            <div class="login_form otp_form" v-else>
              <h2>Resend One Time Password (OTP)</h2>
              <p>Please enter your Email Id to get a new OTP for account verification</p>
              <div class="l_form">
                <CForm @submit.prevent="resend_otp" method="POST">
                  <CRow class="justify-content-center">
                    <CCol md="10">
                      <div class="p-relative">
                        <CInput v-model="resendOtpForm.email" prependHtml="<i class='cui-user'></i>" placeholder="your@email_id.com" autocomplete="username email" class="cust-form-cont">
                          <template #prepend-content>
                            <CIcon name="cil-envelope-closed" />
                          </template>
                        </CInput>
                        <p class="text-danger errorLogin posAbs" v-if="ajax_error.errors && ajax_error.errors.email">
                          <i class="fa fa-info-circle pr-2"></i>
                          <span>{{ajax_error.errors.email[0]}}</span>
                        </p>
                      </div>
                    </CCol>
                    <CCol md="10" class="text-center">
                      <CButton :disabled="isbtnDisabled" type="submit" class="submitbtn btn"><span v-if="isSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Resend OTP</CButton>
                      <div class="resent_link mt-3" @click="show=!show">
                        <a href="#">Back</a>
                      </div>
                    </CCol>
                  </CRow>
                </CForm>
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
  import Form from "vform";
  import axios from "axios";
  import { mapGetters, mapActions } from "vuex";
  import VueToast from "vue-toast-notification";
  import "vue-toast-notification/dist/theme-sugar.css";
  Vue.use(VueToast);
  import OtpInput from "@bachdgvn/vue-otp-input";
  Vue.component("v-otp-input", OtpInput);
  export default {
    name: "Regiter",
    data: () => ({
      status: "",
      message: "",
      btnDisable: false,
      Custloader: "none",
      position: "right top",
      remember: false,
      show: true,
      otpForm: new Form({ otpToken: "", verify_otp: "" }),
      isbtnDisabled: false,
      isSpinner: false,
      resendOtpForm: new Form({ email: "" }),
      otpSentFlag: "",
    }),

    created() {
      if (this.$route.params.id) {
        this.otpForm.otpToken = this.$route.params.id;
      }
      this.ajax_error.errors = [];
      this.fetchUser();
      this.checkVeridied(this.$route.params.id);
    },

    computed: {
      ...mapGetters("auth", ["ajax_error", "otpResultData", "resendOtpResultData", "checkVerifiedResultData"]),
    },

    methods: {
      ...mapActions("auth", ["fetchUser", "validateUserOtp", "resendUserOtp", "checkIfAlreadyVerified"]),

      async fetchUser() {
        try {
          const { data } = await axios.get("/api/get_user");
          this.user = data;
          if (this.user != "") {
            this.$router.push({ path: "dashboard" });
          }
        } catch (e) {}
      },

      handleOnComplete(value) {
        this.otpForm.verify_otp = value;
      },

      handleOnChange(value) {
        this.otpForm.verify_otp = value;
      },

      validateotp() {
        this.isbtnDisabled = true;
        this.isSpinner = true;
        if (this.otpForm.verify_otp != "") {
          this.validateUserOtp(this.otpForm)
            .then(() => {
              Vue.$toast.open({
                message: this.otpResultData.data.message,
                type: this.otpResultData.data.status,
                position: "top-right",
              });
              this.isbtnDisabled = false;
              this.isSpinner = false;
              if (this.otpResultData.data.status == "success") {
                this.$router.push({ name: "login" }).catch(() => {});
              }
            })
            .catch((error) => {
              this.isbtnDisabled = false;
              this.isSpinner = false;
            });
        } else {
          this.isbtnDisabled = false;
          this.isSpinner = false;
          Vue.$toast.open({
            message: "Please enter OTP !",
            type: "error",
            position: "top-right",
          });
        }
      },

      resend_otp() {
        this.isbtnDisabled = true;
        this.isSpinner = true;
        if (this.resendOtpForm.email != "") {
          this.resendUserOtp(this.resendOtpForm).then(() => {
            this.isbtnDisabled = false;
            this.isSpinner = false;
            if (this.resendOtpResultData.data.status == "success") {
              this.otpSentFlag = true;
              this.resendOtpForm.email = "";
              this.show = true;
              setTimeout(() => {
                this.$router.push({ name: "verify-otp", params: { id: this.resendOtpResultData.data.otpToken } }).catch(() => {});
                this.otpSentFlag = false;
                this.otpForm.otpToken = this.$route.params.id;
              }, 5000);
            } else {
              this.otpSentFlag = false;
              Vue.$toast.open({
                message: this.resendOtpResultData.data.message,
                type: this.resendOtpResultData.data.status,
                position: "top-right",
              });
            }
          });
        } else {
          this.otpSentFlag = false;
          this.isbtnDisabled = false;
          this.isSpinner = false;
          Vue.$toast.open({
            message: "Please enter Email ID !",
            type: "error",
            position: "top-right",
          });
        }
      },

      checkVeridied(id) {
        this.checkIfAlreadyVerified(id).then(() => {
          if (this.checkVerifiedResultData.data.status == "error") {
            this.$router.push({ name: "page-not-found" });
          }
        });
      },
    },
  };
</script>
