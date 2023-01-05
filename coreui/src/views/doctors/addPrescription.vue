 <template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">
                  Patient 
                  <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>
                  Add Prescription
               </h5>
               <div class="">
                     <CButton size="sm" class="btn_custom" @click="addPrescription" >Save</CButton>
                     <router-link :to="{ name: 'doctor_appointment_patient_view' ,params: { id: appointment_id }}">
                     <CButton color="light">Back</CButton>
                  </router-link>
               </div>
            </div>
         </CCol>
         <CCol sm="9" class="px-2 mx-auto">
            <CCard>
               <CCardBody class="p-3">
                  <CRow class="mx-0">
                     <CCol md="6" class="px-2">
                        <div class="dr_infom">
                           <img src="images/uyr_logo.png" width="120px">
                        </div>
                     </CCol>
                      <CCol md="6" class="px-2 mt-3 text-right">
                        <div class="dr_infom">
                           <span>{{doctorPatientData.date}}</span>
                           <span>#INV001</span>
                        </div>
                     </CCol>
                     <CCol md="6" class="px-2 mt-3">
                        <div class="dr_infom">
                           <h4>Docotor Info</h4>
                           <span>Dr.{{doctorPatientData.doctorName}}</span>
                           <span>{{doctorPatientData.Speciality}}</span>
                           <span>{{doctorPatientData.doctorAddress}}</span>
                        </div>
                     </CCol>
                     <CCol md="6" class="px-2 mt-3 text-right">
                        <div class="dr_infom">
                           <h4>Patient Info</h4>
                           <span>{{doctorPatientData.patientName}}</span>
                           <span>{{doctorPatientData.patientAddress}}</span>
                        </div>
                     </CCol>                    
                     <CCol md="12" class="px-2">
                        <div class="Prescription_table">
                           <table class="table">
                              <thead>
                                 <tr>
                                    <th>Name</th>
                                    <th width="150">Quantity</th>
                                    <th width="150">Days</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                  <tr v-for="(item, index) in items">
                                   <td>
                                       <input type="text" id="title" class="form-control" v-model="item.title">
                                   </td>
                                    <td>
                                       <input type="number" class="form-control" v-model="item.qty">
                                    </td>
                                    <td>
                                       <input type="number" class="form-control" v-model="item.days">
                                    </td>
                                    <td>
                                       <div class="d-flex align-items-center">
                                       <div class="Prescription_checkbox">
                                          <input type="checkbox" name="morning" :id="'morning'+index" v-model="item.morning">
                                          <label :for="'morning'+index">Morning</label>
                                       </div>
                                       <div class="Prescription_checkbox">
                                          <input type="checkbox" name="afternoon" :id="'afternoon'+index" v-model="item.afternoon">
                                          <label :for="'afternoon'+index">Afternoon</label>
                                       </div>
                                       <div class="Prescription_checkbox">
                                          <input type="checkbox" name="evening" :id="'evening'+index" v-model="item.evening">
                                          <label :for="'evening'+index">Evening</label>
                                       </div>
                                       <div class="Prescription_checkbox">
                                          <input type="checkbox" name="night" :id="'night'+index" v-model="item.night">
                                          <label :for="'night'+index">Night</label>
                                       </div>
                                    </div>
                                    </td>
                                       <td>
                                       <a class="btn btn-success" v-on:click="addItem" 
                                       v-if="items.length - 1 <= index" 
                                       v-bind:class="{ disabled: item.title.length === 0 || item.qty.length == 0 || item.days.length == 0 }">Add More</a>

                                         <CButton size="sm" color="" class="btn-outline-danger" title="Delete" v-on:click="removeItem(index);" v-if="(items.length - 1 >= index) && (items.length -1 != index)" >
                                          <vue-fontawesome icon="trash" size="0.8"></vue-fontawesome>
                                       </CButton>
                                     </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="doctor_signature">
                           </br><br> <br>
                           <p class="mb-0">Dr. {{doctorPatientData.doctorName}}</p>    
                           <span>{{doctorPatientData.Speciality}}</span>                          
                        </div>
                     </CCol>
                  </CRow>
               </CCardBody>
            </CCard>
         </CCol>
      </CRow>
   </div>
</template>
<script>
   import { mapGetters, mapActions } from "vuex";
   import Vue from 'vue'
   import Form from "vform";
   import Swal from 'sweetalert2';
   
   export default{
         data() {
            return {
               doctorPatientData:[],
               appointment_id:"",
                items: [
                     {
                       title: '',
                       qty: '',
                       days:'',
                       morning:'',
                       afternoon:'',
                       evening:'',
                       night:'',
                     }
                   ]
            };
         },

    created() {
          if(this.$route.params.id != '' && this.$route.params.id != undefined){
             this.getPatientDoctorinfo(this.$route.params.id);
             this.appointment_id = this.$route.params.id;
          }
       },

       computed: {
            ...mapGetters("Doctor/Index", ["result","returnData","PatientDoctor"]),
        },

         methods: {
             ...mapActions("Doctor/Index", ["getPatientDoctorinfoAppointment","submitPrescriptionForm"]),
             getPatientDoctorinfo(id) {
                this.getPatientDoctorinfoAppointment(id).then(() => {
                 this.doctorPatientData =  this.PatientDoctor.doctorPatientData;
                
               });
              },

               addPrescription() {
                  if(this.items[0].title !='' && this.items[0].qty !='' && this.items[0].days !=''){
                  let newData  =  new FormData();
                  newData.append('formData',JSON.stringify(this.items))
                  this.submitPrescriptionForm({newData:newData,appointment_id:this.appointment_id}).then(()=> {
                     if(this.returnData.status =='success'){
                       Vue.$toast.open({
                               message: this.returnData.message,
                               type: this.returnData.status,
                           });
                        this.$router.push({ name: 'doctor_appointment_patient_view', params: { id: this.appointment_id } });
                     }
                  }) 
                 .catch(error => {
                 });
                  }else{
                     Vue.$toast.open({
                         message: "Please Update data!",
                         type: 'error',
                         duration: 5000,
                         dismissible: true
                       });
                  }

               },


             addItem: function() {
               this.items.push({
                 title: '',
                 qty:'',
                 days:'',
                 morning:'',
                 afternoon:'',
                 evening:'',
                 night:'',
               });
             },
             removeItem: function(index) {
               this.items.splice(index, 1);
             }
           }
   }
   
</script>
