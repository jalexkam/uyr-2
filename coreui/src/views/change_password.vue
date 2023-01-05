<template>
      <CCol md="9" class="px-2">
            <CCard class="mb-2">
               <CCardHeader class="bg_themes p-2">
                  <!-- <CIcon name="cil-pencil"/> -->
                  <strong>Change Password</strong>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CForm method="POST">
                     <CRow class="m-0">
                        <CCol class="form-group px-1" sm="12" lg="7" md="12">
                           <CInput class="mb-0" label="Old Password" v-model="formData.old_password" type="password" placeholder="Enter Old password" autocomplete="current-password"/>
                           <small class="text-danger" v-if="ajax_error.errors.old_password">{{ajax_error.errors.old_password[0] }}</small>
                           <!-- <small class="text-danger" v-if="ajax_error.errors.old_password">{{ ajax_error.errors.old_password[0] }}</small> -->
                        </CCol>

                        <CCol class="form-group px-1" sm="12" lg="7" md="12">
                           <CInput class="mb-0" label="New Password" v-model="formData.password" type="password" placeholder="Enter New password" autocomplete="current-password"/>
                           <small class="text-danger" v-if="ajax_error.errors.password">{{ajax_error.errors.password[0] }}</small>
                        </CCol>
                        <CCol class="form-group px-1" sm="12" lg="7" md="12">
                           <CInput class="mb-0" label="Confirm Password" v-model="formData.password_confirmation" type="password" placeholder="Confirm password" autocomplete="current-password"/>
                           <small class="text-danger" v-if="ajax_error.errors.password_confirmation">{{ajax_error.errors.password_confirmation[0] }}</small>
                        </CCol>
                     </CRow>
                  </CForm>
                     <CCol md="12" class="p-2 ">
                        <CButton class="btn_custom" @click="submitFormData">Submit</CButton>
                     </CCol>
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
      name:"change_password",

      data() {
         return {
            formData     : new Form({ old_password: '',password :'',password_confirmation:''}),
            message : '',
            status:'',
         };
      },
      created() {
         
      },
      computed: {
         ...mapGetters("Users/Index", ["returnData","ajax_error"]),
         ...mapGetters({ user: 'auth/user' }),
      },
      methods: {
         ...mapActions("Users/Index", ["changePassword"]),

         submitFormData() {
            this.changePassword({'id':this.user.id,'formData':this.formData}).then(() => {            
               if (this.returnData.status) {
                  Vue.$toast.open({
                     message: this.returnData.message,
                     type: this.returnData.status,
                  });
               }
               this.resetData();
            })
            .catch(error => {
               window.scrollTo(0,0);      
            });
         },

         resetData(){
            this.ajax_error.errors = [];
            this.formData = new Form({ old_password: '',password :'',password_confirmation:''});
         }



      },

      
   }
</script>