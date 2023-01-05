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
                  <router-link :to="{ name: 'doctor_appointment' }" >
                     <CButton color="light">Back</CButton>
                  </router-link>
               </div>
            </div>
         </CCol>
         <CCol sm="9" class="p-2">
            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>Patient Info</strong>
                  </div>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CRow class="m-0">
                     <CCol sm="6" md="4" class="px-2">
                        <div class="form-group">
                           <label>Full Name</label>
                           <h6>{{patientData.patientName}}</h6>
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
            </CCard>
            <CCard class="mt-3">
               <vue-tabs class="pateint_view_tab">
                  <v-tab title="Medical History">
                     <div class="">
                        <CCard class="mb-0">
                           <!--    <h4 class="card-title d-flex justify-content-between">
                              <span>Medical History</span> 
                              </h4> -->
                           <CCardBody class="px-1 py-2 view_page">
                              <CRow class="m-0">
                                 <CCol sm="12" md="12" class="px-2" v-if="medicalData.medical_history">
                                    <div class="form-group m_hist">
                                       <label>Do you know if {{patientData.patientName}} suffers from any of the following?</label>
                                       <h6>
                                          <ul class="d-flex flex-wrap">
                                             <li  v-for="(history,index) in medicalData.medical_history">{{history}}</li>
                                          </ul>
                                       </h6>
                                    </div>
                                 </CCol>
                                 <CCol sm="12" md="12" class="px-2" v-if="medicalData.description">
                                    <div class="form-group m_hist">
                                       <label>If you have ticked any of the above, please give details:</label>
                                       <h6>
                                         {{medicalData.description}}
                                       </h6>
                                    </div>
                                 </CCol>
                              </CRow>
                           </CCardBody>
                        </CCard>
                     </div>
                  </v-tab>
                  <v-tab title="Appointment">
                     <div class="">
                        <CCard class="mb-0">
                           <!-- <h4 class="card-title d-flex justify-content-between">
                              <span>Appointment</span> 
                              </h4> -->
                           <CCardBody class="px-1 py-2">
                              <div class="table-responsive">
                                 <table class="table">
                                    <thead>
                                       <tr  >
                                          <th width="130">Appointment ID</th>
                                          <th>Date</th>
                                          <th>Time</th>
                                          <th>Doctor Name</th>
                                          <th>Fees</th>
                                          <th class="text-center">Status</th>
                                          <th class="text-center">Payment Status</th>
                                          <!-- <th width="90">Actions</th> -->
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr v-for="(row,index) in appointmentData">
                                          <td>{{row.id}}</td>
                                          <td>{{row.appointment_date}}</td>
                                          <td>{{row.appointment_time}}</td>
                                          
                                          <td>{{row.doctorName}}</td>
                                          <td v-if="row.status =='Accept'">{{ row.fees_amount }}/-</td>
                                          <td v-else>-</td>
                                          <td class="text-center">
                                              <CBadge color="warning" v-if="row.status =='Pending'">{{row.status}}</CBadge>
                                               <CBadge color="success" v-if="row.status =='Accept'">{{row.status}}</CBadge>
                                               <CBadge color="danger" v-if="row.status =='Reject'">{{row.status}}</CBadge>
                                          </td>

                                          <td class="text-center">
                                             -
                                            <!--  <span class="text-success border-success px-2 p-status">Paid</span> 
                                            <span class="text-warning border-warning px-2 p-status">Pending</
                                             <span class="text-danger border-danger px-2 p-status">Failed</span>
                                            -->
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </CCardBody>
                        </CCard>
                     </div>
                  </v-tab>
                  <v-tab title="Prescription">
                     <div class="">
                        <div class="text-right mb-2">
                           <router-link :to="{ name: 'doctor_add_prescription' ,params: { id: appointment_id }}">
                                 <CButton size="sm" class="btn-flex btn_custom">
                                    <vue-fontawesome icon="plus" class="mr-2" size="0.8"></vue-fontawesome>
                                 Add Prescription
                              </CButton>
                           </router-link>
                           </div>
                        <CCard class="mb-0">                            
                           <CCardBody class="px-1 py-2">
                              <div class="table-responsive">
                                 <table class="table">
                                    <thead>
                                       <tr>
                                          <th>Sr.No</th>
                                          <th>Date</th>
                                          <th width="80"></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr v-for="(prescription, index) in patientPrescriptions">
                                         <td>{{ index + 1 }}</td>
                                        <td>{{prescription.date}}</td>
                                       <!-- <td>Prescription 1</td>
                                       <td>Dr. George Anderson</td> -->
                                          <td>
                                             <CButtonGroup size="sm">

                                             <CButton size="sm" color="" class="btn-outline-info" title="View"  @click="prescription_view_model(prescription.id)" data-toggle="modal"
                                                      data-target="#fulfill_order_attachment">
                                             <vue-fontawesome icon="eye" size="0.8"></vue-fontawesome>
                                             </CButton>
                                             <CButton size="sm" color="" class="btn-outline-primary" title="Print">
                                             <vue-fontawesome icon="print" size="0.8"></vue-fontawesome>
                                             </CButton>

                                             <CButton size="sm" color="" class="btn-outline-danger" title="Delete">
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
                     </div>
                  </v-tab>
                  <v-tab title="Medical Reports">
                     <div class="">
                        <div class="text-right mb-2">
                                 <CButton size="sm" class="btn-flex btn_custom"  @click="myModal = true">
                                    <vue-fontawesome icon="plus" class="mr-2" size="0.8"></vue-fontawesome>Add Medical Reports</CButton>
                           </div>
                        <CCard class="mb-0">
                            
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
                                             <CButtonGroup size="sm">
                                           <CButton size="sm" color="" class="btn-outline-primary" title="Print">
                                              <a :href="'uploads/patient/'+row.user_id+'/report/'+row.attach_report" download>
                                                <vue-fontawesome icon="print" size="0.8"></vue-fontawesome>
                                             </a>
                                          </CButton>

                                       <CButton size="sm" color="" class="btn-outline-danger" title="Delete"  @click="MultiAction(row.report_id, 'Delete')" >
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
                     </div>
                  </v-tab>
               </vue-tabs>
            </CCard>
         </CCol>
      </CRow>
      <CModal
      title="Medical Records"
      :show.sync="myModal"
      :closeOnBackdrop="false"
      addContentClasses="medical_report_card"
    >
      <div class="medical_report">
         <div class="form-group d-flex">
            <label class="label" for="medical_report">Upload Report</label>
            <div class="custom-file">
               <input type="file" id="customFile" class="custom-file-input" v-on:change="onChange"> 
              
               <label for="customFile" class="custom-file-label" v-if="attach_report_name">{{attach_report_name}}</label>
                <label for="customFile" class="custom-file-label" v-else>Choose file</label>

            </div>
         </div>
         <div class="form-group d-flex">
            <label class="label">Description<br> (Optional)</label>
            <textarea class="form-control" v-model="formData.description"></textarea>
         </div>
         <div class="form-group mb-0 border-top pt-2 mt-3 text-right">
            <CButton size="sm" class="btn_custom" @click="submitform">Submit</CButton>
            <CButton size="sm" color="light" @click="closeModal()">Close</CButton>
         </div>
      </div>
    </CModal>

     <CModal
      title="Patient Prescription"
      :show.sync="viewPrescription"
      :closeOnBackdrop="false"
      size="lg"
      addContentClasses="medical_report_card"
    >
    <viewPrescription :doctorPatientData="doctorPatientData" :patientPrescriptionData="patientPrescriptionData"> </viewPrescription>
 </CModal>
   </div>
</template>
<script>
   import { mapGetters, mapActions } from "vuex";
   import Vue from 'vue'
    import Form from "vform";
   import {VueTabs, VTab} from 'vue-nav-tabs';
   import 'vue-nav-tabs/themes/vue-tabs.css';
   import Swal from 'sweetalert2';
   import viewPrescription from "./../components/viewPrescription"
   export default{
      components: {
            VueTabs,
            VTab,
            viewPrescription,
         },

      data(){
         return{
           formData: new Form({
               description:''
            }),

         myModal: false,
         viewPrescription:false,
         appointment_id:"",
         patientData:[],
         medicalData:[],
         appointmentData:[],
         medicalReportsData:[],
         patientPrescriptions:[],
         doctorPatientData:[],
         patientPrescriptionData:[],
         attach_report:'',
         doctor_id:"",
         attach_report_name:"",

         }
      },

      created() {
          if(this.$route.params.id != '' && this.$route.params.id != undefined){
            this.getPatientAppointment(this.$route.params.id);
            this.appointment_id = this.$route.params.id;
          }
       },

       computed: {
             ...mapGetters("Doctor/Index", ["result","returnData","prescriptionData","PatientDoctor"]),
           },

      methods:{
         ...mapActions("Doctor/Index", ["getPatientDoctorinfoAppointment","getPatientAppointmentData","submitMedicalReport","DeleteAttachment","getPrescriptionData"]),
        getPatientAppointment(id) {
          this.getPatientAppointmentData(id).then(() => {
          this.patientData = this.result.patientData;
          this.patient_id  = this.result.patientData.patient_id;
           this.doctor_id  = this.result.patientData.doctor_id;
          this.medicalData = this.result.medicalData;
          this.appointmentData = this.result.appointmentData;
          this.medicalReportsData = this.result.medicalReportsData;
          this.patientPrescriptions = this.result.patientPrescriptions;
         });
        },

          onChange(e) {
            this.attach_report = e.target.files[0];
            this.attach_report_name = this.attach_report.name;
          },

          submitform(){
             let newData  =  new FormData();
              if(this.attach_report =='' || this.attach_report =='undefined'){
             Vue.$toast.open({
                   message: "Please Select Report!",
                   type: 'error',
                   duration: 5000,
                   dismissible: true
                 });
            }else{
             newData.append('patient_id',this.patient_id);
             newData.append('appointment_id',this.appointment_id);
             newData.append('description',this.formData.description);
             newData.append('attach_report',this.attach_report);
             newData.append('doctor_id',this.doctor_id);
             this.submitMedicalReport({newData:newData,appointment_id:this.appointment_id}).then(()=> {
                   if (this.returnData.status == 'success') {
                       Vue.$toast.open({
                              message: this.returnData.message,
                              type: this.returnData.status,
                          });
                        this.myModal = false;
                        this.getPatientAppointment(this.$route.params.id);
                        this.attach_report ='';
                        this.attach_report_name="";
                        this.formData.description="";
                     }
                });
            }
          },

         MultiAction(id, action) {
            Swal.fire({
                title: 'Are you sure',
                text: 'Do you really want to ' + action + ' ' + 'This record',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: action,
                confirmButtonColor: '#dd4b39',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    this.DeleteAttachment({ id: id, action: action }).then(() => {
                        if (this.returnData.status == 'success') {
                              Vue.$toast.open({
                                   message: this.returnData.message,
                                   type: this.returnData.status,
                               });
                           this.getPatientAppointment(this.$route.params.id);
                        }
                    });
                }
            });
        },

      prescription_view_model(id){
          this.viewPrescription = true;
           this.getPatientDoctorinfoAppointment(this.appointment_id).then(() => {
                 this.doctorPatientData =  this.PatientDoctor.doctorPatientData;
               });
           
            this.getPrescriptionData(id).then(() => {
                this.patientPrescriptionData =  this.prescriptionData.patientPrescriptionData;
               });


      },

      closeModal(){
            this.myModal = false;
         }
      }
    
   }
   
</script>
<style>
   
</style>