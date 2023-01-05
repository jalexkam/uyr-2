<template>
  <div>
    <CRow class="m-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Admin List</h5>
               <div class="d-flex">
                  <div class="search_box">
                     <input type="search" v-model="keyword" @keyup="searchData" placeholder="Search..." class="form-control" name="">
                     <CButton><vue-fontawesome icon="search" class="mr-1" size="0.9"></vue-fontawesome></CButton>
                  </div>

               <router-link :to="{ name: 'addAdmin' }">
                  <CButton class="btn_custom btn-flex" size="sm" >
                    <vue-fontawesome icon="plus" class="mr-1" size="0.8"></vue-fontawesome>
                     Add New Admin
                  </CButton>
               </router-link>
               </div>
            </div>
         </CCol>      
      </CRow>
    <CRow class="m-0">
      <CCol sm="12" class="px-2"> 
        <CCard class="mb-2">
          <CCardBody>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Sr.No.</th>
                  <th>First name</th>
                  <th>Last name</th>
                  <!-- <th>User name</th> -->
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
               <FlashMessage :position="position"></FlashMessage>
             <tbody v-if="result.data && result.data.length > 0 && result.total > 0">
                <tr v-if="result.data" v-for="(row, index) in result.data" :key="index">
                  <td>{{ result.from + index }}</td>
                  <td>{{ row.first_name }}</td>
                  <td>{{ row.last_name }}</td>
                  <!-- <td>{{ row.user_name }}</td> -->
                  <td>{{ row.email }}</td>
                  <td>{{ row.phone_number }}</td>
                  <td v-if="row.status">In-Active</td>
                  <td v-else>Active</td>

                  <td>
                    <CButtonGroup size="sm">
                     <!--  <router-link :to="{ name: 'changePassword',params: { id: row.id } }">
                        <CButton size="sm" class="btn-outline-info" title="CHANGE PASSWORD">
                        <vue-fontawesome icon="lock" size="0.8"></vue-fontawesome>
                        </CButton>
                      </router-link> -->
                      <router-link :to="{ name: 'edit',params: { id: row.id } }">
                        <CButton size="sm" class="btn-outline-success" title="EDIT">
                          <vue-fontawesome icon="pencil" size="0.8"></vue-fontawesome>
                        </CButton>
                      </router-link>
                      <!-- <CButton size="sm" color="light"
                       @click="MultiAction(row.id, 'Delete')"
                        title="USER DELETE"><CIcon size="sm" name="cil-trash"/></CButton> -->
                        <CButton size="sm" color="" class="btn-outline-danger" @click="MultiAction(row.id, 'Delete')"
                        title="USER DELETE">
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
import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)
import Swal from 'sweetalert2';
import pagination from "./../components/pagination"


export default {
     components: {
      pagination
    },

      data() {
        return {
            user_id: '',
            keyword: '',
            disabled: false,
            position: 'right bottom',
            modal_title: 'Add User',
            tokenData: '',
        };
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

    ...mapGetters("Admin/Index", ["result","returnData"]),
  },
  methods: {
    ...mapActions("Admin/Index", ["list","deleteUser","UpdateMultiAction"]),

     paginateHandle(pageNum) {
            this.$router.push({ name: 'paginate_admin', params: { page: pageNum } });
            this.list({ page: pageNum,'keyword': this.keyword});
        },

      searchData() {
            var page = 1;
            if (this.keyword.length >= 3) {
                if (this.$route.params.page != 1)
                    this.$router.push({ name: 'paginate_admin', params: { page: page } });
                this.list({ page: page, keyword: this.keyword });
            } else {
                this.list({ page: page, keyword: this.keyword });
            }
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

  }
}
</script>
