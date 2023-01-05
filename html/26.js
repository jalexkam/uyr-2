(window.webpackJsonp=window.webpackJsonp||[]).push([[26],{10:function(t,e,r){"use strict";var s=r(4),a=r.n(s),o=Object.defineProperty,i=Object.prototype.hasOwnProperty,n=Object.getOwnPropertySymbols,c=Object.prototype.propertyIsEnumerable,l=(t,e,r)=>e in t?o(t,e,{enumerable:!0,configurable:!0,writable:!0,value:r}):t[e]=r,u=(t,e)=>{for(var r in e||(e={}))i.call(e,r)&&l(t,r,e[r]);if(n)for(var r of n(e))c.call(e,r)&&l(t,r,e[r]);return t};const m=t=>void 0===t,p=t=>Array.isArray(t),d=t=>t&&"number"==typeof t.size&&"string"==typeof t.type&&"function"==typeof t.slice,h=(t,e,r,s)=>((e=e||{}).indices=!m(e.indices)&&e.indices,e.nullsAsUndefineds=!m(e.nullsAsUndefineds)&&e.nullsAsUndefineds,e.booleansAsIntegers=!m(e.booleansAsIntegers)&&e.booleansAsIntegers,e.allowEmptyArrays=!m(e.allowEmptyArrays)&&e.allowEmptyArrays,r=r||new FormData,m(t)||(null===t?e.nullsAsUndefineds||r.append(s,""):(t=>"boolean"==typeof t)(t)?e.booleansAsIntegers?r.append(s,t?1:0):r.append(s,t):p(t)?t.length?t.forEach((t,a)=>{const o=s+"["+(e.indices?a:"")+"]";h(t,e,r,o)}):e.allowEmptyArrays&&r.append(s+"[]",""):(t=>t instanceof Date)(t)?r.append(s,t.toISOString()):!(t=>t===Object(t))(t)||(t=>d(t)&&"string"==typeof t.name&&("object"==typeof t.lastModifiedDate||"number"==typeof t.lastModified))(t)||d(t)?r.append(s,t):Object.keys(t).forEach(a=>{const o=t[a];if(p(o))for(;a.length>2&&a.lastIndexOf("[]")===a.length-2;)a=a.substring(0,a.length-2);h(o,e,r,s?s+"["+a+"]":a)})),r);var f={serialize:h};function v(t){if(null===t||"object"!=typeof t)return t;const e=Array.isArray(t)?[]:{};return Object.keys(t).forEach(r=>{e[r]=v(t[r])}),e}function _(t){return Array.isArray(t)?t:[t]}class b{constructor(){this.errors={},this.errors={}}set(t,e){"object"==typeof t?this.errors=t:this.set(u(u({},this.errors),{[t]:_(e)}))}all(){return this.errors}has(t){return Object.prototype.hasOwnProperty.call(this.errors,t)}hasAny(...t){return t.some(t=>this.has(t))}any(){return Object.keys(this.errors).length>0}get(t){if(this.has(t))return this.getAll(t)[0]}getAll(t){return _(this.errors[t]||[])}only(...t){const e=[];return t.forEach(t=>{const r=this.get(t);r&&e.push(r)}),e}flatten(){return Object.values(this.errors).reduce((t,e)=>t.concat(e),[])}clear(t){const e={};t&&Object.keys(this.errors).forEach(r=>{r!==t&&(e[r]=this.errors[r])}),this.set(e)}}class g{constructor(t={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new b,this.progress=void 0,this.update(t)}static make(t){return new this(t)}update(t){this.originalData=Object.assign({},this.originalData,v(t)),Object.assign(this,t)}fill(t={}){this.keys().forEach(e=>{this[e]=t[e]})}data(){return this.keys().reduce((t,e)=>u(u({},t),{[e]:this[e]}),{})}keys(){return Object.keys(this).filter(t=>!g.ignore.includes(t))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout(()=>{this.recentlySuccessful=!1},g.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter(t=>!g.ignore.includes(t)).forEach(t=>{this[t]=v(this.originalData[t])})}get(t,e={}){return this.submit("get",t,e)}post(t,e={}){return this.submit("post",t,e)}patch(t,e={}){return this.submit("patch",t,e)}put(t,e={}){return this.submit("put",t,e)}delete(t,e={}){return this.submit("delete",t,e)}submit(t,e,r={}){return this.startProcessing(),r=u({data:{},params:{},url:this.route(e),method:t,onUploadProgress:this.handleUploadProgress.bind(this)},r),"get"===t.toLowerCase()?r.params=u(u({},this.data()),r.params):(r.data=u(u({},this.data()),r.data),function t(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find(e=>t(e))}(r.data)&&!r.transformRequest&&(r.transformRequest=[t=>f.serialize(t)])),new Promise((t,e)=>{(g.axios||a.a).request(r).then(e=>{this.finishProcessing(),t(e)}).catch(t=>{this.handleErrors(t),e(t)})})}handleErrors(t){this.busy=!1,this.progress=void 0,t.response&&this.errors.set(this.extractErrors(t.response))}extractErrors(t){return t.data&&"object"==typeof t.data?t.data.errors?u({},t.data.errors):t.data.message?{error:t.data.message}:u({},t.data):{error:g.errorMessage}}handleUploadProgress(t){this.progress={total:t.total,loaded:t.loaded,percentage:Math.round(100*t.loaded/t.total)}}route(t,e={}){let r=t;return Object.prototype.hasOwnProperty.call(g.routes,t)&&(r=decodeURI(g.routes[t])),"object"!=typeof e&&(e={id:e}),Object.keys(e).forEach(t=>{r=r.replace(`{${t}}`,e[t])}),r}onKeydown(t){const e=t.target;e.name&&this.errors.clear(e.name)}}g.routes={},g.errorMessage="Something went wrong. Please try again.",g.recentlySuccessfulTimeout=2e3,g.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"],e.a=g},27:function(t,e){t.exports={onlyNumric:function(t){var e=(t=t||window.event).which?t.which:t.keyCode;if(!(e>31&&(e<48||e>57)&&46!==e))return!0;t.preventDefault()},hashkey:function(){return Math.random().toString(36).slice(-8)},isMobile:function(){var t=window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth;return!!(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)||t<768)},VueMetaData:function(t){},getPrice:function(t){if(t>=1e7)if((e=(t=(t/1e7).toFixed(2)).split("."))[1]>0)t=t+" Cr";else t=e[0]+" Cr";else if(t>=1e5){if((e=(t=(t/1e5).toFixed(2)).split("."))[1]>0)t=t+" Lacs";else t=e[0]+" Lacs"}else if(t>=1e3){var e;if((e=(t=(t/1e3).toFixed(2)).split("."))[1]>0)t=t+" K";else t=e[0]+" K"}return t},isPhone:function(t){return!!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)}}},28:function(t,e,r){"use strict";var s={name:"Uheader",data:function(){return{isActive:!1}}},a=r(6),o=Object(a.a)(s,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("header",{staticClass:"header"},[r("div",{staticClass:"top-header-bar"},[r("div",{staticClass:"container"},[r("div",{staticClass:"top-header"},[r("div",{staticClass:"top-header-right"},[r("ul",[r("li",[r("vue-fontawesome",{attrs:{icon:"volume-control-phone",size:"0.9"}}),t._v(" "),r("a",{attrs:{href:"tel:+496170961709"}},[t._v("Customer Support")])],1),t._v(" "),r("li",[r("vue-fontawesome",{attrs:{icon:"user-circle-o",size:"0.9"}}),t._v(" "),r("router-link",{attrs:{to:"login"}},[t._v("\n                                Login")])],1),t._v(" "),r("li",[r("vue-fontawesome",{attrs:{icon:"user",size:"0.9"}}),t._v(" "),r("router-link",{attrs:{to:"register"}},[t._v("Register")])],1)])])])])]),t._v(" "),r("div",{staticClass:"container"},[r("div",{staticClass:"main-header"},[r("div",{staticClass:"logo"},[r("router-link",{attrs:{to:{name:"homepage"}}},[r("img",{attrs:{src:"images/uyr_logo.png",width:"180",alt:"Logo"}})])],1),t._v(" "),r("div",{staticClass:"menu"},[r("ul",{staticClass:"menu_ul",class:{active:t.isActive}},[r("li",[r("router-link",{attrs:{to:{name:"homepage"}}},[r("vue-fontawesome",{staticClass:"mr-1",attrs:{icon:"home",size:"1"}}),t._v("Home")],1)],1),t._v(" "),r("li",[r("router-link",{attrs:{to:{name:"about"}}},[r("vue-fontawesome",{staticClass:"mr-1",attrs:{icon:"users",size:"1"}}),t._v("About Us")],1)],1),t._v(" "),r("li",[r("router-link",{attrs:{to:{name:"career"}}},[r("vue-fontawesome",{staticClass:"mr-1",attrs:{icon:"briefcase",size:"1"}}),t._v("Careers")],1)],1),t._v(" "),r("li",[r("router-link",{attrs:{to:{name:"blog"}}},[r("vue-fontawesome",{staticClass:"mr-1",attrs:{icon:"pencil-square-o",size:"1"}}),t._v("Articles")],1)],1),t._v(" "),r("li",[r("router-link",{attrs:{to:{name:"contact"}}},[r("vue-fontawesome",{staticClass:"mr-1",attrs:{icon:"map-marker",size:"1"}}),t._v(" Contact Us")],1)],1)]),t._v(" "),r("div",{staticClass:"hamburger menutoggle",class:{active:t.isActive},attrs:{id:"hamburger-6"},on:{click:function(e){t.isActive=!t.isActive}}},[r("span",{staticClass:"line"}),t._v(" "),r("span",{staticClass:"line"}),t._v(" "),r("span",{staticClass:"line"})])])])])]),t._v(" "),r("div",{staticClass:"menu_overlay",class:{active:t.isActive},on:{click:function(e){t.isActive=!t.isActive}}})])}),[],!1,null,null,null);e.a=o.exports},29:function(t,e,r){"use strict";var s=r(82),a={name:"Ufooter",data:function(){return{}},components:{UAnimateContainer:s.UAnimateContainer,UAnimate:s.UAnimate}},o=r(6),i=Object(o.a)(a,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("div",{staticClass:"footer_bottom text-center"},[e("div",{staticClass:"container"},[e("div",{staticClass:"f_bottm"},[this._m(0),this._v(" "),e("div",{staticClass:"f_left"},[e("ul",[e("li",[e("router-link",{attrs:{to:{name:"privacy-policy"}}},[this._v("Privacy & Policy")])],1),this._v(" "),e("li",[e("router-link",{attrs:{to:{name:"terms-condition"}}},[this._v("Terms & Conditions")])],1)])])])])])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"f_left"},[e("p",[this._v("2022 © All Rights Reserved.")])])}],!1,null,null,null);e.a=i.exports},820:function(t,e,r){"use strict";r.r(e);var s=r(19),a=r.n(s),o=r(5),i=r.n(o),n=r(10),c=r(4),l=r.n(c),u=r(1),m=r(24),p=r.n(m),d=(r(38),r(27)),h=r.n(d),f=r(28),v=r(29);function _(t,e,r,s,a,o,i){try{var n=t[o](i),c=n.value}catch(t){return void r(t)}n.done?e(c):Promise.resolve(c).then(s,a)}function b(t){return function(){var e=this,r=arguments;return new Promise((function(s,a){var o=t.apply(e,r);function i(t){_(o,s,a,i,n,"next",t)}function n(t){_(o,s,a,i,n,"throw",t)}i(void 0)}))}}function g(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,s)}return r}function y(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?g(r,!0).forEach((function(e){C(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):g(r).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function C(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}i.a.use(p.a);var w,x,j,k={name:"Regiter",data:function(){return{form:new n.a({last_name:"",first_name:"",user_name:"",email:"",password:"",password_confirmation:"",phone_number:"",type:"user"}),status:"",message:"",isbtnDisabled:!1,isSpinner:!1,otpSentFlag:!1,Custloader:"none",position:"right top",remember:!1,formError:""}},components:{Uheader:f.a,Ufooter:v.a},created:function(){this.ajax_error.errors=[],this.fetchUser(),setInterval(function(){$(".alertDiv").hide()}.bind(this),2e4)},computed:y({},Object(u.c)("auth",["returnData","ajax_error","userData"])),methods:y({},Object(u.b)("auth",["registerUser","resetState","fetchUser"]),{onlyNumric:function(t){return h.a.onlyNumric(t)},acceptNumber:function(){var t=this.form.phone_number.replace(/\D/g,"").match(/(\d{0,3})(\d{0,3})(\d{0,4})/);this.form.phone_number=t[2]?t[1]+"-"+t[2]+(t[3]?"-"+t[3]:""):t[1]},register:(j=b(a.a.mark((function t(){var e=this;return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:this.isbtnDisabled=!0,this.isSpinner=!0,this.registerUser(this.form).then((function(){"success"==e.returnData.data.status&&(i.a.$toast.open({message:e.returnData.data.message,type:e.returnData.data.status,position:"top-right"}),e.$router.push({name:"login"}).catch((function(){}))),e.isbtnDisabled=!1,e.isSpinner=!1})).catch((function(t){e.isbtnDisabled=!1,e.isSpinner=!1}));case 3:case"end":return t.stop()}}),t,this)}))),function(){return j.apply(this,arguments)}),fetchUser:(x=b(a.a.mark((function t(){var e,r;return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,l.a.get("/api/get_user");case 3:e=t.sent,r=e.data,this.user=r,""!=this.user&&this.$router.push({path:"dashboard"}),t.next=11;break;case 9:t.prev=9,t.t0=t.catch(0);case 11:case"end":return t.stop()}}),t,this,[[0,9]])}))),function(){return x.apply(this,arguments)}),saveTokenUser:(w=b(a.a.mark((function t(e){return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:this.$store.dispatch("auth/saveToken",{token:e,remember:this.remember}),this.$store.dispatch("auth/fetchUser"),this.$router.push({path:"dashboard"});case 4:case"end":return t.stop()}}),t,this)}))),function(t){return w.apply(this,arguments)})})},O=r(6),A=Object(O.a)(k,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{},[r("Uheader"),t._v(" "),r("main",{staticClass:"pts"},[r("CContainer",{attrs:{fluid:""}},[r("CRow",[r("CCol",{attrs:{lg:"6"}},[r("div",{staticClass:"login_logoo"},[r("img",{attrs:{src:"images/uyr_logo.png",alt:"Logo",width:"200px"}})])]),t._v(" "),r("CCol",{attrs:{lg:"6"}},[r("div",{staticClass:"log_head"},[r("CButton",{attrs:{to:"doctor_register",size:"sm"}},[r("vue-fontawesome",{staticClass:"mr-2 my-0",attrs:{icon:"user-md",size:"1.1"}}),t._v("for Doctor")],1)],1),t._v(" "),t.otpSentFlag?r("div",{staticClass:"register_section justify-content-center"},[r("div",{staticClass:"gif_check_animation"},[r("svg",{staticClass:"checkmark",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 52 52"}},[r("circle",{staticClass:"checkmark__circle",attrs:{cx:"26",cy:"26",r:"25",fill:"none"}}),t._v(" "),r("path",{staticClass:"checkmark__check",attrs:{fill:"none",d:"M14.1 27.2l7.1 7.2 16.7-16.8"}})]),t._v(" "),r("h2",[t._v("OTP Sent")]),t._v(" "),r("p",{staticClass:"text-center"},[t._v("A One Time Password(OTP) has been sent to your registered Email Id")])])]):r("div",{staticClass:"register_section"},[r("div",{staticClass:"register_form login_form"},[r("div",{staticClass:"text-center"},[r("h2",[t._v("User Register")])]),t._v(" "),r("div",{staticClass:"l_form"},[r("CForm",{staticClass:"validate-form",on:{submit:function(e){return e.preventDefault(),t.register.apply(null,arguments)},keydown:function(e){return t.form.onKeydown(e)}}},[r("CRow",[r("CCol",{attrs:{sm:"6"}},[r("div",{staticClass:"pos_relative"},[r("CInput",{staticClass:"cust-form-cont mb-0",class:[t.ajax_error.errors.first_name?"formError":""],attrs:{label:"First Name*",type:"text",placeholder:"First Name",autocomplete:""},model:{value:t.form.first_name,callback:function(e){t.$set(t.form,"first_name",e)},expression:"form.first_name"}}),t._v(" "),t.ajax_error.errors.first_name?r("small",{staticClass:"text-danger mb-0"},[t._v("\n                          "+t._s(t.ajax_error.errors.first_name[0])+"\n                        ")]):t._e()],1)]),t._v(" "),r("CCol",{attrs:{sm:"6"}},[r("div",{staticClass:"pos_relative"},[r("CInput",{staticClass:"cust-form-cont mb-0",class:[t.ajax_error.errors.last_name?"formError":""],attrs:{label:"Last Name*",type:"text",placeholder:"Last Name",autocomplete:""},model:{value:t.form.last_name,callback:function(e){t.$set(t.form,"last_name",e)},expression:"form.last_name"}}),t._v(" "),t.ajax_error.errors.last_name?r("small",{staticClass:"text-danger mb-0"},[t._v("\n                          "+t._s(t.ajax_error.errors.last_name[0])+"\n                        ")]):t._e()],1)]),t._v(" "),r("CCol",{attrs:{sm:"6"}},[r("div",{staticClass:"pos_relative"},[r("CInput",{staticClass:"cust-form-cont mb-0",class:[t.ajax_error.errors.email?"formError":""],attrs:{label:"Email ID*",placeholder:"test@exmaple.com",type:"email",autocomplete:""},model:{value:t.form.email,callback:function(e){t.$set(t.form,"email",e)},expression:"form.email"}}),t._v(" "),t.ajax_error.errors.email?r("small",{staticClass:"text-danger mb-0"},[t._v("\n                          "+t._s(t.ajax_error.errors.email[0])+"\n                        ")]):t._e()],1)]),t._v(" "),r("CCol",{attrs:{sm:"6"}},[r("div",{staticClass:"pos_relative"},[r("CInput",{staticClass:"cust-form-cont mb-0",class:[t.ajax_error.errors.phone_number?"formError":""],attrs:{label:"Phone No.*",maxlength:"12",placeholder:"9876543210",type:"tel",autocomplete:""},on:{blur:t.acceptNumber,input:t.acceptNumber,keypress:function(e){return t.onlyNumric(e)}},model:{value:t.form.phone_number,callback:function(e){t.$set(t.form,"phone_number",e)},expression:"form.phone_number"}}),t._v(" "),t.ajax_error.errors.phone_number?r("small",{staticClass:"text-danger mb-0"},[t._v("\n                          "+t._s(t.ajax_error.errors.phone_number[0])+"\n                        ")]):t._e()],1)]),t._v(" "),r("CCol",{attrs:{sm:"6"}},[r("div",{staticClass:"pos_relative"},[r("CInput",{staticClass:"cust-form-cont mb-0",class:[t.ajax_error.errors.password?"formError":""],attrs:{name:"password",label:"Password*",placeholder:"*******",type:"password",autocomplete:""},model:{value:t.form.password,callback:function(e){t.$set(t.form,"password",e)},expression:"form.password"}}),t._v(" "),t.ajax_error.errors.password?r("small",{staticClass:"text-danger mb-0"},[t._v("\n                          "+t._s(t.ajax_error.errors.password[0])+"\n                        ")]):t._e()],1)]),t._v(" "),r("CCol",{attrs:{sm:"6"}},[r("div",{staticClass:"pos_relative"},[r("CInput",{staticClass:"cust-form-cont mb-0",class:[t.ajax_error.errors.password_confirmation?"formError":""],attrs:{name:"password_confirmation",label:"Confirm Password*",placeholder:"*******",type:"password",autocomplete:""},model:{value:t.form.password_confirmation,callback:function(e){t.$set(t.form,"password_confirmation",e)},expression:"form.password_confirmation"}}),t._v(" "),t.ajax_error.errors.password_confirmation?r("small",{staticClass:"text-danger mb-0"},[t._v("\n                          "+t._s(t.ajax_error.errors.password_confirmation[0])+"\n                        ")]):t._e()],1)])],1),t._v(" "),r("CRow",[r("CCol",{staticClass:"text-center",attrs:{col:"12"}},[r("CButton",{staticClass:"submitbtn btn",attrs:{disabled:t.isbtnDisabled,type:"submit"}},[t.isSpinner?r("span",{staticClass:"spinner-border spinner-border-sm",attrs:{role:"status","aria-hidden":"true"}}):t._e(),t._v(" Register")])],1)],1),t._v(" "),r("CRow")],1)],1)])])])],1)],1)],1),t._v(" "),r("Ufooter")],1)}),[],!1,null,null,null);e.default=A.exports}}]);