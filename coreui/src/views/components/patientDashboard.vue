<template>

   <div>
   
    <CRow class="m-0">
      

        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow warning mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="user-circle-o" size="1" class="mr-2"></vue-fontawesome>Total Patients</h6>
                    <h4 class="mb-1">12</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>12</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>0</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol>
        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow danger mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="thermometer-three-quarters" size="1" class="mr-2"></vue-fontawesome>Total Appointment</h6>
                    <h4 class="mb-1">430</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>9</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>419</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol>

        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow success mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="tasks" size="1" class="mr-2"></vue-fontawesome>Reject Appointment</h6>
                    <h4 class="mb-1">11</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>11</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>0</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol>

     
        <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow warning mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="tasks" size="1" class="mr-2"></vue-fontawesome>Upcoming Appointment </h6>
                    <h4 class="mb-1">11</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Active</p>
                      <span>11</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">In-Active</p>
                      <span>0</span>
                    </div>
                </div>
              </CCardBody>  
            </CCard>
        </CCol>

         <CCol lg="3" sm="6" class="px-2">
            <CCard class="py-2 px-3 dcard_shadow warning mb-3">
              <CCardBody class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="text-center w-100 m-2">
                    <h6 class="mb-2 text-muted"><vue-fontawesome icon="user-circle-o" size="1" class="mr-2"></vue-fontawesome>Visit Type</h6>
                    <h4 class="mb-1">12</h4>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="d_small text-center active">
                      <p class="m-0">Home Visit</p>
                      <span>12</span>
                    </div>
                    <div class="d_small text-center inactive">
                      <p class="m-0">Clinic Visit</p>
                      <span>0</span>
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
export default {
    data() {
        return {
           
        };
    },

  created() {
   
    
  },
    computed: {
   
  },

 
  methods: {
  
  }
}
</script>


