<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">Doctor <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>View</h5>
               <div class="">
                 <router-link :to="{ name: 'doctor'}">
                     <CButton size="sm" color="light">Back</CButton>
                  </router-link>
               </div>
            </div>
         </CCol>
         <CCol sm="12" class="p-2">
            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>Personal / General Info</strong>

                     <!-- {{doctorResult}} -->
                  </div>
               </CCardHeader> 
               <CCardBody class="px-1 py-2 view_page">
                  <CForm method="POST">
                     <CRow class="m-0">
                        <CCol sm="12" md="2" class="px-1">
                        <div class="form-group">
                           <div class="profile-img">
                              <div class="profileimg">
                              <img src="/uploads/profile/1626676073.jpg">
                              </div>
                           </div>
                        </div>
                     </CCol>
                     <CCol sm="12" md="10" class="px-2" >
                        <CRow class="m-0" >
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>First Name</label>
                              <h6>{{doctorResult.result.fullname}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Last Name</label>
                              <h6>{{doctorResult.result.fullname}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>User Name</label>
                              <h6>{{doctorResult.result.fullname}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Email</label>
                              <h6>{{doctorResult.result.email}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Phone No.</label>
                              <h6>{{doctorResult.result.phone_no}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Password</label>
                              <h6>Password</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Age</label>
                              <h6>{{doctorResult.result.age}}</h6>
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
                              <label>Autosearch Address</label>
                              <h6>Autosearch Address</h6>
                            </div>
                        </CCol>
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Address</label>
                              <h6> Address</h6>
                            </div>
                        </CCol>
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Address 2</label>
                              <h6>Address 2</h6>
                            </div>
                        </CCol>
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Area</label>
                              <h6>Area</h6>
                            </div>
                        </CCol>
                         <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>City</label>
                              <h6>City</h6>
                            </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Country</label>
                              <h6>Country</h6>
                            </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>latitude</label>
                              <h6>latitude</h6>
                            </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>longitude</label>
                              <h6>longitude</h6>
                            </div>
                        </CCol>

                      </CRow>
                    </CForm>
                  </CCardBody>
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
                              <h6>{{doctorResult.result.type}}</h6>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                              <div class="form-group">
                                 <label>Certificate awarding University</label>
                                 <div class="attch-button">
                                    <input type="file" name="file" id="file" class="inputfile" />
                                    <label for="file">
                                       <CIcon name="cil-file"/>
                                    </label> 
                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                              <div class="form-group">
                                 <label>Copy of specialty diploma</label>
                                 <div class="attch-button">
                                    <input type="file" name="file" id="file" class="inputfile" />
                                    <label for="file">
                                       <CIcon name="cil-file"/>
                                    </label> 
                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                              <div class="form-group">
                                 <label>Copy of registration in the doctor’s council (Medical council)</label>
                                 <div class="attch-button">
                                    <input type="file" name="file" id="file" class="inputfile" />
                                    <label for="file">
                                       <CIcon name="cil-file"/>
                                    </label> 
                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Medical License Number</label>
                              <h6>{{doctorResult.result.license_no}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Date of Registration</label>
                              <h6>{{doctorResult.date}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Registration No.</label>
                              <h6>{{doctorResult.result.regn_no}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Years of Experience</label>
                              <h6>{{doctorResult.result.experience}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Current Clinic/hospital of work</label>
                              <h6>{{doctorResult.result.clinic_address}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Radius of Dr's availability</label>
                              <h6>{{doctorResult.result.dr_availability}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Service(s) provided</label>
                              <h6>{{doctorResult.result.service_provided}}</h6>
                           </div>
                        </CCol>  
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Equipment list</label>
                              <ul class="d-flex justify-content-around m-0 p-0">
                                <!--  <li>A</li>
                                 <li>B</li>
                                 <li>C</li>
                                 <li>D</li>
                                 <li>E</li>

 -->                          
                                 A   
                               </ul>
                           </div>                        
                        </CCol>                 
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Willing to serve as</label>
                              <h6>{{doctorResult.result.willing_to_serve}}</h6>  
                           </div>
                        </CCol>
                        <!-- <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Enter your availability</label>
                              <h6>{{doctorResult.result.enter_your_availability}}</h6>
                           </div>
                        </CCol> -->
                         <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Area of Coverage</label>
                              <h6>{{doctorResult.result.area_of_coverage}}</h6>
                           </div>
                        </CCol>
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Brief summary about yourself (150 words)</label>
                              <h6>
                                 {{doctorResult.result.brief_summary}}     
                              </h6>
                           </div>
                        </CCol> 
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Terms and condition (policy and procedure of working together)</label>
                              <h6>
                                 {{doctorResult.result.terms_and_conditions}}
                              </h6>
                           </div>
                        </CCol>                                      
                     </CRow>
                  </CForm>
               </CCardBody>
            </CCard>
         </CCol>
        <!--  <CCol sm="3" class="p-2">
            <CCard>
               <CCardBody class="p-2">
                  <CForm method="POST">
                    
                  </CForm>
               </CCardBody>
            </CCard>
         </CCol> -->
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
        };
 },
  created() {
    if(this.$route.params.id != ''){
      this.getDoctorFormData(this.$route.params.id);
    }
  },
  computed: {
    ...mapGetters("Doctor/Index", ["doctorResult"]),
  },
  methods: {
    ...mapActions("Doctor/Index", ["getdoctorData"]),

   getDoctorFormData(id){
     this.getdoctorData(id);
       // this.formData.keys().forEach(key => {
       //     if(this.usersResult.result[key]){
       //       this.formData[key] = this.usersResult.result[key];
       //     }
       // });
     // });
   },

    checkstatus(id,type,status){
         if(type == "Approved"){
           this.aprovedDocument({ id: id , type: type, status: status}).then(() => {
            this.list(this.$route.params.id);
             if(this.returnData.status == 'success'){
               alert(this.returnData.message);
   
             }
           });
         }
       }

   // submitFormData() {
   //   this.submitForm({'id':this.$route.params.id,'formData':this.formData})
   //   .then(() => {
   //      this.$router.push({name:"users"});
   //   })
   //   .catch(error => {
   //      window.scrollTo(0,0);      
   //   });
   //  },
  }
}
</script> 
if(this.$route.params.id != ''){
      this.getUserFormData(this.$route.params.id);
    }
  },