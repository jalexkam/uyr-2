<template>
  <div>
  <header class="header">
            <div class="top-header-bar">
                <div class="container">
                  <div class="top-header">
                     <div class="top-header-right">
                           <ul>
                              <li>
                                <vue-fontawesome icon="volume-control-phone"  size="0.9"></vue-fontawesome>
                                <a href="tel:+496170961709">Customer Support</a>
                              </li>
                              <li>
                                <vue-fontawesome icon="user-circle-o"  size="0.9"></vue-fontawesome>
                                <router-link to="login">
                                  Login</router-link>
                              </li>
                              <li>
                                <vue-fontawesome icon="user"  size="0.9"></vue-fontawesome>
                                <router-link to="register">Register</router-link>
                              </li>
                          </ul>
                     </div>
                  </div>
                </div>
            </div>
          <div class="container">
            <div class="main-header">
              <div class="logo">
                <router-link :to="{ name: 'homepage'}" ><img src="images/uyr_logo.png" width="180" alt="Logo"></router-link>
              </div>
            
       <div class="menu">
      <ul class="menu_ul" :class="{ active: isActive }">
                 
                      <li>
                        <router-link :to="{ name: 'homepage'}"><vue-fontawesome icon="home" class="mr-1"  size="1"></vue-fontawesome>Home</router-link>
                      </li>
                      <li>
                        <router-link :to="{ name: 'about'}">
                          <vue-fontawesome icon="users" class="mr-1"  size="1"></vue-fontawesome>About Us</router-link></li>
                      <li>
                        <router-link :to="{ name: 'career'}" >
                          <vue-fontawesome icon="briefcase" class="mr-1"  size="1"></vue-fontawesome>Careers</router-link></li>
                      <!-- <li>
                        <router-link :to="{ name: 'location'}"><vue-fontawesome icon="globe" class="mr-1"  size="1"></vue-fontawesome>Location</router-link>
                        </li> -->
                      <li>
                        <router-link :to="{ name: 'blog'}" >
                        <vue-fontawesome icon="pencil-square-o" class="mr-1"  size="1"></vue-fontawesome>Articles</router-link></li>
                      <li>
                        <router-link :to="{ name: 'contact'}" >
                          <vue-fontawesome icon="map-marker" class="mr-1"  size="1"></vue-fontawesome> Contact Us</router-link>
                        </li>
                         <!--  <li><router-link :to="{ name: 'privacy-policy'}" >Privacy & Policy</router-link></li>
                          <li><router-link :to="{ name: 'terms-condition'}" >Terms & Conditions</router-link></li> -->
                  </ul>
                   <div class="hamburger menutoggle" id="hamburger-6" @click="isActive = !isActive" :class="{ active: isActive }">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </div>
               

                     </div>
            </div>
          </div>
      </header>
      <div class="menu_overlay" @click="isActive = !isActive" :class="{ active: isActive }"></div>
      
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
