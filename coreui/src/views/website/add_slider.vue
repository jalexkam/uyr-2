<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0"> Home Page Slider <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>Add</h5>
               <div class="">
                  <!-- <CButton size="sm" class="btn_custom" @click="submitFormData">Submit</CButton> -->
                  <router-link :to="{ name: 'slider_list' }" >
                     <CButton size="sm" color="light">Back</CButton>
                  </router-link>
               </div>
            </div>
         </CCol>
         <CCol sm="9" class="p-2">
            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>Banner Details</strong>
                  </div>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CForm method="POST">
                     <CRow class="m-0"> 
                        <CCol sm="12" md="12" class="px-2">
                           <div class="form-group">
                              <label>Banner Image</label>
                              <div class="slider-img rounded p-1">
                              <div class="sliderimg">
                              <img src="images/dummy_banner.jpg">
                                 
                              </div>
                              <button class="file btn btn-sm upload_btn text-center">
                                 <vue-fontawesome icon="upload" class="px-1 mr-2" size="0.8"></vue-fontawesome>
                                 Upload Image
                                 <input type="file" name="profile_picture"  v-on:change="onImageChange">
                              </button>
                           </div>
                           </div>
                        </CCol>                    
                        <CCol md="12" class="px-2">
                           <CInput label="Banner Title" placeholder=""/>
                        </CCol>
                        
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Banner Description</label>
                              <textarea class="form-control"></textarea>
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
                   <CButton size="sm" color="info" class="text-white mx-auto d-block w-75 p-2 mb-3">
                  <vue-fontawesome icon="upload" class="mr-1" size="0.8"></vue-fontawesome>Publish</CButton>
                  <CButton size="sm" color="danger" class="d-block w-75 mx-auto p-2">
                     <vue-fontawesome icon="trash" class="mr-1" size="0.8"></vue-fontawesome>Delete</CButton>
               </CCardBody>
            </CCard>
         </CCol>
      </CRow>
   </div>
</template>
<script>
   import Vue from 'vue'
   import { VueEditor } from "vue2-editor";

   export default{
   components: {
     VueEditor,
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