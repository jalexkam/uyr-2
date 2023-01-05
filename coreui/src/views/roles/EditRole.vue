	<template>
  <div>
    <CRow class="m-0">
      <CCol sm="12" class="p-2">
        <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Role <vue-fontawesome icon="caret-right" class="px-1" size="1"></vue-fontawesome>Update</h5>
        <div>
        <CButton class="btn_custom" @click="submitForm">Submit</CButton>
        <router-link :to="{ name: 'roles' }" ><CButton color="light">Back</CButton></router-link>
      </div>
    </div>
      </CCol>
      <CCol sm="12" class="px-2">
        <CCard>
          <CCardHeader class="p-2 bg_themes">
            <strong>Update Role</strong> 
          </CCardHeader>
          <CCardBody>
            <CForm method="POST">
              	<CRow class="m-0">
	                <CCol class="form-group pt-2 px-2" sm="6" lg="4" md="6">
                     <label>Role Name</label>
                     <input class="form-control" type="text" placeholder="Enter Role Name" :value="item.title" name="title" @input="updateStates">
	                </CCol>
               	</CRow>
                <CRow class="m-0">
                <CCol sm="12" class="px-2">
                    <label class="font-weight-bold mb-0">Permissions</label>
                    <hr class="mt-0 mb-2">

                    <!-- <table class="table table-bordered bg-gray-100 permission-padding">
                        <thead class="bg-gray-500 ">
                        </thead>

                        <tbody class="bg-gray-100 text-dark border-white"> 
                            <tr class="text-center border-white"  v-for="(row, index) in menuTabs.data">
                               
                                <td scope="row" class="text-left font-weight-bold">
                                   <input type="checkbox" :id="'chk'+row.parent.slug" name="permission[]" :value="row.parent.id" :pid="index" :checked="row.parent.temp == 1"  @change="checkAll" >
                                    {{row.parent.name}}

                                  <td v-if="row.child.length>0" v-for="(key, index1) in row.child">
                                  <input type="checkbox" :id="'chk'+key.slug" name="permission[]" :value="key.id" :pid="index" :cid="index1" :checked="key.temp == 1"  @change="updatePermissions">
                                    {{key.name}}
                                </td>
                                </td>                               
                            </tr>
                        </tbody>
                    </table> -->

                    <div class="role_div" v-for="(row, index) in menuTabs.data">
                      <h6>
                        <input type="checkbox" :id="'chk'+row.parent.slug" name="permission[]" :value="row.parent.id" :pid="index" :checked="row.parent.temp == 1"  @change="checkAll" >
                      <label :for="'chk'+row.parent.slug"> {{row.parent.name}}</label>
                      </h6>
                      <ul class="role_flex" v-if="row.child.length>0" >
                        <li v-for="(key, index1) in row.child">
                          <input type="checkbox" :id="'chk'+key.slug" name="permission[]" :value="key.id" :pid="index" :cid="index1" :checked="key.temp == 1"  @change="updatePermissions">
                          <label :for="'chk'+key.slug"> {{key.name}}</label>
                        </li>
                      </ul>
                    </div>
                    
                  </CCol>
              	</CRow>
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

export default {
  data() {
    return {
      formData     : new Form({ name: "",slug:"",parent_id:"",is_parent:'0'}),
    };
  },
  created() {
    this.fetchData(this.$route.params.id);
    this.setMenus({id:this.$route.params.id});
  },
  computed: {
    ...mapGetters("Roles/Index", ["item","result",'returnData',"menuTabs","ajax_error"]),
  },
  methods: {
    ...mapActions("Roles/Index", ["updateData","setMenus","checkAllData","checkData","setFormStates","fetchData"]),

   submitForm() {
      this.updateData()
        .then(() => {
          Vue.$toast.open({
                          message: 'Role updated successfully',
                          type: 'success',
                         });
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
        this.checkData({pid:pid,cid:cid,temp:0});
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
<style>
  .role_flex{
    display: flex;
    flex-wrap: wrap;
    margin-left: 30px;
    margin-top: 10px;
  }
  .role_div h6 {
    margin: 0;
    display: flex;
    align-items: center;
    font-size: 13px;
  }
  .role_div h6 label {
    margin: 0;
}
ul.role_flex li label {
    margin: 0;
}
  .role_div h6 input {
    margin-right: 7px;
}
  ul.role_flex li {
    display: flex;
    align-items: center;
    margin-right: 25px;
  }

  ul.role_flex li input {
      margin-right: 7px;
  }
  .role_div {
    padding: 8px 0;
    border-bottom: 1px solid #ccc;
  }
  .role_div:last-child {
    border-bottom: 0;
}
</style>