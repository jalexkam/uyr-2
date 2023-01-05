<template>
  <div>
    <CRow class="m-0">
      <CCol sm="12" class="p-2">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Favorite Doctor</h5>
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
                    <th class="text-center">Sr.No</th>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>Type</th>
                    <th>Fees</th>
                    <th>Km Away</th>
                    <th width="220">Action</th>
                  </tr>
                </thead>
                <tbody v-if="result.data && result.data.length > 0 && result.total > 0">
                  <tr v-for="(row, index) in result.data" :key="'row'+index">
                    <td class="text-center">{{ result.from + index }}</td>
                   <td v-if="row.first_name">{{row.first_name}} {{row.last_name}}</td>
                    <td v-else>--</td>
                    <td v-if="row.patientArr && row.patientArr.first_name">{{row.patientArr.first_name}} {{row.patientArr.last_name}}</td>
                    <td v-else>--</td>
                    <td v-if="row.type_name">{{row.type_name}}</td>
                    <td v-else>--</td>
                    <td v-if="row.fees_amount">{{row.fees_amount}}</td>
                    <td v-else>--</td>
                    <td v-if="row.distance">{{row.distance}}</td>
                    <td v-else>--</td> 
                    <td>
                      <router-link v-if="row.patientArr" :to="{ name: 'favPatientBooking', params: { d_id: row.doctor_id, p_id: row.patientArr.id}}">
                        <CButton size="sm" class="btn_custom">Book Appointment</CButton>
                      </router-link>

                      <router-link :to="{ name: 'favorite', params: { doctor_id: row.id,}}">
                        <CButton v-if="row.isFavoriteDoctor == 0" size="sm" color="warning" class="text-white mb-2 d-block" @click="updateStatus(row.id, 'Add')">
                          <vue-fontawesome icon="star" class="mr-1" size="0.8"></vue-fontawesome>
                          Add Favorite
                        </CButton>
                      </router-link>
                      <CButton v-if="row.patientArr" size="sm" color="danger" @click="updateStatus(row.doctor_id, row.patientArr.id,'Unfavorite')"> Remove</CButton>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="8" align="center" class="p-3">
                      <h6 class="m-0">Data Not Found !</h6>
                    </td>
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
  import Swal from "sweetalert2";
  import pagination from "./../components/pagination";

  export default {
    components: {
      pagination,
    },
    data() {
      return {
        keyword: "",
      };
    },

    created: function () {
      // if (this.$route.params.id != undefined)
      // this.doctor_suggest_id = this.$route.params.id; // doctor_suggest id
      this.page;
    },
    computed: {
      page() {
        if (this.keyword == "") {
          var page = 1;
          if (this.$route.params.page != undefined) page = this.$route.params.page;
          this.getFavoriteDoctorList({ page: page, keyword: this.keyword });
          return Number(page) || 1;
        } else {
        }
      },

      ...mapGetters("Patient/Index", ["result", "returnData", "ajax_error"]),
      ...mapGetters("auth", ["user"]),
    },

    methods: {
      ...mapActions("Patient/Index", ["getFavoriteDoctorList","favoriteStatusChange"]),
     

      paginateHandle(pageNum) {
        this.getFavoriteDoctorList({ page: pageNum, keyword: this.keyword });
        this.$router.push({ name: "favorite-list-page", params: { page: pageNum } }).catch(() => {});
      },


      updateStatus(id,patient_id, action) {
        this.favoriteStatusChange({ doctor_id: id, patient_id: patient_id, action: action }).then(() => {
          if (this.returnData.status == "success") {
            Vue.$toast.open({
              message: this.returnData.message,
              type: this.returnData.status,
            });
             this.getFavoriteDoctorList({ page: 1, keyword: this.keyword });
            // this.searchDoctor({ page: 1, keyword: this.keyword, type_specialist: this.type_specialist, doctor_suggest_id: this.doctor_suggest_id, distance: this.distance, patient_id:this.patient_id });
          }
        });
      },



      //   updateStatus(id, action) {
      //       Swal.fire({
      //           title: 'Are you sure',
      //           text: 'Do you really want to ' + action + ' ' + 'This record',
      //           type: 'warning',
      //           showCancelButton: true,
      //           confirmButtonText: action,
      //           confirmButtonColor: '#dd4b39',
      //           cancelButtonText: 'Cancel',
      //           icon:'warning',
      //           reverseButtons: true,
      //       }).then((result) => {
      //           if (result.value) {
      //               this.favoriteStatusChange({ doctor_id: id, user_id: this.user.id, action: action }).then(() => {
      //                   if (this.returnData.status == 'success') {
      //                         Vue.$toast.open({
      //                              message: this.returnData.message,
      //                              type: this.returnData.status,
      //                          });
      //                      this.searchDoctor({ page: 1, keyword: this.keyword,'type_specialist': this.type_specialist,'doctor_suggest_id':this.doctor_suggest_id,'distance':this.distance});
      //                   }
      //               });
      //           }
      //       });
      //   },
    },
  };
</script>
