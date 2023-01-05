<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">Associate Partners
                </h5>
               <div class="d-flex">
                     <CButton size="sm" class="btn_custom float-right file_i mr-2">
                        <vue-fontawesome icon="plus" class="mr-1" size="0.8"></vue-fontawesome>Add New Partner
                        <input type="file" name="" v-on:change="onImageChange">
                     </CButton>
                  <router-link :to="{ name: 'manage-website-homepage' }" >
                     <CButton size="sm" color="light" class="py-1 px-3">Back</CButton>
                  </router-link>
               </div>
            </div>
         </CCol>
          <CCol md="12" class="px-2 pb-2">
            <CCard class="mb-0">
               <CCardBody>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th width="80" class="text-center pl-0">Sr.No.</th>
                              <th width="230">Image</th>
                              <th>Date Added</th>
                              <th width="100">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr class="mb-2 card-shadow" v-for="(row, index) in result.data" :key="'row'+index">
                         
                              <td class="text-center pl-0">{{ result.from + index }}</td>
                              <td>
                                 <div class="tblogimg">
                                    <img :src="'uploads/associatePartners/'+row.id+'/'+row.image" v-if="row.image">
                                     <img src="/images/dummy_banner.jpg" v-else >
                                   
                                 </div>
                              </td>
                              <td>{{row.created_at}}</td>
                              <td>
                                    <CButtonGroup size="sm">
                                    <CButton size="sm" color="" class="btn-outline-danger" @click="MultiAction(row.id, 'Delete')">
                                       <vue-fontawesome icon="trash" size="0.8"></vue-fontawesome>
                                    </CButton>
                                 </CButtonGroup>
                              </td>
                           </tr>

                        </tbody>
                     </table>
                  </div>
               </CCardBody>
            </CCard>
         </CCol>
      </CRow>  
      <pagination :page="result.current_page" @paginateHandle="paginateHandle" :result="result"></pagination>    
   </div>
</template>
<script>
   import Vue from 'vue'
   import { mapGetters, mapActions } from "vuex";
   import Paginate from 'vuejs-paginate';
   Vue.component('paginate', Paginate);
   import Swal from 'sweetalert2';
   import pagination from "./../components/pagination";

   export default{
      components: {
         pagination
      },

      data() {
         return {
               keyword: '',
               position: 'right bottom',
               picture:[],
         };
      },

      created: function () {
         var page = 1;
         if (this.$route.params.page != undefined) page = this.$route.params.page;
         this.list({ page: page, keyword: this.keyword });
      },

      computed: {
         ...mapGetters("ManageWebsite/AssociatePartners", ["result","returnData"]),
      },

      methods: {
         ...mapActions("ManageWebsite/AssociatePartners", ["list","deleteDoctor","UpdateMultiAction","submitForm"]),

          paginateHandle(pageNum) {
            this.$router.push({ name: 'manage-website-blog-page', params: { page: pageNum } });
            this.list({ page: pageNum,'keyword': this.keyword});
        },

         onImageChange(e) {
            this.picture = e.target.files[0];
            var reader = new FileReader();
            reader.onload = (e) => {
                this.imageDoc = e.target.result;
            }
            reader.readAsDataURL(this.picture);
            this.submitFormData();
          },

           submitFormData() {
               let newData  =  new FormData();
               newData.append('file',this.picture)
               newData.append('formData',JSON.stringify(this.formData))
             this.submitForm({newData:newData,id:''}).then(() => {
              if (this.returnData.status == 'success') {
                Vue.$toast.open({
                          message: this.returnData.message,
                          type: this.returnData.status,
                          position:'bottom-left',
                          duration:5000,
                      });
                   this.$router.push({name:"manage-website-associate-partners"}); 
                  this.list({ page: 1, keyword: this.keyword });
                }
                })
            .catch(error => {      
            });
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


      },



   }
   
</script> 

<style>
   .tblogimg {
    width: 150px;
    padding: 5px
}

.tblogimg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.file_i{
   position: relative;
}
.file_i input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    opacity: 0;
    height: 100%;
    cursor: pointer;
 }
</style>