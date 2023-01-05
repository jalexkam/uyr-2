<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="px-2 btn-sticky">
            <div class="d-flex justify-content-between py-2 align-items-center">
               <h5 class="mb-0">Blog<vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>List</h5>
               <div class="">
                  <router-link :to="{ name: 'manage-website-add-blog' }" >
                     <CButton size="sm" class="btn_custom btn-flex">
                     <vue-fontawesome icon="plus" class="mr-1" size="0.8"></vue-fontawesome>
                     Add New Blog</CButton>
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
                           <tr>
                              <th>Image</th>
                              <th>Title</th>
                              <th>Author</th>
                              <th>Date</th>
                              <th width="100">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr class="mb-2 card-shadow" v-for="(row, index) in result.data" :key="'row'+index">
                           
                              <td>
                                 <div class="tblogimg">
                                     <img :src="'uploads/blog/'+row.id+'/'+row.image_name" v-if="row.image_name">
                                     <img src="images/dummy_banner.jpg" v-else >
                                 </div>
                              </td>
                              <td>{{row.title}}</td>
                              <td>{{row.author_name}}</td>
                              <td>{{row.created_at}}</td>
                              <td>
                                    <CButtonGroup size="sm">
                                   <router-link :to="{ name: 'manage-website-edit-blog',params: { id: row.id } }">
                                     <CButton size="sm" color="" class="btn-outline-success">
                                       <vue-fontawesome icon="pencil" size="0.8"></vue-fontawesome>
                                    </CButton>
                                      </router-link>
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
         };
      },

      created: function () {
         var page = 1;
         if (this.$route.params.page != undefined) page = this.$route.params.page;
         this.list({ page: page, keyword: this.keyword });
      },

      computed: {
         ...mapGetters("ManageWebsite/Blog", ["result","returnData"]),
      },

      methods: {
         ...mapActions("ManageWebsite/Blog", ["list","deleteDoctor","UpdateMultiAction"]),

          paginateHandle(pageNum) {
            this.$router.push({ name: 'manage-website-blog-page', params: { page: pageNum } });
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
</style>