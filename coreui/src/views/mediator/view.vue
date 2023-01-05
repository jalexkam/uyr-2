<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0"> Mediator Doctor <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome> </h5>
               <div class="">
                 <router-link :to="{ name: 'mediator'}">
                     <CButton color="light">Back</CButton>
                  </router-link>
               </div>
            </div>
         </CCol>
         <CCol sm="12" class="p-2">
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
                           <div class="profile-img">
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
                              <h6>{{doctorResult.age}}</h6>
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
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Select Address</label>
                                <h6>{{doctorResult.full_address}}</h6>
                            </div>
                        </CCol>
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

                        <CCol sm="6" md="3" class="px-2">
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
                              <h6>{{doctorResult.type}}</h6>
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
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Radius of Dr's availability</label>
                              <h6>{{doctorResult.availability_time_from}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Service(s) provided</label>
                              <h6>{{doctorResult.service_provided}}</h6>
                           </div>
                        </CCol>  
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Equipment list</label>
                              <!-- <ul class="d-flex justify-content-around m-0 p-0">
                                 {{doctorResult.equipment}}  
                               </ul> -->
                               <ul class="d-flex justify-content-around m-0 p-0" v-for="(row, index) in doctorResult.equipmentArr" :key="index" >
                                 {{row.equipment_name}}
                               </ul>
                           </div>                        
                        </CCol>                 
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Willing to serve as</label>
                              <h6>{{doctorResult.willing_to_serve}}</h6>  
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
        };
   },
   created() {
       if(this.$route.params.id != ''){
         this.getDoctorFormData(this.$route.params.id);
       }
   },

  computed: {
    ...mapGetters("Mediator/Index", ["doctorResult"]),
  },

  methods: {
    ...mapActions("Mediator/Index", ["getMediatorData"]),
   getDoctorFormData(id) {
         this.getMediatorData(id).then(() => {
               var lat = parseFloat(this.doctorResult.latitude);
               var lng = parseFloat(this.doctorResult.longitude);

                 const marker = {
                    lat: lat,
                    lng: lng
                  };
                  //console.log(marker);
                  this.markers.push({ position: marker });
                  this.center = marker;
         });
        },

  }
}
</script> 