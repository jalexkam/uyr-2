<template>
   
   <div>
      <div class="d-flex ml-3 align-items-center">
       <router-link :to="{ name: 'dashboard'}">
         <div class="logo mr-5 ">
            <img src="/images/uyr_logo.png" width="150px">
         </div>
         </router-link>

         <CHeaderNav class="mob_menu mr-auto">

             <div v-if="user && tabs" v-for="tab in tabs">
               <li class="c-header-nav-item dropdownn">
                   <router-link :to="{ name:tab.href}">{{ tab.slug }}</router-link>
                  <ul class="dropdown-menuu" v-if="tab.child">
                    <li  v-for="child in tab.child" >
                     <router-link :to="{ name:child.href}">{{ child.slug }}</router-link>
                     </li>
                  </ul>
               </li>
            </div>

         <!-- 
           <div v-if="user" >
               <li class="c-header-nav-item dropdownn" v-if="user.role_type =='1' || user.role_type =='2'">
                <router-link :to="{ name: 'users'}">Users</router-link>
               </li>
            </div>


            <div v-if="user">
               <li class="c-header-nav-item dropdownn" v-if="user.role_type =='1' || user.role_type=='2'">
                <router-link :to="{ name: 'doctor'}">Doctors</router-link>

              </li>
            </div>

            <div v-if="user">
               <li class="c-header-nav-item dropdownn" v-if="user.role_type =='1'">
                 <router-link :to="{ name: 'admin'}">Admin</router-link>
               </li>
            </div>

            <div v-if="user">
               <li class="c-header-nav-item dropdownn" v-if="user.role_type == '1'|| user.role_type == '2' ">
                  <router-link :to="{ name: 'sales'}">Sales</router-link>
              </li>
            </div>

            <div v-if="user">
               <li class="c-header-nav-item dropdownn" v-if="user.role_type =='1' || user.role_type == '2' || user.role_type == '5'" >
                  <router-link :to="{ name: 'mediator'}">Mediator</router-link>                  
               </li>
            </div>
             <div v-if="user">
               <li class="c-header-nav-item dropdownn" v-if="user.role_type == '6'">
                  <a href="#">Booking</a>
                  <ul class="dropdown-menuu">
                     <li>
                        <router-link :to="{ name: 'book_doctor'}">Search Doctor</router-link> 
                     </li>
                     <li>
                        <router-link :to="{ name: 'suggest_doctor'}">Suggest Doctor</router-link> 
                     </li>
                  </ul>
               </li>
            </div>
            
            <div v-if="user">
               <li class="c-header-nav-item dropdownn" v-if="user.role_type == 1 || user.role_type == 2">
                  <a href="javascript:void(0)">Masters</a>
                  <ul class="dropdown-menuu">
                     
                     <li>
                        <router-link :to="{ name: 'master_equipments'}">Equipments</router-link>
                     </li>
                     <li>
                        <router-link :to="{ name: 'master_services'}">Services</router-link>
                     </li>
                      <li>
                        <router-link :to="{ name: 'master_types'}">Types</router-link>
                     </li>
                    
                  </ul>
               </li>
            </div>





            <div v-if="user">
               <li class="c-header-nav-item dropdownn" v-if="user.role_type == '1'">
                  <a href="javascript:void(0)">Payout</a>
                  <ul class="dropdown-menuu">
                     <li>
                        <router-link :to="{ name: 'd_payout'}">Mediator Dr. Payout</router-link>
                     </li>
                     <li>
                        <router-link :to="{ name: 'd_payout'}">Sales. Payout</router-link>
                     </li>
                     <li>
                        <router-link :to="{ name: 'd_payout'}">Dr. Payout</router-link>
                     </li>
                  </ul>
               </li>
            </div>
            
            <div v-if="user">
               <li class="c-header-nav-item dropdownn" v-if="user.role_type == '1'|| user.role_type == '2'|| user.role_type == '4' || user.role_type == '5'">
                        <router-link :to="{ name: 'manage_booking'}" >Manage Booking</router-link>
                    </li>
            </div>
            
            <div v-if="user">
               <li class="c-header-nav-item" v-if="user.role_type =='3'">
                 <router-link :to="{ name: 'doctoradd'}">Add new Doctor</router-link>
               </li>
            </div>
            <div v-if="user">
               <li class="c-header-nav-item" v-if="user.role_type =='3'">
                  <router-link :to="{ name: 'doctor'}">View Doctor</router-link>
               </li>
            </div>
            <div v-if="user">
               <li class="c-header-nav-item" v-if="user.role_type =='5'">
                  <router-link :to="{ name: 'd_payout'}">Payout</router-link>
               </li>
            </div>
            <div v-if="user">
               <li class="c-header-nav-item" v-if="user.role_type =='4'">
                  <router-link :to="{ name: 'd_payout'}" >Payout</router-link>
               </li>
            </div>
            <div v-if="user">
               <li class="c-header-nav-item" v-if="user.role_type =='3'">
                  <router-link :to="{ name: 'd_payout'}"> Payout</router-link>
               </li>
            </div>
             <div v-if="user">
               <li class="c-header-nav-item" v-if="user.role_type =='6'">
                  <router-link :to="{ name: 'patient'}">Patient List</router-link>
               </li>
            </div>
             <div v-if="user">
                <li class="c-header-nav-item" v-if="user.role_type =='6'">
                    <router-link  :to="{ name: 'Appointment'}">My Appointment</router-link>
                     </li>
                   </div>
                   <div v-if="user">
               <li class="c-header-nav-item" v-if="user.role_type =='6'">
                  <router-link :to="{ name: 'favorite'}" >Favorite</router-link>
               </li>
            </div>
                        <div v-if="user">
               <li class="c-header-nav-item dropdownn" v-if="user.role_type == 1 || user.role_type == 2">
                  <a href="javascript:void(0)">Manage Website</a>
                  <ul class="dropdown-menuu">
                     <li>
                        <router-link :to="{ name: 'master_contact_us'}">Contact Us</router-link>
                     </li>
                     <li>
                        <router-link :to="{ name: 'faq_list'}">FAQs</router-link>
                     </li>
                     <li>
                        <router-link :to="{ name: 'About_edit'}">About Us</router-link>
                     </li>
                      <li>
                        <router-link :to="{ name: 'blog_page'}">Articles/ Blogs</router-link>
                     </li>
                     <li>
                        <router-link  :to="{ name: 'homepage_pg'}" >Footer </router-link>
                     </li>
                     <li>
                        <router-link :to="{ name: 'homepage_pg'}">Side Menu</router-link>
                     </li>
                     <li>
                        <router-link :to="{ name: 'Privacy_Policy_Edit'}">Privacy & policy</router-link>
                     </li>
                     <li>
                        <router-link :to="{ name: 'Terms_Condition_Edit'}">Terms and Conditions</router-link>
                     </li>
                      <li>
                        <router-link :to="{ name: 'homepage_pg'}">Careers</router-link>
                     </li>

                  </ul>
               </li>
            </div> -->



            
            <!-- <div v-if="user">
               <li class="c-header-nav-item dropdownn" v-if="user.title == 'admin' || user.title == 'user'">
                  <a href="#">Profile</a>
                  <ul class="dropdown-menuu">
                     <li><a href="#">Create Profile</a></li>
                     <li><a href="#">Create Profile</a></li>
                  </ul>
               </li>
            </div> -->
            <!-- </li> -->
         </CHeaderNav>


      </div>
   </div>
</template>
<script>
   import { mapGetters, mapActions } from "vuex";
   import axios from 'axios'
   export default {
     // name: 'Menu',
     data () {
       return {
         nav: [],
         buffor: [],
         img_path : process.env.MIX_IMAGE_URL,
       }
     },
     created() {
       if(localStorage.getItem('is_login') !='Yes') {
           this.$router.push({ name:"login"});
         }else{
            this.getLeftMenus();
         }
         
       },
     computed: {
       show () {
         return this.$store.state.sidebarShow 
       },
       minimize () {
         return this.$store.state.sidebarMinimize 
       },
       ...mapGetters("LeftMenus", ["tabs"]),
       ...mapGetters("auth", ["user"]),
     },
     methods: {
       ...mapActions("LeftMenus", ["getLeftMenus"]),
   
       
     },
    
   }
</script>