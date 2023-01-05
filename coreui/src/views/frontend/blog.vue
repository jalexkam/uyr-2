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
          <h2>Articles</h2>
          <!-- <ul class="breadcumb">
            <li><router-link to="homepage">Home</router-link></li>
            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
            <li><span>Article</span></li>
          </ul> -->
        </div>
      </div>
    </div>
  </section>
 
      <div class="blog_section ptb_60 pt-2">
        <div class="container">
            <div class="row"> 
                <div class="col-md-8">
                    <div v-if="result && result.blog" class="single_blog" v-for="(row, index) in result.blog" :key="index">
                      
                        <div class="blog_img">
                            <img width="100%" alt="about img" :src="'/uploads/blog/'+row.id+'/'+row.image_name" v-if="row.image_name">
                             <img src="/images/banner.jpg" width="100%" alt="about img" v-else>

                        </div>
                        <div class="blog_details">
                            <div class="blog_title">
                              <h2>{{row.title}}</h2>
                            </div>
                              <ul class="single-post">
                                 <li>
                                    <span class="p-date">
                                      <i class="fa fa-calendar-check-o"></i> Feb 16, 2021 </span>
                                 </li>
                                 <li>
                                    <span class="p-date"> <i class="fa fa-user-o"></i>Author: {{row.author_name}} </span>
                                 </li>
                              </ul>                              
                                <p><span v-html="row.description.substring(0, 600) + '...'"> </span> </p>
                                <router-link :to="{ name: 'blog_details',params: { id: row.id } }"> Read more...</router-link>
                        </div>
                    </div>
                </div>
                 <div class="col-md-4">
                      <div class="card latest_blog_box">
                          <div class="card-header p-3">
                              <h6>Latest Post</h6>
                          </div>
                          <div class="card-body p-3">
                            <router-link :to="{ name: 'blog_details',params: { id: row.id } }" v-if="index < 5 " v-for="(row, index) in result.blog" :key="index">
                              <div class="latest_blog" >
                                  <div class="lblog_img">
                                    <img width="100%" alt="about img" :src="'/uploads/blog/'+row.id+'/'+row.image_name" v-if="row.image_name">
                                     <img src="/images/banner.jpg" width="100%" alt="about img" v-else>
                                      <!-- <img src="images/banner.jpg" width="100%"> -->
                                  </div>
                                  <div class="lbog_info">
                                    <h2>{{row.title}}</h2>
                                    <p>04 Dec 2020</p>
                                  </div>
                              </div>
                              </router-link>
                          </div>
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
   import Uheader from './header'
   import Ufooter from './footer'
   import VueSlickCarousel from 'vue-slick-carousel'
   import 'vue-slick-carousel/dist/vue-slick-carousel.css'
   import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
   import { mapGetters, mapActions } from 'vuex';

   export default {
    data () {
      return {
      }
    },
    components: { 
      VueSlickCarousel,
      Uheader,
      Ufooter,
     },
    created(){
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