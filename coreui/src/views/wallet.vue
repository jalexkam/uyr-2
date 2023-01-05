<template>
      <CCol md="9" class="px-2">
            <CCard class="mb-2">
               <CCardHeader class="bg_themes text-black p-2">
                  <strong>Wallet</strong>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CRow class="m-0">
                     <CCol sm="12" lg="12" md="12" class="px-2">
                        <div class="d-flex justify-content-between align-items-center">
                           <div>
                              <h3 class="mb-0">Rs. 2000/-</h3>
                              <span class="text-muted">Available Balance</span>
                           </div>
                           <CButton class="btn-warning text-white">Add Money to wallet</CButton>
                        </div>
                     </CCol>     

                     <CCol md="12" class="px-2 mt-4">
                        <div class="table-responsive">
                           <table class="table table-striped table-hover">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Purpose</th>
                                    <th>Patient Name</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Transaction Type</th>
                                    <th>Transaction Code</th>
                                    <th>Date</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>1</td>
                                    <td>Purpose</td>
                                    <td>Patient Name</td>
                                    <td>Amount</td>
                                    <td>Status</td>
                                    <td>Description</td>
                                    <td>Transaction Type</td>
                                    <td>Transaction Code</td>
                                    <td>22-07-2021</td>
                                 </tr>
                                 <tr>
                                    <td>1</td>
                                    <td>Purpose</td>
                                    <td>Patient Name</td>
                                    <td>Amount</td>
                                    <td>Status</td>
                                    <td>Description</td>
                                    <td>Transaction Type</td>
                                    <td>Transaction Code</td>
                                    <td>22-07-2021</td>
                                 </tr>
                                 <!-- <tr>
                                    <td colspan="9" class="text-center p-2">You have no wallet transactions</td>
                                 </tr> -->
                              </tbody>
                           </table>
                        </div>
                     </CCol>


                  </CRow>
               </CCardBody>
            </CCard>
         </CCol>
</template>
<script>
   export default{
      name:"wallet",
        
   }
</script>