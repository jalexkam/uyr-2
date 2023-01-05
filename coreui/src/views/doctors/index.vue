<template>
   <div>
      <CRow class="m-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Doctors List</h5>
              <div class="d-flex">
                  <div class="search_box">
                     <input type="search" v-model="keyword" @keyup="searchData" placeholder="Search..." class="form-control" name="">
                     <CButton><vue-fontawesome icon="search" class="mr-1" size="0.9"></vue-fontawesome></CButton>
                  </div>
                  <router-link :to="{ name: 'doctoradd' }" >
                  <CButton class="btn_custom btn-flex" size="sm" >
                     <vue-fontawesome icon="plus" class="mr-1" size="0.8"></vue-fontawesome>
                     Add Doctor
                  </CButton>
               </router-link>
               </div>
            </div>
         </CCol>
      </CRow>

      <CRow class="m-0" v-if="result.data && result.data.length > 0 && result.total > 0">
         <div class="col-md-6 col-xl-4 px-2" v-for="(row, index) in result.data" :key="index">
            <CCard class="doctor_card">
               <div class="doctor_list_card" >
                  <div class="doctor-img">
                     <img :src="'uploads/profile/'+row.id+'/'+row.profile_photo" v-if="row.profile_photo">
                     <img src="/uploads/profile/default-profile.png" v-else>
                  </div>
                  <div class="doctor_info">
                     <p>
                        <strong>Name:</strong>
                        <span>{{row.first_name}} {{row.last_name}}</span>
                     </p>
                     <p>
                        <strong>Registered Date:</strong>
                        <span>{{row.date_of_registration}}</span>
                     </p>

                     <p>
                        <strong>Email-ID:</strong>
                        <span>{{row.email}}</span>
                     </p>

                     <p>
                        <strong>Account Status:</strong>
                        <span class="text-warning" v-if="row.status ==0">Pending</span>
                        <span class="text-danger" v-if="row.status ==1">Rejected</span>
                        <span class="text-success"  v-if="row.status ==2">Approved</span>
                        <!-- <span class="text-danger">{{row.status}}</span> -->
                     </p>
                    <router-link :to="{ name: 'view_doctor' ,params: { id: row.doctor_id }}">
                        <CButton size="sm" color=""  class="btn-outline-info">
                        <vue-fontawesome icon="eye" size="0.8"></vue-fontawesome>
                        </CButton>
                    </router-link>
                    <router-link :to="{ name: 'edit_doctor' ,params: { id: row.doctor_id }}" v-if="user && (user.role_type ==1 || user.role_type == 2)">
                        <CButton size="sm" color="" class="btn-outline-success">
                        <vue-fontawesome icon="pencil" size="0.8"></vue-fontawesome>
                        </CButton>
                    </router-link>

                    <CButton size="sm" color="" class="btn-outline-danger" @click="MultiAction(row.id, 'Delete')" title="Doctor Delete" v-if="user && (user.role_type ==1 || user.role_type == 2)">
                       <vue-fontawesome icon="trash" size="0.8"></vue-fontawesome>
                    </CButton>

                  </div>
               </div>
            </CCard>
         </div>
      </CRow>
       <tbody align="center" v-else>
                <tr>
                  <td colspan="8" align="center" class="p-3">
                    <h6 class="m-0">Data Not Found !</h6>
                    </td>
                </tr>
                 </tbody>


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
            keyword: '',
            disabled: false,
            position: 'right bottom',
        };
    },

  created: function () {
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

    ...mapGetters("Doctor/Index", ["result","returnData"]),
    ...mapGetters("auth", ["user"]),
  },


  methods: {
    ...mapActions("Doctor/Index", ["list","deleteDoctor","UpdateMultiAction"]),

     paginateHandle(pageNum) {
            this.$router.push({ name: 'paginate_doctor', params: { page: pageNum } });
        },

        searchData() {
            var page = 1;
            if (this.keyword.length >= 3) {
                if (this.$route.params.page != 1)
                    this.$router.push({ name: 'paginate_doctor', params: { page: page } });
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
                        this.list({ page: this.result.current_page,keyword: this.keyword });
                        }
                    });
                }
            });
        },
  }
}
</script>
