<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Contact Us Information</h5>
                   <CButton class="btn_custom" type="button" @click="submitFormData()">Submit</CButton>
              </div>
         </CCol>
       </CRow>
      <CRow class="m-0">
         <CCol md="9" class="px-2 pb-2">
            <CCard>
              <CCardBody>
                  <div class="">
                     <table class="table table-striped table-hover">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Email</th>
                              <th>Contact No</th>
                              <th>Address</th>
                               <th>Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody v-if="result.data && result.data.length > 0 && result.total > 0">
                           <tr class="mb-2 card-shadow" v-if="result.data" v-for="(row, index) in result.data" :key="'row'+index">
                            <td>{{result.from + index}}</td>
                            <td>{{row.email}}</td>
                            <td>{{row.contactno}}</td>
                            <td>{{row.address}}</td>
                            <td> <div v-if="row.isactive == 1" class="text-success border-success px-2 d-inline-block" >Active</div>
                               <div v-else  class="text-danger border-danger px-2 d-inline-block">Inactive</div>
                            </td>
                              <td>
                                 <CButtonGroup size="sm">
                                       <CButton size="sm" color="" class="btn-outline-warning"  v-c-tooltip.hover="{content: `Edit`}" 
                                       @click="getFormData(row.id)">
                                        <vue-fontawesome icon="pencil" size="0.8"></vue-fontawesome>                                     
                                    </CButton>
                                    <CButton size="sm" @click="MultiAction(row.id, 'Delete')" color="" class="btn-outline-danger"  v-c-tooltip.hover="{content: `Remove`}">
                                        <vue-fontawesome icon="trash" size="0.8"></vue-fontawesome>                             
                                    </CButton>
                                    
                                  </CButtonGroup>
                              </td>
                           </tr>
                           <tr v-if="result.data==''">
                              <td colspan="14" align="center" class="p-3">
                                 <h6 class="mb-0" >
                                    <strong>No data found!</strong>
                                 </h6>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </CCardBody>
            </CCard>
         </CCol>

         <CCol md="3" class="px-2">
          <CCard>
            <CCardHeader class="p-2 px-3 bg_themes">
              <h6 class="mb-0">{{label}} Contact Us</h6>
            </CCardHeader>
            <CCardBody class="p-2">
          <CForm method="POST">
                           <div class="form-group">
                              <label>Email<span class="text-danger">*</span></label>
                            
                               
                          <CInput placeholder="" v-model="formData.email"/>
                                 <small class="text-danger" v-if="ajax_error.errors.email">{{ ajax_error.errors.email[0] }}</small>
                           </div>
                           <div class="form-group">                        
                               <label>Contact No<span class="text-danger">*</span></label>
                              
                               <CInput placeholder="" v-model="formData.contactno"/>
                                 <small class="text-danger" v-if="ajax_error.errors.contactno">{{ ajax_error.errors.contactno[0] }}</small>
                          </div>

                          <div class="form-group">                        
                               <label>Address<span class="text-danger"></span></label>
                                  <textarea class="form-control" v-model="formData.address"></textarea>
                                 <small class="text-danger" v-if="ajax_error.errors.address">{{ ajax_error.errors.address[0] }}</small>
                          </div>

                         

                          <div class="form-group">                        
                              <label>Status </label><br>
                              <select class="form-control" v-model="formData.isactive">
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>                                
                              </select>
                          </div>
                          

                  </CForm>
                </CCardBody>
              </CCard>
        </CCol>

      </CRow>
   <pagination :page="page" @paginateHandle="paginateHandle" :result="result"></pagination>

   </div>   
</template>

<script>
    import { mapGetters, mapActions } from "vuex";
    import Vue from 'vue';
    import Vuex from 'vuex';
    import Form from "vform";
    import pagination from "./../components/pagination"
    import Swal from 'sweetalert2';
   export default {
       components: {
         pagination
       },
         data () {
            return {
            id         : 0,
            keyword    : '',
            label      : 'Add',
            formData     : new Form({ id: "",email:'',contactno: '',isactive:0,address:''}),
            }
         },
     
     created() {
      this.page;
       
     },
     computed: {
      page() {
            if (this.keyword == '') {
                var page = 1;
                if (this.$route.params.page != undefined) page = this.$route.params.page;
                this.list({ page: page, keyword: this.keyword });
                return Number(page) || 1;
            } else {
            }
        },
    
       ...mapGetters("ManageWebsite/ContactUsDetails", ["result","editData","returnData","ajax_error","returnData"]),
     },
     methods: {
     
       ...mapActions("ManageWebsite/ContactUsDetails", ["list","edit","submitForm","UpdateMultiAction","getContactUsForm"]),

       paginateHandle(pageNum) {
            this.list({ page: pageNum,'keyword': this.keyword});
        },
      

      MultiAction(id, action) {
            Swal.fire({
                title: 'Are you sure',
                text: 'Do you really want to ' + action + ' ' + 'This record',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: action,
                confirmButtonColor: '#dd4b39',
                cancelButtonText: 'Cancel',
                icon:'warning',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    this.UpdateMultiAction({ id: id, action: action }).then(() => {
                        if (this.returnData.status == 'success') {
                              Vue.$toast.open({
                                   message: this.returnData.message,
                                   type: this.returnData.status,
                               });
                            this.list({ page: this.result.current_page });
                        }
                    });
                }
            });
        },


   submitFormData() {

     if(this.formData.email =='') {
         Vue.$toast.open({
             message: "Please Insert ContactUs!",
             type: 'error',
             duration: 5000,
             dismissible: true
           });
     }else{
   
     this.submitForm(this.formData).then(() => {
       if (this.returnData.status == 'success') {
         Vue.$toast.open({
                   message: this.returnData.message,
                   type: this.returnData.status,
               });

        this.list({ page: 1, keyword: this.keyword }); 
            //this.$router.push({name:"master_services"});
                this.label = 'Add';
                this.formData.email =''; 
                this.formData.contactno =''; 
                this.formData.isactive =0; 
                this.formData.address = '';
        } 
     })
     .catch(error => {
        window.scrollTo(0,0);      
     });
     }
    },
      getFormData(id) {
            this.user_id = id;
            this.label ='Edit';
            this.edit(id).then(() => {
                this.formData.keys().forEach((key) => {
                    this.formData[key] = this.editData[key];
                });
            });
            this.ajax_error.errors = [];
        },
    }
   }
</script>