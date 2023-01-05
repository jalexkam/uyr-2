<template>

   <div>
    <CRow class="m-0">
       <CCol md="12" class="p-2">
          <h2 class="mb-0">Dashboard</h2>
        </CCol>
    </CRow>
    
    <!-- <adminDashboard v-if="user && (user.role_type ==1 || user.role_type ==2)" 
    :user="user"
    :doctorData="doctorData"
    :mediatorDoctorData="mediatorDoctorData"
    :patientData="patientData"
    :appointmentData="appointmentData"
    :adminCount="adminCount"
    :patientCount="patientCount"
    :doctorCount="doctorCount"


    ></adminDashboard>
    <salesDashboard v-if="user && (user.role_type ==3 )"></salesDashboard>
    <doctorDashboard v-if="user && (user.role_type ==4 )"></doctorDashboard>
    <mediatorDashboard v-if="user && (user.role_type ==5 )"></mediatorDashboard>
    <patientDashboard v-if="user && (user.role_type ==6 )"></patientDashboard> -->
 

    <div v-if="user && (user.role_type ==1 || user.role_type ==2)">  

    <!-- <CRow class="m-0">
      <CCol md="12" class="px-2">
           <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Doctors List</h5>
               <div class="d-flex">
                  <div class="search_box">
                     <input type="search" v-model="keyword" @keyup="searchData" placeholder="Search..." class="form-control" name="">
                     <CButton><vue-fontawesome icon="search" class="mr-1" size="0.9"></vue-fontawesome></CButton>
                  </div>
               </div>
            </div>
         </CCol> 
          <CCard class="border-top-0">
              <CCardBody>
                <div class="table-responsive dash_table">
                    <table class="table"> 
                        <thead>
                              <tr>
                              <th class="text-center" width="80">ID</th>
                              <th>Doctors Name</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                              <th>Age</th>                               
                              <th>Address</th> 
                              <th>Account Status</th>
                              <th v-if="user && (user.role_type ==1 || user.role_type ==2)">Action</th>                
                              </tr>
                        </thead>
                        <tbody>
                              <tr class="col-md-4 px-2" v-if="result.data" v-for="(row, index) in result.data">
                                 <td>{{ index + 1 }}</td>
                                  <td>{{row.first_name}} {{row.last_name}}</td>
                                  <td>{{row.email}}</td>
                                  <td>{{row.phone_number}}</td>
                                  <td>{{row.age}}</td>  
                                  <td>{{row.address}}</td>
                                  
                                   <td class="text-center" v-if="row.status =='Pending'">
                                    <CBadge color="warning">Pending</CBadge>
                                   </td>
                                    <td class="text-center" v-else-if="row.status =='Rejected'">
                                      <CBadge color="danger">Rejected</CBadge>
                                    </td>
                                     <td class="text-center" v-else>
                                      <CBadge color="success">Approved</CBadge>
                                    </td>
                                      <td> 
                                      <select class="form-control" v-if="user && (user.role_type ==1 || user.role_type ==2)" v-on:change="changeStatus($event,row.id)">
                                        <option value="0" :selected="row.status == 'Pending'">Pending</option>
                                        <option value="1" :selected="row.status == 'Rejected'">Rejected</option>
                                        <option value="2" :selected="row.status == 'Approved'">Approved</option>
                                      </select>
                                    </td>
                              </tr>
                        </tbody>
                    </table>
                </div>
              </CCardBody>
          </CCard>
      </CCol>
    </CRow> -->

    </div>        
   </div>


</template> 
<style type="text/css">
.avatar {
    position: relative;
    display: inline-block;
    width: 3rem;
    height: 3rem;
}
.avatar-sm {
    width: 2.5rem;
    height: 2.5rem;
}

</style>    

<script>
import { mapGetters, mapActions } from "vuex";
import Vue from 'vue';
import Vuex from 'vuex';
import adminDashboard from "./components/adminDashboard"
import salesDashboard from "./components/salesDashboard"
import doctorDashboard from "./components/doctorDashboard"
import mediatorDashboard from "./components/mediatorDashboard"
import patientDashboard from "./components/patientDashboard"


export default {
      components: {
          adminDashboard,
          salesDashboard,
          doctorDashboard,
          mediatorDashboard,
          patientDashboard
        },

      data() {
        return {
            user_id: '',
            doctorData:[],
            mediatorDoctorData:[],
            patientData:[],
            appointmentData:[],
            adminCount:[],
            patientCount:[],
            doctorCount:[],
        };
    },

  created() {
    this.get_DashboardData();
  },
  computed: {
     ...mapGetters("Dashboard/Index", ["result"]),    
     ...mapGetters("auth", ["user"]),
  },
  methods: {
     ...mapActions("Dashboard/Index", ["getDashboardData"]),
     
     get_DashboardData(){
         this.getDashboardData().then(() => {
            //console.log(this.result);
               this.doctorData = this.result.doctorData;
               this.mediatorDoctorData = this.result.mediatorDoctorData;
               this.patientData = this.result.patientData;
               this.appointmentData = this.result.appointmentData;
               this.doctorCount = this.result.doctorCount;
               this.patientCount = this.result.patientCount;
               this.adminCount = this.result.adminCount;
               
               //console.log(this.doctorData);
             });

        
     }
  }
}
</script>
