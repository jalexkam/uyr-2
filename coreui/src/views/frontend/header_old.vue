<template>
  <div>
  <header class="header">
           <!--  <div class="top-header-bar">
                <div class="container">
                  <div class="top-header">
                     <div class="top-header-left">
                        <ul>
                          <li>
                              <i class="fa fa-envelope" aria-hidden="true"></i>
                              <a href="mailto:demo@gmail.com">demo@gmail.com</a>
                          </li>
                          <li>
                              <i class="fa fa-phone" aria-hidden="true"></i>
                              <a href="tel:9876543210">9876543210</a>
                          </li>
                        </ul>
                     </div>
                     <div class="top-header-right">
                          <ul>
                              <li>
                                <router-link to="doctor_register">Login For Doctors</router-link>
                              </li>
                              <li>
                                <router-link to="login">Login</router-link>
                                </li>
                              <li><a href="#">Sign Up</a></li>
                          </ul>

                     </div>
                  </div>
                </div>
            </div> -->
          <div class="container">
            <div class="top-header-right hmobile_view text-right my-1">
                          <ul>
                              <li>
                                <vue-fontawesome icon="volume-control-phone"  size="0.9"></vue-fontawesome>
                                <a href="tel:+496170961709">Customer Support</a>
                              </li>
                              <li>
                                <vue-fontawesome icon="user"  size="0.9"></vue-fontawesome>
                                <router-link to="register">
                                  For User</router-link>
                              </li>
                              <li>
                                <vue-fontawesome icon="user-md"  size="0.9"></vue-fontawesome>
                                <router-link to="doctor_register">For Doctor</router-link>
                              </li>
                          </ul>
                        </div>
            <div class="main-header">
              <div class="logo">
                <router-link :to="{ name: 'homepage'}" ><img src="images/uyr_logo.png" width="180" alt="Logo"></router-link>
                  <!-- <h2>LOGO</h2> -->
              </div>
              <div class="menudflex">
                
                  <!-- <ul class="menu_ul" :class="{ active: isActive }">
                      <li>
                        <router-link to="homepage">Home</router-link>
                      </li>
                      <li>
                        <router-link to="about">About Us</router-link></li>
                      <li>
                        <router-link to="career">Careers</router-link></li>
                      <li>
                        <router-link to="location">Location</router-link></li>
                      <li>
                        <router-link to="blog">Articles</router-link></li>
                      <li>
                        <router-link to="contact">Contact Us</router-link></li>
                  </ul> -->
                
                  
                  <div class="top-header-right hdesktop_view">
                          <ul>
                              <li>
                                <vue-fontawesome icon="volume-control-phone"  size="0.9"></vue-fontawesome>
                                <a href="tel:+496170961709">Customer Support</a>
                              </li>
                              <li>
                                <vue-fontawesome icon="user"  size="0.9"></vue-fontawesome>
                                <router-link to="register">
                                  For User</router-link>
                              </li>
                              <li>
                                <vue-fontawesome icon="user-md"  size="0.9"></vue-fontawesome>
                                <router-link to="doctor_register">For Doctor</router-link>
                              </li>
                          </ul>
                          <!-- <div class="menutoggle" 
                    @click="isActive = !isActive"><vue-fontawesome icon="bars"  size="1.8"></vue-fontawesome>
                  </div> -->
                  <div class="hamburger menutoggle" id="hamburger-6" @click="isActive = !isActive" :class="{ active: isActive }">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </div>

                     </div>

                     <!-- <div class="header-search">
                      <input type="search" class="header-search-field" placeholder="Search …" value="" name="s" autocomplete="off" title="Search for:">
                      <button type="submit" class="header-search-submit" value=""><vue-fontawesome icon="search"  size="1.2"></vue-fontawesome>
                   </button>
                  </div> -->
                  
                  <!-- <div class="dwnload_app">
                      <router-link to="Login"><button class="btn btn-custom">Book Appointment </button></router-link>
                  </div> -->
                 <!--  <div class="menutoggle">
                    <vue-fontawesome icon="search"  size="1.5"></vue-fontawesome>
                  </div> -->
                  
                  

              </div>  
            </div>
          </div>
      </header>
      <div class="menu_overlay" @click="isActive = !isActive" :class="{ active: isActive }"></div>
      <div class="menu">
      <ul class="menu_ul" :class="{ active: isActive }">
                      <li class="menu_title">
                        <router-link :to="{ name: 'login'}"  >
                          <vue-fontawesome icon="user-circle-o" class="mr-2"  size="1"></vue-fontawesome>
                          <strong>Login</strong></router-link>
                      </li>
                      <li class="menu_title">
                        <router-link :to="{ name: 'login'}">
                          <vue-fontawesome icon="calendar-check-o" class="mr-2"  size="1"></vue-fontawesome>
                          <strong>Book Appointment</strong></router-link>
                      </li>
                      <li>
                        <router-link :to="{ name: 'homepage'}"><vue-fontawesome icon="home" class="mr-3"  size="1"></vue-fontawesome>Home</router-link>
                      </li>
                      <li>
                        <router-link :to="{ name: 'about'}">
                          <vue-fontawesome icon="users" class="mr-3"  size="1"></vue-fontawesome>About Us</router-link></li>
                      <li>
                        <router-link :to="{ name: 'career'}" >
                          <vue-fontawesome icon="briefcase" class="mr-3"  size="1"></vue-fontawesome>Careers</router-link></li>
                      <!-- <li>
                        <router-link :to="{ name: 'location'}"><vue-fontawesome icon="globe" class="mr-3"  size="1"></vue-fontawesome>Location</router-link>
                        </li> -->
                      <li>
                        <router-link :to="{ name: 'blog'}" >
                        <vue-fontawesome icon="pencil-square-o" class="mr-3"  size="1"></vue-fontawesome>Articles</router-link></li>
                      <li>
                        <router-link :to="{ name: 'contact'}" >
                          <vue-fontawesome icon="map-marker" class="mr-3"  size="1"></vue-fontawesome> Contact Us</router-link>
                        </li>
                          <li><router-link :to="{ name: 'privacy-policy'}" >Privacy & Policy</router-link></li>
                          <li><router-link :to="{ name: 'terms-condition'}" >Terms & Conditions</router-link></li>
                  </ul>
                </div>
    </div>
    </template>
    <script>
    export default {
      name:'Uheader',
       data() {
        return{
        isActive: false
      }
    },

}
  
      
    </script>
