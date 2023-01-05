<template>
  <div>
    <CRow class="m-0">
      <CCol sm="12" class="p-2">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Search Doctor</h5>
        </div>
      </CCol>

      <CCol sm="12" class="p-2">
        <CCard class="mb-2 card-shadow bg-filter">
          <CCardBody class="px-2 py-3">
            <CRow class="m-0">
              <!--  <CCol sm="3" class="px-1" >
                        <div class="sub-filter">
                           <CInput label="Select Location" placeholder="Select Location"/>
                        </div>
                     </CCol> -->
              <CCol sm="3" class="px-1">
                <div class="sub-filter">
                  <div class="form-group">
                    <label>Doctor Type</label>
                    <select class="form-control" v-model="type_specialist" @change="drTypeChange($event)">
                      <option value="0"> All</option>
                      <option v-for="type, index in resultType" :value="type.id">{{type.type_name}}</option>
                    </select>
                  </div>
                </div>
              </CCol>

              <CCol sm="3" class="px-1">
                <div class="sub-filter">
                  <CInput label="Search by Name" v-model="keyword" @keyup="searchData" placeholder="Search by Doctor Name" />
                </div>
              </CCol>

              <CCol sm="2" class="px-1">
                <div class="form-group">
                  <label>Search KM<span></span></label><br />
                  <select class="form-control" v-model="distance" @change="selectkm($event)">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                  </select>
                </div>
              </CCol>

              <CCol sm="3" class="px-1">
                <div class="form-group mt-2">
                  <label>&nbsp;</label><br />
                  <button class="btn btn-sm btn-light mr-1">
                    <vue-fontawesome icon="refresh" class="mr-1" size="0.8"></vue-fontawesome>
                    Reset
                  </button>
                  <button class="btn btn-sm btn-dark">
                    <vue-fontawesome icon="search" class="mr-1" size="0.8"></vue-fontawesome>
                    Search
                  </button>
                </div>
              </CCol>
            </CRow>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
    <CRow class="m-0 align-items-center">
      <CCol sm="10">
        <div class="row m-0 align-items-center paginationPanel">
          <div class="col px-2" v-if="result.data && result.data.length > 0 && result.total > 0">
            <h6 class="m-0">You have found <b>{{ result.to }}</b> search results.</h6>
          </div>
        </div>
      </CCol>

      <CCol sm="2" class="p-2 float-right">
        <div class="form-group mb-0 d-flex align-items-center sortby">
          <label class="mr-2">Sort by:</label>
          <select class="form-control">
            <option>Select</option>
            <option>Nearest Location</option>
            <option>Highest Star Rating</option>
            <option>Price low to high</option>
          </select>
        </div>
      </CCol>
    </CRow>
    <CRow class="m-0" v-if="result.data && result.data.length > 0 && result.total > 0">
      <CCol md="4" class="px-2" v-if="result.data" v-for="(row, index) in result.data" :key="index">
        <CCard class="doctor_inf_card">
          <div class="doctor_full_info">
            <div class="doctorlist_card">
              <div class="doctor_imgbox">
                <img :src="'uploads/profile/'+row.user_id+'/'+row.profile_photo" v-if="row.profile_photo" />
                <img src="/uploads/profile/default-profile.png" v-else />
              </div>
              <div class="doctor_information">
                <p>
                  <strong>Name:</strong>
                  <span>{{row.first_name}} {{row.last_name}}</span>
                </p>
                <div class="rating">
                  <i class="fa fa-star filled"></i>
                  <i class="fa fa-star filled"></i>
                  <i class="fa fa-star filled"></i>
                  <i class="fa fa-star filled"></i>
                  <i class="fa fa-star"></i>
                </div>
                <p>
                  <strong>Type:</strong>
                  <span>{{row.type_name}}</span>
                </p>
                <p>
                  <strong>Fees:</strong>
                  <span>{{row.fees_amount}}/-</span>
                </p>
                <p>
                  <strong>KM Away:</strong>
                  <span>{{row.distance}} KM</span>
                </p>
              </div>
            </div>

            <div class="card_butns">
              <!-- <router-link :to="{ name: 'favorite', params: { doctor_id: row.id,}}"> -->
              <CButton v-if="row.isFavoriteDoctor == 0" size="sm" color="warning" class="text-white mb-2 d-block" @click="updateStatus(row.id,patient_id, 'Add')">
                <vue-fontawesome icon="star" class="mr-1" size="0.8"></vue-fontawesome>
                Add Favorite
              </CButton>
              <!-- </router-link> -->
              <!-- <router-link :to="{ name: 'favorite', params: { doctor_id: row.id,}}"> -->
              <CButton v-else size="sm" color="danger" class="text-white mb-2 d-block" @click="updateStatus(row.id, patient_id,'Unfavorite')">
                <vue-fontawesome icon="star" class="mr-1" size="0.8"></vue-fontawesome>
                Unfavorite
              </CButton>
              <!-- </router-link> -->

              <router-link :to="{ name: 'view_doctor_patient' ,params: { id: row.id,doctor_suggest_id:doctor_suggest_id}}">
                <CButton size="sm" class="btn_custom d-block mb-2">
                  <vue-fontawesome icon="calendar-check-o" class="mr-1" size="0.8"></vue-fontawesome>
                  Book Appointment
                </CButton>
              </router-link>
              <router-link :to="{ name: 'view_doctor_patient' ,params: { id: row.id,doctor_suggest_id:doctor_suggest_id}}">
                <CButton size="sm" color="info" class="d-block">
                  <vue-fontawesome icon="eye" class="mr-1" size="0.8"></vue-fontawesome>
                  View Profile
                </CButton>
              </router-link>
            </div>
          </div>
        </CCard>
      </CCol>
    </CRow>
    <CRow class="m-0" v-else>
      <CCol md="12">
        <CCard class="doctor_inf_card">
          <div class="doctor_full_info" align="center">
            <h6 class="m-0">Doctor Not Found Please try Again!</h6>
          </div>
        </CCard>
      </CCol>
    </CRow>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from "vuex";
  import Vue from "vue";
  import Vuex from "vuex";
  import Swal from "sweetalert2";
  import Paginate from "vuejs-paginate";
  Vue.component("paginate", Paginate);
  export default {
    data() {
      return {
        keyword: "",
        type_specialist: 0,
        disabled: false,
        position: "right bottom",
        patient_id: "",
        distance: "",
      };
    },

    created: function () {
      if (this.$route.params.id != undefined) this.doctor_suggest_id = this.$route.params.id; // doctor_suggest id
      if (this.$route.params.p_id != undefined) this.patient_id = this.$route.params.p_id; // patient_id
      this.page;
      this.TypeList();
      console.log(this.returnData)
    },
    computed: {
      page() {
        if (this.keyword == "") {
          var page = 1;
          if (this.$route.params.page != undefined) page = this.$route.params.page;
          this.searchDoctor({ page: page, keyword: this.keyword, type_specialist: this.type_specialist, doctor_suggest_id: this.doctor_suggest_id, distance: this.distance, patient_id:this.patient_id});
          return Number(page) || 1;
        } else {
        }
      },

      ...mapGetters("Patient/Index", ["result", "returnData", "ajax_error"]),
      ...mapGetters("Masters/TypesMaster", ["resultType"]),
      ...mapGetters("auth", ["user"]),
    },

    methods: {
      ...mapActions("Patient/Index", ["searchDoctor", "submitSuggestDoctorForm", "favoriteStatusChange"]),
      ...mapActions("Masters/TypesMaster", ["TypeList"]),

      paginateHandle(pageNum) {
        this.$router.push({ name: "paginate_searchDoctor", params: { id: this.doctor_suggest_id, page: pageNum } });
      },
      searchData() {
        var page = 1;
        if (this.keyword.length >= 3) {
          if (this.$route.params.page != 1) this.$router.push({ name: "paginate_searchDoctor", params: { id: this.doctor_suggest_id, page: page } });
          this.searchDoctor({ page: page, keyword: this.keyword, type_specialist: this.type_specialist, doctor_suggest_id: this.doctor_suggest_id, distance: this.distance, patient_id:this.patient_id });
        } else {
          this.searchDoctor({ page: page, keyword: this.keyword, type_specialist: this.type_specialist, doctor_suggest_id: this.doctor_suggest_id, distance: this.distance, patient_id:this.patient_id });
        }
      },

      updateStatus(id,patient_id, action) {
        this.favoriteStatusChange({ doctor_id: id, patient_id: patient_id, action: action }).then(() => {
          if (this.returnData.status == "success") {
            Vue.$toast.open({
              message: this.returnData.message,
              type: this.returnData.status,
            });
            this.searchDoctor({ page: 1, keyword: this.keyword, type_specialist: this.type_specialist, doctor_suggest_id: this.doctor_suggest_id, distance: this.distance, patient_id:this.patient_id });
          }
        });
      },

      drTypeChange(event) {
        this.type_specialist = event.target.value;
        this.searchDoctor({ page: 1, keyword: this.keyword, type_specialist: this.type_specialist, doctor_suggest_id: this.doctor_suggest_id, distance: this.distance, patient_id:this.patient_id });
      },

      selectkm(event) {
        this.distance = event.target.value;
        this.searchDoctor({ page: 1, keyword: this.keyword, type_specialist: this.type_specialist, doctor_suggest_id: this.doctor_suggest_id, distance: this.distance, patient_id:this.patient_id });
      },
    },
  };
</script>
