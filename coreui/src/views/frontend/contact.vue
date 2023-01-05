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
          <h2>Contact Us</h2>
          <!-- <ul class="breadcumb">
            <li><router-link to="homepage">Home</router-link></li>
            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
            <li><span>Contact Us</span></li>
          </ul> -->
        </div>
      </div>
    </div>
  </section>

      <div class="ptb_60 pt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="contact_details">
                      <h2>Get In Touch</h2>
                      <ul v-if="result.contact" class="mb-0" v-for="row, index in result.contact" :key="index">
                      <li>
                        <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <p>{{row.address}}</p>
                      </li>
                      <li>
                        <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                        <p><a>{{row.contactno}}</a></p>
                      </li>
                      <li >
                        <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                        <p><a>{{row.email}}</a></p>
                      </li>
                      <hr/>
                    </ul>
                    <ul class="mb-0">
                    <li class="social">
                          <a v-if="result && result.socialLinksData && result.socialLinksData.instagram" :href="result.socialLinksData.instagram" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                          <a v-if="result && result.socialLinksData && result.socialLinksData.twitter" :href="result.socialLinksData.twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                          <a v-if="result && result.socialLinksData && result.socialLinksData.facebook" :href="result.socialLinksData.facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                          <a v-if="result && result.socialLinksData && result.socialLinksData.linkedIn" :href="result.socialLinksData.linkedIn" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                          <a v-if="result && result.socialLinksData && result.socialLinksData.youTube" :href="result.socialLinksData.youTube" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i>
                          </a>
                      </li>
                    </ul>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="contact_form">
                        <form>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>First Name</label>
                                    <input type="text" name="" class="form-control" v-model="contactUsForm.firstName">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="" class="form-control" v-model="contactUsForm.lastName">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Email ID</label>
                                    <input type="email" name="" class="form-control" v-model="contactUsForm.email">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Phone No,</label>
                                    <input type="tel" name="" class="form-control" v-model="contactUsForm.phone" v-on:blur="acceptNumber" maxlength="12" @input="acceptNumber" @keypress="onlyNumric($event)" >
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Message</label>
                                    <textarea class="form-control" v-model="contactUsForm.message"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button class="submitbtn" type="button" @click="submitFormData()">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>    
        </div>
      </div>
      <!-- footer section add -->
    </main>
      <Ufooter/>
    </u-animate-container>
	</div>
</template>
<script>
   import Vue from 'vue';
   import Form from "vform"; 
   import Uheader from './header'
   import Ufooter from './footer'
   import { mapGetters, mapActions } from "vuex";
   import VueToast from 'vue-toast-notification';
   import 'vue-toast-notification/dist/theme-sugar.css';
   import commonHelper from "./../../global_helper/helpers.js";
   Vue.use(VueToast);
   
   export default {

    data () {
    return {
      formModal              : false,
      formModal1              : false,
      id                     : 0,
      contactUsForm         : new Form({firstName : '', lastName: '', email: '', phone: '', message: ''}),
      }
     },

      components: { 
      Uheader,
      Ufooter
     },
     
     
     created() {
      this.id = this.$route.params.id;
     // this.ContactUsList();
      this.homePageData();
     },
     computed: {
       //...mapGetters("Masters/ContactUsDetails", ["result"]),
       ...mapGetters("Front/HomePage", ["result","returnData"]),
     },
     methods: {
     
        //...mapActions("Masters/ContactUsDetails", ["ContactUsList"]),
         ...mapActions("Front/HomePage", ["gethomePageData","submitContactUsForm"]),
        homePageData() {
        this.gethomePageData().then(() => {
          //console.log(this.result)
        });
      },

      onlyNumric(evt){ return commonHelper.onlyNumric(evt); },
      acceptNumber() {
         var x = this.contactUsForm.phone.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
           this.contactUsForm.phone = !x[2] ? x[1] : '' + x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '');
      },


    submitFormData() {
     if(this.contactUsForm.lastName =='' || this.contactUsForm.lastName ==''|| this.contactUsForm.email ==''|| this.contactUsForm.phone =='' || this.contactUsForm.message =='' )  {
         Vue.$toast.open({
             message: "Please Insert All Data!",
             type: 'error',
             duration: 5000,
             dismissible: true
           });
     }else{

     this.submitContactUsForm(this.contactUsForm).then(() => {
       if (this.returnData.status == 'success') {
         Vue.$toast.open({
                   message: this.returnData.message,
                   type: this.returnData.status,
               });
        this.contactUsForm  = new Form({firstName : '', lastName: '', email: '', phone: '', message: ''});
    
        } 
     })
     .catch(error => {
        window.scrollTo(0,0);      
     });
     }
    },
    }
   }
</script>