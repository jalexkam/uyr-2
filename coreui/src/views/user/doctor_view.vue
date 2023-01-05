<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">Doctor <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>View</h5>
               <div class="">
                  <router-link to="Book_doctor">
                  <CButton color="light" size="sm" >
                     Back
                  </CButton>
               </router-link>
               </div>
            </div>
         </CCol>
         <CCol sm="9" class="p-2">
            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>Personal / General Info</strong>
                  </div>
               </CCardHeader> 
               <CCardBody class="px-1 py-2 view_page">
                  <CForm method="POST">
                     <CRow class="m-0">
                        <CCol sm="12" md="2" class="px-1">
                        <div class="form-group">
                           <div class="profile-img">
                              <div class="profileimg">
                              <img src="/uploads/profile/1626676073.jpg">
                              </div>
                           </div>
                        </div>
                     </CCol>
                     <CCol sm="12" md="10" class="px-2">
                        <CRow class="m-0">

                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Full Name</label>
                              <h6>George Anderson</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Email</label>
                              <h6>Demo@test.com</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Phone No.</label>
                              <h6>9876543210</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                           <div class="form-group">
                              <label>Age</label>
                              <h6>35 Years</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="3" class="px-2">
                            <div class="form-group">
                              <label>Gender</label>
                              <h6>Male</h6>
                           </div>
                        </CCol>
                        <CCol sm="12" md="9" class="px-2">
                           <div class="form-group">
                              <label>Address</label>
                              <h6> 2286 Sundown Lane, Austin, Texas 78749, USA</h6>                              
                           </div>
                        </CCol>  
                        </CRow>
                        </CCol>                                     
                     </CRow>
                  </CForm>
               </CCardBody>
            </CCard>

            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>ID and Licensing Credentials</strong>
                  </div>
               </CCardHeader>
               <CCardBody class="px-1 py-2 view_page">
                  <CForm method="POST">
                     <CRow class="m-0">
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Type</label>
                              <h6>Physiotherapist</h6>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                              <div class="form-group">
                                 <label>Certificate awarding University<span>*</span></label>
                                 <div class="attch-button">
                                    <input type="file" name="file" id="file" class="inputfile" />
                                    <label for="file">
                                       <CIcon name="cil-file"/>
                                    </label> 
                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                              <div class="form-group">
                                 <label>Copy of specialty diploma<span>*</span></label>
                                 <div class="attch-button">
                                    <input type="file" name="file" id="file" class="inputfile" />
                                    <label for="file">
                                       <CIcon name="cil-file"/>
                                    </label> 
                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                              <div class="form-group">
                                 <label>Copy of registration in the doctor’s council (Medical council)<span>*</span></label>
                                 <div class="attch-button">
                                    <input type="file" name="file" id="file" class="inputfile" />
                                    <label for="file">
                                       <CIcon name="cil-file"/>
                                    </label> 
                                 </div>
                              </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Enter your medical license number</label>
                              <h6>Physiotherapist</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Date of Registration</label>
                              <h6>20-06-2019</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Registration No.</label>
                              <h6>1562</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Years of Experience</label>
                              <h6>5 Years</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Current Clinic/hospital of work</label>
                              <h6>Physiotherapist</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Select radius on map for Dr's availability</label>
                              <h6>Physiotherapist</h6>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Service(s) provided</label>
                              <h6>Physiotherapist</h6>
                           </div>
                        </CCol>  
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Select equipment available at your current clinic/hospital</label>
                              <ul class="d-flex justify-content-around m-0 p-0">
                                 <li>A</li>
                                 <li>B</li>
                                 <li>C</li>
                                 <li>D</li>
                                 <li>E</li>
                              </ul>
                           </div>                        
                        </CCol>                 
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Willing to serve as</label>
                              <h6>General practitioner</h6>  
                           </div>
                        </CCol>
                        <!-- <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Enter your availability<span>*</span></label>
                              <h6>Only weekends</h6>
                           </div>
                        </CCol> -->
                         <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Area of Coverage</label>
                              <h6>Lorem ipusum</h6>
                           </div>
                        </CCol>
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Brief summary about yourself (150 words)</label>
                              <h6>
                                 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                 proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                 proident, sunt in culpa qui officia deserunt mollit anim id est laborum.     
                              </h6>
                           </div>
                        </CCol> 
                        <CCol sm="12" class="px-2">
                           <div class="form-group">
                              <label>Terms and condition (policy and procedure of working together)</label>
                              <h6>
                                 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                 proident, sunt in culpa qui officia deserunt mollit anim id est laborum.   
                              </h6>
                           </div>
                        </CCol>                                      
                     </CRow>
                  </CForm>
               </CCardBody>
            </CCard>
           <!--  <CCard class="mb-0">
             <CCardBody>
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>Reviews</strong>
                  </div>
               </CCardHeader> 
               <div class="px-3 py-3">
                <div class="review_listing mb-5">
                   <ul class="commernt_list p-0">
                      <li>
                         <div class="comment">
                            <img src="/uploads/profile/1626676073.jpg" class="review_img ">
                            <div class="comment_body">
                               <div class="meta_data">
                                  <h5 class="comment_author">George Anderson</h5>
                                  <span class="comment_date">Reviewed 2 Days ago</span>
                                  <div class="review-count rating">
                                     <i class="fa fa-star filled"></i> 
                                     <i class="fa fa-star filled"></i> 
                                     <i class="fa fa-star filled"></i> 
                                     <i class="fa fa-star filled"></i> 
                                     <i class="fa fa-star"></i>
                                  </div>
                               </div>
                               <p class="recommended"><i class="fa fa-thumbs-up"></i> I recommend the doctor</p>
                               <p class="comment-content">
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                  Ut enim ad minim veniam, quis nostrud exercitation.
                                  Curabitur non nulla sit amet nisl tempus
                               </p>
                               <div class="comment-reply">
                                  <a href="#" class="comment-btn"><i class="fa fa-reply"></i> Reply</a> 
                                  <p class="recommend-btn"><span>Recommend?</span> 
                                     <a href="#" class="like-btn">
                                     <i class="fa fa-thumbs-up"></i> Yes
                                     </a> 
                                     <a href="#" class="dislike-btn">
                                     <i class="fa fa-thumbs-down"></i> No
                                     </a>
                                  </p>
                               </div>
                            </div>
                         </div>
                         <ul class="comment_reply p-0">
                            <li>
                               <div class="comment">
                                  <img src="/uploads/profile/1626676073.jpg" class="review_img ">
                                  <div class="comment_body">
                                     <div class="meta_data">
                                        <h5 class="comment_author">George Anderson</h5>
                                        <span class="comment_date">Reviewed 2 Days ago</span>
                                        <div class="review-count rating">
                                           <i class="fa fa-star filled"></i> 
                                           <i class="fa fa-star filled"></i> 
                                           <i class="fa fa-star filled"></i> 
                                           <i class="fa fa-star filled"></i> 
                                           <i class="fa fa-star"></i>
                                        </div>
                                     </div>
                                     <p class="recommended"><i class="fa fa-thumbs-up"></i> I recommend the doctor</p>
                                     <p class="comment-content">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        Ut enim ad minim veniam, quis nostrud exercitation.
                                        Curabitur non nulla sit amet nisl tempus
                                     </p>
                                     <div class="comment-reply">
                                        <a href="#" class="comment-btn"><i class="fa fa-reply"></i> Reply</a> 
                                        <p class="recommend-btn"><span>Recommend?</span> 
                                           <a href="#" class="like-btn">
                                           <i class="fa fa-thumbs-up"></i> Yes
                                           </a> 
                                           <a href="#" class="dislike-btn">
                                           <i class="fa fa-thumbs-down"></i> No
                                           </a>
                                        </p>
                                     </div>
                                  </div>
                               </div>
                            </li>
                         </ul>
                      </li>
                      <li>
                         <div class="comment">
                            <img src="/uploads/profile/1626676073.jpg" class="review_img ">
                            <div class="comment_body">
                               <div class="meta_data">
                                  <h5 class="comment_author">George Anderson</h5>
                                  <span class="comment_date">Reviewed 2 Days ago</span>
                                  <div class="review-count rating">
                                     <i class="fa fa-star filled"></i> 
                                     <i class="fa fa-star filled"></i> 
                                     <i class="fa fa-star filled"></i> 
                                     <i class="fa fa-star filled"></i> 
                                     <i class="fa fa-star"></i>
                                  </div>
                               </div>
                               <p class="recommended"><i class="fa fa-thumbs-up"></i> I recommend the doctor</p>
                               <p class="comment-content">
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                  Ut enim ad minim veniam, quis nostrud exercitation.
                                  Curabitur non nulla sit amet nisl tempus
                               </p>
                               <div class="comment-reply">
                                  <a href="#" class="comment-btn"><i class="fa fa-reply"></i> Reply</a> 
                                  <p class="recommend-btn"><span>Recommend?</span> 
                                     <a href="#" class="like-btn">
                                     <i class="fa fa-thumbs-up"></i> Yes
                                     </a> 
                                     <a href="#" class="dislike-btn">
                                     <i class="fa fa-thumbs-down"></i> No
                                     </a>
                                  </p>
                               </div>
                            </div>
                         </div>
                      </li>
                   </ul>
                   <div class="text-center mb-3">
                      <CButton color="danger">Show all Feedback
                         <strong>(10)</strong>
                      </CButton>
                   </div>
                </div>
                <div class="write-review">
                   <h5>Write a review for <strong>Dr. George Anderson</strong></h5>
                   <form>
                      <div class="form-group text-center">
                         <label>Review</label> 
                         <div class="star-rating">
                            <input id="star-5" type="radio" name="rating" value="star-5"> 
                            <label for="star-5" title="5 stars">
                            <i class="active fa fa-star"></i>
                            </label> 
                            <input id="star-4" type="radio" name="rating" value="star-4"> 
                            <label for="star-4" title="4 stars">
                            <i class="active fa fa-star"></i>
                            </label> 
                            <input id="star-3" type="radio" name="rating" value="star-3"> 
                            <label for="star-3" title="3 stars">
                            <i class="active fa fa-star"></i>
                            </label> 
                            <input id="star-2" type="radio" name="rating" value="star-2"> 
                            <label for="star-2" title="2 stars">
                            <i class="active fa fa-star"></i>
                            </label> 
                            <input id="star-1" type="radio" name="rating" value="star-1"> 
                            <label for="star-1" title="1 star">
                            <i class="active fa fa-star"></i>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Title of your review</label> 
                         <input type="text" placeholder="If you could say it in one sentence, what would you say?" class="form-control">
                      </div>
                      <div class="form-group">
                         <label>Your review</label> 
                         <textarea maxlength="100" class="form-control"></textarea>
                         <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted">
                            <span id="chars">100</span> characters remaining</small>
                         </div>
                      </div>
                      <span class="border-top d-block my-2"></span>
                      <div class="form-group">
                         <div class="terms-accept">
                            <div class="custom-checkbox"><input type="checkbox" id="terms_accept"> 
                               <label for="terms_accept">I have read and accept <a class="text-danger" href="#">Terms &amp; Conditions</a></label>
                            </div>
                         </div>
                      </div>
                      <div class="submit-section">
                         <CButton class="btn_custom" >Add Review</CButton>
                      </div>
                   </form>
                </div>
             </div>
             </CCardBody>
          </CCard> -->
         </CCol>
         <CCol sm="3" class="p-2">
            <CCard>
               <CCardBody class="p-2">
                  <CButton size="sm" color="warning" class="text-white mx-auto d-block w-75 p-2 mb-3">
                  <vue-fontawesome icon="star" class="mr-1" size="0.8"></vue-fontawesome>Add Favorite</CButton>
                  <CButton size="sm" class="btn_custom d-block w-75 mx-auto p-2" to="Add_time">
                     <vue-fontawesome icon="calendar-check-o" class="mr-1" size="0.8"></vue-fontawesome>Book Appointment</CButton>
                  <!-- <CButton size="sm" color="warning">Add Favorite</CButton> -->

               </CCardBody>
            </CCard>
         </CCol>
      </CRow>
   </div>
</template>
<script>
   import Vue from 'vue'
   export default{
       
    
   }
   
</script> 
