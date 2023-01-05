      <template>
        <div>
          
      <!-- <footer class="footer">
          <div class="container">
              <div class="footer_flex">
                <u-animate name="zoomIn" duration="2s" :offset="-10" delay="0s" class="f_widget">
                    
                      <div class="footer_logo mb-2">
                      <img src="images/uyr_logo.png" width="150" alt="Footer Logo">
                    </div>
                      <p class="text-justify"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                      <div class="social-links">

              <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>

          </div>
                  </u-animate>
                  <u-animate name="zoomIn" duration="2s" :offset="-10" delay="0.2s" class="f_widget f_wid">
                      <h2>Quick Links</h2>                      
                      <ul>
                          <li><router-link :to="{ name: 'blog'}">Articles</router-link></li>
                          <li><router-link :to="{ name: 'career'}"> Careers</router-link></li>
                          <li> <router-link :to="{ name: 'contact'}"> Contact Us </router-link></li>
                          <li><router-link :to="{ name: 'about'}">About Us</router-link></li>                        
                      </ul>
                  </u-animate>
                  <u-animate name="zoomIn" duration="2s" :offset="-10" delay="0.4s" class="f_widget f_wid">
                      <h2>Locations</h2>
                      <ul>
                          <li><a href="#">Location 1</a></li>
                          <li><a href="#">Location 2</a></li>
                          <li><a href="#">Location 3</a></li>
                          <li><a href="#">Location 4</a></li>
                      </ul>
                  </u-animate>
              </div>
          </div>  
      </footer> -->
      <div class="footer_bottom text-center">
        <div class="container">
            <div class="f_bottm">
                <div class="f_left">
                   <p>2022 © All Rights Reserved.</p>
                </div>
                 <div class="f_left">
                    <ul>
                           <li><router-link :to="{ name: 'privacy-policy'}" >Privacy & Policy</router-link></li>
                           <li><router-link :to="{ name: 'terms-condition'}" >Terms & Conditions</router-link></li>

                        <!-- <li><a href="#">Privacy & Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
      </div>
    </div>
      </template>
    <script>
    import {UAnimateContainer, UAnimate} from 'vue-wow'
    export default {
      name:'Ufooter',
       data () {
     return {
       
   
     }
   },
   components: { 
       UAnimateContainer,
      UAnimate
     },
    }
      
    </script>

   

  