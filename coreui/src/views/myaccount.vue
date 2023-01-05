<template>
  <div>
    <CRow class="m-0">
      <CCol md="12" class="p-2">
        <CButton size="sm" class="btn_custom" @click="submitFormData">Submit</CButton>
      </CCol>
      <CCol md="5" class="px-2">
        <CCard class="mb-2">
          <CCardHeader class="bg_themes p-2">
            <!-- <CIcon name="cil-pencil"/> -->
            <strong>My Account</strong>
          </CCardHeader>
          <CCardBody class="px-1 py-2">
              <CRow class="m-0">
                <CCol sm="12" lg="12" md="12" class="px-1">
                  <CInput label="Email ID" type="email" placeholder="Email Id"/>
                </CCol>
                <CCol sm="12" lg="12" md="12" class="px-1">
                  <CInput label="Old Password" type="password" placeholder="Old Password"/>
                </CCol>
                <CCol sm="12" lg="12" md="12" class="px-1">
                  <CInput label="New Password" type="password" placeholder="New Password"/>
                </CCol>
                <CCol sm="12" lg="12" md="12" class="px-1">
                  <CInput label="Confirm Password" type="password" placeholder="Enter email id" autocomplete="email"/>
                </CCol>
              </CRow>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
 
  </div>
</template>
<style>
.profile-img .file {
    position: relative;
}

.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
    cursor: pointer;
}

.profileimg {
    width: 200px;
    height: 200px;
    border: 1px solid #ebedef;
    overflow: hidden;
}

.profileimg img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.logo-img {
    height: 90px !important;
    width: 200px !important;
}
</style>

<script>
import axios from "axios";

export default {
 
 }

</script>