 <template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 mx-auto">
            <CCard>
               <!-- <CCardHeader class="px-3 py-2">
                  <h5 class="mb-0 px-2">Add Prescription</h5>
               </CCardHeader> -->
               <CCardBody class="p-3">
                  <CRow class="mx-0">
                     <CCol md="6" class="px-2">
                        <div class="dr_infom">
                           <img src="images/uyr_logo.png" width="120px">
                        </div>
                     </CCol>
                      <CCol md="6" class="px-2 mt-3 text-right">
                        <div class="dr_infom">
                           <span>{{doctorPatientData.date}}</span>
                           <span>#INV001</span>
                        </div>
                     </CCol>
                     <CCol md="6" class="px-2 mt-3">
                        <div class="dr_infom">
                           <h4>Docotor Info</h4>
                           <span>{{doctorPatientData.doctorName}}</span>
                           <span>{{doctorPatientData.Speciality}}</span>
                           <span>{{doctorPatientData.doctorAddress}}</span>
                        </div>
                     </CCol>
                     <CCol md="6" class="px-2 mt-3 text-right">
                        <div class="dr_infom">
                           <h4>Patient Info</h4>
                           <span>{{doctorPatientData.patientName}}</span>
                           <span>{{doctorPatientData.patientAddress}}</span>
                        </div>
                     </CCol>                    
                     <CCol md="12" class="px-2">
                        <div class="Prescription_table mt-3">
                           <table class="table table-bordered text-center">
                              <thead>
                                 <tr>
                                    <th rowspan="2">Name</th>
                                    <th rowspan="2" width="80">Quantity</th>
                                    <th rowspan="2" width="60">Days</th>
                                    <th colspan="4">Time</th>
                                 </tr>
                                 <tr>
                                    <th>Morning</th>
                                    <th>Afternoon</th>
                                    <th>Evening</th>
                                    <th>Night</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr  v-for="(prescription,index) in patientPrescriptionData">
                                    <td>{{prescription.title}} </td>
                                    <td>{{prescription.qty}}</td>
                                   <td>{{prescription.days}}</td>
                                    <td>
                                      <vue-fontawesome icon="check"
                                      v-bind:class = "(prescription.morning == 1)?'text-success':'text-danger'" 
                                      size="0.8">
                                     </vue-fontawesome>
                                    </td>
                                    <td>
                                       <vue-fontawesome icon="check"
                                      v-bind:class = "(prescription.afternoon == 1)?'text-success':'text-danger'" 
                                      size="0.8">
                                     </vue-fontawesome>
                                    </td>
                                    <td>
                                       <vue-fontawesome icon="check"
                                      v-bind:class = "(prescription.evening == 1)?'text-success':'text-danger'" 
                                      size="0.8">
                                     </vue-fontawesome>
                                    </td>
                                    <td>
                                      <vue-fontawesome icon="check"
                                      v-bind:class = "(prescription.night == 1)?'text-success':'text-danger'" 
                                      size="0.8">
                                     </vue-fontawesome>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="doctor_signature">
                           <div class="dr_sign">
                              <!-- <img src="images/uyr_logo.png"> -->
                           </div>
                           <p class="mb-0">( Dr. {{doctorPatientData.doctorName}} )</p>    
                           <span>{{doctorPatientData.Speciality}} </span>                          
                        </div>
                     </CCol>
                  </CRow>
               </CCardBody>
            </CCard>
         </CCol>
      </CRow>
   </div>
</template>
<script>
   import Vue from 'vue'
   
   export default{
        name: 'viewPrescription',
        props: ['doctorPatientData',"patientPrescriptionData"],
    
   }
   
</script>