<template>

   <div>
   
    <CRow class="m-0">
        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="users" size="1" class="mr-2"></vue-fontawesome>Total Doctors</h6>
                    <h4 class="mb-1">{{doctorCount.doctorTotal}}</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>{{doctorCount.doctorActive}}</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>{{doctorCount.doctorInactive}}</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol>

        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow warning mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="user-circle-o" size="1" class="mr-2"></vue-fontawesome>Total Patients</h6>
                    <h4 class="mb-1">{{patientCount.patientTotal}}</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>{{patientCount.patientActive}}</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>{{patientCount.patientInactive}}</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol>
        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow danger mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="thermometer-three-quarters" size="1" class="mr-2"></vue-fontawesome>Total Appointments</h6>
                    <h4 class="mb-1">430</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>9</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>419</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol>

        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow success mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="tasks" size="1" class="mr-2"></vue-fontawesome>Total Mediator doctors</h6>
                    <h4 class="mb-1">11</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>11</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>0</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol>

        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow danger mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="users" size="1" class="mr-2"></vue-fontawesome>Total Sales</h6>
                    <h4 class="mb-1">26</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>25</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>1</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol>
        
        <CCol lg="3" sm="6" class="px-2" v-if="user.role_type == 1">
            <CCard class="py-2 px-3 dcard_shadow success mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="user-circle-o" size="1" class="mr-2"></vue-fontawesome>Total Admins</h6>
                    <h4 class="mb-1">{{adminCount.adminTotal}}</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>{{adminCount.adminActive}}</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>{{adminCount.adminInactive}}</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol>
        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="thermometer-three-quarters" size="1" class="mr-2"></vue-fontawesome>Revenue</h6>
                    <h4 class="mb-1">430</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>9</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>419</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol>
      <!--   <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow warning mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="tasks" size="1" class="mr-2"></vue-fontawesome>Total Mediator </h6>
                    <h4 class="mb-1">11</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>11</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>0</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol> -->
    </CRow>
      <CRow class="m-0">
        <CCol md="6" class="px-2">
           <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Doctors List</h5>
            </div>
         </CCol> 
          <CCard class="border-top-0">
              <CCardBody>
                <div class="table-responsive dash_table">
                    <table class="table">
                        <thead>
                              <tr >
                              <th>#</th>
                              <th>Doctor Name</th>
                              <th>Speciality</th>
                              <th>Phone Number</th>
                              <th>Email</th>                           
                              <th>Reviews</th> 
                              </tr>
                        </thead>
                        <tbody>
                              <tr v-for="(row,index) in this.doctorData">
                                 <td> 
                                    <img class="avatar-img rounded-circle avatar-sm" :src="'uploads/profile/'+row.user_id+'/'+row.profile_photo" v-if="row.profile_photo" alt="User Image">
                                    <img  class="avatar-img rounded-circle avatar-sm" src="/uploads/profile/default-profile.png" v-else>
                                 </td>
                                    <td>
                                        <router-link :to="{ name: 'view_doctor' ,params: { id: row.doctor_id }}">
                                        Dr.{{row.name}}</router-link>
                                    </td>
                                  <td>{{row.Speciality}}</td>
                                  <td>{{row.phone_number}}</td>
                                  <td>{{row.email}}</td>  
                                  <td>-</td> 
                              </tr>
                        </tbody>
                    </table>
                </div>
              </CCardBody>
          </CCard>
      </CCol>

      <CCol md="6" class="px-2">
           <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Customers List</h5>
            </div>
         </CCol> 
          <CCard class="border-top-0">
              <CCardBody>
                <div class="table-responsive dash_table">
                    <table class="table"> 
                        <thead>
                              <tr>
                              <th>#</th>
                              <th>Customer Name</th>
                              <th>Phone Number</th>
                              <th>Email</th>
                              <th>Age</th>                           
                              <th>Status</th> 
                              </tr>
                        </thead>
                        <tbody>
                              <tr v-for="(row,index) in this.patientData" :key="index">
                                  <td> 
                                    <!-- <img class="avatar-img rounded-circle avatar-sm" :src="'uploads/profile/'+row.user_id+'/'+row.profile_photo" v-if="row.profile_photo" alt="User Image">
                                    <img  class="avatar-img rounded-circle avatar-sm" src="/uploads/profile/default-profile.png" v-else> -->
                                 </td> 
                                    <td>{{row.name}}</td>
                                  <td>{{row.phone_number}}</td>
                                  <td>{{row.email}}</td>
                                  <td>{{row.age}}</td>  
                                  <td>-</td> 
                              </tr>
                        </tbody>
                    </table>
               
                </div>
              </CCardBody>
          </CCard>
      </CCol>

      <!--  <CCol md="6" class="px-2">
           <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Mediator List</h5>
            </div>
         </CCol> 
          <CCard class="border-top-0">
              <CCardBody>
                <div class="table-responsive dash_table">
                    <table class="table"> 
                        <thead>
                              <tr>
                              <th>#</th>
                              <th>Doctor Name</th>
                              <th>Speciality</th>
                              <th>Phone Number</th>
                              <th>Email</th>                           
                              <th>Status</th> 
                              </tr>
                        </thead>
                       <tbody>
                              <tr v-for="(row,index) in this.mediatorDoctorData">
                                 <td> 
                                    <img class="avatar-img rounded-circle avatar-sm" :src="'uploads/profile/'+row.user_id+'/'+row.profile_photo" v-if="row.profile_photo" alt="User Image">
                                    <img  class="avatar-img rounded-circle avatar-sm" src="/uploads/profile/default-profile.png" v-else>

                                 </td>
                                    <td>
                                    <router-link :to="{ name: 'view_mediator' ,params: { id: row.doctor_id }}">
                                        Dr.{{row.name}}
                                    </router-link></td>
                                  <td>{{row.Speciality}}</td>
                                  <td>{{row.phone_number}}</td>
                                  <td>{{row.email}}</td>  
                                  <td>-</td> 
                              </tr>
                        </tbody>
                    </table>
               
                </div>
              </CCardBody>
          </CCard>
      </CCol>

       <CCol md="6" class="px-2">
           <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Appointment List</h5>
            </div>
         </CCol> 
          <CCard class="border-top-0">
              <CCardBody>
                <div class="table-responsive dash_table">
                    <table class="table"> 
                        <thead>
                              <tr>
                              <th>#</th>
                              <th>Doctor Name</th>
                              <th>Speciality</th>
                              <th>Patient Name</th>
                              <th>Apointment Date</th>
                              </tr>
                        </thead>
                        <tbody>
                                <tr v-for="(row,index) in this.appointmentData">
                                 <td> 
                                    <img class="avatar-img rounded-circle avatar-sm" :src="'uploads/profile/'+row.dr_user_id+'/'+row.doctor_photo" v-if="row.doctor_photo" alt="User Image">
                                    <img  class="avatar-img rounded-circle avatar-sm" src="/uploads/profile/default-profile.png" v-else>

                                 </td>
                                  <td><router-link :to="{ name: 'view_doctor' ,params: { id: row.doctor_id }}">
                                       Dr.{{row.doctorName}}</router-link></td>
                                  <td>{{row.Speciality}}</td>
                                  <td>
                                    <img class="avatar-img rounded-circle avatar-sm" :src="'uploads/profile/'+row.p_user_id+'/'+row.patient_photo" v-if="row.patient_photo" alt="User Image">
                                    <img  class="avatar-img rounded-circle avatar-sm" src="/uploads/profile/default-profile.png" v-else>
                                    {{row.patientName}}</td>
                                  <td>{{row.appointment_date}} </br>
                                  {{row.appointment_time}}
                                    </td> 
                              </tr>
                        </tbody>
                    </table>
               
                </div>
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
export default {
     props: ['user','doctorData','mediatorDoctorData','patientData','appointmentData','adminCount','patientCount','doctorCount'],
    data() {
        return {
           
        };
    },

  created() {
   
    
  },
    computed: {
   
  },

 
  methods: {
  
  }
}
</script>


