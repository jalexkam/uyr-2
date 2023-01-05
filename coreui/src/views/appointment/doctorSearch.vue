<template>
  <div>
    <CRow class="m-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Doctor Search List</h5>
               <div class="d-flex">
                  <div class="search_box mr-1">
                     <input type="search" v-model="keyword" @keyup="searchData" placeholder="Search..." class="form-control" name="">
                     <CButton><vue-fontawesome icon="search" class="mr-1" size="0.9"></vue-fontawesome></CButton>
                  </div>
                  <CButton class="btn-light btn-flex mr-1" size="sm" >Back</CButton>
                  <CButton class="btn_custom btn-flex" size="sm" v-if="result && result.data" v-on:click="suggestToPatientAll(result.data[0].suggest_id)">Suggest to Patient </CButton>

               </div>
            </div>
         </CCol>      
      </CRow>
      
      <CRow class="m-0">
        <CCol sm="12" class="px-2"  v-if="result.data && result.data.length > 0 && result.total > 0"> 
            <div v-for="(row, index) in result.data">
          <CCard class="mb-2">
              <CCard class="patient_card">
              <div class="patient_card_header">
                    <div class="form-group mb-0 mr-3 checkbox custom_list_checkbox">
                      <input type="checkbox" name="doctor_ids[]" :value="row.doctor_id" :id="'doctor_ids'+ row.doctor_id" @change="check($event)" v-model="doctor_ids">
                      <label :for="'doctor_ids'+ row.doctor_id"></label>                        
                    </div>
                    <div class="patient_info">
                        <h6 class="">
                          <vue-fontawesome icon="user" class="mr-1" size="0.8"></vue-fontawesome>
                          {{ row.first_name }} {{ row.last_name }}
                        </h6>
                     </div>
                     <div class="patient_info">
                        <h6 class="">
                          <vue-fontawesome icon="envelope" class="mr-1" size="0.8"></vue-fontawesome>
                           {{ row.email }}
                        </h6>
                     </div>
                     <div class="patient_info">
                        <h6 class="">
                          <vue-fontawesome icon="phone" class="mr-1" size="0.9"></vue-fontawesome>
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
                <div class="pcard_box">
                  <div class="d-flex  flex-wrap ml-4">
                      <div class="inner_info dr_info">
                        <h6>Type</h6>
                        <span>{{row.type_specialist}}</span>
                      </div>
                      <div class="inner_info dr_info">
                        <h6>Medical license number</h6>
                        <span>{{row.medical_license_number}}</span>
                      </div>
                      <div class="inner_info dr_info">
                        <h6>Date of Registration</h6>
                        <span>{{row.date_of_registration}}</span>
                      </div>
                      <div class="inner_info dr_info">
                        <h6>Registration No.</h6>
                        <span>{{row.registration_no}}</span>
                      </div>
                      <div class="inner_info dr_info">
                        <h6>Years of Experience</h6>
                        <span>{{row.experience}} Years</span>
                      </div>
                      <div class="inner_info dr_info">
                        <h6>Current Clinic/hospital of work</h6>
                        <span>{{row.current_clinic_hospital}}</span>
                      </div>
                      <!-- <div class="inner_info dr_info">
                        <h6>Enter your availability</h6>
                        <span>{{row.availability_time_from}}</span>
                      </div> -->
                      <div class="inner_info dr_info w-100">
                        <h6>Select equipment available at your current clinic/hospital</h6>
                        <ul>
                         <!-- {{row.equipment}} -->
                          <li>Allergies</li>
                          <li>Thyroid Problems</li>
                          <li>Headaches</li>
                          <li>High/Low Blood Pressure</li>
                          <li>Heart Condition</li>
                          <li>Varicose Veins</li>
                          <li>Epilepsy</li>
                          <li>Diabetes</li>
                          <li>Other</li>
                        </ul>
                      </div>                      
                      <div class="inner_info dr_info w-100">
                        <h6>Brief summary about yourself (150 words)</h6>
                        <span>{{row.brief_summary}} </span>
                      </div>
                      <div class="inner_info dr_info w-100">
                        <h6>Terms and condition (policy and procedure of working together)</h6>
                        <span>{{row.terms_and_conditions}} </span>
                      </div>
                  </div>
                </div>
                <div class="text-right my-2">
                  <CButton size="sm" class="btn_custom py-1 px-3" 
                  v-on:click="suggestToPatient(row.suggest_id,row.doctor_id)">Suggest to Patient</CButton>
                </div>
              </div>
            </CCard>
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
                <div class="col px-2"  v-if="result.data && result.data.length > 0 && result.total > 0">
                    Showing {{ result.from }} to {{ result.to }} of
                    {{ result.total }} Entries
                </div>
                <div class="col-aut px-2" v-if="result.data && result.data.length > 0 && result.last_page > 1">
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
            keyword: '',
            doctor_suggest_id:'',
            doctor_ids:[],
        };
    },

  created() {
    this.page;
  },
  computed: {
           page() {
            if (this.keyword == '') {
                var page = 1;
                 if (this.$route.params.doctor_suggest_id != undefined) this.doctor_suggest_id = this.$route.params.doctor_suggest_id;
                if (this.$route.params.page != undefined) page = this.$route.params.page;
                this.searchDoctor({ page: page, keyword: this.keyword,doctor_suggest_id: this.doctor_suggest_id });
                return Number(page) || 1;
            } else {
            }
        },
    
    ...mapGetters("Appointment/Index", ["result","returnData"]),
  },
  methods: {
    ...mapActions("Appointment/Index", ["searchDoctor","suggest_To_Patient"]),
     paginateHandle(pageNum) {
            this.$router.push({ name: 'paginate_users', params: { page: pageNum } });
            this.searchDoctor({ page: pageNum,'keyword': this.keyword});
        },
      searchData() {
            var page = 1;
            if (this.keyword.length >= 3) {
                if (this.$route.params.page != 1)
                    this.$router.push({ name: 'paginate_users', params: { page: page } });
                this.searchDoctor({ page: page, keyword: this.keyword });
            } else {
                this.searchDoctor({ page: page, keyword: this.keyword });
            }
        },

      suggestToPatient(suggest_id,doctor_id,action="Suggest To Patient") {
            Swal.fire({
                title: 'Are you sure',
                text: 'Do you really want to ' + action + ' ' + 'This record',
                
                showCancelButton: true,
                confirmButtonText: action,
                confirmButtonColor: '#dd4b39',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    this.suggest_To_Patient({ suggest_id: suggest_id, doctor_id: doctor_id,doctor_ids:'',type:'one' }).then(() => {
                        if (this.returnData.status == 'success') {
                          Vue.$toast.open({
                                 message: this.returnData.message,
                                 type: this.returnData.status,
                             });
                         this.$router.push({ name: 'requestAppointments'});
                        }
                    });
                }
            });
        },

        check: function(e) {
          console.log(this.doctor_ids);
          },

        suggestToPatientAll(suggest_id,action="Suggest To Patient"){
            if(this.doctor_ids =='' || this.doctor_ids =='undefined'){
             Vue.$toast.open({
                   message: "Please Select at least one doctor!",
                   type: 'error',
                   duration: 5000,
                   dismissible: true
                 });
            }else{

                Swal.fire({
                title: 'Are you sure',
                text: 'Do you really want to ' + action + ' ' + 'This record',
                showCancelButton: true,
                confirmButtonText: action,
                confirmButtonColor: '#dd4b39',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    this.suggest_To_Patient({ suggest_id: suggest_id, doctor_id: '',doctor_ids:this.doctor_ids,type:'all' }).then(() => {
                        if (this.returnData.status == 'success') {
                          Vue.$toast.open({
                                 message: this.returnData.message,
                                 type: this.returnData.status,
                             });
                         this.$router.push({ name: 'requestAppointments'});
                        }
                    });
                }
            });

            }
        },
  }
}
</script>
