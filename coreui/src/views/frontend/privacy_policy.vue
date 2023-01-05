<template>
	<div>
     <u-animate-container>
		  <!-- Header area start -->
       <Uheader/>
      <!-- Header area End -->
      <main class="pts">
	 <section class="inner-header">
         <div class="container">
            <div class="row">
               <div class="col-md-12 sec-title colored text-center">
                  <h2>{{result.privacyPolicyData.title}}</h2>
               </div>
            </div>
         </div>
      </section>
 
     <div class="about_us_section ptb_60 pt-2">
      <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="privacy_policy text-justify">
                     <p v-html="result.privacyPolicyData.description"> </p>
                  </div>
               </div>
            </div>
         </div>   
      </div>
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