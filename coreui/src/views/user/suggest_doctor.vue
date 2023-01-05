<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">
                  Doctor 
                  <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>
                  Suggest
               </h5>
               <div class="">
                  <CButton size="sm" class="btn_custom" to="Book_doctor">Submit</CButton>
                  <router-link to="Book_doctor" >
                     <CButton size="sm" color="light">Back</CButton>
                  </router-link>
               </div>
            </div>
         </CCol>
         <CCol sm="9" class="p-2">
            <CForm method="POST">
               <CCard class="mb-0">
                  <CCardHeader class="p-2 px-3 bg_themes">
                     <div>
                        <strong>Suggest Me Doctor</strong>
                     </div>
                  </CCardHeader>
                  <CCardBody class="px-1 py-2">
                     <CRow class="m-0">
                        <!-- <CCol sm="6" md="4" class="px-2">
                           <CInput label="Patient Name"  placeholder=""/>
                           </CCol> -->
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Select Type of Specialist</label>
                              <select class="form-control" v-model="selecta">
                                 <option value="1">General practitioner</option>
                                 <option value="2">Physiotherapist</option>
                                 <option value="3">Specialist</option>
                              </select>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Select Date</label>
                              <date-picker v-model="datetime" type="date" format="DD/MM/YYYY" jumpMinute="5" roundMinute="true"  min="01/01/1980" color="#2c449e"
                                 ></date-picker>
                           </div>
                        </CCol>
                        <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Selece Time</label>
                              <div class="d-flex align-items-center">
                                 <date-picker v-model="datetime" type="time" format="HH:mm" jumpMinute="15" roundMinute="true" color="#2c449e"
                                    ></date-picker>
                                 <label class="mx-2">To</label>
                                 <date-picker v-model="datetime" type="time" format="HH:mm" jumpMinute="15" roundMinute="true" color="#2c449e"
                                    ></date-picker>
                              </div>
                           </div>
                        </CCol>
                      <!--   <CCol sm="6" md="4" class="px-2">
                           <div class="form-group">
                              <label>Where to Visit</label>
                              <select class="form-control">
                                 <option>Home Visit</option>
                                 <option>Clinic Visit</option>
                              </select>
                           </div>
                        </CCol> -->
                     </CRow>
                  </CCardBody>
               </CCard>
               <!-- <CAlert color="danger">
                  <h2><vue-fontawesome icon="exclamation-triangle" class="mr-2" size="1.2"></vue-fontawesome>Caution </h2>
                  <p class="text-justify">Home visits are possible, but are dependent on the area. Also, our home doctors’ visits may require a follow-up hospital visit as a home visit doctor my recommend lab work, specialist, scans etc. you may have to purchase another visit to a health care facility of your choice. </p>
                  <p>Thanks </p>
                  <CButton size="sm" color="danger">Accept</CButton>
                  </CAlert> -->
               <div v-show="selecta === '1'">
                  <CCard class="mb-0">
                     <CCardHeader class="p-2 px-3 bg_themes">
                        <div>
                           <strong>Patient’s Personal Details:  </strong>
                        </div>
                     </CCardHeader>
                     <CCardBody class="px-1 py-2">
                        <CRow class="m-0">
                           <CCol sm="6" md="4" class="px-2">
                              <CInput label="Full Name*" placeholder=""/>
                           </CCol>
                           <CCol sm="6" md="4" class="px-2">
                              <CInput label="Contact No.*" placeholder=""/>
                           </CCol>
                           <CCol sm="6" md="4" class="px-2">
                              <CInput label="Email*" placeholder=""/>
                           </CCol>
                           <CCol sm="12" class="px-2">
                              <div class="form-group">
                                 <label>Address</label>
                                 <textarea class="form-control"></textarea>
                              </div>
                           </CCol>
                        </CRow>
                     </CCardBody>
                  </CCard>
                  <CCard class="mb-0">
                     <CCardHeader class="p-2 px-3 bg_themes">
                        <div>
                           <strong>Reason for your request:</strong>
                        </div>
                     </CCardHeader>
                     <CCardBody class="px-1 py-2">
                        <CRow class="m-0">
                           <CCol sm="6" md="6" class="px-2">
                              <div class="form-group">
                                 <label>Medical recommendation to see general practitioner:</label><br>
                                 <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInlineg1" name="customRadioInlineg1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInlineg1">Yes</label>
                                 </div>
                                 <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInlineg2" name="customRadioInlineg1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInlineg2">No</label>
                                 </div>
                              </div>
                           </CCol>
                           <CCol sm="4" md="4" class="px-2">
                              <div class="form-group">
                                 <label>Where to Visit</label>
                                 <select class="form-control">
                                    <option>Home Visit</option>
                                    <option>Clinic Visit</option>
                                 </select>
                              </div>
                           </CCol>
                           <CCol sm="6" md="6" class="px-2">
                              <div class="form-group">
                                 <label> Upload med report with recommendation if available</label>
                                 <input type="file" name="">
                              </div>
                           </CCol>
                            <CCol sm="12" md="12" class="px-2">
                              <div class="form-group">
                                 <label> Enter details for other reason here</label>
                                 <textarea class="form-control" rows="3"></textarea>
                              </div>
                           </CCol>
                        </CRow>
                     </CCardBody>
                  </CCard>
                  <CCard class="mb-0">
                     <CCardHeader class="p-2 px-3 bg_themes">
                        <div>
                           <strong>Medical History</strong>
                        </div>
                     </CCardHeader>
                     <CCardBody class="px-1 py-2">
                        <CRow class="m-0">
                           <CCol sm="12" md="12" class="px-2">
                              <div class="form-group medi_his">
                                 <label>Do you know if #patient name# suffers from any of the following? </label><br>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">Allergies</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">Thyroid Problems</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                                    <label class="form-check-label" for="inlineCheckbox3">Headaches</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option4">
                                    <label class="form-check-label" for="inlineCheckbox4">High/Low Blood Pressure</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="option5">
                                    <label class="form-check-label" for="inlineCheckbox5">Heart Condition</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox7" value="option7">
                                    <label class="form-check-label" for="inlineCheckbox7">Varicose Veins</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox8" value="option8">
                                    <label class="form-check-label" for="inlineCheckbox8">Eczema/Psoriasis</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox9" value="option9">
                                    <label class="form-check-label" for="inlineCheckbox9">Cancer</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox10" value="option10">
                                    <label class="form-check-label" for="inlineCheckbox10">IBS/Bowel Problems</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox11" value="option11">
                                    <label class="form-check-label" for="inlineCheckbox11">Arthritis/Rheumatism</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox12" value="option12">
                                    <label class="form-check-label" for="inlineCheckbox12">Epilepsy</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox13" value="option13">
                                    <label class="form-check-label" for="inlineCheckbox13">Claustrophobia</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox14" value="option14">
                                    <label class="form-check-label" for="inlineCheckbox14">Asthma/Lung Problems </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox15" value="option15">
                                    <label class="form-check-label" for="inlineCheckbox15">Back Problems </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox16" value="option16">
                                    <label class="form-check-label" for="inlineCheckbox16">Fungal Infection </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox17" value="option17">
                                    <label class="form-check-label" for="inlineCheckbox17">Diabetes </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox18" value="option18">
                                    <label class="form-check-label" for="inlineCheckbox18">Muscular Pain</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox19" value="option19">
                                    <label class="form-check-label" for="inlineCheckbox19">Other</label>
                                 </div>
                              </div>
                           </CCol>
                           <CCol md="12" class="px-2">
                              <div class="form-group">
                                 <label> If you have ticked any of the above, please give details:</label>
                                 <textarea class="form-control" rows="3"></textarea>
                              </div>
                           </CCol>
                        </CRow>
                     </CCardBody>
                  </CCard>
               </div>
               <div v-show="selecta === '2'">
                  <!--  <CAlert color="danger">
                     <h2><vue-fontawesome icon="exclamation-triangle" class="mr-2" size="1.2"></vue-fontawesome>Caution </h2>
                     <p class="text-justify">Home visits are possible, but are dependent on the area. Also, our home doctors’ visits may require a follow-up hospital visit as a home visit doctor my recommend lab work, specialist opinion, scans etc. you may have to make another purchase to visit to a health care facility of your choice.</p>
                     <p>Thanks </p>
                     <CButton size="sm" color="danger">Accept</CButton>
                     </CAlert> -->
                  <CCard class="mb-0">
                     <CCardHeader class="p-2 px-3 bg_themes">
                        <div>
                           <strong>Patient’s Personal Details:  </strong>
                        </div>
                     </CCardHeader>
                     <CCardBody class="px-1 py-2">
                        <CRow class="m-0">
                           <CCol sm="6" md="4" class="px-2">
                              <CInput label="Full Name*" placeholder=""/>
                           </CCol>
                           <CCol sm="6" md="4" class="px-2">
                              <CInput label="Contact No.*" placeholder=""/>
                           </CCol>
                           <CCol sm="6" md="4" class="px-2">
                              <CInput label="Email*" placeholder=""/>
                           </CCol>
                           <CCol sm="12" class="px-2">
                              <div class="form-group">
                                 <label>Address</label>
                                 <textarea class="form-control"></textarea>
                              </div>
                           </CCol>
                        </CRow>
                     </CCardBody>
                  </CCard>
                  <CCard class="mb-0">
                     <CCardHeader class="p-2 px-3 bg_themes">
                        <div>
                           <strong>Reason for your request:</strong>
                        </div>
                     </CCardHeader>
                     <CCardBody class="px-1 py-2">
                        <CRow class="m-0">
                           <CCol sm="6" md="6" class="px-2">
                              <div class="form-group">
                                 <label>Medical recommendation to see Physio:</label><br>
                                 <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInlinep1" name="customRadioInlinep1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInlinep1">Yes</label>
                                 </div>
                                 <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInlinep2" name="customRadioInlinep1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInlinep2">No</label>
                                 </div>
                              </div>
                           </CCol>
                           <CCol sm="6" md="4" class="px-2">
                              <div class="form-group">
                                 <label>Where to Visit</label>
                                 <select class="form-control">
                                    <option>Home Visit</option>
                                    <option>Clinic Visit</option>
                                 </select>
                              </div>
                           </CCol>
                           <CCol sm="6" md="6" class="px-2">
                              <div class="form-group">
                                 <label> Upload med report with recommendation if available</label>
                                 <input type="file" name="">
                              </div>
                           </CCol>
                            <CCol sm="12" md="12" class="px-2">
                              <div class="form-group">
                                 <label> Enter details for other reason here</label>
                                 <textarea class="form-control" rows="3"></textarea>
                              </div>
                           </CCol>
                        </CRow>
                     </CCardBody>
                  </CCard>
               </div>
               <div v-show="selecta === '3'">
                  <!--  <CAlert color="danger">
                     <h2><vue-fontawesome icon="exclamation-triangle" class="mr-2" size="1.2"></vue-fontawesome>Caution </h2>
                     <p class="text-justify">Home visits are possible, but are dependent on the area. Also, our home doctors’ visits may require a follow-up hospital visit as a home visit doctor my recommend lab work, specialist, scans etc. you may have to purchase another visit to a health care facility of your choice. </p>
                     <p>Thanks </p>
                     <CButton size="sm" color="danger">Accept</CButton>
                     </CAlert> -->
                  <CCard class="mb-0">
                     <CCardHeader class="p-2 px-3 bg_themes">
                        <div>
                           <strong>Patient’s Personal Details:  </strong>
                        </div>
                     </CCardHeader>
                     <CCardBody class="px-1 py-2">
                        <CRow class="m-0">
                           <CCol sm="6" md="4" class="px-2">
                              <CInput label="Full Name*" placeholder=""/>
                           </CCol>
                           <CCol sm="6" md="4" class="px-2">
                              <CInput label="Contact No.*" placeholder=""/>
                           </CCol>
                           <CCol sm="6" md="4" class="px-2">
                              <CInput label="Email*" placeholder=""/>
                           </CCol>
                           <CCol sm="12" class="px-2">
                              <div class="form-group">
                                 <label>Address</label>
                                 <textarea class="form-control"></textarea>
                              </div>
                           </CCol>
                           <CCol md="4" class="px-2">
                              <div class="form-group">
                                 <label>Select required health specialist </label><br>
                                 <select class="form-control">
                                    <option>Allergy and immunology</option>
                                    <option>Anaesthesiology</option>
                                    <option>Dermatology</option>
                                    <option>Diagnostic radiology</option>
                                    <option>Emergency medicine</option>
                                    <option>Family medicine</option>
                                    <option>Internal medicine</option>
                                    <option>Medical genetics</option>
                                    <option>Neurology</option>
                                    <option>Nuclear medicine</option>
                                    <option>Obstetrics and gynaecology</option>
                                    <option>Ophthalmology</option>
                                    <option>Pathology</option>
                                    <option>Paediatrics</option>
                                    <option>Physical medicine and rehabilitation</option>
                                    <option>Preventive medicine</option>
                                    <option>Psychiatry</option>
                                    <option>Radiation oncology</option>
                                    <option>Surgery</option>
                                    <option>Urology </option>
                                    </option>
                                 </select>
                              </div>
                           </CCol>
                        </CRow>
                     </CCardBody>
                  </CCard>
                  <CCard class="mb-0">
                     <CCardHeader class="p-2 px-3 bg_themes">
                        <div>
                           <strong>Reason for your request:</strong>
                        </div>
                     </CCardHeader>
                     <CCardBody class="px-1 py-2">
                        <CRow class="m-0">
                           <CCol sm="6" md="6" class="px-2">
                              <div class="form-group">
                                 <label>Medical recommendation to see specialist:</label><br>
                                 <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInlines1" name="customRadioInlines1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInlines1">Yes</label>
                                 </div>
                                 <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInlines2" name="customRadioInlines1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInlines2">No</label>
                                 </div>
                              </div>
                           </CCol>
                           <CCol sm="6" md="4" class="px-2">
                              <div class="form-group">
                                 <label>Where to Visit</label>
                                 <select class="form-control">
                                    <option>Home Visit</option>
                                    <option>Clinic Visit</option>
                                 </select>
                              </div>
                           </CCol>
                           <CCol sm="6" md="6" class="px-2">
                              <div class="form-group">
                                 <label> Upload med report with recommendation if available</label>
                                 <input type="file" name="">
                              </div>
                           </CCol>
                            <CCol sm="12" md="12" class="px-2">
                              <div class="form-group">
                                 <label> Enter details for other reason here</label>
                                 <textarea class="form-control" rows="3"></textarea>
                              </div>
                           </CCol>
                        </CRow>
                     </CCardBody>
                  </CCard>
                  <CCard class="mb-0">
                     <CCardHeader class="p-2 px-3 bg_themes">
                        <div>
                           <strong>Medical History</strong>
                        </div>
                     </CCardHeader>
                     <CCardBody class="px-1 py-2">
                        <CRow class="m-0">
                           <CCol sm="12" md="12" class="px-2">
                              <div class="form-group medi_his">
                                 <label>Do you know if #patient name# suffers from any of the following? </label><br>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">Allergies</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">Thyroid Problems</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                                    <label class="form-check-label" for="inlineCheckbox3">Headaches</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option4">
                                    <label class="form-check-label" for="inlineCheckbox4">High/Low Blood Pressure</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="option5">
                                    <label class="form-check-label" for="inlineCheckbox5">Heart Condition</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox7" value="option7">
                                    <label class="form-check-label" for="inlineCheckbox7">Varicose Veins</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox8" value="option8">
                                    <label class="form-check-label" for="inlineCheckbox8">Eczema/Psoriasis</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox9" value="option9">
                                    <label class="form-check-label" for="inlineCheckbox9">Cancer</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox10" value="option10">
                                    <label class="form-check-label" for="inlineCheckbox10">IBS/Bowel Problems</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox11" value="option11">
                                    <label class="form-check-label" for="inlineCheckbox11">Arthritis/Rheumatism</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox12" value="option12">
                                    <label class="form-check-label" for="inlineCheckbox12">Epilepsy</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox13" value="option13">
                                    <label class="form-check-label" for="inlineCheckbox13">Claustrophobia</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox14" value="option14">
                                    <label class="form-check-label" for="inlineCheckbox14">Asthma/Lung Problems </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox15" value="option15">
                                    <label class="form-check-label" for="inlineCheckbox15">Back Problems </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox16" value="option16">
                                    <label class="form-check-label" for="inlineCheckbox16">Fungal Infection </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox17" value="option17">
                                    <label class="form-check-label" for="inlineCheckbox17">Diabetes </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox18" value="option18">
                                    <label class="form-check-label" for="inlineCheckbox18">Muscular Pain</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox19" value="option19">
                                    <label class="form-check-label" for="inlineCheckbox19">Other</label>
                                 </div>
                              </div>
                           </CCol>
                           <CCol md="12" class="px-2">
                              <div class="form-group">
                                 <label> If you have ticked any of the above, please give details:</label>
                                 <textarea class="form-control" rows="3"></textarea>
                              </div>
                           </CCol>
                        </CRow>
                     </CCardBody>
                  </CCard>
               </div>
            </CForm>
         </CCol>
         <!--  <CCol sm="3" class="p-2">
            <CCard>
               <CCardBody class="p-2">
                  <CForm method="POST">
                    
                  </CForm>
               </CCardBody>
            </CCard>
            </CCol> -->
      </CRow>
   </div>
</template>
<script>
   import Vue from 'vue'
   import VueDatetimePickerJs from 'vue-date-time-picker-js';
   Vue.component('date-picker', VueDatetimePickerJs);
   export default{
      data(){
            return {
                date: '',
                selecta:null
            }
        },
        components: {
            datePicker: VueDatetimePickerJs
        }
       
    
   }
   
</script>