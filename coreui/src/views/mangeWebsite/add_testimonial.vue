<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">Testimonials  <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>Add</h5>
               <div class="">
                  <!-- <CButton size="sm" class="btn_custom" @click="submitFormData">Submit</CButton> -->
                  <router-link :to="{ name: 'manage-website-testimonial' }" >
                     <CButton size="sm" color="light">Back</CButton>
                  </router-link>
               </div>
            </div>
         </CCol>
         <CCol sm="9" class="p-2">
            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>Testimonials Details</strong>
                  </div>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CForm  >
                     <CRow class="m-0"> 
                                         
                        <CCol sm="6" md="6" class="px-2">
                           <CInput label="Name" v-model="formData.name" placeholder=""/>
                        </CCol>
                        
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Description</label>
                              <vue-editor v-model="formData.description"></vue-editor>

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
                   <CButton size="sm" color="info" class="text-white mx-auto d-block w-75 p-2 mb-3" @click="submitFormData">
                  <vue-fontawesome icon="upload" class="mr-1" size="0.8"></vue-fontawesome>Publish</CButton>
               </CCardBody>
            </CCard>
         </CCol>
      </CRow>
   </div>
</template>
<script>
   import Vue from 'vue'
   import Form from "vform";
   import { VueEditor } from "vue2-editor";
   import { mapGetters, mapActions } from "vuex";
   export default{
   components: {
     VueEditor,
   },

    data() {
        return {
            id:'', 
            show:false,
            showModal: true,
            formData : new Form({id:'', name:'',description:''}),
            picture  : '',
            imageDoc : [],
            id:0,
          }
    },

     computed: {
         ...mapGetters("ManageWebsite/Testimonials", ["returnData","editData"]),
      },

      created() {
         if(this.$route.params.id != '' && this.$route.params.id != undefined){
            this.getFormData(this.$route.params.id);
         }
      },
         

      methods: {
         ...mapActions("ManageWebsite/Testimonials", ["submitForm","UpdateMultiAction","edit"]),

         getFormData(id) {
            this.lable ='Edit';
            this.user_id = id;
            this.edit(id).then(() => {
                this.formData.keys().forEach((key) => {
                    this.formData[key] = this.editData[key];
                });
            });
           // this.ajax_error.errors = [];
        },

          submitFormData() {
             this.submitForm(this.formData).then(() => {
              if (this.returnData.status == 'success') {
                Vue.$toast.open({
                          message: this.returnData.message,
                          type: this.returnData.status,
                          position:'bottom-left',
                          duration:5000,
                      });
                   this.$router.push({name:"manage-website-testimonial"}); 
                }
                })
            .catch(error => {      
            });
          },


      },


       
    
   }
   
</script> 
<style>
   .blog-img{
      display: flex;
      align-items: center;
   }

   .blogimg {
    width: 320px;
    height: 200px;
    border: 2px solid #2c449e;
    overflow: hidden;
    margin-right: 16px;
}
.blogimg img {
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
}

.blog-img .file {
    position: relative;
}
.blog-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
}
</style>