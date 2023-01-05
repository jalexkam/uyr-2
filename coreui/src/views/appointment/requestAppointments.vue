<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Requested Appointments</h5>
            </div>
         </CCol>
      </CRow>
      <CRow class="m-0">
         <CCol md="12" class="p-2">
            <div class="d-flex justify-content-between">
              
               <div class="form-group">
                  <select class="form-control" v-model="drType" @change="drTypeChange($event)">
                       <option value="0"> All</option>
                       <option  v-for="type, index in resultType" :value="type.id" >{{type.type_name}}</option>
                     </select>
               </div>

               <div class="search_box">
                  <input type="search" v-model="keyword" @keyup="searchData"  placeholder="Search..." class="form-control" name="">
                  <CButton>
                     <vue-fontawesome icon="search" class="mr-1" size="0.9"></vue-fontawesome>
                  </CButton>
               </div>

            </div>
         </CCol>
         

         <CCol md="12" class="px-2 pb-2"  v-if="result && result.data && result.data.length > 0"  >
             <div v-for="(row, index) in result.data">
            <CCard class="patient_card" >
              <div class="patient_card_header">
                    <div class="patient_info">
                        <h6 class="">
                          <vue-fontawesome icon="user" class="mr-1" size="0.7"></vue-fontawesome>
                          {{ row.patient_name }}
                        </h6>
                     </div>
                     <div class="patient_info">
                        <h6 class="">
                          <vue-fontawesome icon="envelope" class="mr-1" size="0.7"></vue-fontawesome>
                             {{ row.email }}
                        </h6>
                     </div>
                     <div class="patient_info">
                        <h6 class="">
                          <vue-fontawesome icon="phone" class="mr-1" size="0.8"></vue-fontawesome>
                           {{ row.phone_number }}
                        </h6>
                     </div>
                     <div class="patient_info">
                        <h6 class="">
                          <vue-fontawesome icon="map-marker" class="mr-1" size="0.8"></vue-fontawesome>
                          {{ row.address }}
                        </h6>
                     </div>
                </div>
              <div class="patient_card_body">
                <div class="d-flex justify-content-between">
                  <div class="pcard_left">
                    <div class="pcard_box">
                      <div class="d-flex flex-wrap ml-4">
                          <div class="inner_info">
                            <h6>Type of Specialist</h6>
                            <span>{{ row.type_specialist }}</span>
                          </div>
                          <div class="inner_info">
                            <h6>Select Date</h6>
                            <span>{{ row.date_of_suggest }}</span>
                          </div>
                          <div class="inner_info">
                            <h6>Time</h6>
                            <span>{{ row.to_time }} </span> To
                          <!-- </div>
                          <div class="inner_info">
                            <h6>From time</h6> -->
                            <span>{{ row.from_time }}</span>
                          </div>
                          <div class="inner_info">
                            <h6>Where to Visit</h6>
                            <span>{{ row.visit_type}}</span>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="pcard_right">
                    <div class="pcard_box">
                      <div class="d-flex flex-wrap ml-4">

                          <div class="lower_inner_info" v-if="row.medical_recommendation">
                            <h6>Medical recommendation to see:</h6>
                            <span>{{row.medical_recommendation}}</span>
                          </div>

                          <div class="lower_inner_info" v-if="row.health_specialist">
                            <h6>Health Specialist:</h6>
                            <span>{{row.health_specialist}} </span>
                          </div>

                          <div class="lower_inner_info" v-if="row.medical_report_attachment">
                            <h6>Upload med report with recommendation if available</h6>
                            <span>
                              <a :href="'uploads/patient/'+row.user_id+'/medicalfile/'+row.medical_report_attachment" download>  
                                <vue-fontawesome icon="file-pdf-o" class="mr-1" size="0.8"></vue-fontawesome> 
                                Download
                              </a>
                            </span>
                          </div>

                          <div class="lower_inner_info w-100" v-if="row.reason">
                            <h6>Enter details for other reason here</h6>
                            <span>{{row.reason}}</span>
                          </div>
                      </div>

                    </div>
                    <div class="pcard_box">
                      <div class="card_headings">
                        <h6>Medical History:</h6>
                      </div>

                      <div class="d-flex flex-wrap ml-4">
                          <div class="lower_inner_info w-100" v-if="row.medical_history">
                            <h6>Do you know if <strong>  {{ row.patient_name }}</strong> suffers from any of the following?</h6>
                            <ul >
                              <li v-for="(row, index) in row.medical_history">{{row}}</li>
                            </ul>
                          </div>
                          <div class="lower_inner_info w-100" v-if="row.description">
                            <h6>If you have ticked any of the above, please give details:</h6>
                            <span>{{row.description}}</span>
                          </div>
                      </div>
                    </div>

                    <div class="text-right my-2">
                     <!--  <CButton @click="MultiAction(row.id, 'Delete')" size="sm" class="btn_custom py-1 px-3">Delete</CButton> -->
                     
                     <router-link class="p-2" :to="{ name: 'doctorSearch',params: { doctor_suggest_id: row.id } }">
                      <CButton size="sm" class="btn_custom py-1 px-3">Suggest Doctor</CButton>
                    </router-link>
                    </div>
                  </div>
                </div>
              </div>
            
            </CCard>
            </div>
         </CCol>
          <CCol v-else>
             <CCard class="patient_card" >
                <td colspan="11" style="height: 200px "class="text-center">
                Sorry no Record found!
                </td>
             </CCard>
          </CCol>

      </CRow>

       <div class="row m-0 align-items-center paginationPanel">
                <div
                    class="col px-2"
                    v-if="result.data && result.data.length > 0 && result.total > 0"
                >
                    Showing {{ result.from }} to {{ result.to }} of
                    {{ result.total }} Entries
                </div>
                <div
                    class="col-aut px-2"
                    v-if="
                        result.data &&
                        result.data.length > 0 &&
                        result.last_page > 1
                    "
                >
                   <paginate
                          :value="page"
                          :page-count="result.last_page"
                          :page-range="3"
                          :margin-pages="2"
                          :click-handler="paginateHandle"
                          :prev-text="'←'"
                          :next-text="'→'"
                          :container-class="'pagination'"
                          :page-class="'page-item'"
                      >
                      </paginate>
                </div>
            </div>
   </div>

   </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Vue from 'vue';
import Vuex from 'vuex';
import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)
import Swal from 'sweetalert2';

export default {
      data() {
        return {
            user_id: '',
            keyword: '',
            drType: '',
            disabled: false,
        };
    },

  created() {
    this.page;
     this.TypeList();
  },
  computed: {
           page() {
            if (this.keyword == '') {
                var page = 1;
                if (this.$route.params.page != undefined) page = this.$route.params.page;
                this.requestAppointmentsList({ page: page, keyword: this.keyword ,'drType': this.drType});
                return Number(page) || 1;
            } else {
            }
        },

     ...mapGetters("Appointment/Index", ["result","returnData"]),
     ...mapGetters("Masters/TypesMaster", ["resultType"]),
  },
  methods: {
     ...mapActions("Appointment/Index", ["requestAppointmentsList","UpdateMultiAction"]),
     ...mapActions("Masters/TypesMaster", ["TypeList"]),
     paginateHandle(pageNum) {
            this.$router.push({ name: 'paginate_requestAppointments', params: { page: pageNum } });
            this.requestAppointmentsList({ page: pageNum,'keyword': this.keyword,'drType': this.drType});
        },

      searchData() {
            var page = 1;
            if (this.keyword.length >= 3) {
                if (this.$route.params.page != 1)
                    this.$router.push({ name: 'paginate_requestAppointments', params: { page: page } });
                this.requestAppointmentsList({ page: page, keyword: this.keyword ,'drType': this.drType});
            } else {
                this.requestAppointmentsList({ page: page, keyword: this.keyword ,'drType': this.drType});
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
                    this.UpdateMultiAction({ id: id, action: action }).then(() => {
                        if (this.returnData.status == 'success') {
                            Vue.$toast.open({
                                   message: this.returnData.message,
                                   type: this.returnData.status,
                               });
                            this.requestAppointmentsList({ page: this.result.current_page,'drType': this.drType });
                        }
                    });
                }
            });
        },
      drTypeChange(event){
         this.requestAppointmentsList({ page: 1,'keyword': this.keyword,'drType': this.drType});
      }

  }
}
</script>
<style>
  
</style>