<template>
  <div>
    <CRow class="m-0">
      <CCol sm="12" class="p-2">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Orders List</h5>
        </div>
      </CCol>
    </CRow>

    <vue-tabs class="pateint_view_tab" @tab-change="handleTabChange">
      <v-tab title="Order All">
        <div class="">
          <CCard class="mb-3">
            <CRow class="m-0">
              <CCol md="12" class="px-2 pb-2">
                <CCard>
                  <CCardBody>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Order ID</th>
                            <th>Appointment ID</th>
                            <th>Date / Time</th>
                            <th>Doctor Name</th>
                            <th>Type of doctor</th>
                            <th width="10%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-if="result.data && row.dr_status =='All'" v-for="(row, index) in result.data" :key="index">
                            <td>#{{ index + 1 }}</td>
                            <td>{{ row.id }}</td>
                            <td>{{ row.appointment_date }} {{ row.appointment_time }}</td>
                            <td>{{ row.doctorName }}</td>
                            <td>{{ row.doctortype }}</td>

                            <td>
                              <CButton size="sm" class="btn-outline-success d-flex" v-on:click="MultiAction(row.id,'My Open Order')"> <vue-fontawesome icon="check" class="mr-1" size="0.8"></vue-fontawesome>Select Order </CButton>
                              <!--    
                                 <div class="form-group">
                                     <select class="form-control"   @change="selectkm($event)">
                                          <option>Select Order</option>
                                     </select>
                                 </div> -->
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </CCardBody>
                </CCard>
              </CCol>
            </CRow>

            <!-- </CCollapse> -->
          </CCard>
        </div>
      </v-tab>

      <v-tab title="My open Orders ">
        <div class="">
          <CCard class="mb-3">
            <CRow class="m-0">
              <CCol md="12" class="px-2 pb-2">
                <CCard>
                  <CCardBody>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover order_table">
                        <thead>
                          <tr>
                            <th>Order ID</th>
                            <th>Appointment ID</th>
                            <th>Date / Time</th>
                            <th>Doctor Name</th>
                            <th>Type of doctor</th>
                            <th class="text-center">Status</th>
                            <th width="150px">Action</th>
                          </tr>
                        </thead>
                        <tbody v-if="user && user.doctor !='' && result.data && row.dr_status =='My Open Order' &&  row.mediator_doctor_id == user.doctor.id" v-for="(row, index) in result.data" :key="index">
                          <tr>
                            <td>#{{ index + 1 }}</td>
                            <td>{{ row.id }}</td>
                            <td>{{ row.appointment_date }} {{ row.appointment_time }}</td>
                            <td>{{ row.doctorName }}</td>
                            <td>{{ row.doctortype }}</td>
                            <td class="text-center">
                              <CButton size="sm" color="warning" v-if="row.status =='Pending'">{{row.status}}</CButton>
                              <CButton size="sm" color="success" v-if="row.status =='Accept'">{{row.status}}</CButton>
                              <CButton size="sm" color="danger" v-if="row.status =='Reject'">{{row.status}}</CButton>

                              <!--  <CBadge color="warning" v-if="row.status =='Pending'">{{row.status}}</CBadge>
                                <CBadge color="success" v-if="row.status =='Accept'">{{row.status}}</CBadge>
                                <CBadge color="danger" v-if="row.status =='Reject'">{{row.status}}</CBadge> -->
                            </td>

                            <td class="">
                              <!-- <CButton size="sm" color=""  @click="accordion = accordion === row.id ? false : row.id"   class="btn-outline-info">
                                        <vue-fontawesome icon="caret-down" size="1"></vue-fontawesome>
                                    </CButton> -->
                              <CButton size="sm" color="info" variant="outline" @click="getCondtion(row.id); myModal = true"> <vue-fontawesome icon="eye" class="" size="0.8"></vue-fontawesome>  </CButton>

                               <CButton size="sm" color="danger" variant="outline" v-on:click="MultiAction(row.id,'Cancel')"> <vue-fontawesome icon="refresh" class="" size="0.8"></vue-fontawesome>  </CButton>


                             <!--  <font-awesome-icon icon="fa-brands fa-rev" /> -->


                              <CButton v-if="row.status == 'Accept'" size="sm" color="danger" variant="outline" v-on:click="MultiAction(row.id,'Close')">
                                <vue-fontawesome icon="times" class="mr-1" size="0.8"></vue-fontawesome>Close
                              </CButton>

                              <!--  @click="collapse = !collapse" -->
                            </td>
                          </tr>

                          <tr>
                            <td colspan="7" class="p-0 border-0">
                              <CCollapse :show="accordion === row.id" class="navbar-collapse order_collpase">
                                <CCol md="12" class="px-0 pb-2">
                                  <div>
                                    <CCard class="patient_card mb-0">
                                      <div class="patient_card_body pb-3">
                                        <div class="d-flex justify-content-between flex-wrap">
                                          <div class="pcard_left w-100 border-0">
                                            <div class="pcard_box">
                                              <h5>Doctor Information:</h5>
                                              <div class="d-flex flex-wrap ml-4">
                                                <div class="inner_info">
                                                  <h6>Doctor Name</h6>
                                                  <span>{{row.doctorName}}</span>
                                                </div>

                                                <div class="inner_info">
                                                  <h6>Email</h6>
                                                  <span>{{row.doctorEmail}}</span>
                                                </div>

                                                <div class="inner_info">
                                                  <h6>Phone</h6>
                                                  <span>{{row.doctorPhone}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Type</h6>
                                                  <span>{{row.doctortype}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Appointment Date/Time</h6>
                                                  {{ row.appointment_date }} {{ row.appointment_time }}
                                                  <span></span>
                                                </div>
                                              </div>
                                            </div>
                                            <!--  </div>
                                
                                <div class="pcard_left w-100 border-0"> -->
                                            <div class="pcard_box">
                                              <h5>Patient Information:</h5>
                                              <div class="d-flex flex-wrap ml-4">
                                                <div class="inner_info">
                                                  <h6>Patient Name</h6>
                                                  <span>{{row.patientName}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Email</h6>
                                                  <span>{{row.patientEmail}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Phone</h6>
                                                  <span>{{row.patientPhone}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Where to Visit</h6>
                                                  <span>{{row.visit_type}} </span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Blood group</h6>
                                                  <span>{{row.patient_blood_group}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Date of birth</h6>
                                                  <span>{{row.patient_date_of_birth}}</span>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="d-flex justify-content-between pt-2">
                                          <div class="">
                                            <label><b>Status : </b></label>
                                            <CButton size="sm" color="warning" v-if="row.status =='Pending'">{{row.status}}</CButton>
                                            <CButton size="sm" color="success" v-if="row.status =='Accept'">Accepted</CButton>
                                            <CButton size="sm" color="danger" v-if="row.status =='Reject'">{{row.status}}</CButton>
                                            <!--  <CBadge size="sm" color="warning" class="text-white p-2">In-Progress</CBadge> -->
                                          </div>
                                          <!-- <CButton size="sm" class="btn_custom">Process this order</CButton> -->
                                        </div>
                                      </div>
                                    </CCard>
                                  </div>
                                </CCol>
                              </CCollapse>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </CCardBody>
                </CCard>
              </CCol>
            </CRow>
            <!-- </CCollapse> -->
          </CCard>
        </div>
      </v-tab>

      <v-tab title="Approve Order">
        <div class="">
          <CCard class="mb-3">
            <CRow class="m-0">
              <CCol md="12" class="px-2 pb-2">
                <CCard>
                  <CCardBody>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover order_table">
                        <thead>
                          <tr>
                            <th>Order ID</th>
                            <th>Appointment ID</th>
                            <th>Date / Time</th>
                            <th>Doctor Name</th>
                            <th>Type of doctor</th>
                            <th class="text-center">Status</th>
                            <th width="150px">Action</th>
                          </tr>
                        </thead>
                        <tbody v-if="user && user.doctor !='' && result.data && row.dr_status =='Approved mediator' && row.status !='Completed' &&  row.mediator_doctor_id == user.doctor.id" v-for="(row, index) in result.data" :key="index">
                          <tr>
                            <td>#{{ index + 1 }}</td>
                            <td>{{ row.id }}</td>
                            <td>{{ row.appointment_date }} {{ row.appointment_time }}</td>
                            <td>{{ row.doctorName }}</td>
                            <td>{{ row.doctortype }}</td>
                            <td class="text-center">
                              <CButton size="sm" color="warning" v-if="row.status =='Pending'">{{row.status}}</CButton>
                              <CButton size="sm" color="success" v-if="row.status =='Accept'">{{row.status}}</CButton>
                              <CButton size="sm" color="danger" v-if="row.status =='Reject'">{{row.status}}</CButton>
                               <CButton size="sm" color="success" v-if="row.status =='Completed'">{{row.status}}</CButton>
                            </td>

                            <td class="">
                              <!-- <CButton size="sm" color="info" variant="outline" @click="getCondtion(row.id); myModal = true"> <vue-fontawesome icon="eye" class="mr-1" size="0.8"></vue-fontawesome> View </CButton> -->
                              <CButton v-if="row.status == 'Accept'" size="sm" color="danger" variant="outline" v-on:click="MultiAction(row.id,'Close')">
                                <vue-fontawesome icon="times" class="mr-1" size="0.8"></vue-fontawesome>Close
                              </CButton>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="7" class="p-0 border-0">
                              <CCollapse :show="accordion === row.id" class="navbar-collapse order_collpase">
                                <CCol md="12" class="px-0 pb-2">
                                  <div>
                                    <CCard class="patient_card mb-0">
                                      <div class="patient_card_body pb-3">
                                        <div class="d-flex justify-content-between flex-wrap">
                                          <div class="pcard_left w-100 border-0">
                                            <div class="pcard_box">
                                              <h5>Doctor Information:</h5>
                                              <div class="d-flex flex-wrap ml-4">
                                                <div class="inner_info">
                                                  <h6>Doctor Name</h6>
                                                  <span>{{row.doctorName}}</span>
                                                </div>

                                                <div class="inner_info">
                                                  <h6>Email</h6>
                                                  <span>{{row.doctorEmail}}</span>
                                                </div>

                                                <div class="inner_info">
                                                  <h6>Phone</h6>
                                                  <span>{{row.doctorPhone}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Type</h6>
                                                  <span>{{row.doctortype}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Appointment Date/Time</h6>
                                                  {{ row.appointment_date }} {{ row.appointment_time }}
                                                  <span></span>
                                                </div>
                                              </div>
                                            </div>
                                            <!--  </div>
                                
                                <div class="pcard_left w-100 border-0"> -->
                                            <div class="pcard_box">
                                              <h5>Patient Information:</h5>
                                              <div class="d-flex flex-wrap ml-4">
                                                <div class="inner_info">
                                                  <h6>Patient Name</h6>
                                                  <span>{{row.patientName}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Email</h6>
                                                  <span>{{row.patientEmail}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Phone</h6>
                                                  <span>{{row.patientPhone}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Where to Visit</h6>
                                                  <span>{{row.visit_type}} </span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Blood group</h6>
                                                  <span>{{row.patient_blood_group}}</span>
                                                </div>
                                                <div class="inner_info">
                                                  <h6>Date of birth</h6>
                                                  <span>{{row.patient_date_of_birth}}</span>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="d-flex justify-content-between pt-2">
                                          <div class="">
                                            <label><b>Status : </b></label>
                                            <CButton size="sm" color="warning" v-if="row.status =='Pending'">{{row.status}}</CButton>
                                            <CButton size="sm" color="success" v-if="row.status =='Accept'">Accepted</CButton>
                                            <CButton size="sm" color="danger" v-if="row.status =='Reject'">{{row.status}}</CButton>
                                            <!--  <CBadge size="sm" color="warning" class="text-white p-2">In-Progress</CBadge> -->
                                          </div>
                                          <!-- <CButton size="sm" class="btn_custom">Process this order</CButton> -->
                                        </div>
                                      </div>
                                    </CCard>
                                  </div>
                                </CCol>
                              </CCollapse>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </CCardBody>
                </CCard>
              </CCol>
            </CRow>
            <!-- </CCollapse> -->
          </CCard>
        </div>
      </v-tab>

      <v-tab title="Completed Order">
        <div class="">
          <CCard class="mb-3">
            <CRow class="m-0">
              <CCol md="12" class="px-2 pb-2">
                <CCard>
                  <CCardBody>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Order ID</th>
                            <th>Appointment ID</th>
                            <th>Date / Time</th>
                            <th>Doctor Name</th>
                            <th>Type of doctor</th>
                            <th class="text-center">Status</th>
                             <th class="text-center">view</th>
                            <!--  <th class="text-center" width="10%">Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-if="result.data  && row.status =='Completed' && row.dr_status =='Approved mediator' " v-for="(row, index) in result.data">
                            <td>#{{ index + 1 }}</td>
                            <td>{{ row.id }}</td>
                            <td>{{ row.appointment_date }} {{ row.appointment_time }}</td>
                            <td>{{ row.doctorName }}</td>
                            <td>{{ row.doctortype }}</td>
                            <td class="text-center">
                              <CBadge color="warning" v-if="row.status =='Pending'">{{row.status}}</CBadge>
                              <CBadge color="danger" v-if="row.status =='Accept'">Closed</CBadge>
                              <CBadge color="danger" v-if="row.status =='Reject'">{{row.status}}</CBadge>
                               <CBadge color="success" v-if="row.status =='Completed'">Completed</CBadge>
                            </td>
                            <td>
                             <!-- <router-link :to="{ name: 'doctor_appointment_patient_view',params: { id: row.id } }"> -->
                             <CButton color="info"  @click="formMyModal = true; getConsultationForm(row.id,'Completed');" >
                               <vue-fontawesome icon="eye"size="1"></vue-fontawesome>
                               
                            </CButton>
                            </td>
                        <!-- </router-link> -->


                            <!--  <td class="text-center">
                                 <div class="form-group">
                                     Closed
                                 </div>
                              </td>  -->
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </CCardBody>
                </CCard>
              </CCol>
            </CRow>
            <!-- </CCollapse> -->
          </CCard>
        </div>
      </v-tab>

        <v-tab title="Close Order">
        <div class="">
          <CCard class="mb-3">
            <CRow class="m-0">
              <CCol md="12" class="px-2 pb-2">
                <CCard>
                  <CCardBody>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <thead> 
                          <tr>
                            <th>Order ID</th>
                            <th>Appointment ID</th>
                            <th>Date / Time</th>
                            <th>Doctor Name</th>
                            <th>Type of doctor</th>
                            <th class="text-center">Status</th>
                             <th class="text-center">view</th>
                            <!--  <th class="text-center" width="10%">Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-if="result.data && row.status =='Completed' && row.dr_status =='Close'" v-for="(row, index) in result.data">
                            <td>#{{ index + 1 }}</td>
                            <td>{{ row.id }}</td>
                            <td>{{ row.appointment_date }} {{ row.appointment_time }}</td>
                            <td>{{ row.doctorName }}</td>
                            <td>{{ row.doctortype }}</td>
                            <td class="text-center">
                              <CBadge color="warning" v-if="row.status =='Pending'">{{row.status}}</CBadge>
                              <CBadge color="danger" v-if="row.status =='Accept'">Closed</CBadge>
                              <CBadge color="danger" v-if="row.status =='Reject'">{{row.status}}</CBadge>
                               <CBadge color="success" v-if="row.status =='Completed'">Completed</CBadge>
                            </td>
                            <td>
                             <!-- <router-link :to="{ name: 'doctor_appointment_patient_view',params: { id: row.id } }"> -->
                             <CButton color="info"  @click="formMyModal = true; getConsultationForm(row.id,'Close');" >
                               <vue-fontawesome icon="eye"size="1"></vue-fontawesome>
                               
                            </CButton>
                            </td>
                        <!-- </router-link> -->


                            <!--  <td class="text-center">
                                 <div class="form-group">
                                     Closed
                                 </div>
                              </td>  -->
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </CCardBody>
                </CCard>
              </CCol>
            </CRow>
            <!-- </CCollapse> -->
          </CCard>
        </div>
      </v-tab>

    </vue-tabs>

    <CModal title="View Order" :show.sync="myModal" :closeOnBackdrop="false" addContentClasses="medical_report_card">
      <div class="order_modal">
        <CCard class="mb-0 border-0">
          <CCardBody class="p-0">
            <CRow class="m-0">
              <CCol md="12" class="px-2">
                <div class="form-group mb-3">
                  <label>Patient Condition: </label>
                  <h6>{{getPatientCondtionData.patient_condtion}}</h6>
                </div>
              </CCol>
              <CCol md="6" class="px-2">
                <div class="form-group mb-3">
                  <label>Doctor Name</label>
                  <h6>{{getPatientCondtionData.drFname}} {{getPatientCondtionData.drLname}}</h6>
                </div>
              </CCol>
              <CCol md="6" class="px-2">
                <div class="form-group mb-3">
                  <label>Doctor Type</label>
                  <h6>{{getPatientCondtionData.doctortype}}</h6>
                </div>
              </CCol>
              <CCol md="12" class="px-2">
                <div class="mt-2 text-center button_group">
                  <CButton color="success" v-on:click="MultiAction(getPatientCondtionData.id,'Approved')">Approve</CButton>
                  <CButton color="warning" class="text-white">Ammend</CButton>
                  <CButton color="danger">Reject</CButton>
                </div>
              </CCol>
            </CRow>
          </CCardBody>
        </CCard>
      </div>
    </CModal>

    <CModal
      title="Consultation form"
      :show.sync="formMyModal"
      :closeOnBackdrop="false"
      addContentClasses="medical_report_card"
      :size="'xl'"
    >
      <div class="medical_report">
        <CRow class="m-0">
          <CCol sm="12" class="p-2">
            <CCard class="mb-0 consultationViewCard border-bottom-0">
               <CCardHeader class="px-2">
                  <h6>Medical History</h6>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CRow class="m-0">
                     <CCol sm="12" md="12" class="px-2">
                        <div class="form-group medi_his">
                           <label>Have you ever had or do you have now a problem with :</label><br>
                           <ul >
                             <li v-for="(medical, index) in getConsultationData.medicalHistory" :key="index">{{medical}}</li>
                           </ul>

                        </div>
                     </CCol>
                     <CCol md="12" class="px-2">
                        <div class="form-group">
                           <label> Describe the situation below:</label>
                           <p><span v-html="getConsultationData.describeSituation"></span></p>
                        </div>
                     </CCol>
                     <CCol md="12" class="px-2">
                        <div class="form-group">
                           <label>Describe answers above with dates: </label>
                           <p><span v-html="getConsultationData.describeAnswers"></span></p>
                        </div>
                     </CCol>  

                     <CCol md="12" class="px-2">
                        <div class="form-group">
                           <label>PAST MEDICAL HISTORY: </label>
                          <span v-html="getConsultationData.pastHistory"></span>
                        </div>
                     </CCol> 
                     <CCol md="12" class="px-2 form-group">
                         <label >Current Medication List: </label>
                         <table class="table table-bordered" >
                              <tbody>
                                <tr v-for="(medication, index) in getConsultationData.medication" :key="index">
                                    <td  >
                                       {{medication}}
                                     </td>
                                 
                                </tr>     
                              </tbody>
                           </table>
                     </CCol>
                  </CRow>
               </CCardBody>
            </CCard>
            
          
            <CCard class="mb-0 consultationViewCard border-top-0">
               <CCardHeader class="px-2">
                  <h6>SOCIAL HISTORY: </h6>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CRow class="m-0">
                      <CCol md="4" class="px-2">
                        <div class="form-group">
                           <label>Occupation</label>
                          <p>{{getConsultationData.occupation}}</p>
                        </div>
                     </CCol>
                     <CCol md="4" class="px-2">
                        <div class="form-group">
                           <label>Marital status</label><br>
                           <p>{{getConsultationData.maritalStatus}}</p>
                        </div>
                     </CCol>
                     <CCol md="4" class="px-2">
                        <div class="form-group">
                           <label>Alcohol <small> oz/day/week</small></label>
                           <p>{{getConsultationData.alcohol}}</p>
                        </div>
                     </CCol>
                     <CCol md="4" class="px-2">
                        <div class="form-group">
                           <label>Athletic Activities</label>
                           <p>{{getConsultationData.athleticActivities}}</p>
                        </div>
                     </CCol>
                     <CCol md="4" class="px-2">
                        <div class="form-group">
                           <label>Tobacco</label>
                              <div class="d-flex align-items-center">
                                 <p>text</p>
                                 <span class="span_lable">pks/d for </span>
                                <p>text</p>
                                 <span class="span_lable">yrs</span>
                              </div>
                        </div>
                     </CCol>
                     
                      <CCol sm="12" md="12" class="px-2">
                        <div class="form-group">
                           <label>Additional Information</label>
                           <p><span v-html="getConsultationData.additionalInformation"></span></p>
                        </div>
                     </CCol>
                     
                     <CCol sm="12" md="12" class="px-2" v-if="type != 'Completed'">
                        <div class="form-group">
                           <label>Comment</label>
                          <span v-html="getConsultationData.comment"></span>
                        </div>
                     </CCol>

                      <CCol sm="12" md="12" class="px-2" v-else>
                        <div class="form-group">
                           <label>Comment</label>
                           <textarea class="form-control" rows="3" v-model="formData.comment"> </textarea>
                        </div>
                     </CCol>


                  </CRow>
               </CCardBody>
            </CCard>
         </CCol>

         <CCol sm="12" class="p-2" v-if="type =='Completed'">
         <div class="form-group mb-0 border-top pt-2 mt-3 text-right">
            <CButton size="sm" class="btn_custom" @click="submitFormData()">Submit</CButton>
            <CButton size="sm" color="light" @click="closeModal()">Close</CButton>
         </div>
         </CCol>
         <!-- <CCol sm="12" class="p-2">
         <div class="form-group mb-0 border-top pt-2 mt-3 text-right">
          
            <CButton size="sm" color="light" @click="closeModal()">Close</CButton>
         </div>
         </CCol> -->
      </CRow>
      </div>
    </CModal>

   <div class="row m-0 align-items-center paginationPanel">
        <div  class="col px-2"  v-if="result.data && result.data.length > 0 && result.total > 0"  >
            Showing {{ result.from }} to {{ result.to }} of
            {{ result.total }} Entries
        </div>
        <div  class="col-aut px-2" v-if="
                result.data &&
                result.data.length > 0 &&
                result.last_page > 1
            "
        >
           <paginate
                  :value="page"
                  :page-count="result.last_page"
                  :page-range="3"
                  :margin-pages="2"
                  :click-handler="paginateHandle"
                  :prev-text="'←'"
                  :next-text="'→'"
                  :container-class="'pagination'"
                  :page-class="'page-item'"
              >
              </paginate>
        </div>
    </div> 
  </div>
</template>

<script>
  import { mapGetters, mapActions } from "vuex";
  import Vue from "vue";
  import Vuex from "vuex";
  import Form from "vform";
  import Paginate from "vuejs-paginate";
  Vue.component("paginate", Paginate);
  import Swal from "sweetalert2";
  import { VueTabs, VTab } from "vue-nav-tabs";
  import "vue-nav-tabs/themes/vue-tabs.css";
  export default {
    components: {
      VueTabs,
      VTab,
    },
    data() {
      return {
        accordion: false,
        user_id: "",
        keyword: "",
        type:"Completed",
        disabled: false,
        position: "right bottom",
        modal_title: "Add User",
        tokenData: "",
        myModal: false,
        formMyModal:false,
         formData :new Form({  comment: "",type:'',bookingID:'', type:'comment'}),
         bookingID:"",
         tabID:0,
      };
    },

    created() {
      this.page;
    },
    computed: {
      page() {
        if (this.keyword == "") {
          var page = 1;
          if (this.$route.params.page != undefined) page = this.$route.params.page;
          this.bookingOrders({ page: page, keyword: this.keyword ,tabID:this.tabID});
          return Number(page) || 1;
        } else {
        }
      },

      ...mapGetters("Orders/Index", ["result", "returnData", "getPatientCondtionData","getConsultationData"]),
      ...mapGetters("auth", ["user"]),
      ...mapGetters("Appointment/Index", ["consaltionData"]),
    },
    methods: {
      ...mapActions("Orders/Index", ["bookingOrders", "updateStatus", "getPatientCondtion","getConsultation"]),
      ...mapActions("Appointment/Index", ["submitConsultationComment"]),
      paginateHandle(pageNum) {

        this.$router.push({ name: "paginate_orders", params: { page: pageNum } });
        this.bookingOrders({ page: pageNum, keyword: this.keyword,tabID:this.tabID });
      },

      handleTabChange(tabIndex, newTab, oldTab){
        this.tabID = tabIndex;
        this.bookingOrders({ page: 1, keyword: this.keyword,tabID:this.tabID });
        
      },

      searchData() {
        var page = 1;
        if (this.keyword.length >= 3) {
          if (this.$route.params.page != 1) this.$router.push({ name: "paginate_orders", params: { page: page } });
          this.bookingOrders({ page: page, keyword: this.keyword,tabID:this.tabID });
        } else {
          this.bookingOrders({ page: page, keyword: this.keyword,tabID:this.tabID });
        }
      },

      submitFormData(){
      this.formData.bookingID = this.bookingID;  
        this.submitConsultationComment(this.formData)
          .then(() => {
            this.formMyModal = false;
            this.bookingOrders({ page: 1, keyword: this.keyword,tabID:this.tabID });
          })
          .catch((error) => {
            window.scrollTo(0, 0);
            this.isActive = false;
          });

      },

      getCondtion(id) {
        this.getPatientCondtion(id).then(() => {
          // this.formData.keys().forEach((key) => {
          //     this.formData[key] = this.editData[key];
          // });
        });
      },

      getConsultationForm(bookingID,type){
        this.bookingID = bookingID;
        this.type = type;
         this.getConsultation(bookingID).then(() => {
          this.type = type;
          // this.formData.keys().forEach((key) => {
          //     this.formData[key] = this.editData[key];
          // });
        });
      },

      MultiAction(id, action) {
        if(action == 'Cancel'){
          var cancelButtonText ='Close';
          var conformbutton = 'Ok';

        } 
        else {
          var conformbutton = action;
          var cancelButtonText = 'Cancel';
        } 

        Swal.fire({
          title: "Are you sure",
          text: "Do you really want to " + action + " " + "This Orders!",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: conformbutton,
          confirmButtonColor: "#dd4b39",
          cancelButtonText: cancelButtonText,
          reverseButtons: true,
          icon: "warning",
        }).then((result) => {
          if (result.value) {
            this.updateStatus({ id: id, action: action }).then(() => {
              if (this.returnData.status == "success") {
                Vue.$toast.open({
                  message: this.returnData.message,
                  type: this.returnData.status,
                });
                this.myModal = false;
                this.bookingOrders({ page: this.result.current_page,tabID:this.tabID });
              }
            });
          }
        });
      },
    },
  };
</script>
<style type="text/css">
  .medi_his ul{
    display: flex;
    flex-wrap: wrap;
    margin-left: 12px;
  }

   .consultationViewCard ul li{
    width: 23%;
    /*display: inline-block;*/
    margin: 2px 0.5%;
    list-style: disc;
  }

  .consultationViewCard label{
    font-weight: 600;
  }

  .consultationViewCard p {
    margin: 0;
    text-align: justify;
}
.consultationViewCard table tr td {
  border-color: #8d8d8d !important;
    padding: 4px 6px !important;
}

.consultationViewCard header.card-header h6 {
    border-bottom: 1px solid #333;
    margin-bottom: 6px;
    padding:6px 4px 8px;
    margin-top: 6px;
    font-size: 16px;
}

.consultationViewCard header.card-header {
    border-bottom: 0;
}


</style>