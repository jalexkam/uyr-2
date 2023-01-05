<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">New Appointments</h5>
            </div>
         </CCol>      
      </CRow>
         <CRow class="m-0 justify-content-between">
            <CCol md="2" sm="5" class="p-2">
               <div class="form-group">
                  <select class="form-control">
                     <option>All</option>
                     <option>Pending</option>
                     <option>Accepted</option>
                     <option>Completed</option>
                     <option>Rejected</option>                     
                  </select>
               </div>
            </CCol> 
            <CCol md="3" sm="5" class="p-2">
              <div class="search_box">
                  <input type="search" placeholder="Search..." class="form-control" name="">
                  <CButton><vue-fontawesome icon="search" class="mr-1" size="0.9"></vue-fontawesome></CButton>
               </div>
            </CCol>
         <CCol md="12" class="px-2 pb-2">
            <CCard>
               <CCardBody>
                  <div class="table-responsive">
                     <table class="table table-striped table-hover">
                        <thead>
                           <tr>
                              <th width="40" data-name="r-checkbox">
                                 <div class="select-all">
                                    <input type="checkbox" name="">
                                    <CDropdown toggler-text="" class="" color="light">
                                       <CDropdownItem>Select All Results</CDropdownItem>
                                    </CDropdown>
                                 </div>
                              </th>
                              <th>Book ID</th>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Patient Name</th>
                              <th>Contact</th>
                              <th>Dr. Name</th>
                              <th>Reports</th>                              
                              <th>Fees</th>
                              <th class="text-center">Status</th>
                              <th width="30">Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td width="40" data-name="r-checkbox">
                                 <div class="select-all">
                                    <input type="checkbox" name="">
                                 </div>
                              </td>
                              <td>1</td>
                              <td>22-07-2021</td>
                              <td>12.00pm</td> 
                              <td>George Anderson</td>
                              <td>9876543210</td>
                              <td>George Anderson</td>
                              <td>Reports</td>
                              <td>2000/-</td>
                              <td class="text-center">
                                <CBadge color="warning">Pending</CBadge></td>
                               <td>
                                    <CButtonGroup size="sm">
                                 
                                      <CButton size="sm" color=""  class="btn-outline-info">
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
                           <tr>
                              <td width="40" data-name="r-checkbox">
                                 <div class="select-all">
                                    <input type="checkbox" name="">
                                 </div>
                              </td>
                              <td>2</td>
                              <td>22-07-2021</td>
                              <td>12.00pm</td> 
                              <td>George Anderson</td>
                              <td>9876543210</td>
                              <td>George Anderson</td>
                              <td>Reports</td>
                              <td>2000/-</td>
                              <td class="text-center">
                                <CBadge color="danger">Rejected</CBadge></td>
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
                           <tr>
                              <td width="40" data-name="r-checkbox">
                                 <div class="select-all">
                                    <input type="checkbox" name="">
                                 </div>
                              </td>
                              <td>3</td>
                              <td>22-07-2021</td>
                              <td>12.00pm</td> 
                              <td>George Anderson</td>
                              <td>9876543210</td>
                              <td>George Anderson</td>
                              <td>Reports</td>
                              <td>2000/-</td>
                              <td class="text-center">
                                <CBadge color="success">Accepted</CBadge></td>
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
                           <tr>
                              <td width="40" data-name="r-checkbox">
                                 <div class="select-all">
                                    <input type="checkbox" name="">
                                 </div>
                              </td>
                              <td>3</td>
                              <td>22-07-2021</td>
                              <td>12.00pm</td> 
                              <td>George Anderson</td>
                              <td>9876543210</td>
                              <td>George Anderson</td>
                              <td>Reports</td>
                              <td>2000/-</td>
                              <td class="text-center">
                                <CBadge color="info">Completed</CBadge></td>
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
<!--       <CModal
      title="Modal title"
      color="warning"
      :show.sync="warningModal"
      class="form-modal"
    >
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </CModal> -->
  </div>
   </div>
</template>
<script>
import Vue from 'vue';
 export default{
      data () {
       return {
         // warningModal: false
       };
     }
   }
  
</script>
<style>
  .form-modal .modal-dialog {
      margin: 0;
      margin-left: auto;
  }

  .form-modal .modal-content {
      border: 0;
      height: 100vh;
      border-radius: 0;
      overflow: auto;
  }

 .form-modal header.modal-header {
      padding: 0.35rem 1rem;
  }
  
 .form-modal .modal-body{
     padding:0.5rem;
  }
</style>