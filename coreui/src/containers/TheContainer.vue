<template>
  <div class="c-app">
    <TheSidebar/>
    <CWrapper>
      <TheHeader/>
      <div class="c-body">
        <main class="c-main">
          <CContainer fluid>
            <transition name="fade">
              <router-view></router-view>
            </transition>
          </CContainer>
        </main>
        <TheFooter/>
      </div>
    </CWrapper>
  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters, mapActions } from "vuex";

import TheSidebar from './TheSidebar'
import TheHeader from './TheHeader'
import TheFooter from './TheFooter'

export default {
  name: 'TheContainer',
  components: {
    TheSidebar,
    TheHeader,
    TheFooter
  },
     data () {
    return {
      role_type : '',
    }
  },

   created(){
    if(localStorage.getItem('is_login') !='Yes') {
    this.$router.push({ name:"Login"});
    }else{
    this.get_users();
    }
   },
   
   computed: {
      ...mapGetters({ user: "auth/user" }),
   },
   methods: {
     ...mapActions('auth', ['fetchUser','get_user']),

     
    get_users() {
      this.get_user()
        .then((res) => {
          this.fetchUser();
        })
        .catch(error => {
          localStorage.removeItem("is_login");
          this.$router.push({ name:"Login"});
        });
    },
   },
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
