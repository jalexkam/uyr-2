<template>
   <div>
     <u-animate-container>
      <!-- Header area start -->
      <Uheader/>
      <main class="pts">
      <!-- Header area End -->
     <section class="inner-header">
         <div class="container">
            <div class="row">
               <div class="col-md-12 sec-title colored text-center">
                  <h2>{{result.wayWorkData.title}}</h2>
                  <!-- <ul class="breadcumb">
                     <li><router-link to="homepage">Home</router-link></li>
                     <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                     <li><span>About Us</span></li>
                  </ul> -->
               </div>
            </div>
         </div>
      </section>
      <div class="about_us_section ptb_60 pt-2">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <u-animate name="zoomIn" duration="2s" class="about_description">
                    
                        <p class="text-justify" v-html="result.wayWorkData.description"></p>
                     
                  </u-animate>
               </div>
            </div>
         </div>
      </div>
      <!-- footer section add -->
      <!-- <Ufooter/> -->
       </main>
  <Ufooter/>
    </u-animate-container>
   </div>


</template>

<script>
   import Vue from 'vue';
    import Uheader from './header'
   import Ufooter from './footer'
   import { mapGetters, mapActions } from "vuex";
   import VueToast from 'vue-toast-notification';
   import 'vue-toast-notification/dist/theme-sugar.css';
   Vue.use(VueToast);
    export default {
      data () {
         return {
            }
         },

     components: { 
      Uheader,
      Ufooter
     },
     
     created() {
      this.homePageData();
     },
     computed: {
        ...mapGetters("Front/HomePage", ["result"]),
     },
     methods: {
       ...mapActions("Front/HomePage", ["gethomePageData"]),


        homePageData() {
        this.gethomePageData().then(() => {
         
        });
      },



    }
   }
</script>