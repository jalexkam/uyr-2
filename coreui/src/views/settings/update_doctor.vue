<template>
  <div>
    <CRow class="m-0">
      <form class="validate-form" @submit.prevent="submitFormData">
        <CCol sm="12" class="px-2 btn-sticky">
          <div class="d-flex justify-content-between py-2 align-items-center">
            <h5 class="mb-0">Doctor <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>Update</h5>
            <div class="">
              <CButton size="sm" type="submit" class="btn_custom" :disabled="isActive">Submit </CButton>
              <router-link :to="{ name: 'profileSettings' }">
                <CButton size="sm" color="light">Back</CButton>
              </router-link>
            </div>
          </div>
        </CCol>
        <CCol sm="12" class="p-2">
          <CCard class="mb-0">
            <CCardHeader class="p-2 px-3 bg_themes">
              <div>
                <strong>Personal / General Info</strong>
              </div>
            </CCardHeader>
            <CCardBody class="px-1 py-2">
              <CRow class="m-0">
                <CCol sm="12" md="3" class="px-1">
                  <div class="form-group">
                    <label>Upload photo (With Coat and stethoscope)<span>*</span></label>
                    <div class="profile-img border rounded p-1">
                      <div class="w-100">
                        <div class="profileimg mx-auto">
                          <!--  <img v-if="user.imageBase64 && user.imageBase64!='' && user.profile!='NULL'" :src="user.imageBase64" style="width: 100%;height: 100%;object-fit: cover;">
                               <img v-else :src="user.photo_url"> -->

                          <img :src="'uploads/doctor/'+doctorResult.user_id+'/'+doctorResult.profile_photo" v-if="doctorResult.profile_photo && imageDoc ==''" />

                          <img :src="imageDoc" class="img-fluid" v-else-if="imageDoc && imageDoc!=''" />

                          <img v-else src="/uploads/profile/default-profile.png" />
                        </div>
                      </div>
                      <button class="file btn btn-sm upload_btn text-center mx-auto mt-2">
                        <vue-fontawesome icon="upload" class="px-1 mr-2" size="0.8"></vue-fontawesome>
                        Upload Photo
                        <input type="file" name="profile_picture" v-on:change="onImageChange" />
                      </button>
                    </div>
                  </div>
                </CCol>
                <CCol sm="12" md="9" class="px-2">
                  <CRow class="m-0">
                    <CCol sm="6" md="4" class="px-2">
                      <label>First Name <span class="text-danger">*</span></label>
                      <CInput v-model="formData.first_name" placeholder="" :class="[ajax_error.errors.first_name ? 'formError' : '']"/>
                      <span class="text-danger" v-if="ajax_error.errors.first_name">{{ ajax_error.errors.first_name[0] }}</span>
                    </CCol>
                    <CCol sm="6" md="4" class="px-2">
                      <label>Last Name <span class="text-danger">*</span></label>
                      <CInput placeholder="" v-model="formData.last_name" :class="[ajax_error.errors.last_name ? 'formError' : '']"/>
                      <span class="text-danger" v-if="ajax_error.errors.last_name">{{ ajax_error.errors.last_name[0] }}</span>
                    </CCol>
                    <!-- <CCol sm="6" md="4" class="px-2">
                      <label>User Name <span class="text-danger">*</span></label>
                      <CInput placeholder="" v-model="formData.user_name" />
                      <span class="text-danger" v-if="ajax_error.errors.user_name">{{ ajax_error.errors.user_name[0] }}</span>
                    </CCol> -->
                    <CCol sm="6" md="4" class="px-2">
                      <label>Email<span class="text-danger">*</span></label>
                      <CInput v-model="formData.email" placeholder="" :class="[ajax_error.errors.email ? 'formError' : '']"/>
                      <span class="text-danger" v-if="ajax_error.errors.email">{{ ajax_error.errors.email[0] }}</span>
                    </CCol>
                    <CCol sm="6" md="4" class="px-2">
                      <label>Phone No<span class="text-danger">*</span></label>
                      <CInput v-model="formData.phone_number" v-on:blur="acceptNumber" maxlength="12" @input="acceptNumber" @keypress="onlyNumric($event)" placeholder="Enter Phone No" :class="[ajax_error.errors.phone_number ? 'formError' : '']"/>
                      <span class="text-danger" v-if="ajax_error.errors.phone_number">{{ ajax_error.errors.phone_number[0] }}</span>
                    </CCol>
                    <CCol sm="6" md="4" class="px-2">
                      <label>Age</label>
                      <CInput v-model="formData.age" placeholder="" />
                      <span class="text-danger" v-if="ajax_error.errors.age">{{ ajax_error.errors.age[0] }}</span>
                    </CCol>
                    <CCol sm="6" md="3" class="px-2">
                      <div class="form-group">
                        <label>Gender<span>*</span></label><br />
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" value="0" v-model="formData.gender" id="customRadioInline1" name="gender" class="custom-control-input" />

                          <label class="custom-control-label" for="customRadioInline1">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" value="1" v-model="formData.gender" name="gender" id="customRadioInline2" class="custom-control-input" />
                          <label class="custom-control-label" for="customRadioInline2">Female</label>
                        </div>
                      </div>
                      <span class="text-danger" v-if="ajax_error.errors.gender">{{ ajax_error.errors.gender[0] }}</span>
                    </CCol>
                  </CRow>
                </CCol>
              </CRow>
            </CCardBody>
          </CCard>

          <CCard class="mb-0">
            <CCardHeader class="p-2 px-3 bg_themes">
              <div>
                <strong>Location<span>*</span></strong>
              </div>
            </CCardHeader>
            <CCardBody class="px-1 py-2">
              <CRow class="m-0">
                <CCol sm="6" md="3" class="px-2">
                  <label>Select Address<span class="text-danger">*</span></label>

                  <w3wMap :lat="formData.latitude" :lng="formData.longitude" :w3words="formData.w3w_address" mapId="w3wMap1" :autoSuggest="true" :mapDiv="false" @getmapdata="getMapData($event)"/>

                  <!-- <gmap-autocomplete class="form-control" autocomplete="off" id="google_autosearch_address" @place_changed="setPlace" :options="autocompleteOptions"> </gmap-autocomplete> -->
                </CCol>
                <CCol sm="6" md="3" class="px-2">
                  <label>Address<span class="text-danger">*</span></label>
                  <CInput placeholder="" v-model="formData.address" :class="[ajax_error.errors.address ? 'formError' : '']"/>
                  <span class="text-danger" v-if="ajax_error.errors.address">{{ ajax_error.errors.address[0] }}</span>
                </CCol>
                <!-- <CCol sm="6" md="3" class="px-2">
                  <label>Address 2<span class="text-danger">*</span></label>
                  <CInput v-model="formData.address2" placeholder="" />
                  <span class="text-danger" v-if="ajax_error.errors.address2">{{ ajax_error.errors.address2[0] }}</span>
                </CCol>
                <CCol sm="6" md="3" class="px-2">
                  <label>Area<span class="text-danger">*</span></label>
                  <CInput placeholder="" v-model="formData.area" />
                  <span class="text-danger" v-if="ajax_error.errors.area">{{ ajax_error.errors.area[0] }}</span>
                </CCol> -->
                <CCol sm="6" md="3" class="px-2">
                  <label>City<span class="text-danger">*</span></label>
                  <CInput placeholder="" v-model="formData.city" :class="[ajax_error.errors.city ? 'formError' : '']"/>
                  <span class="text-danger" v-if="ajax_error.errors.city">{{ ajax_error.errors.city[0] }}</span>
                </CCol>
                <CCol sm="6" md="3" class="px-2">
                  <label>Country<span class="text-danger">*</span></label>
                  <CInput placeholder="" v-model="formData.country" :class="[ajax_error.errors.country ? 'formError' : '']"/>
                  <span class="text-danger" v-if="ajax_error.errors.country">{{ ajax_error.errors.country[0] }}</span>
                </CCol>

                <CCol sm="6" md="3" class="px-2">
                  <label>State</label>
                  <CInput placeholder="" v-model="formData.state" />
                  <span class="text-danger" v-if="ajax_error.errors.state">{{ ajax_error.errors.state[0] }}</span>
                </CCol>

                <CCol sm="6" md="3" class="px-2">
                  <label>Zip code</label>
                  <CInput placeholder="" v-model="formData.zip_code" />
                  <span class="text-danger" v-if="ajax_error.errors.zip_code">{{ ajax_error.errors.zip_code[0] }}</span>
                </CCol>

                <CCol sm="6" md="3" class="px-2" style="display: none;">
                  <label>latitude</label>
                  <CInput placeholder="" v-model="formData.latitude" />
                  <span class="text-danger" v-if="ajax_error.errors.latitude">{{ ajax_error.errors.latitude[0] }}</span>
                </CCol>

                <CCol sm="6" md="3" class="px-2" style="display: none;">
                  <label>longitude</label>
                  <CInput placeholder="" v-model="formData.longitude" />
                  <span class="text-danger" v-if="ajax_error.errors.longitude">{{ ajax_error.errors.longitude[0] }}</span>
                </CCol>

                <CCol sm="6" md="3" class="px-2" >
                          <label>w3w address<span class="text-danger">*</span></label>
                           <CInput placeholder="" v-model="formData.w3w_address" readonly/>
                            <span class="text-danger" v-if="ajax_error.errors.w3w_address">{{ ajax_error.errors.w3w_address[0] }}</span>
                        </CCol>
                        
              </CRow>

              <w3wMap :lat="formData.latitude" :lng="formData.longitude" mapId="w3wMap2" :w3words="formData.w3w_address" :autoSuggest="false" :mapDiv="true" @getmapdata="getMapData($event)"/>

              <!-- <div class="col-md-12" v-if="markers.length>0">
                <gmap-map :center="center" :zoom="17" style="width: 100%; height: 400px;">
                  <gmap-marker :key="index" v-for="(m, index) in markers" :position="m.position" @click="center=m.position" @dragend="updateCoordinates" :draggable="true" :clickable="true"></gmap-marker>
                </gmap-map>
              </div> -->
            </CCardBody>
          </CCard>

          <CCard class="mb-0">
            <CCardHeader class="p-2 px-3 bg_themes">
              <div>
                <strong>ID and Licensing Credentials</strong>
              </div>
            </CCardHeader>
            <CCardBody class="px-1 py-2">
              <CRow class="m-0">
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" v-model="formData.type">
                      <option v-for="type, index in resultType" :value="type.id">{{type.type_name}}</option>
                    </select>
                    <span class="text-danger" v-if="ajax_error.errors.type">{{ ajax_error.errors.type[0] }}</span>
                  </div>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Certificate awarding University</label>
                    <!-- <div class="attch-button">
                                    <input type="file" name="uploadedDoc" v-on:change="cirtificatefile" />
                                 </div> -->
                    <div class="file-upload">
                      <div class="file-select">
                        <div class="file-select-button" id="fileName">Choose File</div>
                        <div class="file-select-name" id="noFile"></div>
                        <input type="file" name="uploadedDoc" v-on:change="cirtificatefile" />
                      </div>
                    </div>
                    <a v-if="formData.certificate_awarding_university" :href="'uploads/doctor/'+formData.user_id+'/'+formData.certificate_awarding_university" download> Download <CIcon name="cil-file" /> </a>

                    <span class="text-danger" v-if="ajax_error.errors.certificate_awarding_university">{{ ajax_error.errors.certificate_awarding_university[0] }}</span>
                  </div>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Copy of specialty diploma</label>
                    <!-- <div class="attch-button">
                                    <input type="file" name="specialty" v-on:change="copyOfSpecialty" />
                                  </div> -->
                    <div class="file-upload">
                      <div class="file-select">
                        <div class="file-select-button" id="fileName">Choose File</div>
                        <div class="file-select-name" id="noFile"></div>
                        <input type="file" name="specialty" v-on:change="copyOfSpecialty" />
                      </div>
                    </div>
                    <a v-if="formData.speciality_diploma" :href="'uploads/doctor/'+formData.user_id+'/'+formData.speciality_diploma" download> Download <CIcon name="cil-file" /> </a>

                    <span class="text-danger" v-if="ajax_error.errors.speciality_diploma">{{ ajax_error.errors.speciality_diploma[0] }}</span>
                  </div>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Copy of registration in the doctor’s council (Medical council)</label>
                    <!-- <div class="attch-button">
                                    <input type="file" name="registration" v-on:change="CopyOfRegistration"  />
                                 </div> -->
                    <div class="file-upload">
                      <div class="file-select">
                        <div class="file-select-button" id="fileName">Choose File</div>
                        <div class="file-select-name" id="noFile"></div>
                        <input type="file" name="registration" v-on:change="CopyOfRegistration" />
                      </div>
                    </div>

                    <a v-if="formData.copy_of_registration" :href="'uploads/doctor/'+formData.user_id+'/'+formData.copy_of_registration" download> Download <CIcon name="cil-file" /> </a>

                    <span class="text-danger" v-if="ajax_error.errors.copy_of_registration">{{ ajax_error.errors.copy_of_registration[0] }}</span>
                  </div>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <label>Enter your medical license number<span class="text-danger">*</span></label>
                  <CInput v-model="formData.medical_license_number" placeholder="" :class="[ajax_error.errors.medical_license_number ? 'formError' : '']"/>
                  <span class="text-danger" v-if="ajax_error.errors.medical_license_number">{{ ajax_error.errors.medical_license_number[0] }}</span>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group" :class="[ajax_error.errors.date_of_registration ? 'formError' : '']">
                    <label>Date of registration</label>
                    <input type="date" v-model="formData.date_of_registration" class="form-control" name="" :class="[ajax_error.errors.date_of_registration ? 'formError' : '']"/>
                    <span class="text-danger" v-if="ajax_error.errors.date_of_registration">{{ ajax_error.errors.date_of_registration[0] }}</span>
                  </div>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <label>Registration No<span class="text-danger">*</span></label>
                  <CInput v-model="formData.registration_no" placeholder="" :class="[ajax_error.errors.registration_no ? 'formError' : '']"/>
                  <span class="text-danger" v-if="ajax_error.errors.registration_no">{{ ajax_error.errors.registration_no[0] }}</span>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <label>Years of experience<span class="text-danger">*</span></label>
                  <CInput v-model="formData.experience" :class="[ajax_error.errors.experience ? 'formError' : '']"/>
                  <span class="text-danger" v-if="ajax_error.errors.experience">{{ ajax_error.errors.experience[0] }}</span>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <label>Current Clinic/hospital of work<span class="text-danger">*</span></label>
                  <CInput v-model="formData.current_clinic_hospital" placeholder="" />
                  <span class="text-danger" v-if="ajax_error.errors.current_clinic_hospital">{{ ajax_error.errors.current_clinic_hospital[0] }}</span>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <div class="sub-filter">
                    <div class="form-group">
                      <label>Select equipment available at your current clinic/hospital 
                        <!-- <small>( Add comma seprated ex. Radiography,Reflex hammer,Sphygmomanometer )</small> -->
                      </label>
                      <!-- <CInput v-model="formData.equipment" placeholder="ex. Radiography,Reflex hammer,Sphygmomanometer.." /> -->

                      <!-- <multiselect v-if="equipListResult" 
                        v-model="equipmentArr" 
                        :options="equipListResult" 
                        @input="atChangeEquipment()" 
                        :multiple="true" 
                        :close-on-select="false" 
                        :limit="2" 
                        :options-limit="300" 
                        :clear-on-select="false" 
                        :preserve-search="true" 
                        label="equipment_name" 
                        track-by="equipment_name" 
                        :preselect-first="false"
                        :hide-selected="true"
                        ></multiselect> -->

                        <multiselect
                          v-if="equipListResult"
                          v-model="equipmentArr"
                          :options="equipListResult"
                          @input="atChangeEquipment()"
                          :multiple="true" 
                          :taggable="true"
                          :close-on-select="false"
                          :options-limit="300"
                          label="equipment_name"
                          track-by="equipment_name"
                          :preselect-first="false"
                        ></multiselect>
                    </div>
                  </div>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group" :class="[ajax_error.errors.willing_to_serve_as ? 'formError' : '']">
                    <label>Willing to serve as<span>*</span></label>
                    <select class="form-control" v-model="formData.willing_to_serve_as">
                      <option v-for="(services, index) in resultService" :key="index" :value="services.id">{{services.service_name}}</option>
                    </select>
                    <span class="text-danger" v-if="ajax_error.errors.willing_to_serve_as">{{ ajax_error.errors.willing_to_serve_as[0] }}</span>
                  </div>
                </CCol>
                <!-- <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Enter your availability</label>
                    <select class="form-control" v-model="formData.availability_time_from">
                      <option v-for="availability, index in resultAvailability" :value="availability.time_from +'-'+availability.time_to">{{availability.time_from}} - {{availability.time_to}}</option>
                    </select>
                    <span class="text-danger" v-if="ajax_error.errors.enter_your_availability">{{ ajax_error.errors.enter_your_availability[0] }}</span>
                  </div>
                </CCol> -->
                <!--  <CCol sm="6" md="4" class="px-2">
                           <CInput label="Area of coverage:" v-model="formData.area_of_coverage"/>
                        </CCol>  -->

                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Account Status <span></span></label>
                    <select class="form-control" v-model="formData.status">
                      <option value="0">Pending</option>
                      <option value="1">Rejected</option>
                      <option value="2">Approved</option>
                    </select>
                  </div>
                </CCol>

                <CCol sm="12" class="px-2">
                  <div class="form-group">
                    <label>Brief summary about yourself (150 words)</label>
                    <textarea rows="6" class="form-control" v-model="formData.brief_summary"></textarea>
                  </div>
                </CCol>
                <CCol sm="12" class="px-2">
                  <div class="form-group">
                    <label>Terms and condition (policy and procedure of working together)</label>
                    <textarea rows="6" class="form-control" v-model="formData.terms_and_conditions"></textarea>
                  </div>
                </CCol>
              </CRow>
            </CCardBody>
          </CCard>
        </CCol>
      </form>
    </CRow>
  </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
  import { mapGetters, mapActions } from "vuex";
  import Vue from "vue";
  import Vuex from "vuex";
  import Form from "vform";
  import Multiselect from 'vue-multiselect'
  import commonHelper from "./../../global_helper/helpers.js";
  import w3wMap from "../components/w3wMap.vue";

  export default {
    components: {      
      Multiselect,
      w3wMap
    },
    data() {
      return {
        address: "",
        autocompleteOptions: {
          componentRestrictions: {
            //country:  'UK',
          },
        },
        ADDRESS_COMPONENTS: {
          subpremise: "short_name",
          street_number: "short_name",
          route: "long_name",
          locality: "long_name",
          administrative_area_level_1: "long_name",
          administrative_area_level_2: "long_name",
          sublocality_level_2: "long_name",
          sublocality_level_1: "long_name",
          area: "long_name",
          country: "long_name",
          postal_code: "short_name",
        },

        center: { lat: 0, lng: 0 },
        currentPlace: null,
        markers: [],
        places: [],

        formData: new Form({
          id: "",
          user_id: "",
          first_name: "",
          last_name: "",
          user_name: "",
          email: "",
          phone_number: "",
          age: "",
          gender: "",
          certificate_awarding_university: "",
          speciality_diploma: "",
          copy_of_registration: "",
          medical_council_regn: "",
          current_clinic_hospital: "",
          medical_license_number: "",
          medical_license_number: "",
          registration_no: "",
          experience: "",
          willing_to_serve_as: "0",
          brief_summary: "",
          terms_and_conditions: "",
          address: "",
          address2: "",
          area: "",
          city: "",
          country: "",
          state: "",
          zip_code: "",
          date_of_registration: "",
          type: "",
          status: 0,
          latitude: "",
          longitude: "",
          type: "",
          availability_time_from: "",
          equipment: "",
          w3w_address: ''
        }),
        uploadedDoc: "",
        specialty: "",
        registration: "",
        profile_picture: "",
        imageData: [],
        docData: [],
        dataDoc: [],
        imageDoc: [],
        equipmentArr: [],
        options: "",
        isActive: false,
      };
    },
    created() {
      this.autocompleteOptions = {
        componentRestrictions: {
          // country:  'UK'
        },
      };

      this.ServiceList();
      this.TypeList();
      this.AvailabilityList();
      this.getEquipmentList();
    },

    mounted() {
      if (this.$route.params.id != "") {
        this.getDoctorProfileFormData(this.$route.params.id);
      }
    },
    computed: {
      ...mapGetters("Doctor/Index", ["returnData", "ajax_error", "doctorResult","equipListResult"]),
      ...mapGetters("auth", ["user"]),

      ...mapGetters("Masters/ServicesMaster", ["resultService"]),
      ...mapGetters("Masters/TypesMaster", ["resultType"]),
      ...mapGetters("Masters/AvailabilityMaster", ["resultAvailability"]),
    },
    methods: {
      ...mapActions("Doctor/Index", ["submitDoctorUpdateForm", "getDoctorProfile","getEquipmentList"]),

      ...mapActions("Masters/ServicesMaster", ["ServiceList"]),
      ...mapActions("Masters/TypesMaster", ["TypeList"]),
      ...mapActions("Masters/AvailabilityMaster", ["AvailabilityList"]),

      getMapData(response) {
            
            if(response.country)
               this.formData.country       = response.country;

               if(response.words)
               this.formData.what3words    = response.words;
               this.formData.w3w_address = response.words;
               if(response.coordinates) {
                  if(response.coordinates.lat)
                  this.formData.latitude  = response.coordinates.lat;
                  if(response.coordinates.lng)
                  this.formData.longitude = response.coordinates.lng;
               }
               
               if(response.nearestPlace){
                  this.formData.area          = response.nearestPlace;
                  this.formData.address       = response.nearestPlace;
                  var city_state = response.nearestPlace.split(',');
                  this.formData.city  = city_state[0];
                  this.formData.state = city_state[1];
               }
          },
          

      onlyNumric(evt) {
        return commonHelper.onlyNumric(evt);
      },

      acceptNumber() {
        var x = this.formData.phone_number.replace(/\D/g, "").match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        this.formData.phone_number = !x[2] ? x[1] : "" + x[1] + "-" + x[2] + (x[3] ? "-" + x[3] : "");
      },

      atChangeEquipment () {
        if(this.equipmentArr.length >=0 ){
          var deptIds = [];
          for (var c=0; c<this.equipmentArr.length ; c++) {
            deptIds.push(this.equipmentArr[c].id);
          }
          this.formData.equipment = deptIds.toString();
         //  console.log(this.formData.equipment);
        }
      },

      getDoctorProfileFormData(id) {
        this.getDoctorProfile(id).then(() => {
          this.formData.keys().forEach((key) => {
            this.formData[key] = this.doctorResult[key];
          });
          this.formData.id = this.doctorResult.doctor_info_id;
          this.equipmentArr = this.doctorResult.equipmentArr;

          var lat = parseFloat(this.doctorResult.latitude);
          var lng = parseFloat(this.doctorResult.longitude);

          this.markers = [];
          const marker = {
            lat: lat,
            lng: lng,
          };
          this.markers.push({ position: marker });
          this.center = marker;
        });
      },

      cirtificatefile(e) {
        this.uploadedDoc = e.target.files[0];
        var reader = new FileReader();
        reader.onload = (e) => {
          this.imageData = e.target.result;
        };
        reader.readAsDataURL(this.uploadedDoc);
      },

      copyOfSpecialty(e) {
        this.specialty = e.target.files[0];
        var reader = new FileReader();
        reader.onload = (e) => {
          this.docData = e.target.result;
        };
        reader.readAsDataURL(this.specialty);
      },

      CopyOfRegistration(e) {
        this.registration = e.target.files[0];
        var reader = new FileReader();
        reader.onload = (e) => {
          this.dataDoc = e.target.result;
        };
        reader.readAsDataURL(this.registration);
      },

      onImageChange(e) {
        this.profile_picture = e.target.files[0];
        var reader = new FileReader();
        reader.onload = (e) => {
          this.imageDoc = e.target.result;
        };
        reader.readAsDataURL(this.profile_picture);
      },

      checkAll() {
        var inlineCheckbox1 = new Array();
        $("input:checked").each(function () {
          inlineCheckbox1.push($(this).val());
        });
      },

      submitFormData() {
        let newData = new FormData();
        newData.append("cirtificatefile", this.uploadedDoc);
        newData.append("specialtyfile", this.specialty);
        newData.append("registrationfile", this.registration);
        newData.append("profilefile", this.profile_picture);
        this.isActive = true;
        newData.append("formData", JSON.stringify(this.formData));
        this.submitDoctorUpdateForm({ newData: newData, id: this.formData.id })
          .then(() => {
            if (this.returnData.status == "success") {
              // this.$router.push({name:"profileSettings"});
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
      },

      //google data

      setPlace(place) {
        var singleValues = $("#google_autosearch_address").val();
        this.formData.full_address = singleValues;
        this.markers = [];
        this.currentPlace = place;
        this.addMarker();
      },

      addMarker() {
        if (this.currentPlace) {
          const marker = {
            lat: this.currentPlace.geometry.location.lat(),
            lng: this.currentPlace.geometry.location.lng(),
          };
          this.markers.push({ position: marker });
          this.places.push(this.currentPlace);
          this.center = marker;
          let returnData = {};

          for (let i = 0; i < this.currentPlace.address_components.length; i++) {
            let addressType = this.currentPlace.address_components[i].types[0];
            if (this.ADDRESS_COMPONENTS[addressType]) {
              let val = this.currentPlace.address_components[i][this.ADDRESS_COMPONENTS[addressType]];
              returnData[addressType] = val;
            }
          }

          this.formData.address = this.currentPlace.formatted_address;
          var city,
            state = "";
          city = returnData.locality;

          if (city == undefined || city == null) {
            city = returnData.administrative_area_level_1;
          }

          if (returnData.sublocality_level_2) this.formData.state = returnData.sublocality_level_2;
          else if (returnData.sublocality_level_1) this.formData.state = returnData.sublocality_level_1;
          else if (returnData.locality) this.formData.state = returnData.locality;

          if (returnData.route) this.formData.address2 = returnData.route;

          if (returnData.sublocality_level_1) this.formData.area = returnData.sublocality_level_1;

          if (returnData.country) this.formData.country = returnData.country;

          if (returnData.administrative_area_level_1) this.formData.state = returnData.administrative_area_level_1;

          if (returnData.locality) this.formData.city = returnData.locality;

          if (returnData.postal_code) this.formData.zip_code = returnData.postal_code;

          this.formData.latitude = this.currentPlace.geometry.location.lat();

          this.formData.longitude = this.currentPlace.geometry.location.lng();
          //End
          this.currentPlace = null;
          var location = this.formData.state + ", " + this.formData.city;
        }
      },

      updateCoordinates(location) {
        this.center = {
          lat: location.latLng.lat(),
          lng: location.latLng.lng(),
        };
        this.formData.latitude = location.latLng.lat();
        this.formData.longitude = location.latLng.lng();
      },
    },
  };
</script>
