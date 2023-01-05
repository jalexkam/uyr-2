<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">My Appointments</h5>
               <div class="d-flex">
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
                              <th>Date</th>
                              <th>Time</th>
                              <th>Doctor Name</th>  
                              <th>Patient Name</th>  

                              <th>Fees</th>
                              <th class="text-center">Status</th>
                              <th class="text-center">Payment Status</th>
                              
                           </tr>
                        </thead>
                        <tbody>
                          <tr v-if="result.data" v-for="(row, index) in result.data">
                              <td width="40" data-name="r-checkbox">
                                 <div class="select-all">
                                    <input type="checkbox" name="">
                                 </div>
                              </td>
                               <td>{{ row.id }}</td>
                              <td>{{ row.appointment_date }}</td>
                              <td>{{ row.appointment_time }}</td>
                              
                               <td>{{ row.doctorName }}</td>
                               <td>{{ row.patientName }}</td>
                              <td>{{ row.fees_amount }}/-</td>
                              <td class="text-center">
                                <CBadge color="warning" v-if="row.status =='Pending'">{{row.status}}</CBadge>
                                <CBadge color="success" v-if="row.status =='Accept'">{{row.status}}</CBadge>
                                <CBadge color="danger" v-if="row.status =='Reject'">{{row.status}}</CBadge>
                                 <CBadge color="success" v-if="row.status =='Completed'">{{row.status}}</CBadge>
                                 
                             </td>

                             <!--  <td class="text-center">
                                 <span class="text-success border-success px-2 p-status">Paid</span>
                              </td> -->
                               <td class="text-center">
                                 <span class="text-warning border-warning px-2 p-status">{{row.paypal_status}}</span>
                              </td>
                              <!-- <td class="text-center">
                                 <span class="text-danger border-danger px-2 p-status">Failed</span>
                               -->
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </CCardBody>
            </CCard>
         </CCol>
      </CRow>

       <div class="row m-0 align-items-center paginationPanel">
                <div  class="col px-2"  v-if="result.data && result.data.length > 0 && result.total > 0"  >
                    Showing {{ result.from }} to {{ result.to }} of
                    {{ result.total }} Entries
                </div>
                <div  class="col-aut px-2" v-if="
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
            disabled: false,
            position: 'right bottom',
            modal_title: 'Add User',
            tokenData: '',
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
                this.patientAppointment({ page: page, keyword: this.keyword });
                return Number(page) || 1;
            } else {
            }
        },

    ...mapGetters("Appointment/Index", ["result","returnData"]),
  },
  methods: {
    ...mapActions("Appointment/Index", ["patientAppointment","UpdateMultiAction"]),
     paginateHandle(pageNum) {
            this.$router.push({ name: 'paginate_patient_appointment', params: { page: pageNum } });
            this.patientAppointment({ page: pageNum,'keyword': this.keyword});
        },

      searchData() {
            var page = 1;
            if (this.keyword.length >= 3) {
                if (this.$route.params.page != 1)
                    this.$router.push({ name: 'paginate_patient_appointment', params: { page: page } });
                this.patientAppointment({ page: page, keyword: this.keyword });
            } else {
                this.patientAppointment({ page: page, keyword: this.keyword });
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
                            this.patientAppointment({ page: this.result.current_page });
                        }
                    });
                }
            });
        },

  }
}
</script>
