<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">Homepage1
                  <!-- <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>List -->
               </h5>
            </div>
         </CCol>
          <CCol md="12" class="px-2 pb-2">
            <CCard>
               <CCardBody>
                  <div class="table-responsive">
                     <table class="table table-striped table-hover">
                        <thead>
                           <!-- <tr>
                              <th colspan="7">Homepage slider</th>
                           </tr> -->
                           <tr>
                              <th width="60">Sr. No.</th>
                              <th>Section</th>
                              <th>Title</th>
                              <th width="100">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="text-center pl-0">1</td>
                              <td>Slider Section</td>
                              <td>Lorem Ipsum</td>

                              <td>
                                    <CButtonGroup size="sm">
                                 
                                    <CButton size="sm" color="" class="btn-outline-info" to="slider_list">
                                       <vue-fontawesome icon="eye" size="0.8" class="mr-2"></vue-fontawesome>View
                                    </CButton>
                                 </CButtonGroup>
                              </td>
                           </tr>
                           <tr>
                              <td class="text-center pl-0">2</td>
                              <td>Testimonial</td>
                              <td>Lorem Ipsum</td>
                              <td>
                                    <CButtonGroup size="sm">
                                 
                                    <CButton size="sm" color="" class="btn-outline-info" to="testimonial">
                                       <vue-fontawesome icon="eye" size="0.8" class="mr-2"></vue-fontawesome>View
                                    </CButton>
                                 </CButtonGroup>
                              </td>
                           </tr>
                           <tr>
                              <td class="text-center pl-0">3</td>
                              <td>Associate Partners</td>
                              <td>Lorem Ipsum</td>
                              <td>
                                    <CButtonGroup size="sm">
                                 
                                    <CButton size="sm" color="" class="btn-outline-info" to="associate_partners">
                                       <vue-fontawesome icon="eye" size="0.8" class="mr-2"></vue-fontawesome>View
                                    </CButton>
                                 </CButtonGroup>
                              </td>
                           </tr>


                        </tbody>
                     </table>
                  </div>
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
<style>
   .tblogimg {
    width: 150px;
    padding: 5px
}

.tblogimg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>