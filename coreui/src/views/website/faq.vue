<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">FAQ
                 <!--  <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>List -->
               </h5>
               <div class="">
                  <router-link :to="{ name: 'add_faq' }" >
                     <CButton size="sm" class="btn_custom btn-flex">
                     <vue-fontawesome icon="plus" class="mr-1" size="0.8"></vue-fontawesome>
                     Add New FAQ</CButton>
                  </router-link>
               </div>
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
                              <th width="80" class="text-center pl-0"># ID</th>
                              <th>Questions</th>
                              <th>Date Added</th>
                              <th>Last Modified</th>
                              <th width="100">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr draggable="true">
                              <td class="text-center pl-0">1</td>
                              <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod ?</td>
                              <td>2021-07-20 12:26:29</td>
                              <td>2021-07-28 02:08:59</td>

                              <td>
                                    <CButtonGroup size="sm">
                                 
                                      <CButton size="sm" color="" class="btn-outline-info">
                                          <vue-fontawesome icon="eye" size="0.8"></vue-fontawesome>
                                       </CButton>
                                    <CButton size="sm" color="" class="btn-outline-success">
                                       <vue-fontawesome icon="pencil" size="0.8"></vue-fontawesome>
                                    </CButton>
                                    <CButton size="sm" color="" class="btn-outline-danger">
                                       <vue-fontawesome icon="trash" size="0.8"></vue-fontawesome>
                                    </CButton>
                                 </CButtonGroup>
                              </td>
                           </tr>
                           <tr draggable="true">
                              <td class="text-center pl-0">2</td>
                              <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod ?</td>
                              <td>2021-07-20 12:26:29</td>
                              <td>2021-07-28 02:08:59</td>

                              <td>
                                    <CButtonGroup size="sm">
                                 
                                      <CButton size="sm" color="" class="btn-outline-info">
                                          <vue-fontawesome icon="eye" size="0.8"></vue-fontawesome>
                                       </CButton>
                                    <CButton size="sm" color="" class="btn-outline-success">
                                       <vue-fontawesome icon="pencil" size="0.8"></vue-fontawesome>
                                    </CButton>
                                    <CButton size="sm" color="" class="btn-outline-danger">
                                       <vue-fontawesome icon="trash" size="0.8"></vue-fontawesome>
                                    </CButton>
                                 </CButtonGroup>
                              </td>
                           </tr>
                           <tr draggable="true">
                              <td class="text-center pl-0">3</td>
                              <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod ?</td>
                              <td>2021-07-20 12:26:29</td>
                              <td>2021-07-28 02:08:59</td>

                              <td>
                                    <CButtonGroup size="sm">
                                 
                                      <CButton size="sm" color="" class="btn-outline-info">
                                          <vue-fontawesome icon="eye" size="0.8"></vue-fontawesome>
                                       </CButton>
                                    <CButton size="sm" color="" class="btn-outline-success">
                                       <vue-fontawesome icon="pencil" size="0.8"></vue-fontawesome>
                                    </CButton>
                                    <CButton size="sm" color="" class="btn-outline-danger">
                                       <vue-fontawesome icon="trash" size="0.8"></vue-fontawesome>
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