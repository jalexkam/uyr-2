<template>
   <div>
      <CRow class="m-0">
         <CCol md="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0"></h5>
               <!--  <CButton size="sm" class="btn_custom" @click="submitFormData">Submit</CButton> -->
            </div>
         </CCol>
         <CCol md="3" class="px-2">
            <CCard>
               <CCardBody>
                  <div class="widget-profile" v-if="user && user.role_type !=6">
                     <div class="profile-widget-info profile-img">
                        <div class="profile_widget_img">
                           
                          <img :src="'uploads/profile/'+user.id+'/'+user.profile_photo" v-if="user.profile_photo && imageDoc ==''">
                            <img :src="imageDoc" class="img-fluid" v-else-if="imageDoc && imageDoc!=''" />
                           <img v-else src="/uploads/profile/default-profile.png"> 

                          <!--  <img :src="imageDoc" class="img-fluid" v-if="imageDoc && imageDoc!=''" />
                           <img src="/uploads/profile/1626676073.jpg" v-else> -->
                        </div>
                        <button class="file btn btn-sm upload_btn text-center mt-2">
                           <vue-fontawesome icon="upload" class="px-1 mr-2" size="0.8"></vue-fontawesome>
                           Change Photo
                           <input type="file" name="profile_picture" v-on:change="onImageChange">
                        </button>
                        <h3 v-if="user">{{formData.first_name+ ' '+ formData.last_name}}</h3>
                     </div>
                  </div>
                 
                  <!-- <flash-message class="myCustomClass"></flash-message>
         }
         }
 -->
                  <div class="profile_menu">
                     <ul v-if="user">
                        <li @click="tab='profile' ; isActive = !isActive;" v-bind:class="{ active: isActive }"
                           >
                           <a href="javascript:void(0)">
                              <vue-fontawesome icon="user" class="px-1" size="1"></vue-fontawesome>
                              Profile Details
                           </a>
                        </li>
                        <li @click="tab='wallet' ; isActive = !isActive;" v-bind:class="{ active: isActive }"
                           >
                           <a href="javascript:void(0)">
                              <CIcon name="cil-wallet" class=""/>
                              Wallet
                           </a>
                        </li>
                        <li @click="tab='change_password' ; isActive = !isActive;" v-bind:class="{ active: isActive }">
                           <a href="javascript:void(0)">
                              <vue-fontawesome icon="lock" class="px-1" size="1"></vue-fontawesome>
                              Change Password
                           </a>
                        </li>
                        <li v-if="user.role_type == 3 || user.role_type == 4 || user.role_type == 5" @click="tab='bank_details' ; isActive = !isActive;" v-bind:class="{ active: isActive }" >
                           <a href="javascript:void(0)">
                              <vue-fontawesome icon="address-card" class="px-1" size="1"></vue-fontawesome>
                              Bank Details
                           </a>
                        </li>
                        <li v-if="user.role_type == 4" @click="tab='appointment' ; isActive = !isActive;" v-bind:class="{ active: isActive }" >
                           <a href="javascript:void(0)">
                              <vue-fontawesome icon="hourglass-start" class="px-1" size="1"></vue-fontawesome>
                              Manage Appointment Slot
                           </a>
                        </li>
                        <li>
                           <a @click="logout()">
                              <vue-fontawesome icon="sign-out" class="px-1" size="1"></vue-fontawesome>
                              Logout
                           </a>
                        </li>
                     </ul>
                  </div>
               </CCardBody>
            </CCard>
         </CCol>
          <FlashMessage :position="position"></FlashMessage>
         <!-- <profile/>
            <change_password/> -->
         <components :is="tab" v-if="tab !='profile'"/>

         <profile v-if="tab =='profile'"  @save_profile="save_profile"
            :ajax_error="ajax_error"
            :formData="formData"
            ref="form"></profile>
        
      </CRow>
   </div>
</template>
<script>
   import { mapGetters, mapActions } from "vuex";
   import Vue from 'vue';
   import Form from "vform";
   import axios from "axios";
   import Swal from 'sweetalert2';
   import profile from "./profile"
   import change_password from "./change_password"
   import bank_details from "./bank_details"
   import appointment from "./appointment"
   import wallet from "./wallet"
   
   export default {
     components: {
      profile,
      change_password,
      bank_details,
      appointment,
      wallet
    },
   
    data() {
        return {
            tab: 'profile',
            position: 'right top',
            isActive: false,
               formData: new Form({
                   first_name: '',
                   last_name: '',
                   user_name: '',
                   email:'',
                   phone_number:'',

               }),
               imageDoc    : [],
               profile_picture:'',
        };
    },
     computed: {
       ...mapGetters('SiteSettings/Index', ['returnData','ajax_error']),
       ...mapGetters('auth', ['user']),
       ...mapGetters({ user: 'auth/user' }),
     },
   
   created() {
        this.fetchUsers();
    },
      methods: {
        ...mapActions('SiteSettings/Index', ['submitFormSetting',"save_profile_photo"]),
        ...mapActions('auth', ['fetchUser']),
      
       onImageChange(e) {
            this.profile_picture = e.target.files[0];
            var reader = new FileReader();
            reader.onload = (e) => {
                this.imageDoc = e.target.result;
            }
            let newData  =  new FormData();
            newData.append('profilefile',this.profile_picture);
            this.save_profile_photo({newData:newData}).then(() => {
                 if (this.returnData.status == 'success') {
                   Vue.$toast.open({
                         message: this.returnData.message,
                         type: this.returnData.status,
                     });
                }
            });

            reader.readAsDataURL(this.profile_picture);
          },


        fetchUsers() {
            this.fetchUser().then(() => {
                this.formData.keys().forEach((key) => {
                    this.formData[key] = this.user[key];
                });
            });
        },
        save_profile() {
            this.submitFormSetting(this.formData).then(() => {
                 if (this.returnData.status == 'success') {

                   Vue.$toast.open({
                         message: this.returnData.message,
                         type: this.returnData.status,
                     });
                    this.ajax_error.errors = [];
                    this.get_userData();
                }
            });
        },
        async get_userData() {
            this.$store.dispatch('auth/fetchUser');
            this.ajax_error.errors = [];
        },
       async logout() {
              await this.$store.dispatch("auth/logout");
              let that = this;
              localStorage.clear();
              that.$router.push({ name: "login" });
        },
      },
   }
</script>