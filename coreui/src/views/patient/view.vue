<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">
                  Patient 
                  <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>
                  View
               </h5>
               <div class="">
                  <router-link :to="{ name: 'patient' }" >
                     <CButton color="light">Back</CButton>
                  </router-link>
               </div>
            </div>
         </CCol>
         <CCol sm="9" class="p-2 patient_accordion">
            <CCard class="mb-3">
               <CCardHeader class="p-2 px-3 bg_themes">              
                  <div>
                     <strong>Patient Info</strong>
                  </div>
               </CCardHeader>
               <!-- <CCollapse :show="accordion === 0"> -->
                  <CCardBody class="px-1 py-2">
                     <CRow class="m-0">
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Full Name</label>
                              <h6>{{patientData.full_name}} </h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Contact No</label>
                              <h6>{{patientData.phone_number}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Email</label>
                              <h6>{{patientData.email}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Address</label>
                              <h6>{{patientData.address}}</h6>
                           </div>
                        </CCol>
                     </CRow>
                  </CCardBody>
               <!-- </CCollapse> -->
            </CCard>
            <vue-tabs class="pateint_view_tab">
                  <v-tab title="Appointmenttt">
                     <div class="">
            <CCard class="mb-3">
               <CCardBody class="px-1 py-2">
                  <div class="table-responsive">
                     <table class="table table-striped table-hover">
                        <thead>
                           <tr>
                              <th>Appointment ID</th>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Doctor Name</th>
                              <th>Fees</th>
                              <th class="text-center">Status</th>
                              <th width="80"></th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="(row,index) in appointmentData">
                              <td>#{{ index + 1 }}</td>
                              <td>{{ row.appointment_date }}</td>
                              <td>{{ row.appointment_time }}</td>
                              <td>{{row.doctorName}}</td>
                              <td>{{row.fees_amount}}/-</td>
                              <td class="text-center">
                                <CBadge color="warning" v-if="row.status =='Pending'">{{row.status}}</CBadge>
                                <CBadge color="success" v-if="row.status =='Accept'">{{row.status}}</CBadge>
                                <CBadge color="danger" v-if="row.status =='Reject'">{{row.status}}</CBadge>
                              </td>
                              <td>
                                 <router-link :to="{ name: 'view_patient_doctor' ,params: { id: row.id}}">
                                    <CButton size="sm" color="info">
                                       <vue-fontawesome icon="eye" class="mr-2" size="0.8"></vue-fontawesome>
                                       View
                                    </CButton>
                                 </router-link>
                                 
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </CCardBody>
            <!-- </CCollapse> -->
            </CCard>
         </div>
      </v-tab>
       <v-tab title="Prescriptions">
         <div class="">
            <CCard class="mb-3">
               <CCardBody class="px-1 py-2">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Date</th>
                              <th>Appointment date</th>
                              <th>Appointment time</th>
                              <th>Doctor Name</th>
                              <th width="80"></th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="(row,index) in patientPrescriptions">
                              <td>{{row.id}}</td>
                              <td>{{row.date}}</td>
                              <td>{{row.appointment_date}}</td>
                              <td>{{row.appointment_time}}</td>
                               <td>Dr.{{row.doctorName}}</td>
                              <td>
                                 <CButton size="sm" color="info" @click="prescription_view_model(row.appointment_id,row.id)">
                                    <vue-fontawesome icon="eye" class="mr-2" size="0.8"></vue-fontawesome>
                                    View
                                 </CButton>
                              </td>
                           </tr>
                        
                        </tbody>
                     </table>
                  </div>
               </CCardBody>
            <!-- </CCollapse> -->
            </CCard>
         </div>
      </v-tab>
       <v-tab title="Medical Report">
                     <div class="">
            <CCard class="mb-3">
              <!--  <CButton block color="link" class="text-left shadow-none card-header p-2" @click="accordion = accordion === 3 ? false : 3"  v-bind:class = "(accordion === 3)?'active':''">
                  <div>
                     <strong>Medical Report</strong>
                  </div>
            </CButton>
               <CCollapse :show="accordion === 3"> -->

               <CCardBody class="px-1 py-2">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr >
                              <th>ID</th>
                              <th>Date</th>
                              <th>Description</th>
                              <th>Attachment</th>
                              <th>Created</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="(row,index) in medicalReportsData" :key="index">
                             <td># {{row.id}}</td>
                              <td> {{row.date}}</td>
                              <td>{{row.description}}</td>
                              <td>
                                 <a :href="'uploads/patient/'+row.user_id+'/report/'+row.attach_report" target="_blank">
                                      {{row.attach_report}}
                                    </a>
                              </td>
                               <td>Dr. {{row.doctorName}}</td>
                              <td width="80">
                                 <CButton size="sm" color="" class="btn-outline-primary" title="Print">
                                     <a :href="'uploads/patient/'+row.user_id+'/report/'+row.attach_report" download>
                                       <vue-fontawesome icon="print" size="0.8"></vue-fontawesome>
                                    </a>
                                 </CButton>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </CCardBody>
            <!-- </CCollapse> -->
            </CCard>
         </div>
      </v-tab>
   </vue-tabs>
         </CCol>
         <CCol sm="3" class="p-2">
            <CCard>
               <!--<CCardBody class="p-2">
                   <router-link :to="{ name: 'suggest_doctor',params: { id: patientData.patient_id } }">
                     <CButton size="sm"color="warning"class="text-white d-block w-75 mx-auto p-2">
                        <vue-fontawesome icon="calendar-check-o" class="mr-2" size="0.8"></vue-fontawesome>
                        Suggest Doctor
                     </CButton>
                  </router-link> -->
                   <!-- <router-link class="p-2" :to="{ name: 'searchDoctor',params: { id: patientData.patient_id } }">
                     <CButton size="sm"color="success"class="text-white d-block w-75 mx-auto p-2">
                        <vue-fontawesome icon="calendar-check-o" class="mr-2" size="0.8"></vue-fontawesome>
                       Find by myself 
                     </CButton>
                  </router-link>

               </CCardBody> -->
            </CCard>
         </CCol>

         <CModal
            title="Patient Prescription"
            :show.sync="prescriptionShow"
            :closeOnBackdrop="false"
            size="lg"
            addContentClasses="medical_report_card"
            >
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
         </CModal>

      </CRow>



   </div>
</template>
<script>
   import { mapGetters, mapActions } from "vuex";
   import Vue from 'vue';
   import Vuex from 'vuex';
   import Form from "vform";
   import {VueTabs, VTab} from 'vue-nav-tabs';
   import 'vue-nav-tabs/themes/vue-tabs.css';
   import viewPrescription from "./../components/viewPrescription"
   
   export default {
         components: {
            viewPrescription,
         },
      data() {
         return {
            accordion: 0,
            prescriptionShow:false,
            center :  {lat: 0,lng: 0},
            markers:  [],
            patientData:[],
            appointmentData:[],
            medicalReportsData:[],
            patientPrescriptions:[],
            doctorPatientData:[],
            patientPrescriptionData:[],
           };
      },
      components: {
        VueTabs,
        VTab,
     },
      created() {
          if(this.$route.params.id != ''){
            this.getPatientFormData(this.$route.params.id);
          }
      },
   
     computed: {
       ...mapGetters("Patient/Index", ["result"]),
       ...mapGetters("Doctor/Index", ["prescriptionData","PatientDoctor"]),
     },
   
     methods: {
       ...mapActions("Patient/Index", ["getPatientDetailsData"]),
        ...mapActions("Doctor/Index", ["getPatientDoctorinfoAppointment","getPrescriptionData"]),
      
      getPatientFormData(id) {
            this.getPatientDetailsData(id).then(() => {
               this.patientData = this.result.patientData;
               this.appointmentData = this.result.appointmentData;
               this.medicalReportsData = this.result.medicalReportsData;
               this.patientPrescriptions = this.result.patientPrescriptions;
               

                  var lat = parseFloat(this.patientData.latitude);
                  var lng = parseFloat(this.patientData.longitude);
   
                    const marker = {
                       lat: lat,
                       lng: lng
                     };
                     this.markers.push({ position: marker });
                     this.center = marker;
            });
           },

     
       prescription_view_model(appointment_id,id){
         this.prescriptionShow  = true;

         this.getPatientDoctorinfoAppointment(appointment_id).then(() => {
                 this.doctorPatientData =  this.PatientDoctor.doctorPatientData;
               });

            this.getPrescriptionData(id).then(() => {
                this.patientPrescriptionData =  this.prescriptionData.patientPrescriptionData;
               });


      },

   
     }
   }
</script>