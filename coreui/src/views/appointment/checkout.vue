<template>
   <div>
      <CRow class="mx-0 justify-content-center">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Checkout</h5>
                <router-link v-if="result.appointmentData && result.appointmentData.doctor_informationID" :to="{ name: 'view_doctor_patient' ,params: { id: result.appointmentData.doctor_informationID,doctor_suggest_id:result.appointmentData.doctor_suggest_id}}">
                  <CButton color="light">
                     Back
                  </CButton>
               </router-link>
            </div>
         </CCol>
         <CCol md="5" class="px-2">
            <CCard class="">
               <CCardBody class="p-4">
                  <div class="payment_widget">
                     <h4 class="mb-3">Personal Information</h4>
                      <div class="payment-list">
                        <CRow>
                           <CCol md="6">
                              <div class="form-group card_lable">
                                 <label>First Name</label>
                                 <input type="text" class="form-control" placeholder="First Name" v-model="formData.fname">
                              </div>
                           </CCol>
                           <CCol md="6">
                              <div class="form-group card_lable">
                                 <label>Last Name</label>
                                 <input type="text" class="form-control" placeholder="Last Name" v-model="formData.lname">
                              </div>
                           </CCol>
                           <CCol md="6">
                              <div class="form-group card_lable">
                                 <label>Email</label>
                                 <input type="text" class="form-control" placeholder="Email" v-model="formData.email">
                              </div>
                           </CCol>
                           <CCol md="6">
                              <div class="form-group card_lable">
                                 <label>Phone</label>
                                 <input type="text" class="form-control" placeholder="Phone" v-model="formData.phone">
                              </div>
                           </CCol>
                             <CCol md="12">
                            <div class="submit_sect mt-3 text-right">
                              <CButton class="btn_custom" type="button"  @click="goToPaypalWallet(1)" :disabled="isActive">Confirm & Pay</CButton>
                           </div>
                           </CCol>
                        </CRow>
                     </div>
                     </div>
                     
               </CCardBody>
            </CCard>
         </CCol>
         <CCol md="4" class="px-2">
            <CCard class="">
               <CCardHeader class="p-3">
                  <h6 class="m-0">Booking Summary</h6>
               </CCardHeader>
               <CCardBody class="p-3">
                  <div class="doctorlist_card mb-3">
                   <!--   <div class="doctor_imgbox">
                        <img src="/uploads/profile/1626676073.jpg">
                     </div> -->
                     <div class="doctor_information pr-2 ml-0">
                        <h6>Doctor Info</h6>

                        <p>
                           <strong><vue-fontawesome icon="user-md" class="mr-1 my-0" size="0.9"></vue-fontawesome></strong>
                           <span>{{appointmentData.doctorName}}</span>
                        </p>
                        <div class="rating">
                           <i class="fa fa-star filled"></i> 
                           <i class="fa fa-star filled"></i> 
                           <i class="fa fa-star filled"></i> 
                           <i class="fa fa-star filled"></i> 
                           <i class="fa fa-star"></i> 
                        </div>
                        <p>
                           <strong>Type:</strong>
                           <span>{{appointmentData.doctortype}}</span>                        
                        </p>
                        <p>
                           <strong>
                              <vue-fontawesome icon="map-marker" class="mr-1 my-0" size="0.9"></vue-fontawesome>
                           </strong>
                           <span>Newyork, USA</span>                        
                        </p>
                     </div>
                     <!-- patient info -->
                      <div class="doctor_information patient_info_che ml-0">
                        <h6>Patient Info</h6>
                        <p>
                           <strong><vue-fontawesome icon="user" class="mr-1 my-0" size="0.9"></vue-fontawesome></strong>
                           <span>{{appointmentData.patientName}}</span>
                        </p>
                        <p>
                           <strong>
                              <vue-fontawesome icon="map-marker" class="mr-1 my-0" size="0.9"></vue-fontawesome>
                           </strong>
                           <span>Newyork, USA</span>                        
                        </p>
                     </div>
                  </div>
                  <div class="booking-summary">
                     <div class="booking-item-wrap">
                        <ul class="booking-date">
                           <li>Date <span>{{appointmentData.appointment_date}}</span></li>
                           <li>Time <span>{{appointmentData.appointment_time}}</span></li>
                        </ul>
                        <ul class="booking-fee">
                           <li>Booking Fee <span>{{appointmentData.fees_amount}}/-</span></li>
                        </ul>
                        <div class="booking-total">
                           <ul class="booking-total-list">
                              <li><span>Total</span> <span class="total-cost">{{appointmentData.fees_amount}}/-</span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </CCardBody>
            </CCard>
         </CCol>
      </CRow>
   </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import Vue from 'vue';
import Vuex from 'vuex';
import Form from "vform";
import Swal from 'sweetalert2';

export default {
   data() {
      return {
         formData       :  new Form({ id:"",fname: '',lname:'',phone:'',email:'',payment_type:'',item_order:'',appointment_id:'',patient_id:""}),
         markers:  [],
         doctorData:[],
         appointmentData:[],
         loader_flag    : false,
         appointment_id:"",
         isActive : false,
        };
   },
   created() {

     
       if(this.$route.params.appointment_id != ''){
         this.formData.appointment_id = this.$route.params.appointment_id;
          localStorage.setItem('appointment_id', this.$route.params.appointment_id);

         this.getBookingInfo(this.$route.params.appointment_id);
       }

        if(this.$route.params.patient_id != ''){
         this.formData.patient_id = this.$route.params.patient_id;
          localStorage.setItem('patient_id', this.$route.params.patient_id);
       }


   },

  computed: {
    ...mapGetters("Appointment/Index", ["result","paymentData"]),
    //...mapGetters("Payment/Index", ["returnData"]),
  },

  methods: {
    ...mapActions("Appointment/Index", ["getBookingData","orderPayment"]),
  //...mapActions("Payment/Index", ["orderPayment"]),

   getBookingInfo(id) {
         this.getBookingData(id).then(() => {
           //this.doctorData =  this.result.doctorData ;
           this.appointmentData =  this.result.appointmentData ;
         });
        },

         goToPaypalWallet(payment_type){
            this.isActive =  true;
            this.formData.payment_type = payment_type;

            if(this.formData.fname == '' || this.formData.lname == ''|| this.formData.email == ''|| this.formData.phone == ''){
               Vue.$toast.open({
                    message: 'Please fill out all required fields.',
                    type: 'error',
                });
            }else{
               this.submitPaymentForm();

            }
      },

       submitPaymentForm(){
          this.isActive =  true; 
         this.formData.appointment_id = this.$route.params.appointment_id;
           this.orderPayment(this.formData)
        .then(()=>{
          if (this.paymentData.status=='success') {
            this.isActive =  false; 
            if (this.formData.payment_type==1) {
               localStorage.setItem('appointment_id', this.$route.params.appointment_id);
               localStorage.setItem('patient_id', this.$route.params.patient_id);
              window.location.href = this.paymentData.url;

            }
            else
            {    
                this.appointment_id = localStorage.getItem("appointment_id");
                this.$router.push({ name: 'booking-success', params: { "appointment_id": this.appointment_id } });
               // this.$router.push({ name: 'booking-success'});
            }
          }
         
        }).catch(error => {
          this.btnDisable = false;
          this.paypal_status = 'error';
          $(".option_paypal").removeClass("div_disabled");
            this.loader_flag = false;
        });

       }

  }
}
</script> 
<style>
   .payment-radio {
   display: block;
   position: relative;
   /*padding-left: 35px;*/
   margin-bottom: 12px;
   cursor: pointer;
   font-size: 16px;
   user-select: none;
   font-weight: 600;
   color: #272b41;
   text-transform: capitalize;
   height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;

   }
   .payment_widget h4 {
   font-size: 18px;
   font-weight: 500;
   }
   .payment-radio input {
   position: absolute;
   opacity: 0;
   cursor: pointer;
   height: 0;
   width: 0;
   }

     .pay_icon {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: #ccc
}

   .payment-radio input:checked~.checkmark {
    border-color: #6dcf8d;
    box-shadow: 0 0 8px 0px #2eb85ca1;
    color: #2eb85c;
    background: #f2fff6;
}

   .payment-radio input:checked~.pay_icon {
       color: #2eb85c;
       z-index: 1;
   }
   /*.payment-radio input:checked~.checkmark::after {
   transform: translate(-50%, -50%) scale(1);
   opacity: 1;
   visibility: visible;
   }
   .payment-radio .checkmark::after {
   position: absolute;
   left: 50%;
   top: 50%;
   content: '';
   width: 9px;
   height: 9px;
   background-color: #2c449e;
   opacity: 0;
   visibility: hidden;
   transform:  translate(-50%, -50%) scale(.1) ;
   border-radius: 50%;
   transition: all .3s;
   }*/
   .payment-radio .checkmark {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   margin: 3px 0 0;
   border: 2px solid #ddd;
   border-radius: 8px;
   transition: all .3s;
   }
 
   .card_lable>label {
   background-color: #fff;
   color: #959595;
   display: inline-block;
   font-size: 13px;
   font-weight: 500;
   margin: 6px auto auto 8px;
   padding: 0 7px;
   }
   .card_lable>input {
   background-color: #fff;
   border: 1px solid #dbdbdb;
   border-radius: 4px;
   box-shadow: 0 1px 3px 0 rgb(0 0 0 / 5%);
   display: block;
   height: 50px;
   margin-top: -13px;
   padding: 5px 15px 0;
   transition: border-color .3s;
   width: 100%;
   }
   .terms-accept .custom-checkbox {
   display: flex;
   align-items: center;
   }
   .payment-list{
   margin-bottom: 15px;
   }
   .booking-total {
   border-top: 1px solid #e4e4e4;
   margin-top: 20px;
   padding-top: 20px;
   }
   .booking-fee li,
   .booking-date li {
   position: relative;
   font-size: 14px;
   font-weight: 500;
   color: #272b41;
   text-transform: capitalize;
   margin-bottom: 15px;
   }
   .booking-fee li span,
   .booking-date li span {
   float: right;
   color: #757575;
   font-weight: 400;
   font-size: 15px;
   }
   .booking-total ul li span {
   font-size: 18px;
   font-weight: 600;
   color: #272b41;
   }
   .booking-total ul li .total-cost {
   color: #2c449e;
   font-size: 16px;
   float: right;
   }
</style>