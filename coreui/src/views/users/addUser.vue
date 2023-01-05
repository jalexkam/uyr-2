<template>
  <div>
    <CRow class="m-0">
    <CCol sm="12" class="p-2">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">User <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>{{this.lable}}</h5><div>
            <CButton class="btn_custom mr-1" @click="submitFormData">Submit</CButton>
            <router-link :to="{ name: 'users' }" ><CButton color="light">Back</CButton></router-link>
          </div>
        </div>
    </CCol>
      <CCol sm="8" class="px-2">
        <CCard>
          <CCardHeader class="p-2 bg_themes">
            <strong>{{this.lable}} User</strong> 
          </CCardHeader>
          <CCardBody class="px-1 py-2"> 
            <CForm method="POST">
              <CRow class="m-0">
                <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <CInput class="mb-0" v-model="formData.first_name" label="First Name" v-on:keypress="isLetter($event)" placeholder="Enter first name" :class="[ajax_error.errors.first_name ? 'formError' : '']"/>                 
                  <small class="text-danger" v-if="ajax_error.errors.first_name">{{ ajax_error.errors.first_name[0] }}</small>
                </CCol>
                <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <CInput class="mb-0" v-model="formData.last_name" label="Last Name" v-on:keypress="isLetter($event)" placeholder="Enter last name" :class="[ajax_error.errors.last_name ? 'formError' : '']"/>
                  <small class="text-danger" v-if="ajax_error.errors.last_name">{{ ajax_error.errors.last_name[0] }}</small>
                </CCol>
                <!-- <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <CInput class="mb-0" v-model="formData.user_name" label="Username" placeholder="Enter username"/>
                  <small class="text-danger" v-if="ajax_error.errors.user_name">{{ ajax_error.errors.user_name[0] }}</small>
                </CCol> -->

                  <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <CInput class="mb-0" v-model="formData.phone_number" label="Phone Number"  v-on:blur="acceptNumber" maxlength="12" @input="acceptNumber" @keypress="onlyNumric($event)" placeholder="Enter Number" :class="[ajax_error.errors.phone_number ? 'formError' : '']"/>
                  <small class="text-danger" v-if="ajax_error.errors.phone_number">{{ ajax_error.errors.phone_number[0] }}</small>
                </CCol>

                  <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <label>Select Status </label>
                   <div class="form-group">
                      <select class="form-control" v-model="formData.status" >
                        <option value="0" >Active </option>
                        <option value="1" >IN-Active</option>
                      </select>
                    </div>
                </CCol>
                <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <CInput class="mb-0" v-model="formData.email" label="Email Id" type="email" placeholder="Enter email id" autocomplete="email" :class="[ajax_error.errors.email ? 'formError' : '']"/>
                  <small class="text-danger" v-if="ajax_error.errors.email">{{ ajax_error.errors.email[0] }}</small>
                </CCol>



              <!--   <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <label>Select Role </label>
                    <div class="form-group">
                      <select class="form-control" v-model="formData.role_type" >
                        <option>- Select Role -</option>
                        <option v-for="type in rolesResult.mainData" :value="type.id">
                          {{ type.title }}
                        </option>
                      </select>
                      <small class="text-danger" v-if="ajax_error.errors.role_type">{{ajax_error.errors.role_type[0] }}</small>
                    </div>
                </CCol> -->
              </CRow>
            </CForm>
          </CCardBody>
        </CCard>
      </CCol>


      <CCol sm="4" class="px-2"  v-if="user_id == ''">
        <CCard>
          <CCardBody class="p-2"> 
            <CForm method="POST">
              <CRow class="m-0">
                
                <CCol class="form-group px-0" sm="12" lg="12" md="12" >
                  <CInput class="mb-0" v-model="formData.password" label="Password" type="password" placeholder="Enter password" autocomplete="current-password" :class="[ajax_error.errors.password ? 'formError' : '']"/>
                  <small class="text-danger" v-if="ajax_error.errors.password">{{ajax_error.errors.password[0] }}</small>
                </CCol>
                <CCol class="form-group px-0" sm="12" lg="12" md="12">
                  <CInput class="mb-0" v-model="formData.password_confirmation" label="Confirm Password" type="password" placeholder="Confirm password" autocomplete="current-password" :class="[ajax_error.errors.password_confirmation ? 'formError' : '']"/>
                  <small class="text-danger" v-if="ajax_error.errors.password_confirmation">{{ajax_error.errors.password_confirmation[0] }}</small>
                </CCol>
              </CRow>
            </CForm>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import Vue from 'vue';
import Vuex from 'vuex';
  import Form from "vform";
import commonHelper from "./../../global_helper/helpers.js";

export default {
  data() {
   return {
    user_id: '',
    lable:'Add',
     formData     : new Form({ id: "",first_name:'',last_name:'',user_name:'',email:'',role_type:'',phone_number:'',status:0}),
   };
 },
  created() {
    this.getRoles();
    if(this.$route.params.id != '' && this.$route.params.id != undefined){
      this.getFormData(this.$route.params.id);
    }


  },
  computed: {
    ...mapGetters("Users/Index", ["rolesResult","returnData","ajax_error","usersResult","editData"]),
  },
  methods: {
    ...mapActions("Users/Index", ["getRoles","submitForm","edit"]),

    onlyNumric(evt){ return commonHelper.onlyNumric(evt); },
      acceptNumber() {
         var x = this.formData.phone_number.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
           this.formData.phone_number = !x[2] ? x[1] : '' + x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '');
      },

    submitFormData() {

     this.submitForm(this.formData).then(() => {
       if (this.returnData.status == 'success') {
         Vue.$toast.open({
                   message: this.returnData.message,
                   type: this.returnData.status,
               });
        this.$router.push({name:"users"}); 
        } 
     })

     .catch(error => {
        window.scrollTo(0,0);      
     });
    },
       getFormData(id) {
            this.user_id = id;
            this.lable ='Edit';
            this.edit(id).then(() => {
                this.formData.keys().forEach((key) => {
                    this.formData[key] = this.editData[key];
                });
            });
            this.ajax_error.errors = [];
        },
      isLetter(e) {
        let char = String.fromCharCode(e.keyCode); // Get the character
        if(/^[A-Za-z]+$/.test(char)) return true; // Match with regex 
        else e.preventDefault(); // If not match, don't add to input text
      },
      validateEmail() {
          if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
              this.msg['email'] = 'Please enter a valid email address';
          } else {
              this.msg['email'] = '';
          }
      },


  }
}
</script>