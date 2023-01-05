<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">My Payout</h5>
            </div>
         </CCol>      
      </CRow>
         <CRow class="m-0">
<!--             <CCol md="2" class="p-2">
               <div class="form-group">
                  <select class="form-control">
                     <option>All</option>
                     <option>Pending</option>
                     <option>Accepted</option>
                     <option>Completed</option>
                     <option>Rejected</option>                     
                  </select>
               </div>
            </CCol>  -->
         <CCol md="12" class="px-2 pb-2">
            <CCard>
               <CCardBody>
                  <div class="table-responsive">
                     <table class="table table-striped table-hover" style="text-align: center;">
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
                              <th>Month/ Year</th>
                              <th>Total Bookings</th>
                              <th>Total Amount Earn</th>                            
                              <th class="text-center">Status</th>
                              <th>Transaction ID</th>

                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td width="40" data-name="r-checkbox">
                                 <div class="select-all">
                                    <input type="checkbox" name="">
                                 </div>
                              </td>
                              <td>July 2021</td>
                              <td>25</td>
                              <td>20000</td> 
                              <td class="text-center">
                                <CBadge color="success">Paid</CBadge></td>
                              <td>ID869D90F</td>
                           </tr>
                           <tr>
                              <td width="40" data-name="r-checkbox">
                                 <div class="select-all">
                                    <input type="checkbox" name="">
                                 </div>
                              </td>
                              <td>August 2021</td>
                              <td>25</td>
                              <td>20000</td> 
                              <td class="text-center">
                                <CBadge color="success">Paid</CBadge></td>
                              <td>ID869D90F</td>
                           </tr>
                           <tr>
                              <td width="40" data-name="r-checkbox">
                                 <div class="select-all">
                                    <input type="checkbox" name="">
                                 </div>
                              </td>
                              <td>September 2021</td>
                              <td>25</td>
                              <td>20000</td> 
                              <td class="text-center">
                                <CBadge color="warning">Pending</CBadge></td>
                              <td></td>
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
