<template>
      <CCol md="9" class="px-2">
            <CCard class="mb-2">
               <CCardHeader class="bg_themes p-2">
                  <!-- <CIcon name="cil-pencil"/> -->
                  <strong>Bank Details</strong>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CForm method="POST">
                     <CRow class="m-0">
                        <CCol sm="12" lg="5" md="6" class="px-1">
                           <CInput label="Bank Name" type="text" v-model="formData.bankName"  placeholder="Enter Bank Name"/>
                           <CInput label="Bank Account No." type="text" v-model="formData.accountNo"  placeholder="Enter Bank Account No."/>
                           <CInput label="Account Holder Name" type="text" v-model="formData.accountHolderName"  placeholder="Enter Account Holder Name"/>
                           <CInput label="IFSC Code" type="text" v-model="formData.ifscCode"  placeholder="Enter IFSC Code"/>
                        </CCol>
                     </CRow>
                  </CForm>
                  <CRow class="mx-0 mt-3">
                     <CCol sm="12" class="px-2">
                        <CButton class="btn_custom px-4"  @click="submitFormData()">Update</CButton>
                     </CCol>
                  </CRow>
               </CCardBody>
            </CCard>
         </CCol>
</template>
<script>
  import { mapGetters, mapActions } from "vuex";
  import Vue from "vue";
  import Vuex from "vuex";
  import Form from "vform";
  

  export default {
   name:"bank_details",

    components: {
    },
    data() {
      return {
         formData: new Form({ 
                              id: "",
                              user_id:"",
                              bankName: "",
                              accountNo: "",
                              accountHolderName: "",
                              ifscCode: ""
                           }),
                            
        };
    },

    created() {
      this.page;
      this.getFormData();
    },

    computed: {  
      ...mapGetters('SiteSettings/Index', ["returnData","editData","ajax_error"]),
      // ...mapGetters('auth', ['user']),
      // ...mapGetters({ user: 'auth/user' }),
    },

    methods: {
      ...mapActions('SiteSettings/Index', ["submitForm","getBankDetails"]),

      submitFormData() {
        this.submitForm(this.formData).then(() => {
            if (this.returnData.status == "success") {
              Vue.$toast.open({
                message: this.returnData.message,
                type: this.returnData.status,
              });
              this.getFormData();
            }
          })
          .catch((error) => {
            window.scrollTo(0, 0);
          });
      },

      getFormData() {        
         this.getBankDetails().then(() => {
            this.formData.keys().forEach((key) => {
               this.formData[key] = this.editData[key];
            });            
            // this.formData.user_id = this.editData.user_id;
         });
      },

      

      


    },
  };
</script>