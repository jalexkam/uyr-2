<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">FAQ
                 <!--  <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>List -->
               </h5>
               <div class="">
                  <router-link :to="{ name: 'add_faq' }" >
                     <CButton size="sm" class="btn_custom btn-flex">
                     <vue-fontawesome icon="plus" class="mr-1" size="0.8"></vue-fontawesome>
                     Add New FAQ</CButton>
                  </router-link>
               </div>
            </div>
         </CCol>
          <CCol md="12" class="px-2 pb-2">
            <CCard>
               <CCardBody>
                  <div class="table-responsive">
                     <table class="table table-striped table-hover">
                        <thead>
                           <!-- <tr>
                              <th colspan="7">Homepage slider</th>
                           </tr> -->
                           <tr>
                              <th> Sr.No. </th>
                              <th>Questions</th>
                              <th>Answer</th>
                              <th width="100">Action</th>
                           </tr>
                        </thead>
                      
                        <tbody v-if="result.data && result.data.length > 0 && result.total > 0">
                           <tr class="mb-2 card-shadow" v-if="result.data" v-for="(row, index) in result.data" :key="'row'+index">
                            <td>{{ result.from + index}}</td>
                            <td>{{row.question}}</td>
                            <td>{{row.answer}}</td>
                            
                              <td>
                                 <CButtonGroup size="sm">
                                  <router-link :to="{ name: 'edit_faq',params: { id: row.id } }">
                                       <CButton size="sm" color="" class="btn-outline-warning"  v-c-tooltip.hover="{content: `Edit`}" 
                                      >
                                        <vue-fontawesome icon="pencil" size="0.8"></vue-fontawesome>                                     
                                    </CButton>
                                  </router-link>
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
            formData     : new Form({ id: "",questions:'',answar: ''}),
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
    
       ...mapGetters("ManageWebsite/FAQs", ["result","editData","returnData","ajax_error","returnData","getFaqForm"]),
     },
     methods: {
     
       ...mapActions("ManageWebsite/FAQs", ["list","UpdateMultiAction"]),

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
                           // this.list({ page: this.result.current_page });
                            this.list({ page: 1,'keyword': this.keyword});

                        }
                    });
                }
            });
        },


     
    }
   }
  

   
</script>