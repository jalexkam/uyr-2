<template>
      <CCol md="9" class="px-2">
            <CCard class="mb-2">
               <CCardHeader class="bg_themes text-black p-2">
                  <strong>Profile Details</strong>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <!-- <CRow class="m-0" >
                     <CCol sm="12" lg="6" md="12" class="px-1">
                        <CInput label="First Name" v-model="formData.first_name" placeholder="Enter First name"/>
                     </CCol>
                      <CCol sm="12" lg="6" md="12" class="px-1">
                        <CInput label="Last Name" v-model="formData.last_name" placeholder="Enter Last name"/>
                     </CCol>
                     <CCol sm="12" lg="6" md="12" class="px-1">
                        <CInput label="Email Id" v-model="formData.email" type="email" placeholder="Enter email id" autocomplete="email"/>
                     </CCol>
                     <CCol sm="12" lg="6" md="12" class="px-1">
                        <CInput label="Contact No."  v-model="formData.phone_number" placeholder="Enter Contact No."/>
                     </CCol>
                     <CCol sm="12" lg="6" md="12" class="px-1">
                        <CInput label="Username" v-model="formData.user_name" placeholder="Username"/>
                     </CCol> -->
                     <!--  -->
                      <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"></h5>
                         <CButton size="sm" class="btn_custom" @click="submitFormData">Submit</CButton>
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
        // props: ['formData'],
        data() {
           formData: new Form({
                    first_name: '',
                    last_name: '',
                    user_name: '',
                    email:'',
                    phone_number:'',
            }),
      },
      
      computed: {
       
      },
      created() {
       console.log('hiii')
      },

      methods: {
         
      },
   }
</script>