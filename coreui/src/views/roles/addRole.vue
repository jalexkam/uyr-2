	<template>
  <div>
    <CRow class="m-0">
      <CCol sm="12" class="p-2">
        <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Role <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>Add</h5>
        <div>
        <CButton size="sm" class="btn_custom" @click="submitForm">Submit</CButton>
        <router-link :to="{ name: 'roles' }" ><CButton size="sm" color="light">Back</CButton></router-link>
          </div>
      </div>
      </CCol>
      <CCol sm="12" class="px-2">
        <CCard>
          <CCardHeader class="p-2 bg_themes">
     
            <strong>Add Role</strong> 
          </CCardHeader>
          <CCardBody>
            <CForm method="POST">
                <CRow class="m-0 mt-2">
	                <CCol class="form-group px-2" sm="6" lg="4" md="6">
                     <label>Role Name</label>
                  <input class="form-control" type="text" placeholder="Enter Role Name" :value="item.title" name="title" @input="updateStates">
	                </CCol>
               	</CRow>
              	<CRow class="m-0">
                  <CCol sm="12" class="px-2 pb-2">
                    <label class="font-weight-bold">Permissions</label>
                    <hr class="mt-0">
                    <table class="table table-striped table-hover table-bordered bg-gray-100 permission-padding">
                        <thead class="bg-gray-600">
                            <tr class="text-center border-white">
                                <th scope="col" class="text-left w-25 align-middle">Menu Name</th>
                                <th scope="col" class="align-middle">Select All</th>
                                <th scope="col" class="align-middle">List Page</th>
                                <th scope="col" class="align-middle">Add</th>
                                <th scope="col" class="align-middle">Update</th>
                                <th scope="col" class="align-middle">Delete</th>
                                <th scope="col" class="align-middle">Change Password</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 text-dark border-white"> 
                            <tr class="text-center border-white"  v-for="(row, index) in menuTabs.data">
                                <td scope="row" class="text-left font-weight-bold">{{row.parent.name}}</td>
                                <td>                                    
                                   <input type="checkbox" :id="'chk'+row.parent.slug" name="permission[]" :value="row.parent.id" :pid="index" :checked="row.parent.temp == 1"  @change="checkAll" >
                                </td>
                                <td v-if="row.child.length>0" v-for="(key, index1) in row.child">
                                  <input type="checkbox" :id="'chk'+key.slug" name="permission[]" :value="key.id" :pid="index" :cid="index1" :checked="key.temp == 1"  @change="updatePermissions">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </CCol>
              	</CRow>
            </CForm>
          </CCardBody>
          <!-- <CCardFooter class="border-top-0 px-2"> 
            <CButton size="sm" color="dark" @click="submitForm">Submit</CButton>
            <router-link :to="{ name: 'roles' }" ><CButton size="sm" color="light">Back</CButton></router-link>
          </CCardFooter> -->
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

export default {
  data() {
    return {
      formData     : new Form({ name: "",slug:"",parent_id:"",is_parent:'0'}),
    };
  },
  created() {
    this.setMenus({id:0});
    this.resetform();
  },
  computed: {
    ...mapGetters("Roles/Index", ["item","result",'returnData',"menuTabs","ajax_error"]),
  },
  methods: {
    ...mapActions("Roles/Index", ["storeData","setMenus","checkAllData","checkData","setFormStates"]),

   submitForm() {
          console.log('here');
      this.storeData()
        .then(() => {
          console.log('heredd');
          this.$router.push({ name: "roles" });
          window.scrollTo(0,0);
        })
        .catch(error => {
          window.scrollTo(0,0);
        });
    },
    checkAll(e) {
       var pid = e.target.getAttribute("pid");
      if(e.target.checked){
         this.checkAllData({pid:pid,temp:1});
       }else{
         this.checkAllData({pid:pid,temp:0});
       }
    },
    updatePermissions(e) {
      var pid = e.target.getAttribute("pid");
      var cid = e.target.getAttribute("cid");
      
      if(e.target.checked){
        this.checkData({pid:pid,cid:cid,temp:1});
      }else{
        this.checkData({pid:pid,cid:cid,temp:1});
      }
    },
    updateStates(e) {
      var fieldSet = e.target.getAttribute("name");
      var fieldValue = e.target.value;
      this.setFormStates({ [fieldSet]: fieldValue });
    },
  }
};
</script>