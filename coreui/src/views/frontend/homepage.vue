<template>
   <div>
     <u-animate-container>
      <!-- Header area start -->
       <Uheader/>
      <!-- Header area End -->
      <main class="pts">
        
       <div class="banner-section" >
        <div v-if="result && result.homepageSlider">
          <VueSlickCarousel v-bind="main_slider" class="main_slider">
            <div class="banner" v-for="(row, index) in result.homepageSlider" :key="index">
                <img v-if="row.image" :src="'/uploads/homepageSlider/'+row.id+'/'+row.image" alt="banner">
            </div>
          </VueSlickCarousel>
          </div>
        </div>

        

      <!-- slider code end  -->
      

      <!-- services section start -->
     <div class="service_section ptb_60">
        <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-12">
                 <u-animate name="zoomIn" duration="2s" class="section_heading text-center mb-3">
                  <h2>Services</h2>
                </u-animate>
              </div> 
                <div class="col-md-4 col-sm-6 serv_b" v-if="result && result.service" v-for="(row, index) in result.service" :key="index">
                  <u-animate name="zoomIn" duration="1.5s" delay="0s" class="services" el="div">
                    <div class="service_details">
                      <div class="service_icon">
                        <!-- <img src="images/services/1.png"> -->
                        <img :src="'/uploads/service/'+row.id+'/'+row.image_name" v-if="row.image_name">
                      </div>
                      <div class="serv_desc">
                        <h2>{{row.service_name}}</h2>
                        <p>{{row.description}}</p>
                      </div>
                    </div>
                  </u-animate>
                </div>   
            </div>
         </div>
     </div>
      <!-- services section End -->
       <!-- About us section start -->
      <div class="about_us_section ptb_60 bg_gray">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-12">
               <u-animate name="zoomIn" duration="2s" class="section_heading text-center mb-3">
                  <h2>About Us</h2>
              </u-animate>
            </div>            
            <div class="col-md-12"> 
               <u-animate name="zoomIn" duration="2s" class="about_description">
                    <div class="abt_heading" v-if="this.result.aboutUS">
                        <h2> {{this.result.aboutUS.title}}</h2>
                    </div>
                    <p class="text-justify" v-if="this.result && this.result.aboutUS">
                      <span v-html="this.result.aboutUS.description.substring(0, 1200) + '...'"> </span> </p>
                     <!-- {{script.script_content.substring(0, 200) + ".."}} -->
                      <router-link :to="{ name: 'about'}">
                        <button class="btn btn-custom">Read more</button>
                      </router-link>
              </u-animate>
            </div>
            <!-- <div class="col-md-4">
               <u-animate name="zoomIn" duration="2s" class="about_img">
                    <img src="images/banner.jpg" alt="about img">
              </u-animate>
            </div> -->
          </div>
        </div>
      </div>
      <!-- About us section End -->
      <!-- Testimonials section start -->
      <div class="testimonials_section py-5 mb-5">
          <div class="container">
            <u-animate name="zoomIn" duration="2s" class="section_heading text-center">
                <h2>Testimonials</h2>
            </u-animate>

              <!-- <vueper-slides>
                  <vueper-slide
                    v-for="(row, index) in result.testimonials"
                    :key="index"
                    :title="row.title"
                    :content="row.description">
                  </vueper-slide>
                </vueper-slides> -->

          <div v-if="result && result.testimonials">
                <VueSlickCarousel v-bind="testimonials_slider" class="testimonials_slider">
                <div class="testimonials_slide" v-for="(row, index) in result.testimonials" :key="index">
                  <u-animate name="zoomIn" duration="1.5s" delay="0s">
                  <div class="testimonial">
                    <div class="testimonial_text">
                      <p v-html="row.description"></p>
                    </div>
                      <h2>{{row.name}}</h2>
                  </div>
                </u-animate>
                </div>
              </VueSlickCarousel> 
          </div>
          </div>
      </div>
      

       <!-- why us section start -->
       <div class="why_us_bg">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="why_us">
                  <h2>Need a Doctor ?</h2>
                  <button class="btn btn-custom">Book Appointment</button>
                </div>
              </div>
               <div class="col-md-6">
                 <div class="why_us">
                  <h2>Why work for us ?</h2>
                   <router-link :to="{ name: 'why-us'}"><button class="btn btn-custom">View Detail</button>
                   </router-link>

                </div>
              </div>
            </div>
          </div>


       </div>

       <!-- why us section end -->
       <!-- client slider start -->
      <div class="partners_section ptb_60 pb-5">
          <div class="container">
              <div class="section_heading text-center">
                  <h2>Associate Partners</h2> 
              </div>
              <div class="partner_s">
                <div v-if="result && result.associatePartner">
                    <VueSlickCarousel v-bind="partners_slider" class="partners_slider">
                      <div class="" v-for="(row, index) in result.associatePartner" :key="index" >
                          <div class="partner_logo">
                            <img width="100%" alt="about img" :src="'uploads/associatePartners/'+row.id+'/'+row.image" v-if="row.image">
                             <img src="/images/uyr_logo.png"  alt="Logo" v-else>
                          </div>  
                      </div>     
                  </VueSlickCarousel>
              </div>
              </div>
          </div>
      </div>
      <!-- client slider end -->
      </main>
      <Ufooter/>
    </u-animate-container>
   </div>
</template>
<script>
  import Uheader from './header'
  import Ufooter from './footer'
  import Vue from "vue";
  
  import VueSlickCarousel from 'vue-slick-carousel'
  import 'vue-slick-carousel/dist/vue-slick-carousel.css'
  import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
  import { mapGetters, mapActions } from 'vuex';
  import axios from "axios";
 

   export default {
    data () {
      return {
        main_slider:{
        "slidesToShow":1,
        "dots": true,
        "arrows":true

       },
       testimonials_slider:{
        "slidesToShow":1,
	      "dots": true,
        "arrows":false

       },
       partners_slider:{
        "slidesToShow":4,
        "responsive": [
          {
            "breakpoint": 1024,
            "settings": {
              "slidesToShow": 3,
              "slidesToScroll": 3,
            }
          },
          {
            "breakpoint": 600,
            "settings": {
              "slidesToShow": 2,
              "slidesToScroll": 2,
            }
          }
        ]
        }
      }
    },
    components: { 
      VueSlickCarousel,
      Uheader,
      Ufooter,
     },
    created(){
       this.fetchUser();
       this.homePageData();
    },

    computed: {
      ...mapGetters("Front/HomePage", ["result"]),
    },

   methods: {
      ...mapActions("auth", ["login","validateLogin", "saveToken","fetchUser", "resetState" ]),
      ...mapActions("Front/HomePage", ["gethomePageData"]),

      async fetchUser() {
        try {
            const { data } = await axios.get('/api/get_user');
            this.user = data;
            if(this.user !=''){
               localStorage.setItem("is_login",'Yes');
               this.$router.push({ path: 'dashboard' });
            }
            else{
              localStorage.removeItem("is_login");
           }
        } catch (e) {
        }
      },

      homePageData() {
        this.gethomePageData().then(() => {
          //console.log(this.result)
        });
      },
    
    }
   }
</script>