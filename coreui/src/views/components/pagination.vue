<template>
   <div class="row m-0 align-items-center paginationPanel">
      <div
         class="col px-2"
         v-if="result.data && result.data.length > 0 && result.total > 0"
         >
         Showing {{ result.from }} to {{ result.to }} of
         {{ result.total }} Entries
      </div>
      <div
         class="col-aut px-2"
         v-if="
         result.data &&
         result.data.length > 0 &&
         result.last_page > 1
         "
         >
         <paginate
            :value="page"
            :page-count="result.last_page"
            :page-range="3"
            :margin-pages="2"
            :click-handler="paginateHandle"
            :prev-text="'←'"
            :next-text="'→'"
            :container-class="'pagination'"
            :page-class="'page-item'"
            >
         </paginate>
      </div>
   </div>
</template>
<script>

   import { mapGetters, mapActions } from "vuex";
   import Vue from 'vue';
   import Vuex from 'vuex';
   import Form from "vform";
   import Paginate from 'vuejs-paginate'
   Vue.component('paginate', Paginate)

   export default{
         props: ['result',"page"],
       
        data() {
           return {
            
           };
      },
      methods: {
         paginateHandle(pageNum){
          this.$emit('paginateHandle',pageNum);
        },
        
      },
   }

   </script>