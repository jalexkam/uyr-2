<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">
                  FAQ 
                  <vue-fontawesome icon="caret-right" class="px-3" size="3"></vue-fontawesome>
                  Add
               </h5>
               <div class="">
                  <!-- <CButton size="sm" class="btn_custom" @click="submitFormData">Submit</CButton> -->
                  <router-link :to="{ name: 'faq' }" >
                     <CButton  color="light">Back</CButton>
                  </router-link>
               </div>
            </div>
         </CCol>
         <CCol sm="9" class="p-2">
            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>FAQ Details</strong>
                  </div>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CForm method="POST">
                     <CRow class="m-0">
                        <CCol md="12" class="px-2">
                           <label>Question<span class="text-danger">*</span></label>
                           <CInput v-model="formData.question" placeholder=""/>
                           <small class="text-danger" v-if="ajax_error.errors.question">{{ ajax_error.errors.question[0] }}</small>
                        </CCol>
                        <CCol sm="12" class="px-2"  >
                           <div class="form-group">
                              <label>Answer<span class="text-danger">*</span></label>
                              <textarea rows="7" class="form-control"v-model="formData.answer" ></textarea>
                              <small class="text-danger" v-if="ajax_error.errors.answer">{{ ajax_error.errors.answer[0] }}</small>
                           </div>
                        </CCol>
                     </CRow>
                  </CForm>
               </CCardBody>
            </CCard>
         </CCol>
         <CCol sm="3" class="p-2">
            <CCard>
               <CCardBody class="p-2">
                  <CButton size="sm" color="info" class="text-white mx-auto d-block w-75 p-2 mb-3"@click="submitFormData">
                     <vue-fontawesome icon="upload" class="mr-1" size="0.8"></vue-fontawesome>
                     Submit 
                  </CButton>
                  <!--  <CButton size="sm" color="danger" class="d-block w-75 mx-auto p-2">
                     <vue-fontawesome icon="trash" class="mr-1" size="0.8"></vue-fontawesome>Delete</CButton> -->
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
        id                  : '',
        label               :'Add',
        formData            : new Form({ id: "",question:'',answer:''}),

   };
 },
  created() {
    if(this.$route.params.id != '' && this.$route.params.id != undefined){
      this.getFormData(this.$route.params.id);
    }


  },
  computed: {
    ...mapGetters("ManageWebsite/FAQs", ["returnData","ajax_error","usersResult","editData"]),
  },
  methods: {
    ...mapActions("ManageWebsite/FAQs", ["submitForm","edit"]),


    submitFormData() {
     this.submitForm(this.formData).then(() => {
       if (this.returnData.status == 'success') {
        Vue.$toast.open({
                   message: this.returnData.message,
                   type: this.returnData.status,
               });
        
        this.$router.push({name:"faq"}); 
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

        
  }
}
</script>
