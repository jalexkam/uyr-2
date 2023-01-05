<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">Social Links </h5>
                <div class="d-flex">
               </div>
            </div>
         </CCol>
         <CCol sm="9" class="p-2">
            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>Social Links </strong>
                  </div>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CForm  >
                     <CRow class="m-0">   
                        <CCol md="6" class="px-2">
                           <CInput label="Instagram" placeholder="Instagram" v-model="formData.instagram"/>
                        </CCol>
                        <CCol md="6" class="px-2">
                           <CInput label="LinkedIn" placeholder="LinkedIn" v-model="formData.linkedIn"/>
                        </CCol>
                        <CCol md="6" class="px-2">
                           <CInput label="Twitter" placeholder="Twitter" v-model="formData.twitter"/>
                        </CCol>
                        <CCol md="6" class="px-2">
                           <CInput label="Facebook" placeholder="Facebook" v-model="formData.facebook"/>
                        </CCol>
                        <CCol md="6" class="px-2">
                           <CInput label="YouTube" placeholder="YouTube" v-model="formData.youTube"/>
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
            formData : new Form({id:'', instagram:'',linkedIn:'',twitter:'',facebook:'',youTube:''}),
            aboutus_picture  : '',
            imageDoc         : [],
            id:0,
          }
    },
   created() {
      this.getFormData();
   },
   computed: {
      ...mapGetters("ManageWebsite/SocialLinks", ["rolesResult","returnData","ajax_error","editData"]),
   },
   methods: {
      ...mapActions("ManageWebsite/SocialLinks", ["submitForm","edit"]),

   
    onImageChange(e) {
            this.aboutus_picture = e.target.files[0];
            var reader = new FileReader();
            reader.onload = (e) => {
                this.imageDoc = e.target.result;
            }
            reader.readAsDataURL(this.aboutus_picture);
          },

      getFormData() {
                this.edit(0).then(() => {
                this.formData.keys().forEach((key) => {
                this.formData[key] = this.editData[key];
                });
            });
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
                }
                })
            .catch(error => {      
            });
          },
    },  

    
   }
   
</script> 
<style>
   .slider-img{
      display: flex;
      align-items: center;
      flex-wrap: wrap;
   }

   .sliderimg {
      width: 100%;
      border: 2px solid #2c449e;
      overflow: hidden;
      margin-right: 16px;
      height: 320px;
   }
.sliderimg img {
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
}

.slider-img .file {
    position: relative;
    margin: 10px 0
}
.slider-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
}
</style>