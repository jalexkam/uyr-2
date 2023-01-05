<template>
  <div>
    <CRow class="m-0">
      <form class="validate-form" @submit.prevent="submitFormData">
        <CCol sm="12" class="px-2 btn-sticky">
          <div class="d-flex justify-content-between py-2 align-items-center">
            <h5 class="mb-0">
              Patient
              <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>
              Booking
            </h5>
            <div class="">
              <CButton type="submit" class="btn_custom" v-if="doctor_id == '' && patient_id == ''">Next</CButton>
              <CButton type="submit" class="btn_custom" v-else>Book Appointment</CButton>
            </div>
          </div>
        </CCol>
        <CCol sm="9" class="p-2">
          <CCard class="mb-0">
            <CCardHeader class="p-2 px-3 bg_themes">
              <div>
                <strong>Booking request:</strong>
              </div>
            </CCardHeader>
            <CCardBody class="px-1 py-2">
              <CRow class="m-0">
                <CCol sm="6" md="4" class="px-2" style="display: none;">
                  <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" v-model="formData.booking_type" @change="bookingTypeChange( $event)">
                      <option value="FindMySelf">Find by myself</option>
                      <!-- <option value="Suggest">Suggest me Doctor</option> -->
                    </select>
                  </div>
                </CCol>

                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Select Patient</label>
                    <select class="form-control" v-model="formData.patient_id">
                      <option value=""> Select Patient</option>
                      <option v-for="row, index in patientData" :value="row.patient_id">{{row.first_name}} {{row.last_name}}</option>
                    </select>
                  </div>
                </CCol>

                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Where to Visit</label>
                    <select class="form-control" v-model="formData.visit_type">
                      <option value="0">Home Visit</option>
                      <option value="1">Clinic Visit</option>
                    </select>
                  </div>
                </CCol>
              </CRow>

              <CRow class="m-0">
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Select Type of Specialist</label>
                    <select class="form-control" v-model="formData.type_specialist">
                      <option v-for="type, index in masterType" :value="type.id">{{type.type_name}}</option>
                    </select>
                  </div>
                </CCol>

                <CCol md="4" class="px-2" v-show="formData.type_specialist == 4">
                  <div class="form-group">
                    <label>Select required health specialist </label><br />
                    <select class="form-control" v-model="formData.health_specialist">
                      <option value="Allergy and immunology">Allergy and immunology</option>
                      <option value="Anaesthesiology">Anaesthesiology</option>
                      <option value="Dermatology">Dermatology</option>
                      <option value="Diagnostic radiology">Diagnostic radiology</option>
                      <option value="Emergency medicine">Emergency medicine</option>
                      <option value="Family medicine">Family medicine</option>
                      <option value="Internal medicine">Internal medicine</option>
                      <option value="Medical genetics">Medical genetics</option>
                      <option value="Neurology">Neurology</option>
                      <option value="Nuclear medicine">Nuclear medicine</option>
                      <option value="Obstetrics and gynaecology">Obstetrics and gynaecology</option>
                      <option value="Ophthalmology">Ophthalmology</option>
                      <option value="Pathology">Pathology</option>
                      <option value="Paediatrics">Paediatrics</option>
                      <option value="Physical medicine and rehabilitation">Physical medicine and rehabilitation</option>
                      <option value="Preventive medicine">Preventive medicine</option>
                      <option value="Psychiatry">Psychiatry</option>
                      <option value="Radiation oncology">Radiation oncology</option>
                      <option value="Surgery">Surgery</option>
                      <option value="Urology">Urology </option>
                      <option value="Preventive cardiologists">Preventive cardiologists </option>
                    </select>
                  </div>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Add medical recommendation:</label><br />
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" value="0" v-model="formData.medical_recommendation" id="customRadioInlines1" name="customRadioInlines1" class="custom-control-input" />
                      <label class="custom-control-label" for="customRadioInlines1">Yes</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" value="1" v-model="formData.medical_recommendation" id="customRadioInlines2" name="customRadioInlines1" class="custom-control-input" />
                      <label class="custom-control-label" for="customRadioInlines2">No</label>
                    </div>
                  </div>
                </CCol>
              </CRow>

              <CRow class="m-0" v-if="formData.booking_type =='Suggest'">
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Select Date</label>
                    <date-picker v-model="formData.date_of_suggest" type="date" format="DD/MM/YYYY" min="01/01/1980" color="#2c449e" :auto-submit="true" :editable="true"></date-picker>
                    <span class="text-danger" v-if="ajax_error.errors.date_of_suggest">{{ ajax_error.errors.date_of_suggest[0] }}</span>
                  </div>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Select Time</label>
                    <div class="d-flex align-items-center">
                      <date-picker v-model="formData.to_time" type="time" format="HH:mm" :editable="true" :jumpMinute="30" :roundMinute="true" color="#2c449e"></date-picker>
                      <span class="text-danger" v-if="ajax_error.errors.to_time">{{ ajax_error.errors.to_time[0] }}</span>
                    </div>
                  </div>
                </CCol>
              </CRow>

              <CRow class="m-0">
                <CCol sm="6" md="4" class="px-2" v-if="formData.medical_recommendation == 0">
                  <div class="form-group">
                    <label> Upload med report with recommendation if available</label>
                    <input type="file" name="recommendation_file" v-on:change="recommendationfile" />
                  </div>
                </CCol>
                <CCol sm="6" md="8" class="px-2">
                  <div class="form-group">
                    <label> Enter details for other reason here</label>
                    <textarea class="form-control" rows="3" v-model="formData.reason"></textarea>
                  </div>
                </CCol>
              </CRow>
            </CCardBody>
          </CCard>

          <div>
            <CCard class="mb-0">
              <CCardHeader class="p-2 px-3 bg_themes">
                <div>
                  <strong>Medical History</strong>
                </div>
              </CCardHeader>
              <CCardBody class="px-1 py-2">
                <CRow class="m-0">
                  <CCol sm="12" md="12" class="px-2">
                    <div class="form-group medi_his">
                      <label> Do you know if the patient suffers from any of the following conditions?</label><br />

                      <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox1" value="Allergies">
                                    <label class="form-check-label" for="inlineCheckbox1">Allergies</label>
                                 </div> -->
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox2" value="Thyroid Problems" />
                        <label class="form-check-label" for="inlineCheckbox2">Thyroid Problems</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox3" value="Headaches" />
                        <label class="form-check-label" for="inlineCheckbox3">Headaches</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox4" value="High/Low Blood Pressure" />
                        <label class="form-check-label" for="inlineCheckbox4">High/Low Blood Pressure</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox5" value="Heart Condition" />
                        <label class="form-check-label" for="inlineCheckbox5">Heart Condition</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox7" value="Varicose Veins" />
                        <label class="form-check-label" for="inlineCheckbox7">Varicose Veins</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox8" value="Eczema/Psoriasis" />
                        <label class="form-check-label" for="inlineCheckbox8">Eczema/Psoriasis</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox9" value="Cancer" />
                        <label class="form-check-label" for="inlineCheckbox9">Cancer</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox10" value="IBS/Bowel Problems" />
                        <label class="form-check-label" for="inlineCheckbox10">IBS/Bowel Problems</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox11" value="Arthritis/Rheumatism" />
                        <label class="form-check-label" for="inlineCheckbox11">Arthritis/Rheumatism</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox12" value="Epilepsy" />
                        <label class="form-check-label" for="inlineCheckbox12">Epilepsy</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox13" value="Claustrophobia" />
                        <label class="form-check-label" for="inlineCheckbox13">Claustrophobia</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox14" value="Asthma/Lung Problems" />
                        <label class="form-check-label" for="inlineCheckbox14">Asthma/Lung Problems </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox15" value="Back Problems" />
                        <label class="form-check-label" for="inlineCheckbox15">Back Problems </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox16" value="Fungal Infection" />
                        <label class="form-check-label" for="inlineCheckbox16">Fungal Infection </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox17" value="Diabetes" />
                        <label class="form-check-label" for="inlineCheckbox17">Diabetes </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox18" value="Muscular Pain" />
                        <label class="form-check-label" for="inlineCheckbox18">Muscular Pain</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.medical_history" id="inlineCheckbox19" value="Other" />
                        <label class="form-check-label" for="inlineCheckbox19">Other</label>
                      </div>
                    </div>
                  </CCol>
                  <CCol md="12" class="px-2">
                    <div class="form-group">
                      <label> If you have ticked any of the above, please give details:</label>
                      <textarea class="form-control" rows="3" v-model="formData.description"></textarea>
                    </div>
                  </CCol>
                </CRow>
              </CCardBody>
            </CCard>
          </div>
        </CCol>
      </form>
    </CRow>
  </div>
</template>
<script>
  import { mapGetters, mapActions } from "vuex";
  import Vue from "vue";
  import Vuex from "vuex";
  import Form from "vform";
  import VueDatetimePickerJs from "vue-date-time-picker-js";
  Vue.component("date-picker", VueDatetimePickerJs);
  export default {
    data() {
      return {
        date: "",
        id: "",
        datetime: "",
        recommendation_file: "",
        selectType: 1,
        formData: new Form({
                              type_specialist: 1,
                              date_of_suggest: "",
                              to_time: "00.00",
                              health_specialist: "",
                              visit_type: 0,
                              medical_report_attachment: "",
                              reason: "",
                              medical_history: [],
                              description: "",
                              medical_recommendation: 1,
                              patient_id: "",
                              booking_type: "FindMySelf",
                           }),
        masterType: [],
        patientData: [],
        doctor_id: "",
        patient_id: "",
      };
    },
    components: {
      datePicker: VueDatetimePickerJs,
    },
    computed: {
      ...mapGetters("Patient/Index", ["result", "returnData", "ajax_error", "patientList", "getFavDoctorResult"]),
    },

    created() {
      if (this.$route.params.d_id && this.$route.params.p_id) {
        this.doctor_id = this.$route.params.d_id;
        this.patient_id = this.$route.params.p_id;

        this.getFavDoctorData(this.doctor_id).then(() => {
          this.formData.type_specialist = this.getFavDoctorResult.type;
          this.formData.patient_id = this.patient_id;
        });
      }
      this.get_PatientsList();
    },
    methods: {
      ...mapActions("Patient/Index", ["getPatientData", "submitBookingRequestForm", "getPatientsList", "getFavDoctorData"]),
      
      get_PatientsList() {
        this.getPatientsList().then(() => {
          this.patientData = this.patientList.patient;
          this.masterType = this.patientList.masterType;
        });
      },

      recommendationfile(e) {
        this.recommendation_file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = (e) => {};
        reader.readAsDataURL(this.recommendation_file);
      },

      submitFormData() {
        if (this.formData.patient_id == "") {
          Vue.$toast.open({
            message: "Please Select Patient!",
            type: "error",
            duration: 5000,
            dismissible: true,
          });
        } else {
          let newData = new FormData();
          newData.append("recommendationfile", this.recommendation_file);
          this.isActive = true;
          newData.append("formData", JSON.stringify(this.formData));
          this.submitBookingRequestForm({ newData: newData })
            .then(() => {
              if (this.returnData.status == "success") {
                if (this.doctor_id != "" && this.patient_id != "") {
                  this.$router.push({ name: "view_doctor_patient", params: { id: this.doctor_id, doctor_suggest_id: this.returnData.id } });
                } else {
                  this.$router.push({ name: "searchDoctor", params: { id: this.returnData.id, p_id: this.formData.patient_id} });
                }

                this.isActive = false;
                Vue.$toast.open({
                  message: this.returnData.message,
                  type: this.returnData.status,
                });
              }
            })
            .catch((error) => {
              window.scrollTo(0, 0);
              this.isActive = false;
            });
        }
      },
      bookingTypeChange(event) {
        this.formData.booking_type = event.target.value;
      },
    },
  };
</script>
