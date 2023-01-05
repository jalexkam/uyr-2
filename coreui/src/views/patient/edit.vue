<template>
   <div>
      <CRow class="m-0">
         <form class="validate-form" @submit.prevent="submitFormData"  >

         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">Patient <vue-fontawesome icon="caret-right" class="px-1" size="1">
               </vue-fontawesome>{{this.lable}}</h5>
               <div class="">
                  <CButton size="sm" type="submit" class="btn_custom" :disabled="isActive">Submit</CButton>
                  <router-link :to="{ name: 'patient' }" >
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
                         <!-- <CCol sm="12" md="3" class="px-1">
                        <div class="form-group">
                           <label>Upload photo<span>*</span></label>
                           <div class="profile-img border rounded p-1">
                            <div class="w-100">
                              <div class="profileimg mx-auto">
                              <img :src="imageDoc" class="img-fluid"v-if="imageDoc && imageDoc!=''" />
                              <img v-else src="/uploads/profile/default-profile.png">
                              </div>
                            </div>
                              <button class="file btn btn-sm upload_btn text-center mx-auto mt-2">
                                 <vue-fontawesome icon="upload" class="px-1 mr-2" size="0.8"></vue-fontawesome>
                                 Upload Photo
                                 <input type="file" name="profile_picture"  
                                 v-on:change="onImageChange">
                              </button>
                           </div>
                        </div>
                     </CCol> -->
                        <CCol sm="12" md="12" class="px-2">
                        <CRow class="m-0">  
                        <CCol sm="6" md="4" class="px-2">
                        <label>First Name <span class="text-danger">*</span></label>
                           <CInput  v-model="formData.first_name" placeholder=""/>
                           <span class="text-danger" v-if="ajax_error.errors.first_name">{{ ajax_error.errors.first_name[0] }}</span>
                        </CCol>
                         <CCol sm="6" md="4" class="px-2">            
                          <label>Last Name <span class="text-danger" >*</span></label>
                           <CInput placeholder="" v-model="formData.last_name" />
                           <span class="text-danger" v-if="ajax_error.errors.last_name">{{ ajax_error.errors.last_name[0] }}</span>
                        </CCol>

                        <CCol sm="6" md="4" class="px-2">
                          <label>Also Known as (Name)<span class="text-danger"></span></label>
                           <CInput  placeholder="Also Known as (Name)" v-model="formData.nickname" />
                         </CCol>
                        
                        
                        <CCol sm="6" md="4" class="px-2">
                          <label>Email<span class="text-danger">*</span></label>
                           <CInput v-model="formData.email" placeholder=""/>
                          <span class="text-danger" v-if="ajax_error.errors.email">{{ ajax_error.errors.email[0] }}</span>
                        </CCol>


                        <CCol sm="3" md="2" class="px-1">
                          <label>Phone No<span class="text-danger">*</span></label>
                           <CInput v-model="formData.phone_number" v-on:blur="acceptNumber" maxlength="12" @input="acceptNumber" @keypress="onlyNumric($event)" placeholder="" />
                           <span class="text-danger" v-if="ajax_error.errors.phone_number">{{ ajax_error.errors.phone_number[0] }}</span>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2" v-if="user_id == ''">
                                             
                        <label>Password<span class="text-danger">*</span></label>
                           <CInput placeholder="" type="password" v-model="formData.password" />
                            <span class="text-danger" v-if="ajax_error.errors.password">{{ ajax_error.errors.password[0] }}</span>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2" v-if="user_id == ''">
                                             
                        <label>Confirm Password<span class="text-danger">*</span></label>
                           <CInput placeholder="" type="password" v-model="formData.password_confirmation" />
                            <span class="text-danger" v-if="ajax_error.errors.password_confirmation">{{ ajax_error.errors.password_confirmation[0] }}</span>

                        </CCol>

                         <CCol sm="3" md="2" class="px-1">
                           <label>Date of Birth <span class="text-danger">*</span></label>
                          <input type="date" v-model="formData.date_of_birth" class="form-control" name="">
                           <span class="text-danger" v-if="ajax_error.errors.date_of_birth">{{ ajax_error.errors.date_of_birth[0] }}</span>
                        </CCol>

                      <!--   <CCol sm="6" md="4" class="px-2">
                          <label>Age<span class="text-danger">*</span></label>
                           <CInput v-model="formData.age" placeholder=""/>
                            <span class="text-danger" v-if="ajax_error.errors.age">{{ ajax_error.errors.age[0] }}</span>
                        </CCol> -->  
                        <CCol sm="3" md="2" class="px-1">
                           <label>Select Status </label>
                            <div class="form-group">
                               <select class="form-control" v-model="formData.status" >
                                 <option value="0" >Active </option>
                                 <option value="1" >IN-Active</option>
                               </select>
                             </div>
                         </CCol> 

                          <!-- <CCol sm="3" md="2" class="px-1">
                               <label>Age<span class="text-danger">*</span></label>
                           <CInput placeholder="" type="number" v-model="formData.age" />
                            <span class="text-danger" v-if="ajax_error.errors.age">{{ ajax_error.errors.age[0] }}</span>
                           </CCol> -->

                          <!-- <CCol sm="3" md="2" class="px-1">
                           <label>Select Blood Group </label>
                            <div class="form-group">
                               <select class="form-control" v-model="formData.blood_group" >
                                 <option value="A+" >A+ </option>
                                 <option value="A-" >A-</option>
                                  <option value="B+">B+</option>
                                 <option value="B-" >B-</option>
                                  <option value="O+">O+</option>
                                 <option value="O-">O-</option>
                                  <option value="AB+" >AB+</option>
                                 <option value="AB-" >AB-</option>
                               </select>
                             </div>
                         </CCol>
                   -->

                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Gender<span>*</span></label><br>
                              <div class="custom-control custom-radio custom-control-inline">
                                 <input type="radio" value="0" v-model="formData.gender" id="customRadioInline1" name="gender" class="custom-control-input">
                              
                                 <label class="custom-control-label" for="customRadioInline1">Male</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                 <input type="radio" value="1" v-model="formData.gender" name="gender" id="customRadioInline2" class="custom-control-input">
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
                          <label>Select Address<span class="text-danger">*</span></label>

                          <w3wMap :lat="formData.latitude" :lng="formData.longitude" :w3words="formData.w3w_address" mapId="w3wMap1" :autoSuggest="true" :mapDiv="false" @getmapdata="getMapData($event)"/>

                          <!-- <a @click="getLocation" href="javascript:void(0)" class="font-weight-bold text-danger">
                               <vue-fontawesome icon="compass" class=" ml-2" size="1"></vue-fontawesome>
                              Get Current location</a>
                           
                           <gmap-autocomplete class="form-control" autocomplete="off" id="google_autosearch_address"   @place_changed="setPlace" :options="autocompleteOptions"> </gmap-autocomplete> -->

                        </CCol>
                        <CCol sm="6" md="6" class="px-2">
                          <label>Address<span class="text-danger">*</span></label>
                           <CInput placeholder="" v-model="formData.address"/>
                            <span class="text-danger" v-if="ajax_error.errors.address">{{ ajax_error.errors.address[0] }}</span>
                        </CCol>
                    <!--     <CCol sm="6" md="3" class="px-2">
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
                           <CInput placeholder="" v-model="formData.city"/>
                           <span class="text-danger" v-if="ajax_error.errors.city">{{ ajax_error.errors.city[0] }}</span>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                          <label>Country<span class="text-danger">*</span></label>
                           <CInput placeholder="" v-model="formData.country" />
                           <span class="text-danger" v-if="ajax_error.errors.country">{{ ajax_error.errors.country[0] }}</span>
                        </CCol>

                         <CCol sm="6" md="3" class="px-2">
                          <label>State<span class="text-danger">*</span></label>
                           <CInput placeholder="" v-model="formData.state" />
                            <span class="text-danger" v-if="ajax_error.errors.state">{{ ajax_error.errors.state[0] }}</span>
                        </CCol>

                        <CCol sm="6" md="3" class="px-2">
                          <label>Zip code<span class="text-danger">*</span></label>
                           <CInput placeholder="" v-model="formData.zip_code" />
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
                               <gmap-map :center="center"  :zoom="12" style="width:100%;  height: 400px;">
                                 <gmap-marker
                                   :key="index"
                                   v-for="(m, index) in markers"
                                   :position="m.position"
                                    @click="center=m.position"
                                   :draggable="true"
                                   :clickable="true"
                                   @dragend="updateCoordinates"
                                 ></gmap-marker>
                               </gmap-map>
                          </div> -->

                  </CCardBody>
            </CCard>

            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>Patient History</strong>
                  </div>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CRow class="m-0">

                     <CCol sm="12" class="px-2">
                        <div class="form-group">
                           <label>Medical History</label>
                           <textarea rows="6" class="form-control" v-model="formData.medical_history"></textarea>
                        </div>
                     </CCol> 

                     <!-- <CCol sm="12" class="px-2">
                        <div class="form-group">
                           <label>Symptoms</label>
                           <textarea rows="6" class="form-control" v-model="formData.symptoms"></textarea>
                        </div>
                     </CCol>   -->

                  </CRow>
               </CCardBody>
            </CCard>
        
         </CCol>
         </form>
      </CRow>
   </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import Vue from 'vue';
import Vuex from 'vuex';
import Form from "vform";
import commonHelper from "./../../global_helper/helpers.js";
import w3wMap from "../components/w3wMap.vue";

export default {
   components: {      
      w3wMap
   },
    data() {
    return {
       user_id: '',
       lable:'Add',
       address         : '',
       autocompleteOptions: {
        componentRestrictions: {
         // country:  'UK',
        },
      },
      ADDRESS_COMPONENTS : {
        subpremise    : 'short_name',
        street_number : 'short_name',
        route         : 'long_name',
        locality      : 'long_name',
        administrative_area_level_1: 'long_name',
        administrative_area_level_2: 'long_name',
        sublocality_level_2 : 'long_name',
        sublocality_level_1 : 'long_name',
        area                : 'long_name',
        country             : 'long_name',
        postal_code         : 'short_name'
    },
         center          :  {lat: 0,lng: 0},
         markers         :  [],
         places          :  [],
         formData :new Form({ id:'',first_name:'',last_name:'',email:'',phone_number:'',password:'',password_confirmation :'',gender:'',address:'',address2:'',area:'',city:'',country:'',state:'',zip_code:'',symptoms:'',medical_history:'',date_of_birth:'',full_address:'',status:'',blood_group:'',age:'',nickname:'', w3w_address: '', latitude: '', longitude: '', w3w_latitude: '', w3w_longitude: ''}),
        
         profile_picture  : '',
         imageDoc         : [],
         isActive         : false,     
   };
 },
  created() {
   
   this.autocompleteOptions = {
      componentRestrictions: {
       // country:  'UK'
      },
    }
  },

   mounted() {
      this.ajax_error.errors =[];
       if(this.$route.params.id != '' && this.$route.params.id != undefined){
      this.getFormData(this.$route.params.id);
    }
  },
  computed: {
      ...mapGetters("Patient/Index", ["returnData","ajax_error","editData"]),
    ...mapGetters("auth", ["user"]),
  },
  methods: {
    ...mapActions("Patient/Index", ["submitPatientsUpdateForm","edit"]),

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

      getFormData(id) {
            this.user_id = id;
            this.lable ='Edit';
            this.edit(id).then(() => {
                  this.formData.keys().forEach((key) => {
                     this.formData[key] = this.editData[key];
                  });

                     var lat = parseFloat(this.editData.latitude);
                     var lng = parseFloat(this.editData.longitude);
                     const marker = {
                        lat: lat,
                        lng: lng
                     };
                  this.markers.push({ position: marker });
                  this.center = marker;

                  this.formData.latitude  = lat;
                  this.formData.longitude = lng;

            });
            this.ajax_error.errors = [];
      },
      
  

    onImageChange(e) {
         this.profile_picture = e.target.files[0];
         var reader = new FileReader();
         reader.onload = (e) => {
            this.imageDoc = e.target.result;
         }
            reader.readAsDataURL(this.profile_picture);
      },
          
    
    submitFormData() {
      let newData  =  new FormData();
      newData.append('profilefile',this.profile_picture)
      this.isActive =  true;
      console.log(this.formData);
      newData.append('formData',JSON.stringify(this.formData))
      this.submitPatientsUpdateForm({newData:newData,id:this.formData.id}).then(()=> {
         if(this.returnData.status =='success'){
           this.$router.push({name:"patient"});  
          this.isActive =  false;
           Vue.$toast.open({
                   message: this.returnData.message,
                   type: this.returnData.status,
               });
         }
      }) 
     .catch(error => {
        window.scrollTo(0,0);
        this.isActive =  false; 
     });
    },

    //google data 

      setPlace(place) {
        var singleValues = $( "#google_autosearch_address" ).val();
        this.formData.full_address = singleValues;
        this.markers = [];
        this.currentPlace = place;
        this.addMarker();
    },

      addMarker() {
         if (this.currentPlace) {
           const marker = {
             lat: this.currentPlace.geometry.location.lat(),
             lng: this.currentPlace.geometry.location.lng()
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
            
           this.formData.address          = this.currentPlace.formatted_address;
           var city,state ='';
           city                        =  returnData.locality; 

           if(city == undefined || city == null){
             city = returnData.administrative_area_level_1;
           }

           if(returnData.sublocality_level_2)
             this.formData.state       = returnData.sublocality_level_2;
           else if(returnData.sublocality_level_1)
             this.formData.state       = returnData.sublocality_level_1;

           else if(returnData.locality)
             this.formData.state       = returnData.locality;

            if(returnData.route)
             this.formData.address2       = returnData.route;
          
           if(returnData.sublocality_level_1)
             this.formData.area       = returnData.sublocality_level_1;

           if(returnData.country)
             this.formData.country       = returnData.country;

           if(returnData.administrative_area_level_1)
             this.formData.state       = returnData.administrative_area_level_1;

          if(returnData.locality)
             this.formData.city       = returnData.locality;

          if(returnData.postal_code)
             this.formData.zip_code       = returnData.postal_code;
            
           this.formData.latitude  = this.currentPlace.geometry.location.lat();

           this.formData.longitude = this.currentPlace.geometry.location.lng();
           //End
           this.currentPlace = null;
           var location = this.formData.state+', '+this.formData.city ;

         }
       },

       updateCoordinates(location) {
           this.center = {
             lat: location.latLng.lat(),
             lng: location.latLng.lng()
           };
           this.getReverseGeocodingData(location.latLng.lat(),location.latLng.lng())
           this.formData.latitude  = location.latLng.lat();
           this.formData.longitude = location.latLng.lng();

       },

       getReverseGeocodingData(lat, lng) {
             var latlng = new google.maps.LatLng(lat, lng);
             var geocoder = new google.maps.Geocoder();
             geocoder.geocode({ 'latLng': latlng },  (results, status) =>{
                 if (status !== google.maps.GeocoderStatus.OK) {
                    
                 }
                  if (status == google.maps.GeocoderStatus.OK) {
                  var address = (results[0].formatted_address);
                  console.log(results[0]);

                    this.formData.full_address = address;
                    this.markers = [];
                    this.currentPlace = results[0];
                    this.addMarker();
                    this.formData.address  = address;
                 }
             });
         },


       getLocation() {
          let options = {
             enableHighAccuracy: true,
             timeout: 5000,
             maximumAge: 0
           };

             let geolocation = navigator.geolocation;
             if (geolocation) {
               geolocation.getCurrentPosition(this.onGeoSuccess, this.onGeoError, options);
             } else {
               console.log("Geolocation is not supported by this browser.");
             }
           },

          onGeoSuccess(position) {
            this.getReverseGeocodingData(position.coords.latitude,position.coords.longitude);
              },
          onGeoError(error) {
            },


      }
}
</script>