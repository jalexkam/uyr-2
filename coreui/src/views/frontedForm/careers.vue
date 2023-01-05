<template>
  <div>
    <CRow class="m-0">
         <CCol sm="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Careers list</h5>
               <div class="d-flex">
                  <div class="search_box">
                     <input type="search" v-model="keyword" @keyup="searchData" placeholder="Search..." class="form-control" name="">
                     <CButton><vue-fontawesome icon="search" class="mr-1" size="0.9"></vue-fontawesome></CButton>
                  </div>
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
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Age</th>
                  <th>Gender</th>
                  <th>Address</th>
                  <th>Resume</th>
                   <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
               <tbody v-if="result.data && result.data.length > 0 && result.total > 0">
                <tr v-for="(row, index) in result.data" :key="index">
                  <td>{{ result.from + index }}</td>
                  <td>{{ row.firstName }} {{ row.lastName }}</td>
                  <td>{{ row.email }}</td>
                  <td>{{ row.phone }}</td>
                  <td>{{ row.age }} Years</td>
                  <td>{{ row.gender }}</td>
                  <td>{{ row.address }}</td>
                   <td v-if="row.resume"> 
                     <a :href="'/uploads/resume/'+row.resume" download=""> 
                      <CButton size="sm" color="" class="btn-outline-info">
                       <vue-fontawesome icon="file" size="0.8"></vue-fontawesome>
                        </CButton>
                         </a>
                  </td>
                  <td v-else>
                  </td> 
                  <td v-if="row.status != 0">
                    <CBadge color="success"  v-if="row.status == 1">Accepted</CBadge>
                    <CBadge color="warning" v-if="row.status == 2">Rejected</CBadge>
                  </td>
                  
                   <td v-if="row.status == 0">
                    <select class="form-control form-ctrl-select" @change="changeStatus(row.id,$event)"> 
                       <option value="">Select </option>
                      <option value="1">Accepted </option>
                       <option value="2">Rejected </option>
                    </select>
                   </td>
                   
                  <td>
                    <CButtonGroup size="sm">
                        <CButton size="sm" color="" class="btn-outline-danger" @click="MultiAction(row.id, 'Delete')">
                        <vue-fontawesome icon="trash" size="0.8"></vue-fontawesome>
                        </CButton>
                    </CButtonGroup>
                  </td>
                </tr>
              </tbody>
               <tbody v-else>
                <tr>
                  <td colspan="9" align="center" class="p-3">
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

    ...mapGetters("FrontForm/Carrers", ["result","returnData"]),
  },
  methods: {
    ...mapActions("FrontForm/Carrers", ["list","UpdateMultiAction","UpdateStatus"]),

     paginateHandle(pageNum) {
            this.$router.push({ name: 'careers-list-page', params: { page: pageNum } });
            this.list({ page: pageNum,'keyword': this.keyword});
        },

      searchData() {
            var page = 1;
            if (this.keyword.length >= 3) {
                if (this.$route.params.page != 1)
                    this.$router.push({ name: 'careers-list-page', params: { page: page } });
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
         changeStatus(id,event) {
          
          if(event.target.value == 1) var action = 'Accepted';
          else if (event.target.value == 2) var action = 'Rejected';
          var status = event.target.value;
          if(event.target.value == '') return true;
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
                    this.UpdateStatus({ id: id, status: status }).then(() => {
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
