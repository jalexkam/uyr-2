
<template>
  <CDropdown 
    v-if="user"
    inNav
    class="c-header-nav-items"
    placement="bottom-end"
    add-menu-classes="pt-0"
  >
    <template #toggler>
      <CHeaderNavLink>
        <div class="c-avatar" v-if="user">
          <!-- <img class="c-avatar-img " :src="'/uploads/profile/'+user.profile_picture" @error="imageError"/> -->
          <img class="c-avatar-img " :src="'/uploads/profile/'+user.id+'/'+user.profile_photo" @error="imageError"/>
        </div>
      </CHeaderNavLink>
    </template>
    <CDropdownHeader tag="div" class="text-center" color="light">
      <strong>My Account</strong>
    </CDropdownHeader>
   <!--  <CDropdownItem :to="{ name: 'Myaccount' }">
           <CIcon name="cil-user" /> My Account
    </CDropdownItem> -->
     <CDropdownItem v-if="user.role_type ==4" :to="{ name: 'updateDoctorProfile' ,params: { id: user.id }}">
        <CIcon name="cil-user" /> Update Profile
    </CDropdownItem>
    <CDropdownItem :to="{ name: 'profileSettings' }">
           <CIcon name="cil-user" /> Profile Settings
    </CDropdownItem>
    <CDropdownItem v-if="user.role_type == 1 || user.role_type == 2 " :to="{ name: 'emailSetting' }">
           <CIcon name="cil-user" /> Email Setting
    </CDropdownItem>
    <CDropdownItem v-if="user.role_type == 1 || user.role_type == 2 " :to="{ name: 'roles' }">
          <CIcon name="cil-lock-unlocked" /> Manage Roles
    </CDropdownItem>
    <!-- <CDropdownItem v-if="user.role_type == 1 || user.role_type == 2 " :to="{ name: 'users' }">
          <CIcon name="cil-people" /> Manage Users 
    </CDropdownItem> -->
    <CDropdownItem @click="logout()">
      <CIcon name="cil-power-standby" /> Logout
    </CDropdownItem>
  </CDropdown>
</template>

<script>
import axios from 'axios'
import { mapGetters, mapActions } from "vuex";
export default {
  name: 'TheHeaderDropdownAccnt',
  data () {
    return { 
      itemsCount: 42,
      userid : 0,
    }
  },
  created(){
    //.this.userid = localStorage.getItem("userid");
  },
    computed: {
    ...mapGetters("auth", ["user"]),
  },
  methods:{
    
    
     async logout() {
              await this.$store.dispatch("auth/logout");
              let that = this;
              localStorage.clear();
              that.$router.push({ name: "login" });
        },
        
  /*  logout(){
      let self = this;
      axios.post(this.$apiAdress + '/api/logout?token=' + localStorage.getItem("api_token"),{})
      .then(function (response) {
        localStorage.setItem('roles', '');
        self.$router.push({ path: '/login' });
      }).catch(function (error) {
        console.log(error); 
      });
    },*/
    imageError(event) {
      event.target.src = "/uploads/profile/default-profile.png";
    },
  }
}
</script>
<style scoped>
  .c-icon {
    margin-right: 0.3rem;
  }
</style>
