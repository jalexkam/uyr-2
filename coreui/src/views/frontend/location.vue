<template>
   <div>
     <u-animate-container>
      <!-- Header area start -->
      <Uheader/>
      <!-- Header area End -->
      <main class="pts">

      <h2 class="m-5">Coming Soon</h2>
     <!--  <div class="ptb_60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <CCardBody class="py-2 px-0">
                     <div class="accordion">
                        <CCard class="mb-2">
                           <CButton block color="link" class="text-left shadow-none card-header" @click="accordion = accordion === 0 ? false : 0"  v-bind:class = "(accordion === 0)?'active':''">
                              <h5 class="m-0">1. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod ?</h5>
                           </CButton>
                           <CCollapse :show="accordion === 0">
                              <CCardBody>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              </CCardBody>
                           </CCollapse>
                        </CCard>
                        <CCard class="mb-2">
                           <CButton block color="link" class="text-left shadow-none card-header" @click="accordion = accordion === 1 ? false : 1"  v-bind:class = "(accordion === 1)?'active':''">
                              <h5 class="m-0">2. Lorem ipsum dolor sit amet ?</h5>
                           </CButton>
                           <CCollapse :show="accordion === 1">
                              <CCardBody>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              </CCardBody>
                           </CCollapse>
                        </CCard>
                        <CCard class="mb-2">
                           <CButton block color="link" class="text-left shadow-none card-header " @click="accordion = accordion === 2 ? false : 2"  v-bind:class = "(accordion === 2)?'active':''">
                              <h5 class="m-0">3. Lorem ipsum dolor sit amet, consectetur adipisicing elit ?</h5>
                           </CButton>
                           <CCollapse :show="accordion === 2">
                              <CCardBody>
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              </CCardBody>
                           </CCollapse>
                        </CCard>
                        <CCard class="mb-2">
                           <CButton block color="link" class="text-left shadow-none card-header " @click="accordion = accordion === 3 ? false : 3"  v-bind:class = "(accordion === 3)?'active':''">
                              <h5 class="m-0">4. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod ?</h5>
                           </CButton>
                           <CCollapse :show="accordion === 3">
                              <CCardBody>
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              </CCardBody>
                           </CCollapse>
                        </CCard>
                        <CCard class="mb-2">
                           <CButton block color="link" class="text-left shadow-none card-header " @click="accordion = accordion === 4 ? false : 4"  v-bind:class = "(accordion === 4)?'active':''">
                              <h5 class="m-0">5. Lorem ipsum dolor sit amet ?</h5>
                           </CButton>
                           <CCollapse :show="accordion === 4">
                              <CCardBody>
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              </CCardBody>
                           </CCollapse>
                        </CCard>
                     </div>
                  </CCardBody>
                </div>
            </div>
            </div>
          </div> -->
        </main>
      <Ufooter/>
    </u-animate-container>
   </div>
</template>
<script>
   import Uheader from './header'
   import Ufooter from './footer'
   export default {
   data(){
    return{
            accordion     : 0,
   
    }
   },
   components: { 
    Uheader,
    Ufooter
   },
   
   
   }
</script>


