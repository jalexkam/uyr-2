<template>
  <div>
    <CRow class="m-0">
      <CCol sm="12" class="p-2">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Services</h5>
          
          <!-- <div class="search_box">
            <input type="search" v-model="keyword" @keyup="searchData" placeholder="Search..." class="form-control" name="" />
            <CButton><vue-fontawesome icon="search" class="mr-1" size="0.9"></vue-fontawesome></CButton>
          </div> -->
          <div class="d-flex">
            <CButton class="btn-light mr-2" type="button" @click="resetForm()">Reset</CButton>
            <CButton class="btn_custom" type="button" @click="submitFormData()">Submit</CButton>
          </div>
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
                    <th class="text-center" width="30px">Sr.No</th>
                    <th class="text-center" width="170px">Image</th>
                    <th>Service Name</th>
                    <th>Discription</th>
                    <th class="text-center">Status</th>
                    <th width="30">Action</th>
                  </tr>
                </thead>
                <tbody v-if="result.data && result.data.length > 0 && result.total > 0">
                  <tr class="mb-2 card-shadow" v-if="result.data" v-for="(row, index) in result.data" :key="'row'+index">
                    <td class="text-center">{{ result.from + index }}</td>
                    <td class="text-center">
                      <div class="blogimg m-2">
                        <img :src="'uploads/service/'+row.id+'/'+row.image_name" v-if="row.image_name">
                        <img src="images/dummy_banner.jpg" v-else/>
                      </div>
                    </td>
                    <td v-if="row.service_name">{{row.service_name}}</td>
                    <td v-else></td>
                    <td v-if="row.description">{{row.description}}</td>
                    <td v-else></td>
                    <td class="text-center" align="center">
                      <div v-if="row.isactive == 1" class="text-success border-success px-2 d-inline-block">Active</div>
                      <div v-else class="text-danger border-danger px-2 d-inline-block">Inactive</div>
                    </td>
                    <td>
                      <CButtonGroup size="sm">
                        <CButton size="sm" color="" class="btn-outline-warning" v-c-tooltip.hover="{content: `Edit`}" @click="getFormData(row.id)">
                          <vue-fontawesome icon="pencil" size="0.8"></vue-fontawesome>
                        </CButton>
                        <CButton size="sm" @click="MultiAction(row.id, 'Delete')" color="" class="btn-outline-danger" v-c-tooltip.hover="{content: `Remove`}">
                          <vue-fontawesome icon="trash" size="0.8"></vue-fontawesome>
                        </CButton>
                      </CButtonGroup>
                    </td>
                  </tr>
                  <tr v-if="result.data==''">
                    <td colspan="14" align="center" class="p-3">
                      <h6 class="mb-0">
                        <strong>No data found!</strong>
                      </h6>
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
      </CCol>

      <CCol md="3" class="px-2">
        <CCard>
          <CCardHeader class="p-2 px-3 bg_themes">
            <h6 class="mb-0">{{label}} Services</h6>
          </CCardHeader>
          <CCardBody class="p-2">
            <CForm method="POST">
              <div class="form-group">
                <label>Service Image</label>
                <div class="blog-img flex-wrap rounded p-1">
                  <div class="blogimg mx-auto ">
                    <img :src="'uploads/service/'+editData.id+'/'+editData.image_name" v-if="editData.image_name && imageDoc ==''">
                    <img :src="imageDoc" class="img-fluid" v-else-if="imageDoc && imageDoc!=''" />
                    <img v-else src="/images/dummy_banner.jpg">                      
                  </div>
                  <div class="w-100 text-center">
                    <button class="file btn btn-sm upload_btn mx-auto mt-3">
                    <vue-fontawesome icon="upload" class="px-1 mr-2" size="0.8"></vue-fontawesome>
                    Upload Image
                    <input type="file" name="profile_picture"  v-on:change="onImageChange">
                  </button>
                  </div>
                  
                </div>
              </div>
              <div class="form-group">
                <label>Services Name<span class="text-danger">*</span></label>
                <CInput placeholder="" v-model="formData.service_name" />
                <small class="text-danger" v-if="ajax_error.errors.service_name">{{ ajax_error.errors.service_name[0] }}</small>
              </div>

              <div class="form-group">
                <label>Description<span class="text-danger">*</span></label>
                <textarea rows="6" maxlength ="100" class="form-control" v-model="formData.description"></textarea>
                <!-- <small class="text-danger" v-if="ajax_error.errors.description">{{ ajax_error.errors.description[0] }}</small> -->
              </div>
              <div class="form-group">
                <label>Status </label><br />
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
  import Vue from "vue";
  import Vuex from "vuex";
  import Form from "vform";
  import pagination from "./../components/pagination";
  import Swal from "sweetalert2";
  export default {
    components: {
      pagination,
    },
    data() {
      return {
        id: 0,
        keyword: "",
        label: "Add",
        formData: new Form({ id: "", service_name: "", description:"", isactive: "" }),
        picture  : '',
        imageDoc : [],
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

      ...mapGetters("Masters/ServicesMaster", ["result", "editData", "returnData", "ajax_error"]),
    },
    methods: {
      ...mapActions("Masters/ServicesMaster", ["list", "edit", "submitForm", "UpdateMultiAction"]),

      paginateHandle(pageNum) {
        service_name;
        this.list({ page: pageNum, keyword: this.keyword });
        this.$router.push({ name: "paginate_services", params: { page: pageNum } });
      },

      onImageChange(e) {           
        this.picture = e.target.files[0];
        var reader = new FileReader();
        reader.onload = (e) => {
          this.imageDoc = e.target.result;
        }
        reader.readAsDataURL(this.picture);
      },

      submitFormData() {
        if (this.formData.service_name == "") {
          Vue.$toast.open({
            message: "Please Insert Service name!",
            type: "error",
            duration: 5000,
            dismissible: true,
          });
        } else {
          // this.submitForm(this.formData)
          let newData  =  new FormData();
          newData.append('file',this.picture)
          newData.append('formData',JSON.stringify(this.formData))
          var id = this.formData.id;
          this.submitForm({newData:newData,id:id}).then(() => {
            if (this.returnData.status == "success") {
              Vue.$toast.open({
                message: this.returnData.message,
                type: this.returnData.status,
              });

              this.list({ page: 1, keyword: this.keyword });
              this.resetForm();
            }
          })
          .catch((error) => {
            window.scrollTo(0, 0);
          });
        }
      },

      getFormData(id) {
        this.user_id = id;
        this.label = "Edit";
        this.edit(id).then(() => {
          this.formData.keys().forEach((key) => {
            this.formData[key] = this.editData[key];
          });
        });
        this.ajax_error.errors = [];
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

      resetForm() {
        this.keyword = "";
        this.editData.image_name = '';
        this.imageDoc = [];
        this.label = "Add";
        this.user_id = "";
        this.list({ page: this.result.current_page });
        this.formData = new Form({ id: "", service_name: "", isactive: "" });
      },

      searchData() {
        var page = 1;
        if (this.keyword.length >= 3) {
          if (this.$route.params.page != 1) this.$router.push({ name: "services", params: { page: page } });
          this.list({ page: page, keyword: this.keyword });
        } else {
          this.list({ page: page, keyword: this.keyword });
        }
      },
    },
  };
</script>

<style scoped>
   .blog-img{
      display: flex;
      align-items: center;
   }

   .blogimg {
    width: 150px;
    height: 150px;
    border: 2px solid #2c449e;
    overflow: hidden;
    margin-right: 16px;
}
.blogimg img {
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
}

.blog-img .file {
    position: relative;
}
.blog-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
}
</style>
