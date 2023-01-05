<template>
  <div class="">
      <Uheader/>
     <main class="pts">
    <CContainer fluid>
      <CRow>
        <CCol lg="6">
          <div class="login_logoo">
            <img src="images/uyr_logo.png" alt="Logo" width="200px" />
          </div>
        </CCol>
        <CCol lg="6">
          <div class="log_head">
           <!--  <CButton class="home_button" :to="{ name: 'homepage' }"> <vue-fontawesome icon="home" class="mr-2 my-0" size="1.1"> </vue-fontawesome>Home </CButton>
            <span>|</span> -->
            <CButton to="doctor_register" size="sm"><vue-fontawesome icon="user-md" class="mr-2 my-0" size="1.1"> </vue-fontawesome>for Doctor</CButton>
          </div>
          <div class="register_section justify-content-center" v-if="otpSentFlag">
            <div class="gif_check_animation">
              <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
              </svg>
              <h2>OTP Sent</h2>
              <p class="text-center">A One Time Password(OTP) has been sent to your registered Email Id</p>
            </div>
          </div>
          <div class="register_section" v-else>
            <div class="register_form login_form">
              <div class="text-center">
                <h2>User Register</h2>
              </div>
              <div class="l_form">
                <CForm class="validate-form" @submit.prevent="register" @keydown="form.onKeydown($event)">
                  <CRow>
                    <CCol sm="6">
                      <div class="pos_relative">
                        <CInput label="First Name*" v-model="form.first_name" type="text" placeholder="First Name" autocomplete="" class="cust-form-cont mb-0" :class="[ajax_error.errors.first_name ? 'formError' : '']"> </CInput>
                        <small v-if="ajax_error.errors.first_name" class="text-danger mb-0">
                          {{ ajax_error.errors.first_name[0] }}
                        </small>
                      </div>
                    </CCol>
                    <CCol sm="6">
                      <div class="pos_relative">
                        <CInput label="Last Name*" v-model="form.last_name" type="text" placeholder="Last Name" autocomplete="" class="cust-form-cont mb-0" :class="[ajax_error.errors.last_name ? 'formError' : '']"> </CInput>
                        <small v-if="ajax_error.errors.last_name" class="text-danger mb-0">
                          {{ ajax_error.errors.last_name[0] }}
                        </small>
                      </div>
                    </CCol>

                    <!-- <CCol sm="6">
                           <CInput
                              label="User Name*"
                              v-model="form.user_name"
                              type="text"
                              placeholder="User Name"
                              autocomplete=""
                              class="cust-form-cont mb-0">                 
                           </CInput>
                           <span v-if="ajax_error.errors.user_name" class="text-danger mb-0">
                            {{ ajax_error.errors.user_name[0] }}
                        </span>
                        </CCol> -->

                    <CCol sm="6">
                      <div class="pos_relative">
                        <CInput label="Email ID*" v-model="form.email" placeholder="test@exmaple.com" type="email" autocomplete="" class="cust-form-cont mb-0" :class="[ajax_error.errors.email ? 'formError' : '']"> </CInput>
                        <small v-if="ajax_error.errors.email" class="text-danger mb-0">
                          {{ ajax_error.errors.email[0] }}
                        </small>
                      </div>
                    </CCol>
                    <CCol sm="6">
                      <div class="pos_relative">
                        <CInput label="Phone No.*" v-model="form.phone_number" v-on:blur="acceptNumber" maxlength="12" @input="acceptNumber" @keypress="onlyNumric($event)" placeholder="9876543210" type="tel" autocomplete="" class="cust-form-cont mb-0" :class="[ajax_error.errors.phone_number ? 'formError' : '']"> </CInput>
                        <small v-if="ajax_error.errors.phone_number" class="text-danger mb-0">
                          {{ ajax_error.errors.phone_number[0] }}
                        </small>
                      </div>
                    </CCol>
                    <CCol sm="6">
                      <div class="pos_relative">
                        <CInput v-model="form.password" name="password" label="Password*" placeholder="*******" type="password" autocomplete="" class="cust-form-cont mb-0" :class="[ajax_error.errors.password ? 'formError' : '']"> </CInput>
                        <small v-if="ajax_error.errors.password" class="text-danger mb-0">
                          {{ ajax_error.errors.password[0] }}
                        </small>
                      </div>
                    </CCol>
                    <CCol sm="6">
                      <div class="pos_relative">
                        <CInput
                          v-model="form.password_confirmation"
                          name="password_confirmation"
                          label="Confirm Password*"
                          placeholder="*******"
                          type="password"
                          autocomplete=""
                          class="cust-form-cont mb-0"
                          :class="[ajax_error.errors.password_confirmation ? 'formError' : '']"
                        >
                        </CInput>
                        <small v-if="ajax_error.errors.password_confirmation" class="text-danger mb-0">
                          {{ ajax_error.errors.password_confirmation[0] }}
                        </small>
                      </div>
                    </CCol>
                    <!--         <CCol sm="6">
                           <CInput
                              label="Referral Code"
                              placeholder=""
                              type="password"
                              autocomplete=""
                              class="cust-form-cont mb-0">
                           </CInput>
                        </CCol> -->

                    <!--     <CCol sm="12">
                           <div class="form-group">
                              <label>Address</label>
                              <textarea class="form-control" rows="3" placeholder="Address">
                              </textarea>
                           </div>
                        </CCol> -->
                  </CRow>
                  <CRow>
                    <CCol col="12" class="text-center">
                      <CButton :disabled='isbtnDisabled' type="submit" class="submitbtn btn"><span v-if="isSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Register</CButton>
                    </CCol>
                  </CRow>
                  <CRow>
                    <!-- <CCol col="12" class="text-center mt-4">
                      <div class="regi_here">
                        <p>
                          <router-link :to="{ name: 'login' }"> Back to Login?</router-link>
                        </p>
                      </div>
                    </CCol> -->
                  </CRow>
                </CForm>
              </div>
            </div>
          </div>

          <!--           <div class="login_section" v-else>
            <div class="login_form">
                  <h2>Enter OTP</h2>
                  <p>OTP is sent to Your Mobile Number</p>
                  <div class="l_form">
                     <CForm @submit.prevent="login" method="POST">
                      <CRow>
                        <CCol md="12">
                          <CInput
                             v-model="email"
                             placeholder=""
                             autocomplete="username email"
                             class="cust-form-cont">
                             <template #prepend-content>
                                <CIcon name="cil-envelope-closed"/>
                             </template>
                          </CInput>
                          <div class="for_pass">
                              <div>
                                 <router-link to="#">Resend OTP ?</router-link>
                               </div>
                          </div>
                        </CCol>
                           <CCol col="12" class="text-center">
                              <CButton type="submit" to="Login" class="submitbtn btn">Submit</CButton>
                           </CCol>
                        </CRow>
                     </CForm>
                  </div>
               </div>
         </div> -->
        </CCol>
      </CRow>
    </CContainer>
  </main>
      <Ufooter/>
  
</div>
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
  import commonHelper from "./../../global_helper/helpers.js";
import Uheader from '../frontend/header'
import Ufooter from '../frontend/footer'



  export default {
    name: "Regiter",
    data: () => ({
      form: new Form({
        last_name             : "",
        first_name            : "",
        user_name             : "",
        email                 : "",
        password              : "",
        password_confirmation : "",
        phone_number          : "",
        type                  : "user",
      }),
      status        : "",
      message       : "",
      isbtnDisabled : false,
      isSpinner     : false,
      otpSentFlag   : false,
      Custloader    : "none",
      position      : "right top",
      remember      : false,
      formError     : "",
    }),
     components: { 
      Uheader,
      Ufooter
     },
    created() {
      this.ajax_error.errors = [];
      this.fetchUser();
      setInterval(
        function () {
          $(".alertDiv").hide();
        }.bind(this),
        20000
      );
    },
    computed: {
      ...mapGetters("auth", ["returnData", "ajax_error", "userData"]),
    },

    methods: {
      ...mapActions("auth", ["registerUser", "resetState", "fetchUser"]),

      onlyNumric(evt) {
        return commonHelper.onlyNumric(evt);
      },

      acceptNumber() {
        var x = this.form.phone_number.replace(/\D/g, "").match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        this.form.phone_number = !x[2] ? x[1] : "" + x[1] + "-" + x[2] + (x[3] ? "-" + x[3] : "");
      },
      
      async register() {        
        this.isbtnDisabled = true;
        this.isSpinner     = true;
        this.registerUser(this.form)
          .then(() => {
            if (this.returnData.data.status == "success") {
              Vue.$toast.open({
                message: this.returnData.data.message,
                type: this.returnData.data.status,
                position: "top-right",
              });
              this.$router.push({ name: "login" }).catch(() => {});
              // if(this.returnData.data.isOtpSent == true){
              //    this.otpSentFlag = true;
              //    this.resetForm();
              //    setTimeout(() => {
              //       this.$router.push({ name : "verify-otp", params: { id: this.returnData.data.otpToken }}).catch(() => {});
              //    }, 5000)
              // }
            }
            this.isbtnDisabled = false;
            this.isSpinner     = false;            
          })
          .catch((error) => {
            this.isbtnDisabled = false;
            this.isSpinner     = false;            
          });
      },

      async fetchUser() {
        try {
          const { data } = await axios.get("/api/get_user");
          this.user = data;
          if (this.user != "") {
            this.$router.push({ path: "dashboard" });
          }
        } catch (e) {}
      },

      async saveTokenUser(token) {
        let self = this;
        this.$store.dispatch("auth/saveToken", {
          token: token,
          remember: this.remember,
        });

        this.$store.dispatch("auth/fetchUser");
        this.$router.push({ path: "dashboard" });
      },
    },
  };
</script>
