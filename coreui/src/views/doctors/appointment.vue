<template>
   <div>
      <CRow class="m-0"> 
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">My Appointments</h5>
               <div class="d-flex">
                    <CCol >
                    <div class="form-group">
                      <select class="form-control">
                         <option>All</option>
                         <option>Pending</option>
                         <option>Accepted</option>
                         <option>Completed</option>
                         <option>Rejected</option>                     
                      </select>
                    </div>
                    </CCol> 
                  <div class="search_box">
                     <input type="search" v-model="keyword" @keyup="searchData" placeholder="Search..." class="form-control" name="">
                     <CButton><vue-fontawesome icon="search" class="mr-1" size="0.9"></vue-fontawesome></CButton>
                  </div>
               </div>

            </div>
         </CCol>      
      </CRow>
         <CRow class="m-0">
         <CCol md="12" class="px-2 pb-2">
          <vue-tabs class="pateint_view_tab">
            <v-tab title="All Appointment">
              <CCard>
                 <CCardBody>
                    <div class="table-responsive">
                       <table class="table table-striped table-hover">
                          <thead>
                             <tr>
                                <th width="40" data-name="r-checkbox">
                                   <div class="select-all">
                                      <input type="checkbox" name="">
                                      <CDropdown toggler-text="" class="" color="light">
                                         <CDropdownItem>Select All Results</CDropdownItem>
                                      </CDropdown>
                                   </div>
                                </th>
                                <th>Appointment ID</th>
                                <th>Date / Time</th>
                                <th>Patient Name</th>  
                                <th>Fees</th>
                                <th class="text-center">Status</th>
                                <th>Payment Status</th>
                                <th width="200">Actions</th>
                             </tr>
                          </thead>
                          <tbody>
                            <tr  v-if="result && result.data && row.dr_status =='Approved mediator'" v-for="(row, index) in result.data" :key="index">
                                <td width="40" data-name="r-checkbox">
                                   <div class="select-all">
                                      <input type="checkbox" name="">
                                   </div>
                                </td>
                                 <td>{{ result.from + index }}</td>
                                <td>{{ row.appointment_Date }} {{ row.appointment_Time }}</td>
                               
                                 <td>{{ row.patientName }}</td>
                                <td >{{ row.fees_amount }}/-</td>
                                
                                <td class="text-center">
                                  <CBadge color="warning" v-if="row.status =='Pending'">{{row.status}}</CBadge>
                                  <CBadge color="success" v-if="row.status =='Accept'">{{row.status}}</CBadge>
                                  <CBadge color="danger" v-if="row.status =='Reject'">{{row.status}}</CBadge>
                                  
                               </td>
                                <td>{{ row.paypal_status }}</td>
                               
                                 <!-- <td class="text-center">
                                   <span class="text-warning border-warning px-2 p-status">Pending</span>
                                 </td>-->
                                <!-- <td class="text-center">
                                   <span class="text-danger border-danger px-2 p-status">Failed</span>
                                </td> -->

                                  <CButtonGroup size="sm" v-if="row.status =='Pending'">
                                      <CButton size="sm" color="" class="btn-outline-success d-flex align-items-center" v-on:click="MultiAction(row.id,row.patient_id,row.appointment_date,row.appointment_time,'Accept')">
                                         <vue-fontawesome icon="check" class="mr-1" size="0.8" ></vue-fontawesome>Accept
                                      </CButton>

                                      <CButton size="sm" color="" class="btn-outline-warning d-flex align-items-center">
                                         Amend
                                      </CButton>

                                       <CButton size="sm" color="" class="btn-outline-danger d-flex align-items-center">
                                         <vue-fontawesome icon="times" class="mr-1" size="0.8" ></vue-fontawesome>Reject
                                      </CButton> 
                                   </CButtonGroup>

                                  


                                   <CButtonGroup size="sm" v-else-if="row.status =='Accept'">

                                     <a :href="row.direction_location" target="_blank" > 
                                      <CButton  color="danger" class="btn-flex" title="Direction Map">
                                      <vue-fontawesome icon="map-marker" size="1"></vue-fontawesome>
                                      </CButton>
                                      </a>

                                      <CButton class="btn-flex btn_custom"  @click="myModal = true,showmodel(row.id);"  title="Consultation form">
                                      <vue-fontawesome icon="file-text-o" size="1"></vue-fontawesome>
                                      </CButton>
                                      <!-- <CButton color="info">
                                          Consultation form
                                      </CButton> -->

                                      <router-link :to="{ name: 'doctor_appointment_patient_view',params: { id: row.id } }">
                                       <CButton color="info">
                                         <vue-fontawesome icon="eye"size="1"></vue-fontawesome>
                                         
                                      </CButton>
                                  </router-link>
                                   </CButtonGroup>

                                   <CButtonGroup size="sm" v-else>
                                          -
                                   </CButtonGroup>
                                   

                                </td>
                             </tr>
                          </tbody>
                       </table>
                    </div>
                 </CCardBody>
              </CCard>
            </v-tab>
            <v-tab title="Completed">
              <CCard>
                 <CCardBody>
                    <div class="table-responsive">
                       <table class="table table-striped table-hover">
                          <thead>
                             <tr>
                                <th width="40" data-name="r-checkbox">
                                   <div class="select-all">
                                      <input type="checkbox" name="">
                                      <CDropdown toggler-text="" class="" color="light">
                                         <CDropdownItem>Select All Results</CDropdownItem>
                                      </CDropdown>
                                   </div>
                                </th>
                                <th>Appointment ID</th>
                                <th>Date / Time</th>
                                <th>Patient Name</th>  
                                <th>Fees</th>
                                <th class="text-center">Status</th>
                                <th>Payment Status</th>
                                <!-- <th width="200">Actions</th> -->
                             </tr>
                          </thead>
                          <tbody>
                            <tr v-if="result && result.data && row.dr_status =='Approved mediator'" v-for="(row, index) in result.data" :key="index">
                                <td width="40" data-name="r-checkbox">
                                   <div class="select-all">
                                      <input type="checkbox" name="">
                                   </div>
                                </td>
                                 <td>{{ result.from + index }}</td>
                                <td>{{ row.appointment_Date }} {{ row.appointment_Time }}</td>
                               
                                 <td>{{ row.patientName }}</td>
                                <td >{{ row.fees_amount }}/-</td>
                                
                                <td class="text-center">
                                  <CBadge color="warning" v-if="row.status =='Pending'">{{row.status}}</CBadge>
                                  <CBadge color="success" v-if="row.status =='Accept'">{{row.status}}</CBadge>
                                  <CBadge color="danger" v-if="row.status =='Reject'">{{row.status}}</CBadge>
                                   <CBadge color="success" v-if="row.status =='Completed'">{{row.status}}</CBadge>

                                  
                               </td>
                                <td>{{ row.paypal_status }}</td>
                                <!--    <td>
                                    <CButtonGroup size="sm" v-if="row.status =='Completed'">
                                      <router-link :to="{ name: 'doctor_appointment_patient_view',params: { id: row.id } }">
                                       <CButton color="info">
                                         <vue-fontawesome icon="eye"size="1"></vue-fontawesome>
                                         
                                      </CButton>
                                  </router-link>
                                   </CButtonGroup>

                                   <CButtonGroup size="sm" v-else>
                                          -
                                   </CButtonGroup>
                                   

                                </td> -->
                             </tr>
                          </tbody>
                       </table>
                    </div>
                 </CCardBody>
              </CCard>
            </v-tab>

             <v-tab title="Close Order">
              <CCard>
                 <CCardBody>
                    <div class="table-responsive">
                       <table class="table table-striped table-hover">
                          <thead>
                             <tr>
                                <th width="40" data-name="r-checkbox">
                                   <div class="select-all">
                                      <input type="checkbox" name="">
                                      <CDropdown toggler-text="" class="" color="light">
                                         <CDropdownItem>Select All Results</CDropdownItem>
                                      </CDropdown>
                                   </div>
                                </th>
                                <th>Appointment ID</th>
                                <th>Date / Time</th>
                                <th>Patient Name</th>  
                                <th>Fees</th>
                                <th class="text-center">Status</th>
                                <th>Payment Status</th>
                                <!-- <th width="200">Actions</th> -->
                             </tr>
                          </thead>
                          <tbody>
                            <tr v-if="result && result.data && row.dr_status =='Close' && row.status =='Completed'" v-for="(row, index) in result.data" :key="index">
                                <td width="40" data-name="r-checkbox">
                                   <div class="select-all">
                                      <input type="checkbox" name="">
                                   </div>
                                </td>
                                 <td>{{ result.from + index }}</td>
                                <td>{{ row.appointment_Date }} {{ row.appointment_Time }}</td>
                               
                                 <td>{{ row.patientName }}</td>
                                <td >{{ row.fees_amount }}/-</td>
                                
                                <td class="text-center">
                                  <CBadge color="warning" v-if="row.status =='Pending'">{{row.status}}</CBadge>
                                  <CBadge color="success" v-if="row.status =='Accept'">{{row.status}}</CBadge>
                                  <CBadge color="danger" v-if="row.status =='Reject'">{{row.status}}</CBadge>
                                   <CBadge color="success" v-if="row.status =='Completed'">{{row.status}}</CBadge>

                                  
                               </td>
                                <td>{{ row.paypal_status }}</td>
                             </tr>
                          </tbody>
                       </table>
                    </div>
                 </CCardBody>
              </CCard>
            </v-tab>

          </vue-tabs>
         </CCol>
      </CRow>



      <pagination :page="page" @paginateHandle="paginateHandle" :result="result"></pagination>

      <CModal
      title="Consultation form"
      :show.sync="myModal"
      :closeOnBackdrop="false"
      addContentClasses="medical_report_card"
      :size="'xl'"
    >
    <consultation :appointmentID="appointmentID" @closeModal="closeModal"> </consultation>

    </CModal>

   </div>
</template>
<style type="text/css">
.span_lable{
    white-space: nowrap;
    margin: 0 6px;
 }
</style>
<script>
import { mapGetters, mapActions } from "vuex";
import Vue from 'vue';
import Vuex from 'vuex';
import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)
import Swal from 'sweetalert2';
import pagination from "./../components/pagination";
import { VueTabs, VTab } from "vue-nav-tabs";
import "vue-nav-tabs/themes/vue-tabs.css";
import consultation from "./consultation";
export default {
     components: {
      pagination,
       VueTabs,
      VTab,
      consultation
    },

      data() {
        return {
            myModal: false,
            user_id: '',
            keyword: '',
            disabled: false,
            position: 'right bottom',
            modal_title: 'Add User',
            tokenData: '',
            appointmentID:"",
            items: [
                     {
                       medication1: '',
                       medication2: '',
                       medication3:'',
                     }
                   ]
        };
    },

  created() {
    this.page;
  },
  computed: {
           page() {
            if (this.keyword == '') {
                var page = 1;
                if (this.$route.params.page != undefined) page = this.$route.params.page;
                this.doctorAppointment({ page: page, keyword: this.keyword });
                return Number(page) || 1;
            } else {
            }
        },

    ...mapGetters("Appointment/Index", ["result","returnData"]),
  },
  methods: {
    ...mapActions("Appointment/Index", ["doctorAppointment","changeAppointmentStatus"]),
     paginateHandle(pageNum) {
            this.$router.push({ name: 'paginate_doctor_appointment', params: { page: pageNum } });
            this.doctorAppointment({ page: pageNum,'keyword': this.keyword});
        },

      searchData() {
            var page = 1;
            if (this.keyword.length >= 3) {
                if (this.$route.params.page != 1)
                    this.$router.push({ name: 'paginate_doctor_appointment', params: { page: page } });
                this.doctorAppointment({ page: page, keyword: this.keyword });
            } else {
                this.doctorAppointment({ page: page, keyword: this.keyword });
            }
        },

      MultiAction(id,patient_id,appointment_date,appointment_time, action) {
            Swal.fire({
                title: 'Are you sure',
                text: 'Do you really want to ' + action + ' ' + 'This record',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: action,
                confirmButtonColor: '#dd4b39',
                cancelButtonText: 'Cancel',
                icon:'warning',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    this.changeAppointmentStatus({ id: id,patient_id: patient_id,  appointment_date: appointment_date,appointment_time: appointment_time,action: action }).then(() => {
                        if (this.returnData.status == 'success') {
                              Vue.$toast.open({
                                   message: this.returnData.message,
                                   type: this.returnData.status,
                               });
                            this.doctorAppointment({ page: this.result.current_page });
                        }
                    });
                }
            });
        },

        showmodel(id){
         this.appointmentID =id;
         },

          closeModal(){
            this.myModal = false;
            var page = 1;
             if (this.$route.params.page != undefined) page = this.$route.params.page;
                this.doctorAppointment({ page: page, keyword: this.keyword });

         },

        }
}
</script>
