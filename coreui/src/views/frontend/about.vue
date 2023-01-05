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
                  <h2>About Us</h2>
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
               <div class="col-md-4">
                  <u-animate name="zoomIn" duration="2s" class="about_img">
                      <img :src="'uploads/aboutus/'+this.result.aboutUS.id+'/'+this.result.aboutUS.image" v-if="this.result && this.result.aboutUS && this.result.aboutUS.image ">
                      <img src="images/banner.jpg" alt="about img" v-else>
                  </u-animate>
               </div>
               <div class="col-md-8">
                  <u-animate name="zoomIn" duration="2s" class="about_description">
                     <div class="abt_heading" v-if="this.result.aboutUS">
                        <h2> {{this.result.aboutUS.title}}</h2>
                     </div>
                     <p class="text-justify" v-if="this.result && this.result.aboutUS">
                         <span v-html="this.result.aboutUS.description"> </span> 
                     </p>
                  </u-animate>
               </div>
            </div>
            <!--  Faq section start here  -->
            <div class="row py-4">
               <div class="col-md-12">
                  <u-animate name="fadeInUp" duration="2s" class="section_heading">
                     <h2 class="mb-3">FAQ</h2>
                  </u-animate>
                  <CCardBody class="py-2 px-0">
                     <div class="accordion" v-for="row, index in result.faq">
                        <u-animate name="fadeInUp" duration="2s" delay="0" class="mb-2 card" >
                           <CButton block color="link" class="text-left shadow-none card-header" @click="accordion = accordion === index ? false : index"  v-bind:class = "(accordion === index)?'active':''">

                              <h5 class="m-0">{{row.question}}</h5>
                           </CButton>
                           <CCollapse :show="accordion === index">
                              <CCardBody>
                                 <p>{{row.answer}}</p>
                              </CCardBody>
                           </CCollapse>
                        </u-animate>
                     </div>
                  </CCardBody>
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
   import Vuex from 'vuex';
   import Form from "vform"; 
    import Uheader from './header'
   import Ufooter from './footer'
   import { mapGetters, mapActions } from "vuex";
   import VueToast from 'vue-toast-notification';
   import 'vue-toast-notification/dist/theme-sugar.css';
   Vue.use(VueToast);
    export default {
      data () {
         return {
            id                     : 0,
            faqForm                : new Form({question : '', answer: ''}),
            accordion              : 0,
            }
         },

     components: { 
      Uheader,
      Ufooter
     },
     
     created() {
      //this.id = this.$route.params.id;
      // this.accordion = 1;
      //this.FaqList();
      this.homePageData();
     },
     computed: {
       //...mapGetters("Masters/FAQs", ["result"]),
        ...mapGetters("Front/HomePage", ["result"]),
     },
     methods: {
     
       //...mapActions("Masters/FAQs", ["FaqList"]),
       ...mapActions("Front/HomePage", ["gethomePageData"]),


        homePageData() {
        this.gethomePageData().then(() => {
          //console.log(this.result)
        });
      },



    }
   }
</script>