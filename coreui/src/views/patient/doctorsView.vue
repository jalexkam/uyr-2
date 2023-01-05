<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">Doctor <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>View</h5>
               <div class="">

                 <span v-if="appointmentData.status != 'Accept'" class="alert_doctor">Your appointment has been under review!</span>

                 <router-link :to="{ name: 'view_patient' ,params: { id: appointmentData.patient_id }}" >
                     <CButton color="light">Back</CButton>
                  </router-link> 
                  
               </div>
            </div>
         </CCol>

        
          <CCol sm="9" class="p-2">
            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>Personal / General Info</strong>

                  </div>
               </CCardHeader> 
               <CCardBody class="px-1 py-2 view_page">
                  <CForm method="POST">
                     <CRow class="m-0">
                        <CCol sm="12" md="2" class="px-1">
                        <div class="form-group">
                           <div class="profile-img align-items-start">
                              <div class="profileimg">
                                 <img :src="'uploads/profile/'+doctorData.id+'/'+doctorData.profile_photo" v-if="doctorData.profile_photo">
                                 <img src="/uploads/profile/default-profile.png" v-else>
                              </div>
                           </div>
                        </div>
                     </CCol>
                     <CCol sm="12" md="10" class="px-2" >
                        <CRow class="m-0" >
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>First Name</label>
                              <h6>{{doctorData.first_name}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Last Name</label>
                              <h6>{{doctorData.last_name}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>User Name</label>
                              <h6>{{doctorData.user_name}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Email</label>
                              <h6>{{doctorData.email}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Phone No.</label>
                              <h6>{{doctorData.phone_number}}</h6>
                           </div>
                        </CCol>
                     
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Age</label>
                              <h6>{{doctorData.age}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                            <div class="form-group">
                              <label>Gender</label>
                              <h6>Male</h6>
                           </div>
                        </CCol>
                        </CRow>
                        </CCol>                                     
                     </CRow>
                  </CForm>
               </CCardBody>
            </CCard>

            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>Location</strong>
                  </div>
               </CCardHeader>
               <CCardBody class="px-1 py-2 view_page">
                  <CForm method="POST">
                     <CRow class="m-0">
                       <!--  <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Select Address</label>
                                <h6>{{doctorData.full_address}}</h6>
                            </div>
                        </CCol> -->
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Address</label>
                               <h6>{{doctorData.address}}</h6>
                            </div>
                        </CCol>
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Address 2</label>
                             <h6>{{doctorData.address2}}</h6>
                            </div>
                        </CCol>
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Area</label>
                              <h6>{{doctorData.area}}</h6>
                            </div>
                        </CCol>
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>City</label>
                                <h6>{{doctorData.city}}</h6>
                            </div>
                        </CCol>

                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>State</label>
                                <h6>{{doctorData.state}}</h6>
                            </div>
                        </CCol>

                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Country</label>
                                <h6>{{doctorData.country}}</h6>
                            </div>
                        </CCol>

                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Zip code</label>
                                <h6>{{doctorData.zip_code}}</h6>
                            </div>
                        </CCol>

                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>latitude</label>
                             <h6>{{doctorData.latitude}}</h6>
                            </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>longitude</label>
                                <h6>{{doctorData.longitude}}</h6>
                            </div>
                        </CCol>

                      </CRow>
                    </CForm>
                  </CCardBody>
                  <gmap-map :center="center" :zoom="17" data-fullscreen="true" style="width:100%;  height: 300px;">
                         <gmap-marker :key="index" v-for="(m, index) in markers" :position="m.position" @click="center=m.position">
                         </gmap-marker>
                     </gmap-map>

                </CCard>

                    


            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>ID and Licensing Credentials</strong>
                  </div>
               </CCardHeader>
               <CCardBody class="px-1 py-2 view_page">
                  <CForm method="POST">
                     <CRow class="m-0">
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Type</label>
                              <h6>{{doctorData.type}}</h6>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2" v-if="doctorData.certificate_awarding_university">
                              <div class="form-group">
                                 <label>Certificate awarding University</label>
                                  <div class="attch-button">
                                     <a :href="'uploads/doctor/'+doctorData.user_id+'/'+doctorData.certificate_awarding_university" download> Download <CIcon name="cil-file"/> </a>

                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2" v-if="doctorData.speciality_diploma">
                              <div class="form-group">
                                 <label>Copy of specialty diploma</label>
                                  <div class="attch-button">
                                     <a :href="'uploads/doctor/'+doctorData.user_id+'/'+doctorData.speciality_diploma" download> Download <CIcon name="cil-file"/> </a>

                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2" v-if="doctorData.copy_of_registration">
                              <div class="form-group">
                                 <label>Copy of registration in the doctor’s council (Medical council)</label>
                                 <div class="attch-button">
                                     <a :href="'uploads/doctor/'+doctorData.user_id+'/'+doctorData.copy_of_registration" download> Download <CIcon name="cil-file"/> </a>

                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Medical License Number</label>
                              <h6>{{doctorData.medical_license_number}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Date of Registration</label>
                              <h6>{{doctorData.date_of_registration}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Registration No.</label>
                              <h6>{{doctorData.registration_no}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Years of Experience</label>
                              <h6>{{doctorData.experience}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Current Clinic/hospital of work</label>
                              <h6>{{doctorData.clinic_address}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Radius of Dr's availability</label>
                              <h6>{{doctorData.dr_availability}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Service(s) provided</label>
                              <h6>{{doctorData.service_provided}}</h6>
                           </div>
                        </CCol>  
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Equipment list</label>
                              <ul class="d-flex justify-content-around m-0 p-0">
                               
                                 A   
                               </ul>
                           </div>                        
                        </CCol>                 
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Willing to serve as</label>
                              <h6>{{doctorData.willing_to_serve}}</h6>  
                           </div>
                        </CCol>
                        <!-- <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Enter your availability</label>
                              <h6>{{doctorData.enter_your_availability}}</h6>
                           </div>
                        </CCol> -->
                         <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Area of Coverage</label>
                              <h6>{{doctorData.area_of_coverage}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Brief summary about yourself (150 words)</label>
                              <h6>
                                 {{doctorData.brief_summary}}     
                              </h6>
                           </div>
                        </CCol> 
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Terms and condition (policy and procedure of working together)</label>
                              <h6>
                                 {{doctorData.terms_and_conditions}}
                              </h6>
                           </div>
                        </CCol>                                      
                     </CRow>
                  </CForm>
               </CCardBody>
            </CCard>
         </CCol>


         <CCol sm="3" >            
            <CCard class="doctor_inf_card time_slot_card">
              <CCardHeader class="p-2 px-3 bg_themes">
               <h6 class="mb-0">Available Time</h6>
              </CCardHeader>

              <CCardBody class="p-2" >
                     <div class="booking-summary">
                     <div class="booking-item-wrap">
                        <ul class="booking-date">
                           <li>Date <span>{{appointmentData.appointment_date}}</span></li>
                           <li>Time <span>{{appointmentData.appointment_time}}</span></li>
                        </ul>
                     </div>
                  </div>

               <router-link :to="{ name: 'appointment_checkout' ,params: { user_name:appointmentData.user_name,appointment_id:appointmentData.id }}" v-if="appointmentData.status == 'Accept'">
                  <CButton size="sm" class="btn_custom mx-auto d-block w-75 p-2 mb-3"  >
                 <vue-fontawesome icon="calendar-check-o" class="mr-1" size="0.8"></vue-fontawesome>Book Appointment
                  </CButton>
               </router-link>

               </CCardBody>
               
               <!-- <CCardBody class="p-2">
                  <CButton size="sm" color="warning" class="text-white mx-auto d-block w-75 p-2 mb-3">
                  <vue-fontawesome icon="star" class="mr-1" size="0.8"></vue-fontawesome>Add Favorite
                  </CButton>
               </CCardBody> -->

               
            </CCard>
           
         </CCol>

      </CRow>
   </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import Vue from 'vue';
import Vuex from 'vuex';
import Form from "vform";

export default {
   data() {
      return {
         center :  {lat: 0,lng: 0},
         markers:  [],
         patient_id:'',
         doctorData:[],
         appointmentData:[],
        };
   },
   created() {
       if(this.$route.params.id != ''){
         this.getDoctorFormData(this.$route.params.id);
       }
       if (this.$route.params.patient_id != undefined) this.patient_id = this.$route.params.patient_id;

   },

  computed: {
    ...mapGetters("Patient/Index", ["result"]),
  },

  methods: {
    ...mapActions("Patient/Index", ["getdoctorData"]),
   getDoctorFormData(id) {
         this.getdoctorData(id).then(() => {
           this.doctorData =  this.result.doctorData ;
           this.appointmentData =  this.result.appointmentData ;
               var lat = parseFloat(this.doctorData.latitude);
               var lng = parseFloat(this.doctorData.longitude);

                 const marker = {
                    lat: lat,
                    lng: lng
                  };
                  this.markers.push({ position: marker });
                  this.center = marker;
         });
        },

  }
}
</script> 

