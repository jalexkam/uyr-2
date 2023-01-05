<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">FAQ <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>Add</h5>
               <div class="">
                  <!-- <CButton size="sm" class="btn_custom" @click="submitFormData">Submit</CButton> -->
                  <router-link :to="{ name: 'faq_list' }" >
                     <CButton size="sm" color="light">Back</CButton>
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
                           <CInput label="Question" placeholder=""/>
                        </CCol>
                        
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Answer</label>
                              <textarea rows="7" class="form-control"></textarea>
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
   export default{

       
    
   }
   
</script> 
