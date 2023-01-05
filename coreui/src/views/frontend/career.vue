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
                     <h2>Careers</h2>
                     <!-- <ul class="breadcumb">
                        <li><router-link to="homepage">Home</router-link></li>                        
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        <li><span>Careers</span></li>
                     </ul> -->
                  </div>
               </div>
            </div>
         </section>
         <div class="ptb_60 pt-2">
            <div class="container">
               <div class="career_section">
                  <div class="row">
                     <div class="col-md-10 mx-auto">
                        <div class="career_form">
                           <form>
                              <div class="form_all">
                                 <div class="form_heading">
                                    <h2>Personal/General Info</h2>
                                 </div>
                                 <div class="form_info">
                                    <div class="row">
                                       <div class="form-group col-md-6">
                                          <label>First Name<span>*</span></label>
                                          <input type="text" name="" class="form-control" v-model="careerForm.firstName">
                                       </div>
                                         <div class="form-group col-md-6">
                                          <label>Last Name<span>*</span></label>
                                          <input type="text" name="" class="form-control" v-model="careerForm.lastName">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Email<span>*</span></label>
                                          <input type="email" name="" class="form-control" v-model="careerForm.email">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Phone No.<span>*</span></label>
                                          <input type="tel" name="" class="form-control" v-model="careerForm.phone" v-on:blur="acceptNumber" maxlength="12" @input="acceptNumber" @keypress="onlyNumric($event)">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Age<span>*</span></label>
                                          <input type="number" name="" class="form-control" v-model="careerForm.age">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Gender<span>*</span></label><br>
                                          <div class="custom-control custom-radio custom-control-inline">
                                             <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="Male" v-model="careerForm.gender">
                                             <label class="custom-control-label" for="customRadioInline1">Male</label>
                                          </div>
                                          <div class="custom-control custom-radio custom-control-inline">
                                             <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="Female" v-model="careerForm.gender">
                                             <label class="custom-control-label" for="customRadioInline2">Female</label>
                                          </div>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label>Address<span>*</span></label>
                                          <textarea class="form-control" placeholder="" v-model="careerForm.address"></textarea>
                                       </div>

                                        <div class="form-group col-md-6">
                                          <label>Upload Document<span></span></label><br>
                                          <input type="file" name="uploddocuemnt"   v-on:change="onImageChange">
                                       </div>

                                    </div>
                                 </div>
                              </div>
                              <!-- <div class="form_all">
                                 <div class="form_heading">
                                    <h2>ID and Licensing Credentials</h2>
                                 </div>
                                 <div class="form_info">
                                    <div class="row">
                                       <div class="form-group col-md-6">
                                          <label>Type<span>*</span></label>
                                          <select class="form-control">
                                             <option>General practitioner</option>
                                             <option>Physiotherapist</option>
                                             <option>Specialist</option>
                                          </select>
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Certificate awarding University<span>*</span></label><br>
                                          <input type="file" name="">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Copy of specialty diploma<span>*</span></label><br>
                                          <input type="file" name="">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Copy of registration in the doctor’s council (Medical council).<span>*</span></label><br>
                                          <input type="file" name="">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Enter your medical license number<span>*</span></label>
                                          <input type="text" class="form-control" name="">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Date of registration<span>*</span></label>
                                          <input type="text" class="form-control" name="">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Registration No.<span>*</span></label>
                                          <input type="text" class="form-control" name="">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Date of registration<span>*</span></label>
                                          <input type="text" class="form-control" name="">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Years of experience<span>*</span></label>
                                          <input type="text" class="form-control" name="">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Current Clinic/hospital of work<span>*</span></label>
                                          <input type="text" class="form-control" name="">
                                       </div>
                                    </div>
                                 </div>
                              </div> -->
                              <div class="form_all">
                                <div class="form_info py-0">
                                  <div class="row">
                                      <div class="form-group col-md-12 text-right">
                                          <!-- <button class="submitbtn" type="reset">Reset</button> -->
                                          <button class="submitbtn" type="button" @click="submitFormData()">Submit</button>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                           </form>
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
      resume:[],
      careerForm         : new Form({firstName : '', lastName: '', email: '', phone: '', age: '',gender: '',address: ''}),
      }
     },

      components: { 
      Uheader,
      Ufooter
     },
     created() {
     },
     computed: {
       ...mapGetters("Front/HomePage", ["returnData"]),
     },
     methods: {
         ...mapActions("Front/HomePage", ["submitCareerForm"]),

      
      onlyNumric(evt){ return commonHelper.onlyNumric(evt); },
      acceptNumber() {
         var x = this.careerForm.phone.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
           this.careerForm.phone = !x[2] ? x[1] : '' + x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '');
      },


    submitFormData() {
     if(this.careerForm.lastName =='' || this.careerForm.lastName ==''|| this.careerForm.email ==''|| this.careerForm.phone =='' || this.careerForm.address =='' )  {
         Vue.$toast.open({
             message: "Please Insert All Data!",
             type: 'error',
             duration: 5000,
             dismissible: true
           });
     }else{

      let newData  =  new FormData();
      newData.append('file',this.resume)
      newData.append('formData',JSON.stringify(this.careerForm))
     this.submitCareerForm({newData:newData}).then(() => {
       if (this.returnData.status == 'success') {
         Vue.$toast.open({
                   message: this.returnData.message,
                   type: this.returnData.status,
               });
        this.careerForm  = new Form({firstName : '', lastName: '', email: '', phone: '', age: '',gender: '',address: ''});
    
        } 
     })
     .catch(error => {
        window.scrollTo(0,0);      
     });
     }
    },

      onImageChange(e) {
      this.resume = e.target.files[0];
      // var reader = new FileReader();
      //    reader.onload = (e) => {
      //          this.imageDoc = e.target.result;
      //    }
      // reader.readAsDataURL(this.resume);
      },

    }
   }
</script>