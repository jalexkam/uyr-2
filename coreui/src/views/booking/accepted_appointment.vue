<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Ongoing Appointments</h5>
               <!-- <router-link to="DoctorAdd">
                  <CButton class="btn_custom btn-flex" size="sm" >
                     <vue-fontawesome icon="plus" class="mr-1" size="0.8"></vue-fontawesome>
                     Add New Doctor
                  </CButton>
               </router-link> -->
            </div>
         </CCol>      
      </CRow>

      <CRow class="m-0">
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
                              <th>Booking ID</th>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Patient Name</th>
                              <th>Contact</th>                              
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
                              <td>2000/-</td>
                              <td class="text-center">
                                <CBadge color="success">Accepted</CBadge>
                              </td>
                              <td>
                                <CButtonGroup size="sm">   
                                  <CButton size="sm" color="" class="btn-outline-info d-flex align-items-center" to="p_view">
                                      <vue-fontawesome icon="eye" class="mr-1 my-0" size="0.8"></vue-fontawesome>View
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
                              <td>1</td>
                              <td>22-07-2021</td>
                              <td>12.00pm</td> 
                              <td>George Anderson</td>
                              <td>9876543210</td>
                              <td>2000/-</td>
                              <td class="text-center">
                                <CBadge color="success">Accepted</CBadge>
                              </td>
                              <td>
                                <CButtonGroup size="sm">   
                                  <CButton size="sm" color="" class="btn-outline-info d-flex align-items-center">
                                      <vue-fontawesome icon="eye" class="mr-1 my-0" size="0.8"></vue-fontawesome>View
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
                              <td>1</td>
                              <td>22-07-2021</td>
                              <td>12.00pm</td> 
                              <td>George Anderson</td>
                              <td>9876543210</td>
                              <td>2000/-</td>
                              <td class="text-center">
                                <CBadge color="success">Accepted</CBadge>
                              </td>
                              <td>
                                <CButtonGroup size="sm">   
                                  <CButton size="sm" color="" class="btn-outline-info d-flex align-items-center">
                                      <vue-fontawesome icon="eye" class="mr-1 my-0" size="0.8"></vue-fontawesome>View
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
import Vue from 'vue';
 export default{
      data () {
       return {
       };
     }
   }
  
</script>
<style>
   .doctor-img img {
    width: 130px;
}
.doctor_list_card{
   display: flex;
}

.card.doctor_card {
    padding: 10px;
    border: 1px solid #ccc !important;
    box-shadow: 1px 1px 5px 2px #eee;
}
.doctor_info {
    margin-left: 20px;
}

.doctor_info p {
    margin-bottom: 0.6rem;
}
</style>
