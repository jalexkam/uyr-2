<template>
   <CCol md="9" class="px-2">
      <CCard class="mb-2">
         <CCardHeader class="bg_themes text-black p-2">
            <strong>Profile Details</strong>
         </CCardHeader>
         <CCardBody class="px-1 py-2">
            <CRow class="m-0" >
               <CCol sm="12" lg="6" md="12" class="px-1">
                  <CInput label="First Name" v-model="formData.first_name" placeholder="Enter First name"/>
                  <p class="text-danger errorLogin posAbs" v-if="ajax_error.errors && ajax_error.errors.first_name">
                  <i class="fas fa-info-circle pr-2"></i>
                  <span>{{ajax_error.errors.first_name[0]}}</span>
                </p>

               </CCol>
               <CCol sm="12" lg="6" md="12" class="px-1">
                  <CInput label="Last Name" v-model="formData.last_name" placeholder="Enter Last name"/>
                  <p class="text-danger errorLogin posAbs" v-if="ajax_error.errors && ajax_error.errors.last_name">
                  <i class="fas fa-info-circle pr-2"></i>
                  <span>{{ajax_error.errors.last_name[0]}}</span>
                </p>

               </CCol>
               <CCol sm="12" lg="6" md="12" class="px-1">
                  <CInput label="Email Id" v-model="formData.email" type="email" placeholder="Enter email id" autocomplete="email" disabled/>
                   <p class="text-danger errorLogin posAbs" v-if="ajax_error.errors && ajax_error.errors.email">
                  <i class="fas fa-info-circle pr-2"></i>
                  <span>{{ajax_error.errors.email[0]}}</span>
                </p>

               </CCol>
               <CCol sm="12" lg="6" md="12" class="px-1">
                  <CInput label="Contact No."  v-model="formData.phone_number" placeholder="Enter Contact No."/>
                   <p class="text-danger errorLogin posAbs" v-if="ajax_error.errors && ajax_error.errors.phone_number">
                  <i class="fas fa-info-circle pr-2"></i>
                  <span>{{ajax_error.errors.phone_number[0]}}</span>
                </p>

               </CCol>
               <!-- <CCol sm="12" lg="6" md="12" class="px-1">
                  <CInput label="Username" v-model="formData.user_name" placeholder="Username" disabled/>
                  <p class="text-danger errorLogin posAbs" v-if="ajax_error.errors && ajax_error.errors.user_name">
                  <i class="fas fa-info-circle pr-2"></i>
                  <span>{{ajax_error.errors.user_name[0]}}</span>
                </p>

               </CCol> -->
               <div class="d-flex justify-content-between align-items-center">
                  <h5 class="mb-0"></h5>
                  <CButton class="btn_custom" @click="save_profile">Submit</CButton>
               </div>
            </CRow>
         </CCardBody>
      </CCard>
   </CCol>
</template>
<script>
   import { mapGetters, mapActions } from "vuex";
   import Vue from 'vue';
   import Vuex from 'vuex';
   import Form from "vform";
   
   export default{
         props: ['formData','ajax_error'],
         name:"profile",
        data() {
           return {
            
           };
      },
      
      computed: {
      },
      created() {
      },
   
      methods: {
         save_profile(){
           this.$emit('save_profile');
        },
        
      },
   }
</script>