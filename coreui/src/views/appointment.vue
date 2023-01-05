<template>
  <CCol md="9" class="px-2">
    <CCard class="mb-2">
      <CCardHeader class="bg_themes text-black p-2">
        <strong>Manage Appointment Slot</strong>
      </CCardHeader>
      <CCardBody class="px-1 py-2">
        <CForm method="POST">
          <CRow class="m-0">
            <CCol sm="12" lg="8" md="9" class="px-1 mx-auto">            
              <table class="table table-borderless appointment_table">
                <thead>
                  <tr>
                    <th>Day</th>
                    <th>From Time</th>
                    <th>To Time</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- {{formData.id}} -->
                  <!-- {{editData.slotArray[0].Sunday}} -->
                  <!-- {{formData}} -->
                  <tr v-if="editData.weekArray" v-for="(row, index) in editData.weekArray" :key="index">
                    <td >
                      <h6>{{row}}</h6>
                    </td>
                    <td>
                      <date-picker v-if="formData[row]" v-model="formData[row].startTime" type="time" format="HH:mm" color="#2c449e" :clearable="true" :roundMinute="true" placeholder="Select From Time"></date-picker>
                    </td>
                    <td>
                      <date-picker v-if="formData[row]" v-model="formData[row].endTime" type="time" format="HH:mm" color="#2c449e" :clearable="true" :roundMinute="true" placeholder="Select To Time"></date-picker>
                    </td>
                  </tr>
                  <!-- <tr>
                    <td><h6>Tuesday</h6></td>
                    <td>
                      <date-picker v-model="formData.startTime.tuesdayStartTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                    <td>
                      <date-picker v-model="formData.endTime.tuesdayEndTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                  </tr>
                  <tr>
                    <td><h6>Wednesday</h6></td>
                    <td>
                      <date-picker v-model="formData.startTime.wednesdayStartTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                    <td>
                      <date-picker v-model="formData.endTime.wednesdayEndTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                  </tr>
                  <tr>
                    <td><h6>Thursday</h6></td>
                    <td>
                      <date-picker v-model="formData.startTime.thursdayStartTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                    <td>
                      <date-picker v-model="formData.endTime.thursdayEndTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                  </tr>
                  <tr>
                    <td><h6>Friday</h6></td>
                    <td>
                      <date-picker v-model="formData.startTime.fridayStartTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                    <td>
                      <date-picker v-model="formData.endTime.fridayEndTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                  </tr>
                  <tr>
                    <td><h6>Saturday</h6></td>
                    <td>
                      <date-picker v-model="formData.startTime.saturdayStartTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                    <td>
                      <date-picker v-model="formData.endTime.saturdayEndTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                  </tr>
                  <tr>
                    <td><h6>Sunday</h6></td>
                    <td>
                      <date-picker v-model="formData.startTime.sundayStartTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                    <td>
                      <date-picker v-model="formData.endTime.sundayEndTime" type="time" format="HH:MM" color="#2c449e" placeholder="Select a Time"></date-picker>
                    </td>
                  </tr> -->
                </tbody>
              </table>
              <div class="text-center mt-3">
                <CButton class="btn_custom px-4"  @click="submitFormData()">Update</CButton>
              </div>
            </CCol>
          </CRow>
        </CForm>
            <!-- <CRow class="mx-0 mt-3">
              <CCol sm="12" class="px-2">
              </CCol>
            </CRow> -->
      </CCardBody>
    </CCard>    
  </CCol>
</template>
<script>
  import { mapGetters, mapActions } from "vuex";
  import Vue from "vue";
  import Vuex from "vuex";
  import Form from "vform";
  import VueDatetimePickerJs from "vue-date-time-picker-js";
  import { VueTabs, VTab } from "vue-nav-tabs";
  import "vue-nav-tabs/themes/vue-tabs.css";

  export default {
    name: "appointment",

    components: {
      VueTabs,
      VTab,
      datePicker: VueDatetimePickerJs,
    },

    data() {
      return {
        
        formData: new Form({ 
          id: "",
          user_id:"",    
          Sunday:{ startTime:'', endTime:'' },
          Monday:{ startTime:'', endTime:'' },
          Tuesday:{ startTime:'', endTime:'' },
          Wednesday:{ startTime:'', endTime:'' },
          Thursday:{ startTime:'', endTime:'' },
          Friday:{ startTime:'', endTime:'' },
          Saturday:{ startTime:'', endTime:'' },
        }),
      };
    },

    created() {
      this.getFormData();
    },

     computed: {  
      ...mapGetters('SiteSettings/Index', ["returnData","editData","ajax_error"]),
      ...mapGetters('auth', ['user']),
      ...mapGetters({ user: 'auth/user' }),
    },

    methods: {
      ...mapActions('SiteSettings/Index', ["submitForm","getAppointmentSlot","submitTimeSlotForm"]),

      submitFormData() {
        this.formData.user_id = this.user.id
        this.submitTimeSlotForm(this.formData).then(() => {
            if (this.returnData.status == "success") {
              Vue.$toast.open({
                message: this.returnData.message,
                type: this.returnData.status,
              });
              this.getFormData();
            }
          })
          .catch((error) => {
            window.scrollTo(0, 0);
          });
      },

      getFormData() {        
        this.getAppointmentSlot().then(() => {
          this.formData.keys().forEach((key) => {
            // console.log(this.editData.slotArray[0]);
              // if(this.editData.slotArray){
              //   this.formData[key] = this.editData.slotArray[key];
              // }
              if(this.editData && this.editData.slotArray !=''){
                this.formData.Sunday = this.editData.slotArray[0].Sunday;
                this.formData.Monday = this.editData.slotArray[1].Monday;
                this.formData.Tuesday = this.editData.slotArray[2].Tuesday;
                this.formData.Wednesday = this.editData.slotArray[3].Wednesday;
                this.formData.Thursday = this.editData.slotArray[4].Thursday;
                this.formData.Friday = this.editData.slotArray[5].Friday;
                this.formData.Saturday = this.editData.slotArray[6].Saturday;
              }

              // if(this.editData.slotArray[0].Sunday){
              //   this.formData.Sunday = this.editData.slotArray[0].Sunday;
              // }
              // if(this.editData.slotArray[0].Monday){
              //   this.formData.Monday = this.editData.slotArray[1].Monday;
              // }
              // if(this.editData.slotArray[0].Tuesday){
              //   this.formData.Tuesday = this.editData.slotArray[2].Tuesday;
              // }
              // if(this.editData.slotArray[0].Wednesday){
              //   this.formData.Wednesday = this.editData.slotArray[3].Wednesday;
              // }
              // if(this.editData.slotArray[0].Thursday){
              //   this.formData.Thursday = this.editData.slotArray[4].Thursday;
              // }
              // if(this.editData.slotArray[0].Friday){
              //   this.formData.Friday = this.editData.slotArray[5].Friday;
              // }
              // if(this.editData.slotArray[0].Saturday){
              //   this.formData.Saturday = this.editData.slotArray[6].Saturday;
              // }
            });      
            // this.formData.user_id = this.editData.user_id;
         });
      },
    
    
    
    
    }
    
  };
</script>

<style type="text/css">
  table.appointment_table tr td,
  table.appointment_table tr th {
    padding: 8px 10px;
  }

  table.table.table-borderless.appointment_table tr th {
    border-bottom: 2px solid #2c449e;
    background: none;
    color: #505050;
  }
</style>
