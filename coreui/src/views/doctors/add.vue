<template>
  <div>
    <CRow class="m-0">
      <form class="validate-form" @submit.prevent="submitFormData">
        <CCol sm="12" class="px-2 btn-sticky">
          <div class="d-flex justify-content-between py-2 align-items-center">
            <h5 class="mb-0">Doctor <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>Add</h5>
            <div class="">
              <CButton type="submit" class="btn_custom" :disabled="isActive">Submit</CButton>
              <router-link :to="{ name: 'doctor' }">
                <CButton color="light">Back</CButton>
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
                          <img :src="imageDoc" class="img-fluid" v-if="imageDoc && imageDoc!=''" />
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
                      <!-- v-on:keypress="isLetter($event)" -->
                      <CInput v-model="formData.first_name" placeholder="Enter First Name" :class="[ajax_error.errors.first_name ? 'formError' : '']" />
                      <span class="text-danger" v-if="ajax_error.errors.first_name">{{ ajax_error.errors.first_name[0] }}</span>
                    </CCol>
                    <CCol sm="6" md="4" class="px-2">
                      <label>Last Name <span class="text-danger">*</span></label>
                      <CInput placeholder="Enter last Name" v-model="formData.last_name" :class="[ajax_error.errors.last_name ? 'formError' : '']"/>
                      <span class="text-danger" v-if="ajax_error.errors.last_name">{{ ajax_error.errors.last_name[0] }}</span>
                    </CCol>
                    <!-- <CCol sm="6" md="4" class="px-2">
                        <label>User Name <span class="text-danger">*</span></label>
                           <CInput placeholder="Enter User Name" v-model="formData.user_name"  />
                            <span class="text-danger" v-if="ajax_error.errors.user_name">{{ ajax_error.errors.user_name[0] }}</span>                        
                        </CCol> -->
                    <CCol sm="6" md="4" class="px-2">
                      <label>Email<span class="text-danger">*</span></label>
                      <CInput v-model="formData.email" type="email" placeholder="Enter email" @blur="validateEmail" @input="validateEmail" @keypress="validateEmail" :class="[ajax_error.errors.email ? 'formError' : '']"/>
                      <span class="text-danger" v-if="ajax_error.errors.email">{{ ajax_error.errors.email[0] }}</span>
                    </CCol>
                    <CCol sm="6" md="4" class="px-2">
                      <label>Phone No<span class="text-danger">*</span></label>
                      <CInput v-model="formData.phone_number" v-on:blur="acceptNumber" maxlength="12" @input="acceptNumber" @keypress="onlyNumric($event)" placeholder="Enter Phone No" :class="[ajax_error.errors.phone_number ? 'formError' : '']"/>
                      <span class="text-danger" v-if="ajax_error.errors.phone_number">{{ ajax_error.errors.phone_number[0] }}</span>
                    </CCol>
                    <CCol sm="6" md="4" class="px-2">
                      <label>Password<span class="text-danger">*</span></label>
                      <CInput placeholder="Enter Password" type="password" v-model="formData.password" :class="[ajax_error.errors.password ? 'formError' : '']"/>
                      <span class="text-danger" v-if="ajax_error.errors.password">{{ ajax_error.errors.password[0] }}</span>
                    </CCol>
                    <CCol sm="6" md="4" class="px-2">
                      <label>Confirm Password<span class="text-danger">*</span></label>
                      <CInput placeholder="Enter Confirm Password" type="password" v-model="formData.password_confirmation" :class="[ajax_error.errors.password_confirmation ? 'formError' : '']"/>
                      <span class="text-danger" v-if="ajax_error.errors.password_confirmation">{{ ajax_error.errors.password_confirmation[0] }}</span>
                    </CCol>
                    <CCol sm="6" md="4" class="px-2">
                      <label>Age</label>
                      <CInput type="number" v-model="formData.age" placeholder="Enter Age" />
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
                <strong>Location</strong>
              </div>
            </CCardHeader>
            <CCardBody class="px-1 py-2">
              <CRow class="m-0">
                <CCol sm="6" md="3" class="px-2">
                  <label>Search Location<span class="text-danger">*</span></label>

                  <w3wMap :lat="formData.latitude" :lng="formData.longitude" :w3words="formData.w3w_address" mapId="w3wMap1" :autoSuggest="true" :mapDiv="false" @getmapdata="getMapData($event)"/>

                  <!-- <a @click="getLocation" href="javascript:void(0)" class="font-weight-bold text-danger">
                    <vue-fontawesome icon="compass" class="ml-2" size="1"></vue-fontawesome>
                    Get Current location
                  </a> -->

                  <!-- <what3words-autosuggest id="autosuggest" api_key="WZ7WH7VU" @suggestions_changed="setPlaceautosuggest" >
                                <input type="text" />
                           </what3words-autosuggest> -->
                  <!-- <gmap-autocomplete class="form-control" autocomplete="off" id="google_autosearch_address" @place_changed="setPlace" :options="autocompleteOptions"> </gmap-autocomplete> -->
                </CCol>

                <!--  {{what3wordresponse}}
 -->
                <CCol sm="6" md="6" class="px-2">
                  <label>Address<span class="text-danger">*</span></label>
                  <CInput placeholder="Enter Address" v-model="formData.address" :class="[ajax_error.errors.address ? 'formError' : '']"/>
                  <span class="text-danger" v-if="ajax_error.errors.address">{{ ajax_error.errors.address[0] }}</span>
                </CCol>
                <!--  <CCol sm="6" md="3" class="px-2">
                          <label>Address 2<span class="text-danger">*</span></label>
                           <CInput v-model="formData.address2" placeholder=""/>
                           <span class="text-danger" v-if="ajax_error.errors.address2">{{ ajax_error.errors.address2[0] }}</span>
                        </CCol> 
                        <CCol sm="6" md="3" class="px-2">
                          <label>Area<span class="text-danger">*</span></label>
                           <CInput placeholder="" v-model="formData.area" />
                           <span class="text-danger" v-if="ajax_error.errors.area">{{ ajax_error.errors.area[0] }}</span>
                        </CCol> -->
                <CCol sm="6" md="3" class="px-2">
                  <label>City<span class="text-danger">*</span></label>
                  <CInput placeholder="Enter City" v-model="formData.city" :class="[ajax_error.errors.city ? 'formError' : '']"/>
                  <span class="text-danger" v-if="ajax_error.errors.city">{{ ajax_error.errors.city[0] }}</span>
                </CCol>
                <CCol sm="6" md="3" class="px-2">
                  <label>Country<span class="text-danger">*</span></label>
                  <CInput placeholder="Enter Country" v-model="formData.country" :class="[ajax_error.errors.country ? 'formError' : '']"/>
                  <span class="text-danger" v-if="ajax_error.errors.country">{{ ajax_error.errors.country[0] }}</span>
                </CCol>

                <CCol sm="6" md="3" class="px-2">
                  <label>State</label>
                  <CInput placeholder="Enter State" v-model="formData.state" />
                  <span class="text-danger" v-if="ajax_error.errors.state">{{ ajax_error.errors.state[0] }}</span>
                </CCol>

                <CCol sm="6" md="3" class="px-2">
                  <label>Zip code </label>
                  <CInput placeholder="Enter Zip Code" v-model="formData.zip_code" />
                  <span class="text-danger" v-if="ajax_error.errors.zip_code">{{ ajax_error.errors.zip_code[0] }}</span>
                </CCol>

                <CCol sm="6" md="3" class="px-2" style="display: none;">
                          <label>latitude<span class="text-danger">*</span></label>
                           <CInput placeholder="" v-model="formData.latitude" />
                          <span class="text-danger" v-if="ajax_error.errors.latitude">{{ ajax_error.errors.latitude[0] }}</span>
                        </CCol>

                        <CCol sm="6" md="3" class="px-2" style="display: none;">
                          <label>longitude<span class="text-danger">*</span></label>
                           <CInput placeholder="" v-model="formData.longitude" />
                            <span class="text-danger" v-if="ajax_error.errors.longitude">{{ ajax_error.errors.longitude[0] }}</span>
                        </CCol>

                        <CCol sm="6" md="3" class="px-2" style="display: none;">
                          <label>w3w latitude<span class="text-danger">*</span></label>
                           <CInput placeholder="" v-model="formData.w3w_latitude" />
                            <span class="text-danger" v-if="ajax_error.errors.w3w_latitude">{{ ajax_error.errors.w3w_latitude[0] }}</span>
                        </CCol>

                        <CCol sm="6" md="3" class="px-2" style="display: none;">
                          <label>w3w longitude<span class="text-danger">*</span></label>
                           <CInput placeholder="" v-model="formData.w3w_longitude" />
                            <span class="text-danger" v-if="ajax_error.errors.w3w_longitude">{{ ajax_error.errors.w3w_longitude[0] }}</span>
                        </CCol>

                <CCol sm="6" md="3" class="px-2" >
                          <label>w3w address<span class="text-danger">*</span></label>
                           <CInput placeholder="" v-model="formData.w3w_address" readonly/>
                            <span class="text-danger" v-if="ajax_error.errors.w3w_address">{{ ajax_error.errors.w3w_address[0] }}</span>
                        </CCol>

              </CRow>

              <w3wMap :lat="formData.latitude" :lng="formData.longitude" mapId="w3wMap2" :w3words="formData.w3w_address" :autoSuggest="false" :mapDiv="true" @getmapdata="getMapData($event)"/>

              <!-- <div class="col-md-12" v-if="markers.length>0">
                <gmap-map :center="center" :zoom="25" style="width: 100%; height: 400px;">
                  <gmap-marker :key="index" v-for="(m, index) in markers" :position="m.position" @click="center=m.position" :draggable="true" :clickable="true" @dragend="updateCoordinates"></gmap-marker>
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
                        <div class="file-select-name" id="noFile" v-if="this.uploadedDoc">{{this.uploadedDoc.name}}</div>
                        <div class="file-select-name" id="noFile" v-else></div>
                        <input type="file" name="uploadedDoc" v-on:change="cirtificatefile" />
                      </div>
                    </div>
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
                        <div class="file-select-name" id="noFile" v-if="this.specialty">{{this.specialty.name}}</div>
                        <div class="file-select-name" id="noFile" v-else></div>
                        <input type="file" name="specialty" v-on:change="copyOfSpecialty" />
                      </div>
                    </div>
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
                        <div class="file-select-name" id="noFile" v-if="this.registration">{{this.registration.name}}</div>
                        <div class="file-select-name" id="noFile" v-else></div>
                        <input type="file" name="registration" v-on:change="CopyOfRegistration" />
                      </div>
                    </div>
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
                    <label>Date of registration <span class="text-danger">*</span></label>
                    <input type="date" v-model="formData.date_of_registration" class="form-control" name="" />
                    <span class="text-danger" v-if="ajax_error.errors.date_of_registration">{{ ajax_error.errors.date_of_registration[0] }}</span>
                  </div>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <label>Registration No<span class="text-danger">*</span></label>
                  <CInput v-model="formData.registration_no" placeholder="Enter Registration No " :class="[ajax_error.errors.registration_no ? 'formError' : '']"/>
                  <span class="text-danger" v-if="ajax_error.errors.registration_no">{{ ajax_error.errors.registration_no[0] }}</span>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <label>Years of experience<span class="text-danger">*</span></label>
                  <CInput v-model="formData.experience" placeholder="Enter Years of experience" :class="[ajax_error.errors.experience ? 'formError' : '']"/>
                  <span class="text-danger" v-if="ajax_error.errors.experience">{{ ajax_error.errors.experience[0] }}</span>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <label>Current Clinic/hospital of work</label>
                  <CInput v-model="formData.current_clinic_hospital" placeholder="Enter Current Clinic/hospital of work" />
                  <span class="text-danger" v-if="ajax_error.errors.current_clinic_hospital">{{ ajax_error.errors.current_clinic_hospital[0] }}</span>
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <CInput label="Fees amount:" v-model="formData.fees_amount" placeholder="Enter Fees Amount" type="number" />
                </CCol>
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group" :class="[ajax_error.errors.willing_to_serve_as ? 'formError' : '']">
                    <label>Willing to serve as<span>*</span></label>
                    <select class="form-control" v-model="formData.willing_to_serve_as" >
                      <option v-for="service, index in resultService" :value="service.id">{{service.service_name}}</option>
                    </select>
                    <span class="text-danger" v-if="ajax_error.errors.willing_to_serve_as">{{ ajax_error.errors.willing_to_serve_as[0] }}</span>
                  </div>
                </CCol>
                <!-- <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Enter your availability</label>
                    <select class="form-control" v-model="formData.availability_time_from">
                      <option v-for="availability, index in resultAvailability" :value="availability.time_from +'-'+availability.time_to">{{availability.time_from}} - {{availability.time_to}}</option>
                      
                    <span class="text-danger" v-if="ajax_error.errors.availability_time_from">{{ ajax_error.errors.availability_time_from[0] }}</span>
                  </div>
                </CCol> -->
                <CCol sm="6" md="4" class="px-2">
                  <CInput label="Area of coverage:" placeholder="Enter Area Of Coverage" v-model="formData.area_of_coverage" />
                </CCol>
                <CCol sm="6" md="4" class="px-2" v-if="user && (user.role_type ==1 || user.role_type == 2)">
                  <div class="form-group">
                    <label>Account Status <span></span></label>
                    <select class="form-control" v-model="formData.status">
                      <option value="0">Pending</option>
                      <option value="1">Rejected</option>
                      <option value="2">Approved</option>
                    </select>
                  </div>
                </CCol>                
                <CCol sm="6" md="4" class="px-2">
                  <div class="form-group">
                    <label>Select equipment available at your current clinic/hospital 
                      <!-- <small>( Add comma seprated ex. Radiography,Reflex hammer,Sphygmomanometer )</small> -->
                    </label>
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
                </CCol>  
                <CCol sm="12" class="px-2">
                  <div class="form-group">
                    <label>Brief summary about yourself (150 words)</label>
                    <textarea rows="6" class="form-control" placeholder="Enter Your Brief Summary Here" v-model="formData.brief_summary"></textarea>
                  </div>
                </CCol>
                <CCol sm="12" class="px-2">
                  <div class="form-group">
                    <label>Terms and condition (policy and procedure of working together)</label>
                    <textarea rows="6" class="form-control" placeholder="Enter Terms & Condition" v-model="formData.terms_and_conditions"></textarea>
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

<script lang="ts">
  import { What3wordsAutosuggest } from '@what3words/vue-components'

  export default {
    name: 'Autosuggest',
    components: {
      What3wordsAutosuggest,
    },
    props: {
      callback: String,
      api_key: String,
      headers: String,
      base_url: String,
      name: String,
      initial_value: String,
      variant: String,
      typeahead_delay: Number,
      invalid_address_error_message: String,
      language: String,
      n_focus_results: Number,
      clip_to_country: String,
      clip_to_bounding_box: String,
      clip_to_circle: String,
      clip_to_polygon: String,
      return_coordinates: Boolean,
      value_changed: Function,
      value_valid: Function,
      value_invalid: Function,
      selected_suggestion: Function,
      suggestions_changed: Function,
      coordinates_changed: Function,
      __hover: Function,
      __focus: Function,
      __blur: Function,
      __error: Function,
    },
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
  import { mapGetters, mapActions } from "vuex";
  import Vue from "vue";
  import Vuex from "vuex";
  import Form from "vform";
  import Multiselect from "vue-multiselect";
  import VueToast from "vue-toast-notification";
  import "vue-toast-notification/dist/theme-sugar.css";
  Vue.use(VueToast);
  import InputTag from "vue-input-tag";
  Vue.component("input-tag", InputTag);
  import commonHelper from "./../../global_helper/helpers.js";
  import w3wMap from "../components/w3wMap.vue";


  export default {
    components: {
      Multiselect,
      w3wMap
    },
    data() {
      return {
        markers: [],
        address: "",
        autocompleteOptions: {
          componentRestrictions: {
            // country:  ['UK','IN'],
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
        markers: [],
        places: [],

        formData: new Form({
          first_name: "",
          last_name: "",
          user_name: "",
          email: "",
          phone_number: "",
          password: "",
          password_confirmation: "",
          age: "",
          gender: "",
          certificate_awarding_university: "",
          speciality_diploma: "",
          medical_council_regn: "",
          current_clinic_hospital: "",
          medical_license_number: "",
          medical_license_number: "",
          registration_no: "",
          experience: "",
          willing_to_serve_as: "",
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
          dr_type: "",
          equipment: "",
          availability_time_from: "",
          area_of_coverage: "",
          fees_amount: "",
          what3wordsjson: "",
          what3words: "",
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
        searchByEquipment: "",
        options: "",
        isActive: false,
        what3wordresponse: "",
      };
    },
    created() {
      this.autocompleteOptions = {
        componentRestrictions: {
          //country:  ['IN']
        },
      };

      this.ServiceList();
      this.TypeList();
      this.AvailabilityList();
      this.getEquipmentList();
    },

    mounted() {},
    computed: {
      ...mapGetters("Doctor/Index", ["returnData", "equipListResult", "ajax_error"]),

      ...mapGetters("auth", ["user"]),
      ...mapGetters("Masters/EquipmentsMaster", ["result"]),
      ...mapGetters("Masters/ServicesMaster", ["resultService"]),
      ...mapGetters("Masters/TypesMaster", ["resultType"]),
      ...mapGetters("Masters/AvailabilityMaster", ["resultAvailability"]),
    },

    methods: {
      ...mapActions("Doctor/Index", ["submitForm", "getEquipmentList"]),

      ...mapActions("Masters/EquipmentsMaster", ["EquipmentList"]),
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
                  this.formData.w3w_latitude = response.coordinates.lat;
                  if(response.coordinates.lng)
                  this.formData.longitude = response.coordinates.lng;
                  this.formData.w3w_longitude = response.coordinates.lng;
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

      atChangeEquipment() {
        if (this.equipmentArr.length > 0) {
          var deptIds = [];
          for (var c = 0; c < this.equipmentArr.length; c++) {
            deptIds.push(this.equipmentArr[c].id);
          }
          this.formData.equipment = deptIds.toString();
        }
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
        console.log(this.registration);
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

      /* onImageChange(e) 
      {
          this.profile = e.target.files[0];
          var reader = new FileReader();
          reader.onload = (e) => {
              this.imageData = e.target.result;
          }
          $('#hideMainImageSpan').hide();
          reader.readAsDataURL(this.profile);
          this.newData.append('profile',this.profile);
      },*/

      submitFormData() {
        let newData = new FormData();
        newData.append("cirtificatefile", this.uploadedDoc);
        newData.append("specialtyfile", this.specialty);
        newData.append("registrationfile", this.registration);
        newData.append("profilefile", this.profile_picture);
        this.isActive = true;
        var id = "";
        newData.append("formData", JSON.stringify(this.formData));
        this.submitForm({ newData: newData, id: id })
          .then(() => {
            if (this.returnData.status == "success") {
              this.$router.push({ name: "doctor" });
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
      /* getAddressData: function (addressData, placeResultData, id) {
         this.address = addressData;
      }, */

      setPlaceautosuggest() {
        var autosuggest = "";
        var what3var = "";
        var autosuggest = document.getElementById("autosuggest");
        autosuggest.addEventListener("selected_suggestion", (value) => {
          what3var = value.detail.suggestion.words;
          what3words.api.convertToCoordinates(what3var).then((response) => {
            this.what3wordresponse = response;
            this.formData.what3wordsjson = response;

            if (response.country) this.formData.country = response.country;

            if (response.words) this.formData.what3words = response.words;

            if (response.coordinates) {
              if (response.coordinates.lat) this.formData.latitude = response.coordinates.lat;
              if (response.coordinates.lng) this.formData.longitude = response.coordinates.lng;
            }

            if (response.nearestPlace) {
              this.formData.area = response.nearestPlace;
              this.formData.address = response.nearestPlace;
              var city_state = response.nearestPlace.split(",");
              this.formData.city = city_state[0];
              this.formData.state = city_state[1];
            }
            // document.getElementById("response-screen").innerHTML = JSON.stringify(response);
          });
        });

        //console.log(autosuggest);
      },

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
        this.getReverseGeocodingData(location.latLng.lat(), location.latLng.lng());
        this.formData.latitude = location.latLng.lat();
        this.formData.longitude = location.latLng.lng();
      },

      // new changes

      getReverseGeocodingData(lat, lng) {
        var latlng = new google.maps.LatLng(lat, lng);
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ latLng: latlng }, (results, status) => {
          if (status !== google.maps.GeocoderStatus.OK) {
          }
          if (status == google.maps.GeocoderStatus.OK) {
            var address = results[0].formatted_address;
            console.log(results[0]);

            this.formData.full_address = address;
            this.markers = [];
            this.currentPlace = results[0];
            this.addMarker();
            this.formData.address = address;
          }
        });
      },

      getLocation() {
        let options = {
          enableHighAccuracy: true,
          timeout: 5000,
          maximumAge: 0,
        };
        let geolocation = navigator.geolocation;
        if (geolocation) {
          geolocation.getCurrentPosition(this.onGeoSuccess, this.onGeoError, options);
        } else {
          console.log("Geolocation is not supported by this browser.");
        }
      },

      onGeoSuccess(position) {
        this.getReverseGeocodingData(position.coords.latitude, position.coords.longitude);
      },

      onGeoError(error) {},

      validateEmail() {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
          this.msg["email"] = "Please enter a valid email address";
        } else {
          this.msg["email"] = "";
        }
      },
      isLetter(e) {
        let char = String.fromCharCode(e.keyCode); // Get the character
        if (/^[A-Za-z]+$/.test(char)) return true;
        // Match with regex
        else e.preventDefault(); // If not match, don't add to input text
      },
    },
  };
</script>
