<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">Terms & Conditions <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>Edit</h5>
               <div class="">
               </div>
            </div>
         </CCol>
         <CCol sm="9" class="p-2">
            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>Terms & Conditions Details</strong>
                  </div>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CForm  >
                     <CRow class="m-0">   
                        <CCol md="12" class="px-2">
                           <CInput label="About Us Title" placeholder="" v-model="formData.title"/>
                        </CCol>
                        
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Terms & Conditions Description</label>
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
            formData : new Form({id:'', title:'',description:'',status:1,pageName:'terms-condition'}),
            aboutus_picture  : '',
            imageDoc         : [],
            id:0,
          }
    },
   created() {
      this.getFormData();
   },
   computed: {
      ...mapGetters("ManageWebsite/AboutUS", ["rolesResult","returnData","ajax_error","editData"]),
   },
   methods: {
      ...mapActions("ManageWebsite/AboutUS", ["submitForm","termsconditionedit"]),

   
    onImageChange(e) {
            this.aboutus_picture = e.target.files[0];
            var reader = new FileReader();
            reader.onload = (e) => {
                this.imageDoc = e.target.result;
            }
            reader.readAsDataURL(this.aboutus_picture);
          },

      getFormData() {
                this.termsconditionedit(0).then(() => {
                this.formData.keys().forEach((key) => {
                this.formData[key] = this.editData[key];
                });
            });
          },
        
      submitFormData() {
               let newData  =  new FormData();
               newData.append('file',this.aboutus_picture)
               newData.append('formData',JSON.stringify(this.formData))
               var id = this.formData.id;
             
             this.submitForm({newData:newData,id:id}).then(() => {
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