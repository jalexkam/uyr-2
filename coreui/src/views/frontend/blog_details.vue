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
                     <h2>Blog Details</h2> 
                  </div>
               </div>
            </div>
         </section>
         <div class="blog_section ptb_60 pt-2">
            <div class="container">
               <div class="row">
                  <div class="col-md-8">
                     <div class="single_blog">
                        <div class="blog_img">
                           <img width="100%" alt="about img" :src="'uploads/blog/'+getArticalviewData.id+'/'+getArticalviewData.image_name" v-if="getArticalviewData.image_name">
                           <img src="images/banner.jpg" width="100%" alt="about img" v-else>
                        </div>
                        <div class="blog_details">
                           <div class="blog_title">
                              <h2>{{getArticalviewData.title}}</h2>
                           </div>
                           <ul class="single-post">
                              <li>
                                 <span class="p-date">
                                 <i class="fa fa-calendar-check-o"></i> Feb 16, 2021 </span>
                              </li>
                              <li>
                                 <span class="p-date"> <i class="fa fa-user-o"></i>Author: Lorem Ipsum </span>
                              </li>
                           </ul>
                           <p v-html="getArticalviewData.description"> </p>
                        </div>
                     </div>
                     <!-- <div class="card blog_share">
                        <div class="card-header px-3 py-2">
                           <h5 class="mb-0">Share the post</h5>
                        </div>
                        <div class="card-body p-3">
                           <ul class="social_share">
                              <li>
                                 <a href="#"><i class="fa fa-facebook"></i></a>
                              </li>
                              <li>
                                 <a href="#"><i class="fa fa-twitter"></i></a>
                              </li>
                              <li>
                                 <a href="#"><i class="fa fa-linkedin"></i></a>
                              </li>
                              <li>
                                 <a href="#"><i class="fa fa-whatsapp"></i></a>
                              </li>
                              <li>
                                 <a href="#"><i class="fa fa-instagram"></i></a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="card blog_author">
                        <div class="card-header px-3 py-2">
                           <h5 class="mb-0">About Author</h5>
                        </div>
                        <div class="card-body p-3">
                           <div class="about_author">
                              <div class="author-img">
                                 <img src="/uploads/profile/1626676073.jpg">
                              </div>
                              <div class="author_detail">
                                 <h6>Lorem ipsum</h6>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card blog_comments">
                        <div class="card-header px-3 py-2">
                           <h5 class="mb-0">Comments <span>(12)</span></h5>
                        </div>
                        <div class="card-body p-3">
                           <ul class="comments-list">
                              <li>
                                 <div class="comment">
                                    <div class="comment-author">
                                       <img alt="" src="/uploads/profile/1626676073.jpg" class="avatar">
                                    </div>
                                    <div class="comment-block">
                                       <span class="comment-by">
                                       <span class="blog-author-name">Michelle Fairfax</span>
                                       </span> 
                                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                       <p class="blog-date">Dec 6, 2017</p>
                                       <a href="#" class="comment-btn">
                                       <i class="fa fa-reply"></i> Reply
                                       </a>
                                    </div>
                                 </div>
                                 <ul class="comments-list">
                                    <li>
                                       <div class="comment">
                                          <div class="comment-author">
                                             <img alt="" src="/uploads/profile/1626676073.jpg" class="avatar">
                                          </div>
                                          <div class="comment-block">
                                             <span class="comment-by">
                                             <span class="blog-author-name">Michelle Fairfax</span>
                                             </span> 
                                             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                             <p class="blog-date">Dec 6, 2017</p>
                                             <a href="#" class="comment-btn">
                                             <i class="fa fa-reply"></i> Reply
                                             </a>
                                          </div>
                                       </div>
                                    </li>
                                    <li>
                                       <div class="comment">
                                          <div class="comment-author">
                                             <img alt="" src="/uploads/profile/1626676073.jpg" class="avatar">
                                          </div>
                                          <div class="comment-block">
                                             <span class="comment-by">
                                             <span class="blog-author-name">Michelle Fairfax</span>
                                             </span> 
                                             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                             <p class="blog-date">Dec 6, 2017</p>
                                             <a href="#" class="comment-btn">
                                             <i class="fa fa-reply"></i> Reply
                                             </a>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                              </li>
                              <li>
                                 <div class="comment">
                                    <div class="comment-author">
                                       <img alt="" src="/uploads/profile/1626676073.jpg" class="avatar">
                                    </div>
                                    <div class="comment-block">
                                       <span class="comment-by">
                                       <span class="blog-author-name">Michelle Fairfax</span>
                                       </span> 
                                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                       <p class="blog-date">Dec 6, 2017</p>
                                       <a href="#" class="comment-btn">
                                       <i class="fa fa-reply"></i> Reply
                                       </a>
                                    </div>
                                 </div>
                              </li>
                              <li>
                                 <div class="comment">
                                    <div class="comment-author">
                                       <img alt="" src="/uploads/profile/1626676073.jpg" class="avatar">
                                    </div>
                                    <div class="comment-block">
                                       <span class="comment-by">
                                       <span class="blog-author-name">Michelle Fairfax</span>
                                       </span> 
                                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                       <p class="blog-date">Dec 6, 2017</p>
                                       <a href="#" class="comment-btn">
                                       <i class="fa fa-reply"></i> Reply
                                       </a>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="card new_comment">
                        <div class="card-header py-2 px-3">
                           <h5 class="mb-0">Leave Comment</h5>
                        </div>
                        <div class="card-body p-3">
                           <form>
                              <div class="row">
                                 <div class="form-group col-md-6">  
                                    <label>Name</label>
                                    <input type="text" name="" class="form-control">
                                 </div>
                                 <div class="form-group col-md-6">  
                                    <label>Email</label>
                                    <input type="email" name="" class="form-control">
                                 </div>
                                 <div class="form-group col-md-12">  
                                    <label>Comment</label>
                                    <textarea rows="3" class="form-control"></textarea>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <button type="submit" class="submitbtn">Submit</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div> -->
                  </div>
                  <div class="col-md-4">
                     <div class="card latest_blog_box">
                        <div class="card-header p-3">
                           <h6>Latest Post</h6>
                        </div>
                        <div class="card-body p-3">
                           <div v-if="index < 5 " v-for="(row, index) in result.blog" :key="index" @click="getdetails(row.id)">
                           <div class="latest_blog" >
                              
                              <div class="lblog_img">
                                 <img width="100%" alt="about img" :src="'uploads/blog/'+row.id+'/'+row.image_name" v-if="row.image_name">
                                     <img src="images/banner.jpg" width="100%" alt="about img" v-else>
                              </div>
                               <!-- <router-link :to="{ name: 'blog_details',params: { id: row.id } }"> -->
                              <div class="lbog_info">
                                 <h2>{{row.title}} </h2>
                                 <p>04 Dec 2020</p>
                              </div>
                           </div>
                             </div>
                         
                        </div>
                     </div>
                     <!-- <div class="card blog_categories">
                        <div class="card-header p-3">
                           <h6>Blog Categories</h6>
                        </div>
                        <div class="card-body p-3">
                           <ul class="categories">
                              <li>
                                 <a href="#">Health Care</a>
                                 <span>(05)</span>
                              </li>
                              <li>
                                 <a href="#">Health Tip</a>
                                 <span>(09)</span>
                              </li>
                              <li>
                                 <a href="#">Health Treatment</a>
                                 <span>(15)</span>
                              </li>
                              <li>
                                 <a href="#">Medical Research</a>
                                 <span>(10)</span>
                              </li>
                           </ul>
                        </div>
                     </div> -->
                  </div>
               </div>
            </div>
         </div>
         <!-- <h2 class="m-5">Coming Soon</h2> -->
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
         if(this.$route.params.id != '' && this.$route.params.id != undefined){
            this.id = this.$route.params.id;
         this.getFormData(this.$route.params.id);
         }
    },

    computed: {
      ...mapGetters("Front/HomePage", ["result","getArticalviewData"]),
    },

 mounted() {
    console.log(`the component is now mounted.`)
  },

   methods: {
      ...mapActions("Front/HomePage", ["gethomePageData","getArticalview"]),

      homePageData() {
        this.gethomePageData().then(() => {
          
        });
      },
      getdetails(id){
      this.getFormData(id);
       this.$router.push({ name: 'blog_details', params: { id: id } });
      },
      getFormData(id) {
         this.getArticalview(id).then(() => {
               
         });
      },

    
    }
   }
</script>
<style>
   ul.social_share li a {
   border: 1px solid #dfdfdf;
   color: #666;
   display: inline-block;
   font-size: 22px;
   height: 40px;
   line-height: 40px;
   width: 40px;
   text-align: center;
   }
   ul.social_share li a:hover {
    background: #2c449e;
    color: #fff;
}
   ul.social_share li{
   display: inline-block;
   margin-left: 6px
   }
   ul.social_share li:first-child{
   margin-left: 0
   }
   .about_author {
   display: flex;
   }
   .author-img {
   width: 100px;
   height: 100px;
   border: 1px solid #ccc;
   margin-right: 15px;
   overflow: hidden;
   }
   .author-img img{
   width: 100%;
   height: 100%;
   object-fit: cover;
   }
   .author_detail {
   width: 82%;
   }
   .author_detail p{
   text-align: justify;
   }
   .blog_comments .comments-list {
   list-style: none;
   margin: 0;
   padding: 0;
   position: relative;
   }
   .blog_comments .comments-list li img.avatar {
   height: 58px;
   width: 58px;
   border-radius: 58px;
   }
   .blog_comments .comments-list li {
   clear: both;
   padding-left: 80px;
   }
   .blog_comments .comments-list li .comment {
   margin-bottom: 20px;
   }
   .blog_comments .comments-list li .comment-author {
   left: 0;
   position: absolute;
   }
   .comment-by {
   display: block;
   font-size: 14px;
   line-height: 21px;
   margin: 0 0 10px;
   }
   .blog-author-name {
   color: #272b41;
   font-size: 16px;
   font-weight: 600;
   }
   .comments-list .comment-block p {
   font-size: 14px;
   margin-bottom: 5px;
   }
   .blog-date {
   color: #999;
   font-size: 12px;
   }
   .blog_comments .comment-btn {
   color:#2c449e;
   display: inline-block;
   font-weight: 500;
   font-size: 15px;
   }
   .blog_comments .card-body>ul li+li {
   margin-top: 20px;
   border-top: 1px dashed #ccc;
   padding-top: 20px;
   }
</style>