<template>
  <CHeader fixed with-subheader light class="border-bottom-0 bg-gray-100">
    <CToggler
      in-header
      class="ml-0 d-none"
      @click="$store.commit('toggleSidebarMobile')"
    />
    <CToggler
      in-header
      class="ml-0 d-none"
      @click="$store.commit('toggleSidebarDesktop')"
    />
    <div class="menu_overlay" @click="isActive = !isActive" :class="{ active: isActive }"></div>
    <CMenu :class="{ active: isActive }"/>
    <div class="d-flex align-items-center ml-auto mr-3 d-lg-none">
    <div class="hamburger menutoggle" id="hamburger-6 " @click="isActive = !isActive" :class="{ active: isActive }">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </div>
      </div>
    <CHeaderNav class="mr-4 ml-lg-auto">
      <span v-if="user"> Logged In As {{user.title}} </span>
        <TheHeaderDropdownAccnt/>
     
    </CHeaderNav>

    <!-- <CSubheader class="px-2 py-0">
      <CBreadcrumbRouter class="border-0 p-0 m-0"/>
    </CSubheader> -->


     <!--  <CBreadcrumb class="p-0 m-0 border-0">
      <li role="presentation" class="breadcrumb-item">
          <a href="#" target="_self" class=""> 
            <CIcon name="cilHome" size="lg" class="mb-1"/>
          </a>
          <CIcon size="sm" name="cilChevronDoubleRight"/>

        </li>
        <li role="presentation" class="breadcrumb-item px-0">
          <a href="#" target="_self" class=""> User </a>
          <CIcon size="sm" name="cilChevronDoubleRight"/>
        </li>
        <li role="presentation" class="active breadcrumb-item px-0">
          <span> Role </span>
        </li>
      </CBreadcrumb> -->

    <!-- </CSubheader> -->
  </CHeader>
</template>

<script>
  import { mapGetters, mapActions } from "vuex";
import CMenu from './Menu'
import TheHeaderDropdownAccnt from './TheHeaderDropdownAccnt'

export default {
  name: 'TheHeader',
  data() {
        return{
        isActive: false
      }
    },
  components: {
    TheHeaderDropdownAccnt,
    CMenu
  },

  created(){
   //this.get_users();
  },

  computed: {
    ...mapGetters({ user: "auth/user" }),
  },
  methods: {
    ...mapActions('auth', ['fetchUser','get_user']),
/*    
  get_users() {
      this.get_user()
        .then((res) => {
          this.fetchUser();
        })
        .catch(error => {
          this.$router.push({ name:"login"});
          //this.$router.push({ path: 'login' });
        });
    },*/


  },
 
}
</script>
<style>
  .breadcrumb-item + .breadcrumb-item::before {
    color: #000;
    content: '>>';
    padding: 0px !important;

  }</style>