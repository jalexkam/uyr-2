<template>


  <CSidebar 
    fixed 
    :minimize="minimize"
    :show="!show"
    @update:show="(value) => $store.commit('set', ['sidebarShow', value])"
    class="d-none"
  >
    <!-- <CSidebarBrand class="d-md-down-none flex-wrap" to="/">
      <div class="logo-up" v-if="user">
         <img :src="'/uploads/logo/'+user.website_logo" @error="logoError" />
      </div>
      <div v-if="user.website_logo == ''">
        <b v-if="user">{{user.website_title}}</b>
      </div>
    </CSidebarBrand> -->

    <ul class="c-sidebar-nav h-100 ps ps--active-y">
      <li class="c-sidebar-nav-item" v-for="(tab, i) in tabs">
        <router-link :to="{ name: tab.href }" :id="'menu_'+i" class="c-sidebar-nav-link" >
           <CIcon :name="tab.icon" class="mr-1"></CIcon>
           <span>{{tab.name}}</span>
        </router-link>
         <ul class="c-sidebar-nav h-100 ps ps--active-y" v-if="tab.child">
         <li v-for="child in tab.child" :key="child.root_name">
            <router-link :to="{name: child.root_name }" >
               {{child.title}}
            </router-link>
         </li>
      </ul>
      </li>
    </ul>
  </CSidebar>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import axios from 'axios'
export default {
  name: 'TheSidebar',
  data () {
    return {
      nav: [],
      buffor: [],
    }
  },
  created() {
      this.getLeftMenus();
    },
  computed: {
    show () {
      return this.$store.state.sidebarShow 
    },
    minimize () {
      return this.$store.state.sidebarMinimize 
    },
    ...mapGetters("LeftMenus", ["tabs"]),
    ...mapGetters("auth", ["user"]),
  },
  methods: {
    ...mapActions("LeftMenus", ["getLeftMenus"]),

    logoError(event) {
      event.target.src = "/uploads/logo/default-logo.png";
    },
  },
  mounted () {
    this.$root.$on('toggle-sidebar', () => {
      const sidebarOpened = this.show === true || this.show === 'responsive'
      this.show = sidebarOpened ? false : 'responsive'
    })
    this.$root.$on('toggle-sidebar-mobile', () => {
      const sidebarClosed = this.show === 'responsive' || this.show === false
      this.show = sidebarClosed ? true : 'responsive'
    })
  }
}
</script>
