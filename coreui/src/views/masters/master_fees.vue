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
          <h5 class="mb-0">Fees</h5>
          <div class="search_box mr-0 invisible">
            <input type="search" v-model="keyword" @keyup="searchData" placeholder="Search..." class="form-control" name="" />
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
                    <th>Visit Type</th>
                    <th>Between KM</th>
                    <th>Amount</th>
                    <th class="text-center">Status</th>
                    <th width="30">Action</th>
                  </tr>
                </thead>
                <tbody v-if="result.data && result.data.length > 0 && result.total > 0">
                  <tr class="mb-2 card-shadow" v-for="(row, index) in result.data" :key="'row'+index">
                    <td>{{result.from + index}}</td>
                    <td v-if="row.visitType">
                      <span v-if="row.visitType == 1">Doctor home visit</span>
                      <span v-else-if="row.visitType == 2">Patient clinic visit</span>
                      <span v-else>Doctor calls patient</span>
                    </td>
                    <td v-else>-</td>
                   <td v-if="row.betweenKm">
                      <span v-if="row.betweenKm == 1">Within 5KMs</span>
                      <span v-else-if="row.betweenKm == 2">Between 5 km to 7:30 km</span>
                      <span v-else>Between 7:30 to 10 km</span>                      
                    </td>
                    <td v-else>-</td>
                    <td v-if="row.amount">{{row.amount}}</td>
                    <td v-else>-</td>
                    <td class="text-center" align="center">
                      <div class="text-success border-success px-2 d-inline-block" v-if="row.status == 1">Active</div>
                      <div v-else  class="text-danger border-danger px-2 d-inline-block">Inactive</div>
                    </td>
                    <td>
                      <CButtonGroup size="sm">
                        <CButton size="sm" color="" class="btn-outline-warning" v-c-tooltip.hover="{content: `Edit`}" @click="getFeesForm(row.id)">
                          <vue-fontawesome icon="pencil" size="0.8"></vue-fontawesome>
                        </CButton>
                        <CButton size="sm" color="" class="btn-outline-danger" v-c-tooltip.hover="{content: `Remove`}" @click="MultiAction(row.id, 'Delete')">
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
        <Pagination :page="page" @paginateHandle="paginateHandle" :result="result"></Pagination>
      </CCol>

      <CCol md="3" class="px-2">
        <div class="py-2 text-right">
          <CButton class="btn_custom" type="button" @click="submitFormData()">Submit</CButton>
        </div>

        <CCard>
          <CCardHeader class="p-2 px-3 bg_themes">
            <h6 class="mb-0">{{label}} Fees</h6>
          </CCardHeader>
          <CCardBody class="p-2">
            <CForm method="POST">
              <div class="form-group">
                <label>Visit Types<span class="text-danger">*</span></label>
                <select class="form-control" v-model="formData.visitType">
                  <option disabled selected value="">-- Select Visit Type--</option>
                  <option value="1">Doctor home visit</option>
                  <option value="2">Patient clinic visit</option>
                  <option value="3">Doctor calls patient</option>
                </select>
              </div>
              <div class="form-group" v-if="formData.visitType == 1">
                <label>Between KM</label>
                <select class="form-control" v-model="formData.betweenKm">
                  <option disabled selected value="">-- Select KM--</option>
                  <option value="1">Within 5KMs</option>
                  <option value="2">Between 5 km to 7:30 km</option>
                  <option value="3">Between 7:30 to 10 km</option>
                </select>
              </div>
              <div class="form-group">
                <label>Amount<span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Add Amount" name="" v-model="formData.amount"/>
              </div>
              <div class="form-group">
                <label>Status </label><br />
                <select class="form-control" v-model="formData.status">
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
  import Vue from "vue";
  import Vuex from "vuex";
  import Form from "vform";
  import Swal from "sweetalert2";
  import Pagination from "./../components/pagination"
  export default {
    components: {
      Pagination
    },
    data() {
      return {
        id: 0,
        keyword: "",
        label: "Add",
        formData: new Form({ id: "", visitType: "", betweenKm: "", amount: "", status: 1 }),
      };
    },

    created() {
      this.page;
      //this.EquipmentList();
    },
    computed: {
      page() {
        if (this.keyword == "") {
          var page = 1;
          if (this.$route.params.page != undefined) page = this.$route.params.page;
          this.list({ page: page, keyword: this.keyword });
          return Number(page) || 1;
        } else {
        }
      },

      ...mapGetters("Masters/FeesMaster", ["result", "editData", "returnData", "ajax_error"]),
    },
    methods: {
      ...mapActions("Masters/FeesMaster", ["list", "edit", "submitForm", "UpdateMultiAction"]),

      paginateHandle(pageNum) {
        this.list({ page: pageNum, keyword: this.keyword });
        this.$router.push({ name: "paginate_fees", params: { page: pageNum } }).catch(() => {});
      },

      MultiAction(id, action) {
        Swal.fire({
          title: "Are you sure",
          text: "Do you really want to " + action + " " + "This record",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: action,
          confirmButtonColor: "#dd4b39",
          cancelButtonText: "Cancel",
          icon: "warning",
          reverseButtons: true,
        }).then((result) => {
          if (result.value) {
            this.UpdateMultiAction({ id: id, action: action }).then(() => {
              if (this.returnData.status == "success") {
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
        if (this.formData.visitType == "") {
          Vue.$toast.open({
            message: "Please Select visit type!",
            type: "error",
            duration: 5000,
            dismissible: true,
          });
        } else if(this.formData.amount == ""){
            Vue.$toast.open({
            message: "Please Insert Amount!",
            type: "error",
            duration: 5000,
            dismissible: true,
          });
        }else{
          this.submitForm(this.formData)
            .then(() => {
              if (this.returnData.status == "success") {
                Vue.$toast.open({
                  message: this.returnData.message,
                  type: this.returnData.status,
                });

                this.list({ page: 1, keyword: this.keyword });
                this.resetForm();
                //this.$router.push({name:"equipments"});
              }
            })
            .catch((error) => {
              window.scrollTo(0, 0);
            });
        }
      },
      getFormData(id) {
        this.user_id = id;
        this.lable = "Edit";
        this.edit(id).then(() => {
          this.formData.keys().forEach((key) => {
            this.formData[key] = this.editData[key];
          });
        });
        this.ajax_error.errors = [];
      },

      getFeesForm(id) {
        this.id = id;
        this.label = "Edit";
        this.edit(id).then(() => {
          this.formData.keys().forEach((key) => {
            this.formData[key] = this.editData[key];
          });
        });
        this.ajax_error.errors = [];
      },

      resetForm() {
        this.keyword = "";
        this.label = "Add";
        this.user_id = "";
        this.list({ page: this.result.current_page });
        this.formData = new Form({ id: "", visitType: "", betweenKm: "", amount: "", status: 1 });
      },
      searchData() {
        var page = 1;
        if (this.keyword.length >= 3) {
          if (this.$route.params.page != 1) this.$router.push({ name: "fees", params: { page: page } });
          this.list({ page: page, keyword: this.keyword });
        } else {
          this.list({ page: page, keyword: this.keyword });
        }
      },
    },
  };
</script>
