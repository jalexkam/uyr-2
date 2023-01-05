<template>
   <div>
     <!--  <CRow class="m-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Types</h5>
               <data></data>
               <div class="search_box">
                     <input type="search" v-model="keyword" @keyup="searchData" placeholder="Search..." class="form-control" name="">
                     <CButton><vue-fontawesome icon="search" class="mr-1" size="0.9"></vue-fontawesome></CButton>
                  </div>
                   <CButton class="btn_custom" type="button" @click="submitFormData()">Submit</CButton>
              </div>
         </CCol>
       </CRow> -->
      <CRow class="m-0">
         <CCol md="9" class="px-2 pb-2">
           <div class="d-flex justify-content-between align-items-center py-2">
               <h5 class="mb-0">Types</h5>
               <div class="search_box mr-0">
                     <input type="search" v-model="keyword" @keyup="searchData" placeholder="Search..." class="form-control" name="">
                     <CButton><vue-fontawesome icon="search" class="mr-1" size="0.9"></vue-fontawesome></CButton>
                  </div>
              </div>
            <CCard>
              <CCardBody>
                  <div class="">
                     <table class="table table-striped table-hover">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Type Name</th>
                              <th class="text-center">Status</th>
                              <th width="30">Action</th>
                           </tr>
                        </thead>
                        <tbody v-if="result.data && result.data.length > 0 && result.total > 0">
                           <tr class="mb-2 card-shadow" v-if="result.data" v-for="(row, index) in result.data" :key="'row'+index">
                            <td>{{result.from + index}}</td>

                            <td v-if="row.type_name">{{row.type_name}}</td>
                            <td v-else></td>
                             <td class="text-center" align="center">
                                
                                  <div v-if="row.isactive == 1" class="text-success border-success px-2 d-inline-block" >Active</div>
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
                        </tbody>
                        <tbody v-else>
                            <tr>
                              <td colspan="8" align="center" class="p-3">
                                <h6 class="m-0">Data Not Found !</h6>
                                </td>
                            </tr>
                        </tbody>
                     </table>
                  </div>
               </CCardBody>
            </CCard>
            <pagination :page="page" @paginateHandle="paginateHandle" :result="result"></pagination>
         </CCol>

         <CCol md="3" class="px-2">
            <div class="py-2 text-right">
               <CButton class="btn_custom" type="button" @click="submitFormData()">Submit</CButton>
            </div>

          <CCard>
            <CCardHeader class="p-2 px-3 bg_themes">
              <h6 class="mb-0">{{label}} Types</h6>
            </CCardHeader>
            <CCardBody class="p-2">
          <CForm method="POST">
                           <div class="form-group">
                              <label>Types Name<span class="text-danger">*</span></label>
                              <CInput placeholder="" v-model="formData.type_name"/>
                                 <small class="text-danger" v-if="ajax_error.errors.type_name">{{ ajax_error.errors.type_name[0] }}</small>
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
            formData     : new Form({ id: "",type_name:'',isactive:''}),
            }
         },
     
     created() {
      this.page;
      //this.EquipmentList();
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
    
       ...mapGetters("Masters/TypesMaster", ["result","editData","returnData","ajax_error"]),
     },
     methods: {
     
       ...mapActions("Masters/TypesMaster", ["list","edit","submitForm","UpdateMultiAction"]),

       paginateHandle(pageNum) {type_name
            this.list({ page: pageNum,'keyword': this.keyword});
            this.$router.push({ name: 'paginate_types', params: { page: page } });

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

     if(this.formData.type_name =='') {
         Vue.$toast.open({
             message: "Please Insert Types name!",
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
        this.resetForm();
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

        resetForm() {
          this.keyword        =  "";
          this.label          = 'Add';
          this.user_id        = '';
          this.list({ page: this.result.current_page});
          this.formData =  new Form({ id: "",type_name:'',isactive: ""});
        },
             searchData() {
            var page = 1;
            if (this.keyword.length >= 3) {
                if (this.$route.params.page != 1)
                    this.$router.push({ name: 'types', params: { page: page } });
                this.list({ page: page, keyword: this.keyword });
            } else {
                this.list({ page: page, keyword: this.keyword });
            }
        },
    }
   }
</script>