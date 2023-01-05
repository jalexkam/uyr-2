<template>
  <div>
    <CRow class="m-0">
      <CCol sm="12" class="p-2">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Mediator Doctor Payout</h5>
        </div>
      </CCol>
    </CRow>
    <CRow class="m-0">
      <CCol sm="12" class="p-2">
        <CCard class="mb-2 card-shadow bg-filter">
          <CCardBody class="px-2 py-3">
            <CRow class="m-0">
              <!-- <CCol md="2" class="p-2">
                <div class="sub-filter">
                  <label>Doctor</label>
                  <select class="form-control" v-model="SearchDoctor">
                      <option value="">-Select Doctor-</option>
                      <option>Pending</option>
                      <option>Accepted</option>
                      <option>Completed</option>
                      <option>Rejected</option>
                  </select>
                </div>
              </CCol> -->
              <CCol md="2" class="p-2">
                <div class="sub-filter">
                  <label>Month & Year</label>
                  <date-picker type="year-month" format="MM/YYYY" min="01/2000" color="#2c449e" :auto-submit="true" placeholder="Select Month & Year" v-model="SearchMonthYear"></date-picker>
                </div>
              </CCol> 
              <CCol sm="3" class="px-1">
                <div class="sub-filter mt-2">
                  <label>&nbsp;</label><br />
                  <button class="btn btn-sm btn-light mr-1"  @click="resetData()">
                    <vue-fontawesome icon="refresh" class="mr-1" size="0.8"></vue-fontawesome>
                    Reset
                  </button>
                  <button class="btn btn-sm btn-dark" @click="searchData()">
                    <vue-fontawesome icon="search" class="mr-1" size="0.8"></vue-fontawesome>
                    Search
                  </button>

                 <CButton class="btn btn-sm btn-dark"  :href="'/api/payouts/exportMidToDoctorCsv?SearchMonthYear='+SearchMonthYear">
                   <vue-fontawesome icon="download" size="0.8" class="mr-2 my-0"></vue-fontawesome> Export CSV
                 </CButton>

                </div>
              </CCol>
              <!-- <CCol md="2" class="p-2">
                <CButton size="sm" class="btn_custom" @click="searchData()">Search</CButton>
                <CButton size="sm" color="light" @click="resetData()">Reset</CButton>
              </CCol> -->
            </CRow>
          </CCardBody>
        </CCard>
      </CCol>
      
       
      <CCol md="12" class="px-2 pb-2">
        <CCard>
          <CCardBody>
            <div class="table-responsive">
              <table class="table table-striped table-hover" style="text-align: center;">
                <thead>
                  <tr>                    
                    <th>Order ID</th>
                    <th>Date/Time</th>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>Mediator Doctor</th>
                    <th>Total Amount</th>
                  </tr>
                </thead>
                <tbody v-if="result.data">
                  <tr v-for="(row, index) in result.data" :key="index">   
                    <td>{{ row.id }}</td>                 
                    <td>{{ row.appointment_date }} / {{ row.appointment_time }}</td>
                    <td>{{ row.doctorName }}</td>
                    <td>{{ row.patientName }}</td>
                    <td>{{ row.mediator_doctor_Name }}</td>
                    <td>{{ row.total_fees }}/-</td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
    <pagination :page="page" @paginateHandle="paginateHandle" :result="result"></pagination>

  </div>
</template>
<script>
  import { mapGetters, mapActions } from "vuex";
  import Vue from "vue";
  import Vuex from "vuex";
  import Paginate from "vuejs-paginate";
  Vue.component("paginate", Paginate);
  import Swal from "sweetalert2";
  import VueDatetimePickerJs from "vue-date-time-picker-js";
  Vue.component("date-picker", VueDatetimePickerJs);
  import pagination from "./../components/pagination"

  export default {
    components: {
      datePicker: VueDatetimePickerJs,
      pagination
    },

    data() {
      return {
        user_id: "",
        keyword: "",
        disabled: false,
        position: "right bottom",
        modal_title: "Add User",
        tokenData: "",
        SearchDoctor: "",
        SearchMonthYear: "",
      };
    },

    created() {
      this.page;
    },
    computed: {
      page() {
        if (this.keyword == "") {
          var page = 1;
          if (this.$route.params.page != undefined) page = this.$route.params.page;
          this.doctorPayout({ page: page, keyword: this.keyword });
          return Number(page) || 1;
        } else {
        }
      },

      ...mapGetters("Payout/Index", ["result", "returnData"]),
    },
    methods: {
      ...mapActions("Payout/Index", ["doctorPayout", "UpdateMultiAction"]),
      paginateHandle(pageNum) {
        this.$router.push({ name: "mediator-doctor-payout-page", params: { page: pageNum } });
        this.doctorPayout({ page: pageNum, keyword: this.keyword , SearchDoctor: this.SearchDoctor, SearchMonthYear: this.SearchMonthYear});
      },

      searchData() {
        var page = 1;
          if (this.$route.params.page != 1) this.$router.push({ name: "mediator-doctor-payout-page", params: { page: page } });
          this.doctorPayout({ page: page, keyword: this.keyword, SearchDoctor: this.SearchDoctor, SearchMonthYear: this.SearchMonthYear });
       
      },

      MultiAction(id, action) {
        Swal.fire({
          title: "Are you sure",
          text: "Do you really want to " + action + " " + "This record",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: action,
          confirmButtonColor: "#dd4b39",
          cancelButtonText: "Cancel",
          reverseButtons: true,
        }).then((result) => {
          if (result.value) {
            this.UpdateMultiAction({ id: id, action: action }).then(() => {
              if (this.returnData.status == "success") {
                Vue.$toast.open({
                  message: this.returnData.message,
                  type: this.returnData.status,
                });
                this.doctorPayout({ page: this.result.current_page });
              }
            });
          }
        });
      },

        resetData(){
          this.SearchDoctor = "";
          this.SearchMonthYear = "";
          this.doctorPayout({ page: 1, keyword: this.keyword, SearchDoctor: this.SearchDoctor, SearchMonthYear: this.SearchMonthYear });
      },



    },
  };
</script>
