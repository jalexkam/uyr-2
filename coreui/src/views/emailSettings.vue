<template>
  <div class="master_sections">
    <CRow class="m-0">
      <CCol sm="12" class="p-2">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Email Settings</h5>
          <div class="d-flex">
            <!-- <CButton class="btn_custom" type="button">Save & Update</CButton> -->
          </div>
        </div>
      </CCol>
    </CRow>
    <CRow class="m-0">
      <CCol md="9" class="px-2 pb-2 mx-auto">
        <CCard>
          <CCardBody class="py-3 px-2">
            <!--  <CRow class="mx-0 mb-2">
                    <CCol sm="12" class="px-2">
                      <div class="form-group">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="mailoption" id="phpmail" value="option1" checked="">
                          <label class="form-check-label" for="phpmail">PHP Mail</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="mailoption" id="smtpmail" value="option2">
                          <label class="form-check-label" for="smtpmail">SMTP</label>
                        </div>
                      </div>
                    </CCol>
                </CRow> -->
                <CForm method="POST">
              <CRow class="mx-0 mb-4">
                <CCol sm="12" class="px-2">
                  <h5 class="mb-3">SMTP Info Email Settings</h5>
                </CCol>
                <CCol sm="6" class="px-2">
                  <div class="form-group">
                    <label>SMTP HOST</label>
                    <input type="text" name="" class="form-control" v-model="formData.smtpHost" />
                  </div>
                </CCol>
                <CCol sm="6" class="px-2">
                  <div class="form-group">
                    <label>SMTP USER NAME</label>
                    <input type="text" name="" class="form-control" v-model="formData.smtpUser" />
                  </div>
                </CCol>
                <CCol sm="6" class="px-2">
                  <div class="form-group">
                    <label>SMTP PASSWORD</label>
                    <input type="text" name="" class="form-control" v-model="formData.smtpPassword" />
                  </div>
                </CCol> 
                <CCol sm="6" class="px-2">
                  <div class="form-group">
                    <label>SMTP PORT</label>
                    <input type="text" name="" class="form-control" v-model="formData.smtpPort" />
                  </div>
                </CCol>
                <CCol sm="6" class="px-2">
                  <div class="form-group">
                    <label>From Address</label>
                    <input type="text" name="" class="form-control" v-model="formData.smtpFromAddress" />
                  </div>
                </CCol>
                <CCol sm="6" class="px-2">
                  <div class="form-group">
                    <label>From Name</label>
                    <input type="text" name="" class="form-control" v-model="formData.smtpFromName" />
                  </div>
                </CCol>                
                <!-- <CCol sm="6" class="px-2">
                  <div class="form-group">
                    <label>SMTP DRIVER</label>
                    <input type="text" name="" class="form-control" v-model="formData.smtpDriver" />
                  </div>
                </CCol>        -->
                <CCol sm="6" class="px-2">
                  <div class="form-group custome_select">
                    <label>SMTP Security</label>
                    <select required class="form-control" v-model="formData.smtpEncryption">
                      <option value="" disabled selected hidden>-Select Security Type-</option>
                      <option value="none">None</option>
                      <option value="ssl">SSL</option>
                      <option value="tls">TLS</option>
                    </select>
                  </div>
                </CCol>
                <!-- <CCol sm="6" class="px-2">
                  <div class="form-group">
                    <label>SMTP Sendmail</label>
                    <input type="text" name="" class="form-control" v-model="formData.smtpSendmail" />
                  </div>
                </CCol><CCol sm="6" class="px-2">
                  <div class="form-group">
                    <label>SMTP Pretend</label>
                    <input type="text" name="" class="form-control" v-model="formData.smtpPretend" />
                  </div>
                </CCol> -->
                <!-- <CCol sm="6" class="px-2">
                  <div class="form-group">
                    <label>SMTP Authentication Domain</label>
                    <input type="email" name="" class="form-control" />
                  </div>
                </CCol> -->
              </CRow>
            </CForm>
            <CRow class="mx-0 mt-3">
              <CCol sm="12" class="px-2 text-center">
                <CButton class="btn_custom px-4"  @click="submitFormData">Update Settings</CButton>
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
  import Vue from "vue";
  import Vuex from "vuex";
  import Form from "vform";
  

  export default {
    components: {
    },
    data() {
      return {
         id: 0,
         keyword: "",
         label: "Add",
         formData: new Form({ 
                              id:'',
                              type:'info',
                              smtpHost:'',
                              smtpUser:'',
                              smtpPassword:'',
                              smtpPort:'',
                              smtpDriver:'',
                              smtpEncryption:'',
                              smtpSendmail:'',
                              smtpPretend:'',
                              smtpFromAddress:'',
                              smtpFromName:'',
                           }),
                            
        };
    },

    created() {
      this.page;
      this.getFormData();
    },

    computed: {  
      ...mapGetters("EmailSettings/Index", ["editData", "returnData", "ajax_error"]),
    },
    methods: {
      ...mapActions("EmailSettings/Index", ["edit", "submitForm"]),

      submitFormData() {
        // var formdata = '';
        // if(type == 'info'){
        //   formdata = this.formData;
        // }else{
        //   formdata = this.formSupport;;
        // }

        this.submitForm(this.formData).then(() => {
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
        this.edit().then(() => {
          this.formData.keys().forEach((key) => {
                    this.formData[key] = this.editData[key];
                });
          // if(this.editData.info && this.editData.info != ''){
          //   this.formInfo = this.editData.info;
          // }
          // if(this.editData.support && this.editData.support != ''){
          //   this.formSupport = this.editData.support;
          // }
        });
      },

      

      


    },
  };
</script>

<style>
.custome_select select:required:invalid {
  color: gray !important;
}

.custome_select option[value=""][disabled] {
  display: none !important;
}

.custome_select option {
  color: black !important;
}
</style>