<template>
   <div>
      <CRow class="mx-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Checkout</h5>
               <router-link to="Add_time">
                  <CButton color="light" size="sm" >
                     Back
                  </CButton>
               </router-link>
            </div>
         </CCol>
         <CCol md="8" class="px-2">
            <CCard class="">
               <CCardBody class="p-4">
                  <div class="payment_widget">
                     <h4 class="mb-3">Payment Method</h4>
                     <div class="payment-list">
                        <label class="payment-radio credit-card-option">
                        <input type="radio" name="radio" checked="checked"> 
                        <span class="checkmark"></span>
                        Debit card
                        </label>
                        <CRow>
                           <CCol md="6">
                              <div class="form-group card_lable">
                                 <label>Name on Card</label>
                                 <input type="text" class="form-control">
                              </div>
                           </CCol>
                           <CCol md="6">
                              <div class="form-group card_lable">
                                 <label>Card Number</label>
                                 <input type="text" class="form-control" placeholder="1234 5678 9876 5432">
                              </div>
                           </CCol>
                           <CCol md="4">
                              <div class="form-group card_lable">
                                 <label>Expiry Month</label>
                                 <input type="text" class="form-control" placeholder="MM">
                              </div>
                           </CCol>
                           <CCol md="4">
                              <div class="form-group card_lable">
                                 <label>Expiry Year</label>
                                 <input type="text" class="form-control" placeholder="YYYY">
                              </div>
                           </CCol>
                           <CCol md="4">
                              <div class="form-group card_lable">
                                 <label>CVV</label>
                                 <input type="text" class="form-control" placeholder="">
                              </div>
                           </CCol>
                        </CRow>
                     </div>
                     <div class="payment-list">
                        <label class="payment-radio credit-card-option">
                        <input type="radio" name="radio"> 
                        <span class="checkmark"></span>
                        Paypal
                        </label>
                     </div>
                     <div class="terms-accept">
                        <div class="custom-checkbox">
                           <input type="checkbox" id="terms_accept"> 
                           <label for="terms_accept" class="ml-2 mb-0">I have read and accept 
                           <a href="#">Terms &amp; Conditions.</a></label>
                        </div>
                     </div>
                     <div class="submit_sect mt-3">
                        <CButton class="btn_custom" type="submit" to="Booking_success">Confirm & Pay</CButton>
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
                     <div class="doctor_imgbox">
                        <img src="/uploads/profile/1626676073.jpg">
                     </div>
                     <div class="doctor_information">
                        <p>
                           <strong>Name:</strong>
                           <span>George Anderson</span>
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
                           <span>Physiotherapist</span>                        
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
                           <li>Date <span>16 Sep 2021</span></li>
                           <li>Time <span>10:00 AM</span></li>
                        </ul>
                        <ul class="booking-fee">
                           <li>Consulting Fee <span>$100</span></li>
                           <li>Booking Fee <span>$10</span></li>
                           <li>Video Call <span>$50</span></li>
                        </ul>
                        <div class="booking-total">
                           <ul class="booking-total-list">
                              <li><span>Total</span> <span class="total-cost">$160</span></li>
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
   export default{
   
     }
     
</script>
<style>
   .payment-radio {
   display: block;
   position: relative;
   padding-left: 35px;
   margin-bottom: 12px;
   cursor: pointer;
   font-size: 16px;
   user-select: none;
   font-weight: 600;
   color: #272b41;
   text-transform: capitalize;
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
   .payment-radio input:checked~.checkmark {
   border-color: #2c449e;
   }
   .payment-radio input:checked~.checkmark::after {
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
   }
   .payment-radio .checkmark {
   position: absolute;
   top: 0;
   left: 0;
   width: 19px;
   height: 19px;
   margin: 3px 0 0;
   border: 2px solid #ddd;
   border-radius: 50%;
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