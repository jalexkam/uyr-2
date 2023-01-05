 <template>
 <div class="medical_report">
        <CRow class="m-0">
          <CCol sm="12" class="p-2">
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
                           <label>Have you ever had or do you have now a problem with :</label><br>
                             
                           <div class="form-check form-check-inline" v-if="medicalhistoryData && medicalhistoryData.medicalhistory" v-for="(row, index) in medicalhistoryData.medicalhistory" :key="index">
                              <input class="form-check-input" type="checkbox" id="inlineCheckbox1" :value="index" v-model="formData.medicalHistory">
                              <label class="form-check-label" for="inlineCheckbox1">{{index}} </label>
                           </div>
                        </div>
                     </CCol>
                     <CCol md="12" class="px-2">
                        <div class="form-group">
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" id="inlineCheckbox41" value="Yes" v-model="formData.noneof">
                              <label class="form-check-label" for="inlineCheckbox41">If none of the above applies, check here: </label>
                           </div>
                        </div>
                     </CCol>
                     <CCol md="12" class="px-2">
                        <div class="form-group">
                           <label> Describe the situation below:</label>
                           <textarea class="form-control" rows="3" v-model="formData.describeSituation"></textarea>
                        </div>
                     </CCol>
                     <CCol md="12" class="px-2">
                        <div class="form-group">
                           <label>Describe answers above with dates: </label>
                           <textarea class="form-control" rows="3" v-model="formData.describeAnswers"></textarea>
                        </div>
                     </CCol>  

                     <CCol md="12" class="px-2">
                        <div class="form-group">
                           <label>PAST MEDICAL HISTORY: </label>
                           <textarea class="form-control" rows="3" v-model="formData.pastHistory"></textarea>
                        </div>
                     </CCol> 
                     <CCol md="12" class="px-2 form-group">
                         <label >Current Medication List: </label>
                         <table class="table table-borderless" >
                              <tbody>
                                <tr class="m-0" v-for="(item, index) in items" :key="index">
                                    <td>
                                       <input type="text" class="form-control" name="" v-model="item.medication">
                                     </td>
                                    <td width="120">
                                    <a class="btn btn-success text-white" v-on:click="addItem"  v-if="items.length - 1 <= index"  >Add More</a>
                                     <CButton size="sm" color="" class="btn-outline-danger" title="Delete" v-on:click="removeItem(index);" v-if="(items.length - 1 >= index) && (items.length -1 != index)" >
                                    <vue-fontawesome icon="trash" size="0.8"></vue-fontawesome>
                                    </CButton>
                                    </td>
                                </tr>     
                              </tbody>
                           </table>
                     </CCol>
                  </CRow>
               </CCardBody>
            </CCard>
            
          
            <CCard class="mb-0">
               <CCardHeader class="p-2 px-3 bg_themes">
                  <div>
                     <strong>SOCIAL HISTORY: </strong>
                  </div>
               </CCardHeader>
               <CCardBody class="px-1 py-2">
                  <CRow class="m-0">
                      <CCol md="4" class="px-2">
                        <div class="form-group">
                           <label>Occupation</label>
                           <input type="text" class="form-control" name="" v-model="formData.occupation">
                        </div>
                     </CCol>
                     <CCol md="4" class="px-2">
                        <div class="form-group">
                           <label>Marital status</label><br>
                           <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="customRadioInlineg1" name="customRadioInlineg1" value="Single" class="custom-control-input" v-model="formData.maritalStatus">
                              <label class="custom-control-label" for="customRadioInlineg1">Single</label>
                           </div>
                           <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="customRadioInlineg2" name="customRadioInlineg1" value="Married" class="custom-control-input"
                              v-model="formData.maritalStatus">
                              <label class="custom-control-label" for="customRadioInlineg2">Married</label>
                           </div>
                        </div>
                     </CCol>
                     <CCol md="4" class="px-2">
                        <div class="form-group">
                           <label>Alcohol <small> oz/day/week</small></label>
                           <input type="text" class="form-control" name="" v-model="formData.alcohol">
                        </div>
                     </CCol>
                     <CCol md="4" class="px-2">
                        <div class="form-group">
                           <label>Athletic Activities</label>
                           <input type="text" class="form-control" name="" v-model="formData.athleticActivities">
                        </div>
                     </CCol>
                     <CCol md="4" class="px-2">
                        <div class="form-group">
                           <label>Tobacco</label>
                              <div class="d-flex align-items-center">
                                 <input type="text" class="form-control" name="">
                                 <span class="span_lable">pks/d for </span>
                                 <input type="text" class="form-control" name="" v-model="formData.tobacco">
                                 <span class="span_lable">yrs</span>
                              </div>
                        </div>
                     </CCol>
                     
                      <CCol sm="12" md="12" class="px-2">
                        <div class="form-group">
                           <label>Additional Information</label>
                           <textarea class="form-control" rows="3"  v-model="formData.additionalInformation"> </textarea>
                        </div>
                     </CCol>
                  </CRow>
               </CCardBody>
            </CCard>
         </CCol>
         <CCol sm="12" class="p-2">
         <div class="form-group mb-0 border-top pt-2 mt-3 text-right">
            <CButton size="sm" class="btn_custom" @click="submitFormData()">Submit</CButton>
            <CButton size="sm" color="light" @click="closeModal()">Close</CButton>
         </div>
         </CCol>
      </CRow>
      </div>
      </template>

<script>
import { mapGetters, mapActions } from "vuex";
import Vue from 'vue';
import Vuex from 'vuex';
import Form from "vform";
 export default{
   props: ['appointmentID'],

       data() {
        return {
            myModal: false,
            appointmentid:this.appointmentID,
            formData :new Form({  id: "",medicalHistory:[],noneof:'',describeSituation:'',describeAnswers:'',pastHistory:'',occupation:'',maritalStatus:'',alcohol:'',athleticActivities:'',tobacco:'',additionalInformation:'',medication:[],type:'Consultation'}),
            items: [{ medication: '' } ]
        };
    },

     created() {
       this.getMedicalHistory();
     },

   computed: {
   ...mapGetters("Appointment/Index", ["medicalhistoryData","consaltionData"]),
  },


     methods: {
        ...mapActions("Appointment/Index", ["getMedicalHistory","submitConsultationForm"]),

     submitFormData(){
      this.formData.appointmentID =  this.appointmentID;

      this.formData.medication =this.items;

        this.submitConsultationForm(this.formData)
          .then(() => {

            this.$emit('closeModal',false);
          // this.closeModal();
            // if (this.returnData.status == "success") {
            //   this.$router.push({ name: "doctor" });
            //   this.isActive = false;
            //   Vue.$toast.open({
            //     message: this.returnData.message,
            //     type: this.returnData.status,
            //   });
            // }
          })
          .catch((error) => {
            window.scrollTo(0, 0);
            this.isActive = false;
          });
        },

         closeModal(){
            this.myModal = false;
         },

         addItem: function() {
            this.items.push({
              medication: ''
            });
         },
         removeItem: function(index) {
           this.items.splice(index, 1);
         }

      }
   }
  
</script>