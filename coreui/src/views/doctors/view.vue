<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">Doctor <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>View</h5>
               <div class="">
                     <CButton v-if="doctor_suggest_id" class="btn_custom" v-on:click="createAppointment()">Create Appointment
                     </CButton>

                 <router-link :to="{ name: 'searchDoctor' ,params: { id: this.doctor_suggest_id }}" v-if="doctor_suggest_id">
                     <CButton  color="light">Back</CButton>
                  </router-link>
                  <router-link :to="{ name: 'doctor'}" v-else>
                     <CButton  color="light">Back</CButton>
                  </router-link>

               </div>
            </div>
         </CCol>

        
          <div :class="doctor_suggest_id ? 'col-md-9' : 'col-md-12'" class="p-2">
           <!--  <CCol sm="9" class="p-2"> -->
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
                                 <img :src="'uploads/profile/'+doctorResult.id+'/'+doctorResult.profile_photo" v-if="doctorResult.profile_photo">
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
                              <h6>{{doctorResult.first_name}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Last Name</label>
                              <h6>{{doctorResult.last_name}}</h6>
                           </div>
                        </CCol>
                        <!-- <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>User Name</label>
                              <h6>{{doctorResult.user_name}}</h6>
                           </div>
                        </CCol> -->
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Email</label>
                              <h6>{{doctorResult.email}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Phone No.</label>
                              <h6>{{doctorResult.phone_number}}</h6>
                           </div>
                        </CCol>
                       <!--  <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Password</label>
                              <h6></h6>
                           </div>
                        </CCol> -->
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Age</label>
                              <h6>{{doctorResult.age}} Year</h6>
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
                        <!-- <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Select Address</label>
                                <h6>{{doctorResult.full_address}}</h6>
                            </div>
                        </CCol> -->
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Address</label>
                               <h6>{{doctorResult.address}}</h6>
                            </div>
                        </CCol>
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Address 2</label>
                             <h6>{{doctorResult.address2}}</h6>
                            </div>
                        </CCol>
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Area</label>
                              <h6>{{doctorResult.area}}</h6>
                            </div>
                        </CCol>
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>City</label>
                                <h6>{{doctorResult.city}}</h6>
                            </div>
                        </CCol>

                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>State</label>
                                <h6>{{doctorResult.state}}</h6>
                            </div>
                        </CCol>

                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Country</label>
                                <h6>{{doctorResult.country}}</h6>
                            </div>
                        </CCol>

                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Zip code</label>
                                <h6>{{doctorResult.zip_code}}</h6>
                            </div>
                        </CCol>

                        <!-- <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>latitude</label>
                             <h6>{{doctorResult.latitude}}</h6>
                            </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>longitude</label>
                                <h6>{{doctorResult.longitude}}</h6>
                            </div>
                        </CCol> -->

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
                              <h6>{{doctorResult.type_name}}</h6>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2" v-if="doctorResult.certificate_awarding_university">
                              <div class="form-group">
                                 <label>Certificate awarding University</label>
                                  <div class="attch-button">
                                     <a :href="'uploads/doctor/'+doctorResult.user_id+'/'+doctorResult.certificate_awarding_university" download> Download <CIcon name="cil-file"/> </a>

                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2" v-if="doctorResult.speciality_diploma">
                              <div class="form-group">
                                 <label>Copy of specialty diploma</label>
                                  <div class="attch-button">
                                     <a :href="'uploads/doctor/'+doctorResult.user_id+'/'+doctorResult.speciality_diploma" download> Download <CIcon name="cil-file"/> </a>

                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2" v-if="doctorResult.copy_of_registration">
                              <div class="form-group">
                                 <label>Copy of registration in the doctor’s council (Medical council)</label>
                                 <div class="attch-button">
                                     <a :href="'uploads/doctor/'+doctorResult.user_id+'/'+doctorResult.copy_of_registration" download> Download <CIcon name="cil-file"/> </a>

                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Medical License Number</label>
                              <h6>{{doctorResult.medical_license_number}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Date of Registration</label>
                              <h6>{{doctorResult.date_of_registration}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Registration No.</label>
                              <h6>{{doctorResult.registration_no}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Years of Experience</label>
                              <h6>{{doctorResult.experience}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Current Clinic/hospital of work</label>
                              <h6>{{doctorResult.current_clinic_hospital}}</h6>
                           </div>
                        </CCol>
                        <!-- <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Radius of Dr's availability</label>
                              <h6>{{doctorResult.dr_availability}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Service(s) provided</label>
                              <h6>{{doctorResult.service_provided}}</h6>
                           </div>
                        </CCol>   -->
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Equipment list</label>
                              <ul class="d-flex justify-content-around m-0 p-0" v-for="(row, index) in doctorResult.equipmentArr" :key="index" >
                                 {{row.equipment_name}}
                               </ul>
                           </div>                        
                        </CCol>                 
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Willing to serve as</label>
                              <h6>{{doctorResult.service_name}}</h6>  
                           </div>
                        </CCol>
                        <!-- <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Enter your availability</label>
                              <h6>{{doctorResult.availability_time_from}}</h6>
                           </div>
                        </CCol> -->
                         <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Area of Coverage</label>
                              <h6>{{doctorResult.area_of_coverage}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Brief summary about yourself (150 words)</label>
                              <h6>
                                 {{doctorResult.brief_summary}}     
                              </h6>
                           </div>
                        </CCol> 
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Terms and condition (policy and procedure of working together)</label>
                              <h6>
                                 {{doctorResult.terms_and_conditions}}
                              </h6>
                           </div>
                        </CCol>                                      
                     </CRow>
                  </CForm>
               </CCardBody>
            </CCard>
         </div>


         <CCol sm="3" class="p-2" v-if="doctor_suggest_id">            
            <CCard class="doctor_inf_card time_slot_card">
              <CCardHeader class="p-2 px-3 bg_themes">
               <h6 class="mb-0">Available Time</h6>
              </CCardHeader>
               <CCardBody class="p-2">
                
                 <div class="form-group mt-2 mb-3">
                    <datepicker v-model="appointment_date" type="date" color="#2c449e" format="dd MMMM, yyyy" @selected="selected" :disabledDates="disabledDates" :bootstrap-styling="true"></datepicker>
                  <!--  <date-picker v-model="appointment_date" type="date" format="DD/MM/YYYY"  min="01/01/1980" color="#2c449e" @change="datepickerClosedFunction"  confirm ></date-picker> -->
               </div>

                <div class="available_time mt-2">
                   <label class="time-radio" v-bind:class="{ booked: time_slot.status}"  v-for="time_slot in getSlotData.bookslot">
                      <input type="radio" name="radio"  :value="time_slot.time" v-model="appointment_time" checked="checked" :disabled="time_slot.status"> 
                      <span class="checkmark"> {{time_slot.time}}</span>
                   </label>
               </div>
              <!--  background: #fa0c17 -->
               <!-- <div class="available_time mt-2">
                   <label class="time-radio" v-for="time in resultDateTime.datetimeArr">
                      <input type="radio" name="radio"  :value="time" v-model="appointment_time" checked="checked"> 
                      <span class="checkmark"> {{time}}</span>
                   </label>
               </div> -->
             </CCardBody>
               
            </CCard>
            <CCard>
              <!--  <CCardBody class="p-2">
                  <CButton size="sm" color="warning" class="text-white mx-auto d-block w-75 p-2 mb-3">
                  <vue-fontawesome icon="star" class="mr-1" size="0.8"></vue-fontawesome>Add Favorite</CButton>
               </CCardBody> -->
            </CCard>
         </CCol>

      </CRow>
   </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
//import VueDatetimePickerJs from 'vue-date-time-picker-js';
import Vue from 'vue';
import Vuex from 'vuex';
import Form from "vform";
import VueDatetimePickerJs from 'vue-date-time-picker-js';
import Datepicker from 'vuejs-datepicker';
export default {
   components: {
     datePicker: VueDatetimePickerJs,
     Datepicker
  },
  
   data() {
      return {
         center :  {lat: 0,lng: 0},
         markers:  [],
         doctor_suggest_id:'',
         appointment_date:"",
         appointment_time:"",
         doctor_id:"",
         disabledDates: {
              to: new Date(Date.now() - 86400000)
            }

        };
   },
   created() {
       this.getDateTime();
       if(this.$route.params.id != '' && this.$route.params.id != undefined){
         this.getDoctorFormData(this.$route.params.id);
         this.doctor_id = this.$route.params.id;
       }
       if (this.$route.params.doctor_suggest_id != undefined)
        {
         this.doctor_suggest_id = this.$route.params.doctor_suggest_id;
         this.get_doctor_slots();
        }
   },

  computed: {
       ...mapGetters("Doctor/Index", ["doctorResult",'getSlotData']),
       ...mapGetters("Appointment/Index", ["result","returnData"]),
       ...mapGetters("Masters/AvailabilityMaster", ["resultDateTime"]),
  },

  methods: {
    ...mapActions("Doctor/Index", ["getdoctorData",'get_doctor_bookSlots']),
    ...mapActions("Appointment/Index", ["searchDoctor","create_appointment"]),
    ...mapActions("Masters/AvailabilityMaster", ["getDateTime"]),

   getDoctorFormData(id) {
         this.getdoctorData(id).then(() => {
            this.appointment_date = this.doctorResult.appointment_date;
               var lat = parseFloat(this.doctorResult.latitude);
               var lng = parseFloat(this.doctorResult.longitude);
                 const marker = {
                    lat: lat,
                    lng: lng
                  };
                  this.markers.push({ position: marker });
                  this.center = marker;
         });
        },

         get_doctor_slots(){
            this.get_doctor_bookSlots({ appointment_date: this.appointment_date,doctor_id:this.doctor_id }).then(() => {

            });
         },


   createAppointment(){
      console.log(this.appointment_time);
      if(this.appointment_date =='' || this.appointment_time =='' ){
             Vue.$toast.open({
                   message: "Please Select Appointment date time",
                   type: 'error',
                   duration: 5000,
                   dismissible: true
                 });
            }else{
            this.create_appointment({ appointment_date: this.appointment_date, appointment_time: this.appointment_time,doctor_suggest_id:this.doctor_suggest_id,doctor_id:this.doctor_id }).then(() => {
               if (this.returnData.status == 'success') {
                 Vue.$toast.open({
                        message: this.returnData.message,
                        type: this.returnData.status,
                    });
               
               console.log(this.returnData.pId)
               console.log(this.returnData.appointment_id)
                this.$router.push({ name: 'appointment_checkout',params: {patient_id:this.returnData.pId,appointment_id:this.returnData.appointment_id}});
               }
            });
      }
   },
   selected: function(appointment_date){
       this.get_doctor_bookSlots({ appointment_date: appointment_date,doctor_id:this.doctor_id });
    },
  }
}
</script> 