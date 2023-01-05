<template>

   <div>
   
    <CRow class="m-0">
        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="users" size="1" class="mr-2"></vue-fontawesome>Total Patient</h6>
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

        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow warning mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="user-circle-o" size="1" class="mr-2"></vue-fontawesome>Today Patient</h6>
                    <h4 class="mb-1">12</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>12</span>
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
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="thermometer-three-quarters" size="1" class="mr-2"></vue-fontawesome>Appoinments</h6>
                    <h4 class="mb-1">430</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Today</p>
                      <span>9</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">Upcoming</p>
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
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="tasks" size="1" class="mr-2"></vue-fontawesome>Revenue</h6>
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

        
       
    </CRow>
    <CRow class="m-0">
        <CCol md="6" class="px-2">
           <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Patient Today Appoinment</h5>
            </div>
         </CCol> 
          <CCard class="border-top-0">
              <CCardBody>
                <div class="table-responsive dash_table">
                    <table class="table">
                        <thead>
                              <tr >
                              <th>#</th>
                              <th>Patient Name</th>
                              <th>Appoinment Date</th>
                              <th>Purpose</th>
                              <th>Type</th>                           
                              <th>Age</th> 
                              </tr>
                        </thead>
                        <tbody>
                              <tr >
                                 <td> 
                                    <img  class="avatar-img rounded-circle avatar-sm" src="/uploads/profile/default-profile.png" >
                                 </td>
                                    
                                   <td>George Anderson
                                        </br>#PT0016</td>
                                    <td>4 Jan 2018
                                        </br>9.40 AM</td>

                                  <td>General</td>
                                  <td>New Patient</td>  
                                  <td>45</td> 
                              </tr>
                              <tr >
                                 <td> 
                                    <img  class="avatar-img rounded-circle avatar-sm" src="/uploads/profile/default-profile.png" >
                                 </td>
                                   
                                   <td>George Anderson
                                        </br>#PT0016</td>
                                        <td>4 Jan 2018
                                        </br>9.40 AM</td>

                                  <td>General</td>
                                  <td>Old Patient</td>  
                                  <td>45</td> 
                              </tr>
                              <tr >
                                 <td> 
                                    <img  class="avatar-img rounded-circle avatar-sm" src="/uploads/profile/default-profile.png" >
                                 </td>
                                    
                                   <td>George Anderson
                                        </br>#PT0016</td>
                                        <td>4 Jan 2018
                                        </br>9.40 AM</td>
                                  <td>General</td>
                                  <td>New Patient</td>  
                                  <td>45</td> 
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
                   <h5 class="mb-0">Patient Upcoming Appoinment</h5>
                </div>
             </CCol> 
              <CCard class="border-top-0">
                  <CCardBody>
                    <div class="table-responsive dash_table">
                        <table class="table"> 
                            <thead>
                                  <tr>
                                  <th>#</th>
                                  <th>Patient Name</th>
                                  <th>Appoinment Date</th>
                                  <th>Purpose</th>
                                  <th>Type</th>                           
                                  <th>Age</th> 
                                  </tr>
                            </thead>
                            <tbody>
                                   <tr >
                                 
                                     <td>  1    </td>
                                   <td>George Anderson
                                        </br>#PT0016</td>
                                        <td>4 Jan 2018
                                        </br>9.40 AM</td>
                                  <td>General</td>
                                  <td>Old Patient</td>  
                                  <td>45</td> 
                              </tr>
                              <tr >
                                 <td>  2    </td>
                                   <td>George Anderson
                                        </br>#PT0016</td>
                                        <td>4 Jan 2018
                                        </br>9.40 AM</td>
                                  <td>General</td>
                                  <td>New Patient</td>  
                                  <td>45</td> 
                              </tr>
                              <tr >
                                 <td>  3  </td>
                                    
                                   <td>George Anderson
                                        </br>#PT0016</td>
                                        <td>4 Jan 2018
                                        </br>9.40 AM</td>
                                  <td>General</td>
                                  <td>Old Patient</td>  
                                  <td>45</td> 
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
import { mapGetters, mapActions } from "vuex";
import Vue from 'vue';
import Vuex from 'vuex';
export default {
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


