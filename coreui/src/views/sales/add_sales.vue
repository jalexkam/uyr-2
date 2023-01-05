<template>
  <div>
    <CRow class="m-0">
    <CCol sm="12" class="p-2">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Sales <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>{{this.lable}}</h5><div>
            <CButton class="btn_custom mr-1" @click="submitFormData">Submit</CButton>
            <router-link :to="{ name: 'sales' }" ><CButton color="light">Back</CButton></router-link>
          </div>
        </div>
    </CCol>
      <CCol sm="8" class="px-2">
        <CCard>
          <CCardHeader class="p-2 bg_themes">
            <strong>{{this.lable}} Sales</strong> 
          </CCardHeader>
          <CCardBody class="px-1 py-2"> 
            <CForm method="POST">
              <CRow class="m-0">
                <CCol class="form-group px-1" sm="6" lg="6" md="6"> 
                  <CInput class="mb-0" v-model="formData.first_name" label="First Name"  placeholder="Enter first name" :class="[ajax_error.errors.first_name ? 'formError' : '']"/>
                 
                  <small class="text-danger" v-if="ajax_error.errors.first_name">{{ ajax_error.errors.first_name[0] }}</small>
                </CCol>
                <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <CInput class="mb-0" v-model="formData.last_name" label="Last Name" placeholder="Enter last name" :class="[ajax_error.errors.last_name ? 'formError' : '']" />
                  <small class="text-danger" v-if="ajax_error.errors.last_name">{{ ajax_error.errors.last_name[0] }}</small>
                </CCol>
                <!-- <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <CInput class="mb-0" v-model="formData.user_name" label="Username" placeholder="Enter username" :class="[ajax_error.errors.user_name ? 'formError' : '']"/>
                  <small class="text-danger" v-if="ajax_error.errors.user_name">{{ ajax_error.errors.user_name[0] }}</small>
                </CCol> -->

                  <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <CInput class="mb-0" v-on:blur="acceptNumber" maxlength="12" @input="acceptNumber" @keypress="onlyNumric($event)"  v-model="formData.phone_number" label="Phone Number" placeholder="Enter Number" :class="[ajax_error.errors.phone_number ? 'formError' : '']"/>
                  <small class="text-danger" v-if="ajax_error.errors.phone_number">{{ ajax_error.errors.phone_number[0] }}</small>
                </CCol>

                  <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <label>Select Status </label>
                   <div class="form-group" :class="[ajax_error.errors.status ? 'formError' : '']">
                      <select class="form-control" v-model="formData.status" >
                        <option value="0" >Active </option>
                        <option value="1" >IN-Active</option>
                      </select>
                    </div>
                </CCol>
                   <CCol class="form-group px-1" sm="6" lg="6" md="6">
                  <CInput class="mb-0" v-model="formData.email" label="Email Id" type="email" placeholder="Enter Email" autocomplete="email" @blur="validateEmail" :class="[ajax_error.errors.email ? 'formError' : '']"/>
                  <small class="text-danger" v-if="ajax_error.errors.email">{{ ajax_error.errors.email[0] }}</small>
                </CCol>

              </CRow>
                  <CCard class="mb-0">
                  <CCardHeader class="p-2 px-3 bg_themes">
                     <div>
                        <strong>Location</strong>
                     </div>
                  </CCardHeader>
                  <CCardBody class="px-1 py-2">
                     <CRow class="m-0">
                        <CCol sm="6" md="3" class="px-2">
                          <label>Select Address</label>
                           <a @click="getLocation" href="javascript:void(0)" class="font-weight-bold text-danger">
                               <vue-fontawesome icon="compass" class=" ml-2" size="1"></vue-fontawesome>
                              Get Current location</a>
                           <gmap-autocomplete class="form-control" autocomplete="off" id="google_autosearch_address"   @place_changed="setPlace" :options="autocompleteOptions"> </gmap-autocomplete>

                        </CCol>
                        <CCol sm="6" md="6" class="px-2">
                          <label>Address</label>
                           <CInput placeholder="" v-model="formData.address"/>
                            <span class="text-danger" v-if="ajax_error.errors.address">{{ ajax_error.errors.address[0] }}</span>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                          <label>City</label>
                           <CInput placeholder="" v-model="formData.city"/>
                           <span class="text-danger" v-if="ajax_error.errors.city">{{ ajax_error.errors.city[0] }}</span>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                          <label>Country</label>
                           <CInput placeholder="" v-model="formData.country" />
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


                        <!-- <CCol sm="6" md="3" class="px-2">
                          <label>latitude</label>
                           <CInput placeholder="" v-model="formData.latitude" />
                          <span class="text-danger" v-if="ajax_error.errors.latitude">{{ ajax_error.errors.latitude[0] }}</span>
                        </CCol>

                        <CCol sm="6" md="3" class="px-2">
                          <label>longitude</label>
                           <CInput placeholder="" v-model="formData.longitude" />
                            <span class="text-danger" v-if="ajax_error.errors.longitude">{{ ajax_error.errors.longitude[0] }}</span>
                        </CCol> -->
                      </CRow>

                  </CCardBody>
            </CCard>

            </CForm>
          </CCardBody>
        </CCard>
      </CCol>


      <CCol sm="4" class="px-2">
        <CCard>
          <CCardBody class="p-2"> 
            <CForm method="POST">
              <CRow class="m-0">
              
                <CCol class="form-group px-0" sm="12" lg="12" md="12"  v-if="user_id == ''">
                  <CInput class="mb-0" v-model="formData.password" label="Password" type="password" placeholder="Enter password" autocomplete="current-password"  :class="[ajax_error.errors.password ? 'formError' : '']"/>
                  <small class="text-danger" v-if="ajax_error.errors.password">{{ajax_error.errors.password[0] }}</small>
                </CCol>
                <CCol class="form-group px-0" sm="12" lg="12" md="12"  v-if="user_id == ''">
                  <CInput class="mb-0" v-model="formData.password_confirmation" label="Confirm Password" type="password" placeholder="Confirm password" autocomplete="current-password" :class="[ajax_error.errors.password_confirmation ? 'formError' : '']"/>
                  <small class="text-danger" v-if="ajax_error.errors.password_confirmation">{{ajax_error.errors.password_confirmation[0] }}</small>
                </CCol>
              </CRow>
            </CForm>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import Vue from 'vue';
import Vuex from 'vuex';
import Form from "vform";
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);
import commonHelper from "./../../global_helper/helpers.js";
export default {
  data() {
   return {
      markers         :  [],
       address         : '',
       autocompleteOptions: {
        componentRestrictions: {
          //country:  'UK',
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
      center            :  {lat: 0,lng: 0},
      markers           :  [],
      places            :  [],
      
    user_id: '',
    lable:'Add',
     formData     : new Form({ id: "",first_name:'',last_name:'',user_name:'',email:'',role_type:'',phone_number:'',status:0,
     city:"",address:'',address2:'',area:'',city:'',country:'',state:'',zip_code:'',}),
   };
 },
  created() {
    if(this.$route.params.id != '' && this.$route.params.id != undefined){
      this.getFormData(this.$route.params.id);
    }

  },
  computed: {
    ...mapGetters("Sales/Index", ["rolesResult","returnData","ajax_error","editData"]),
  },
  methods: {
    ...mapActions("Sales/Index", ["submitForm","edit"]),

    onlyNumric(evt){ return commonHelper.onlyNumric(evt);},
         
    acceptNumber() {
      var x = this.formData.phone_number.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        this.formData.phone_number = !x[2] ? x[1] : '' + x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '');
      },

    submitFormData() {
     this.submitForm(this.formData).then(() => {
       if (this.returnData.status == 'success') {
            Vue.$toast.open({
                   message: this.returnData.message,
                   type: this.returnData.status,
               });

        this.$router.push({name:"sales"}); 
        } 
     })

     .catch(error => {
        window.scrollTo(0,0);      
     });
    },
       getFormData(id) {
            this.lable ='Edit';
            this.user_id = id;
            this.edit(id).then(() => {
                this.formData.keys().forEach((key) => {
                    this.formData[key] = this.editData[key];
                });
            });
            this.ajax_error.errors = [];
        },
        isLetter(e) {
        let char = String.fromCharCode(e.keyCode); // Get the character
        if(/^[A-Za-z]+$/.test(char)) return true; // Match with regex 
        else e.preventDefault(); // If not match, don't add to input text
      },
      validateEmail() {
          if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
              this.msg['email'] = 'Please enter a valid email address';
          } else {
              this.msg['email'] = '';
          }
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
           console.log(city);
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


  }
}
</script>