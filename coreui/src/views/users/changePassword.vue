	<template>
  <div>
    <CRow class="m-0">
       <CCol md="12" class="p-2 text-right">
            <CButton size="sm" class="btn_custom" @click="submitFormData">Submit</CButton>
            <router-link :to="{ name: 'users' }" ><CButton size="sm" color="light">Back</CButton></router-link>
       </CCol>
      <CCol sm="6" class="p-2">
        <CCard>
          <CCardHeader class="p-2 bg_themes"> 
            <strong>Change Password</strong>
          </CCardHeader>
          <CCardBody class="py-2 px-1">
            <CForm method="POST">
              <CAlert show :color="status" closeButton v-if="message !=''">{{message}}</CAlert>
            <CRow class="m-0">
              <CCol class="form-group px-1" sm="12" lg="8" md="12">
                  <CInput class="mb-0" label="Old Password" v-model="formData.old_password" type="password" placeholder="Enter Old password" autocomplete="current-password"/>
                  <small class="text-danger" v-if="ajax_error.errors.password">{{ajax_error.errors.old_password[0] }}</small>
                </CCol>

                 <CCol class="form-group px-1" sm="12" lg="8" md="12">
                  <CInput class="mb-0" label="New Password" v-model="formData.password" type="password" placeholder="Enter New password" autocomplete="current-password"/>
                  <small class="text-danger" v-if="ajax_error.errors.password">{{ajax_error.errors.password[0] }}</small>
                </CCol>
                <CCol class="form-group px-1" sm="12" lg="8" md="12">
                  <CInput class="mb-0" label="Confirm Password" v-model="formData.password_confirmation" type="password" placeholder="Confirm password" autocomplete="current-password"/>
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

export default {
  data() {
   return {
     formData     : new Form({ old_password: '',password :'',password_confirmation:'',role_type:''}),
     message : '',
     status:'',
   };
 },
  created() {
    
  },
  computed: {
    ...mapGetters("Users/Index", ["returnData","ajax_error"]),
  },
  methods: {
    ...mapActions("Users/Index", ["changePassword"]),

    submitFormData() {
     this.changePassword({'id':this.$route.params.id,'formData':this.formData}).then(() => {
        if (this.returnData.status) {
          this.message = this.returnData.message;
          this.status = this.returnData.status;

        }
     })
     .catch(error => {
        window.scrollTo(0,0);      
     });
    },
  }
}
</script>