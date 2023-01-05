<template>
  <div>
       <Uheader/>
     <main class="pts">

   <CContainer fluid>
    <CRow class="justify-content-center">
      <CCol lg="6">
        <div class="login_logoo">
            <img src="images/uyr_logo.png" alt="Logo" width="200px">

        </div>
      </CCol>
      <CCol lg="6" md="6" sm="9">
     <!--    <div class="log_head">
            <CButton class="home_button" :to="{ name: 'homepage' }">
              <vue-fontawesome icon="home" class="mr-2 my-0" size="1.1"></vue-fontawesome>Home
            </CButton>
        </div> -->
    <div class="login_section">
        <div class="login_form" v-if="show">
          <div class="text-center">
           <h2>Login</h2>
         </div>
           <div class="l_form">
             

                <form  class="validate-form" @submit.prevent="submitLoginForm" @keydown="form.onKeydown($event)">

                <!-- <h1 class="text-primary">Sign in</h1> -->
                <!-- <img src="images/logo.png" width="120px"> -->
                <h5 class="py-2">Sign In to your account</h5>
                <!-- 
                <div class="alertDiv">
                  <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="status != '' && status=='success'" >
                    <strong>{{status}}!</strong>
                    {{message}}.
                  </div>

                  <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="status!= '' && status =='error'">
                    <strong>{{status}}!</strong>
                    {{message}}.
                  </div>
                </div>
 -->            
              <div class="pos_relative">
                <CInput
                  v-model="form.email"
                  prependHtml="<i class='cui-user'></i>"
                  placeholder="Username"
                  autocomplete="username email"
                  class="cust-form-cont mb-0"
                  :class="[ajax_error.errors.email ? 'formError' : '']">
                  <template #prepend-content><CIcon name="cil-user"/></template>
                </CInput>
                  <small class="text-danger errorLogin posAbs" v-if="ajax_error.errors && ajax_error.errors.email">
                  <!-- <i class="fa fa-info-circle pr-1"></i> -->
                  <span>{{ajax_error.errors.email[0]}}</span>
                </small>
              </div>
              <div class="pos_relative">
                <CInput
                  v-model="form.password"
                  prependHtml="<i class='cui-lock-locked'></i>"
                  placeholder="Password"
                  type="password"
                  autocomplete="curent-password"
                  class="cust-form-cont mb-0"
                  :class="[ajax_error.errors.password ? 'formError' : '']">
                  <template #prepend-content><CIcon name="cil-lock-locked"/></template>
                </CInput>
                 <small class="text-danger errorLogin posAbs" v-if="ajax_error.errors && ajax_error.errors.password">
              <!-- <i class="fa fa-info-circle pr-1"></i> -->
              <span>{{ajax_error.errors.password[0]}}</span>
            </small>
          </div>

                <div class="for_pass">
                  <div @click="show=!show">
                  <router-link to="#">Forgot Password ?</router-link>

                </div>
                </div>
                <CRow>
                  <CCol col="12" class="text-center">
                    <CButton type="submit" class="submitbtn btn" :disabled="isActive"><span v-if="isSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Login</CButton>
                  </CCol>
                </CRow>
              </form>
              <CRow>
                <CCol col="12" class="text-center mt-4">
                  <div class="regi_here">
                    <p>Don't have an account? <router-link :to="{ name: 'register' }"> Register here</router-link></p>
                  </div>
                </CCol>
              </CRow>
            </div>
          </div>

          <div class="login_form" v-else>
            <div class="text-center">
           <h2>Forgot Password ?</h2>
         </div>
            <p>Enter your email to get a password reset link</p>
           <div class="l_form">
              <CForm @submit.prevent="submitForgotPassword" method="POST">
                <CInput
                  v-model="forgotPasswordForm.email"
                  prependHtml="<i class='cui-user'></i>"
                  placeholder="Email Id"
                  autocomplete="username email"
                  class="cust-form-cont">
                  <template #prepend-content><CIcon name="cil-envelope-closed"/></template>
                </CInput>
                <div class="for_pass">
                  <div @click="show=!show">
                  <router-link to="#">Back to Login ?</router-link>
                </div>
                </div>
                <CRow>
                  <CCol col="12" class="text-center">
                    <CButton type="submit" class="submitbtn btn" :disabled="isActive"><span v-if="isSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Request Reset Link</CButton>
                    <!-- <CButton type="submit" class="submitbtn btn">Reset Password</CButton> -->
                  </CCol>
                </CRow>
              </CForm>
            </div>
          </div>
        </div>
</CCol>
</CRow>
  </CContainer>
</main>
      <Ufooter/>

</div>
</template>

<script>
import Vue from 'vue';
import { mapGetters, mapActions } from 'vuex';
import Form from 'vform';
import axios from "axios";
import Uheader from '../frontend/header'
import Ufooter from '../frontend/footer'


  
  export default {
    middleware: 'guest',
    name: 'Login',
    data() {
      return {
        user:[],
        form: new Form({
          email: "",
          password: "",
          auth_login:1,
        }),
        forgotPasswordForm : new Form({email:''}),
        remember: false,
        spanLogin: "flex",
        spanSpinner: "none",
        status: "",
        message: "",
        btnDisable: false,
        Custloader: "none",
        email: '',
        password: '',
        showMessage: false,
        message: '',
        show:true,
        isActive : false,
        isSpinner: false,
      }
    },
        components: { 
      Uheader,
      Ufooter
     },

    created() {
      this.ajax_error.errors =[];
      this.fetchUser();
      this.resetState();
      setInterval(
        function() {
          $(".alertDiv").hide();
        }.bind(this),
        20000
      );
    },

    computed: {
      ...mapGetters("auth", ["returnData", "ajax_error","forgotPasswordResult"])
    },
    methods: {
     ...mapActions("auth", ["login","validateLogin", "saveToken","fetchUser", "resetState","forgotPasswordEmail" ]),
    

    async fetchUser() {
        try {
            const { data } = await axios.get('/api/get_user');
            this.user = data;
            if(this.user !=''){
              localStorage.setItem("is_login",'Yes');
               this.$router.push({ path: 'dashboard' });
            }else{
              localStorage.removeItem("is_login");
           }
            //console.log(this.user);
            //commit(types.FETCH_USER_SUCCESS, { user: data });
        } catch (e) {
           //commit(types.FETCH_USER_FAILURE);
        }
    },

     submitLoginForm() {
      this.isActive =  true;
      this.isSpinner =  true;
      this.login(this.form)
        .then(() => {
            if(this.returnData.token !=''){
              this.isActive =  false; 
              this.isSpinner =  false;
              this.saveTokenUser(this.returnData.token);
              localStorage.setItem("api_token",this.returnData.token);
            }
            if (this.returnData.status == 'success') {
              Vue.$toast.open({
                position:'top-right',
                message: 'Logged in successfully',
                type: 'success',
              });
            }
        })
        .catch(error => {
          this.isActive =  false; 
          this.isSpinner =  false;
        });
    },

    submitForgotPassword(){
      this.isActive =  true; 
      this.isSpinner =  true; 
      if(this.forgotPasswordForm.email != ''){
          this.forgotPasswordEmail(this.forgotPasswordForm).then(() => {
            this.isActive =  false; 
            this.isSpinner =  false; 
                Vue.$toast.open({
                  message  : this.forgotPasswordResult.data.message,
                  type     : this.forgotPasswordResult.data.status,
                  position : 'top-right',
                });
            if(this.forgotPasswordResult.data.status == 'success'){
                this.forgotPasswordForm.email = '';
            }
          })
          .catch(error => {
            this.isActive =  false; 
            this.isSpinner =  false; 
        });
      }else{
          Vue.$toast.open({
            message  : "Please enter email Id",
            type     : "error",
            position : 'top-right',
          });
          this.isActive =  false; 
          this.isSpinner =  false; 
      }
    },

     async saveTokenUser(token) {
         let self = this;
            this.$store.dispatch('auth/saveToken', {
                token: token,
                remember: this.remember,
            });

           this.$store.dispatch('auth/fetchUser');
          
           if(this.returnData.user !='' && this.returnData.user.role_type == 6){
             this.$router.push({ path: 'patient' });
            }else{
             this.$router.push({ path: 'dashboard' });
           }
        },
    }
  }
</script>
