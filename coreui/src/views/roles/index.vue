<template>
  <div>
    <CRow class="m-0">
         <CCol md="12" class="p-2">
            <div class="d-flex justify-content-between align-items-center">
               <h5 class="mb-0">Role List</h5>
              <!--  <router-link :to="{ name: 'add_roles' }">
              <CButton size="sm" class="btn_custom" title="ADD NEW"><CIcon name="cil-plus"/>&nbsp;Add New</CButton>
            </router-link> -->
            </div>
         </CCol>      
      </CRow>
    <CRow class="m-0">
      <CCol sm="8" class="px-2">
        <CCard>
          <CCardBody>
            <table class="table">
              <thead>
                <tr>
                   <th>Sr.No.</th>
                   <th>Role name</th>
                   <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(row, index) in result.data">
                   <td>{{ index + 1 }}</td>
                   <td>{{row.title}}</td>
                    <td>
                    <CButtonGroup size="sm">
                      <router-link :to="{ name: 'edit_roles',params: { id: row.id } }">
                        <CButton size="sm" class="btn-outline-success" title="EDIT"><CIcon size="sm" name="cil-pencil"/></CButton>
                      </router-link>
                     <!--  <CButton size="sm" v-if="row.id!=1" color="light" @click="deleteRolesData(row.id)" title="DELETE"><CIcon size="sm" name="cil-trash"/></CButton> -->
                    </CButtonGroup>
                  </td>
                </tr>
             </tbody>
          </table>
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

export default {
  created() {
    this.list();
  },
  computed: {
    ...mapGetters("Roles/Index", ["result"]),
  },
  methods: {
    ...mapActions("Roles/Index", ["list","deleteRole"]),

    deleteRolesData(id) {
      if(confirm("Do you really want to delete?")){
        this.deleteRole({ id: id })
        .then(() => {
            this.list();
        });
      }
    },
  }
}
</script>
