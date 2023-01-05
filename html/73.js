(window.webpackJsonp=window.webpackJsonp||[]).push([[73],{10:function(e,t,r){"use strict";var s=r(4),a=r.n(s),o=Object.defineProperty,i=Object.prototype.hasOwnProperty,n=Object.getOwnPropertySymbols,l=Object.prototype.propertyIsEnumerable,c=(e,t,r)=>t in e?o(e,t,{enumerable:!0,configurable:!0,writable:!0,value:r}):e[t]=r,u=(e,t)=>{for(var r in t||(t={}))i.call(t,r)&&c(e,r,t[r]);if(n)for(var r of n(t))l.call(t,r)&&c(e,r,t[r]);return e};const m=e=>void 0===e,d=e=>Array.isArray(e),p=e=>e&&"number"==typeof e.size&&"string"==typeof e.type&&"function"==typeof e.slice,f=(e,t,r,s)=>((t=t||{}).indices=!m(t.indices)&&t.indices,t.nullsAsUndefineds=!m(t.nullsAsUndefineds)&&t.nullsAsUndefineds,t.booleansAsIntegers=!m(t.booleansAsIntegers)&&t.booleansAsIntegers,t.allowEmptyArrays=!m(t.allowEmptyArrays)&&t.allowEmptyArrays,r=r||new FormData,m(e)||(null===e?t.nullsAsUndefineds||r.append(s,""):(e=>"boolean"==typeof e)(e)?t.booleansAsIntegers?r.append(s,e?1:0):r.append(s,e):d(e)?e.length?e.forEach((e,a)=>{const o=s+"["+(t.indices?a:"")+"]";f(e,t,r,o)}):t.allowEmptyArrays&&r.append(s+"[]",""):(e=>e instanceof Date)(e)?r.append(s,e.toISOString()):!(e=>e===Object(e))(e)||(e=>p(e)&&"string"==typeof e.name&&("object"==typeof e.lastModifiedDate||"number"==typeof e.lastModified))(e)||p(e)?r.append(s,e):Object.keys(e).forEach(a=>{const o=e[a];if(d(o))for(;a.length>2&&a.lastIndexOf("[]")===a.length-2;)a=a.substring(0,a.length-2);f(o,t,r,s?s+"["+a+"]":a)})),r);var h={serialize:f};function b(e){if(null===e||"object"!=typeof e)return e;const t=Array.isArray(e)?[]:{};return Object.keys(e).forEach(r=>{t[r]=b(e[r])}),t}function g(e){return Array.isArray(e)?e:[e]}class y{constructor(){this.errors={},this.errors={}}set(e,t){"object"==typeof e?this.errors=e:this.set(u(u({},this.errors),{[e]:g(t)}))}all(){return this.errors}has(e){return Object.prototype.hasOwnProperty.call(this.errors,e)}hasAny(...e){return e.some(e=>this.has(e))}any(){return Object.keys(this.errors).length>0}get(e){if(this.has(e))return this.getAll(e)[0]}getAll(e){return g(this.errors[e]||[])}only(...e){const t=[];return e.forEach(e=>{const r=this.get(e);r&&t.push(r)}),t}flatten(){return Object.values(this.errors).reduce((e,t)=>e.concat(t),[])}clear(e){const t={};e&&Object.keys(this.errors).forEach(r=>{r!==e&&(t[r]=this.errors[r])}),this.set(t)}}class _{constructor(e={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new y,this.progress=void 0,this.update(e)}static make(e){return new this(e)}update(e){this.originalData=Object.assign({},this.originalData,b(e)),Object.assign(this,e)}fill(e={}){this.keys().forEach(t=>{this[t]=e[t]})}data(){return this.keys().reduce((e,t)=>u(u({},e),{[t]:this[t]}),{})}keys(){return Object.keys(this).filter(e=>!_.ignore.includes(e))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout(()=>{this.recentlySuccessful=!1},_.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter(e=>!_.ignore.includes(e)).forEach(e=>{this[e]=b(this.originalData[e])})}get(e,t={}){return this.submit("get",e,t)}post(e,t={}){return this.submit("post",e,t)}patch(e,t={}){return this.submit("patch",e,t)}put(e,t={}){return this.submit("put",e,t)}delete(e,t={}){return this.submit("delete",e,t)}submit(e,t,r={}){return this.startProcessing(),r=u({data:{},params:{},url:this.route(t),method:e,onUploadProgress:this.handleUploadProgress.bind(this)},r),"get"===e.toLowerCase()?r.params=u(u({},this.data()),r.params):(r.data=u(u({},this.data()),r.data),function e(t){return t instanceof File||t instanceof Blob||t instanceof FileList||"object"==typeof t&&null!==t&&void 0!==Object.values(t).find(t=>e(t))}(r.data)&&!r.transformRequest&&(r.transformRequest=[e=>h.serialize(e)])),new Promise((e,t)=>{(_.axios||a.a).request(r).then(t=>{this.finishProcessing(),e(t)}).catch(e=>{this.handleErrors(e),t(e)})})}handleErrors(e){this.busy=!1,this.progress=void 0,e.response&&this.errors.set(this.extractErrors(e.response))}extractErrors(e){return e.data&&"object"==typeof e.data?e.data.errors?u({},e.data.errors):e.data.message?{error:e.data.message}:u({},e.data):{error:_.errorMessage}}handleUploadProgress(e){this.progress={total:e.total,loaded:e.loaded,percentage:Math.round(100*e.loaded/e.total)}}route(e,t={}){let r=e;return Object.prototype.hasOwnProperty.call(_.routes,e)&&(r=decodeURI(_.routes[e])),"object"!=typeof t&&(t={id:t}),Object.keys(t).forEach(e=>{r=r.replace(`{${e}}`,t[e])}),r}onKeydown(e){const t=e.target;t.name&&this.errors.clear(t.name)}}_.routes={},_.errorMessage="Something went wrong. Please try again.",_.recentlySuccessfulTimeout=2e3,_.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"],t.a=_},27:function(e,t){e.exports={onlyNumric:function(e){var t=(e=e||window.event).which?e.which:e.keyCode;if(!(t>31&&(t<48||t>57)&&46!==t))return!0;e.preventDefault()},hashkey:function(){return Math.random().toString(36).slice(-8)},isMobile:function(){var e=window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth;return!!(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)||e<768)},VueMetaData:function(e){},getPrice:function(e){if(e>=1e7)if((t=(e=(e/1e7).toFixed(2)).split("."))[1]>0)e=e+" Cr";else e=t[0]+" Cr";else if(e>=1e5){if((t=(e=(e/1e5).toFixed(2)).split("."))[1]>0)e=e+" Lacs";else e=t[0]+" Lacs"}else if(e>=1e3){var t;if((t=(e=(e/1e3).toFixed(2)).split("."))[1]>0)e=e+" K";else e=t[0]+" K"}return e},isPhone:function(e){return!!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)}}},842:function(e,t,r){"use strict";r.r(t);var s=r(1),a=r(5),o=r.n(a),i=r(10),n=r(27),l=r.n(n);function c(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);t&&(s=s.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,s)}return r}function u(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?c(r,!0).forEach((function(t){m(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):c(r).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function m(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}var d={data:function(){return{user_id:"",lable:"Add",formData:new i.a({id:"",first_name:"",last_name:"",user_name:"",email:"",role_type:"",phone_number:"",status:0})}},created:function(){this.getRoles(),""!=this.$route.params.id&&null!=this.$route.params.id&&this.getFormData(this.$route.params.id)},computed:u({},Object(s.c)("Users/Index",["rolesResult","returnData","ajax_error","usersResult","editData"])),methods:u({},Object(s.b)("Users/Index",["getRoles","submitForm","edit"]),{onlyNumric:function(e){return l.a.onlyNumric(e)},acceptNumber:function(){var e=this.formData.phone_number.replace(/\D/g,"").match(/(\d{0,3})(\d{0,3})(\d{0,4})/);this.formData.phone_number=e[2]?e[1]+"-"+e[2]+(e[3]?"-"+e[3]:""):e[1]},submitFormData:function(){var e=this;this.submitForm(this.formData).then((function(){"success"==e.returnData.status&&(o.a.$toast.open({message:e.returnData.message,type:e.returnData.status}),e.$router.push({name:"users"}))})).catch((function(e){window.scrollTo(0,0)}))},getFormData:function(e){var t=this;this.user_id=e,this.lable="Edit",this.edit(e).then((function(){t.formData.keys().forEach((function(e){t.formData[e]=t.editData[e]}))})),this.ajax_error.errors=[]},isLetter:function(e){var t=String.fromCharCode(e.keyCode);if(/^[A-Za-z]+$/.test(t))return!0;e.preventDefault()},validateEmail:function(){/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)?this.msg.email="Please enter a valid email address":this.msg.email=""}})},p=r(6),f=Object(p.a)(d,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("CRow",{staticClass:"m-0"},[r("CCol",{staticClass:"p-2",attrs:{sm:"12"}},[r("div",{staticClass:"d-flex justify-content-between align-items-center"},[r("h5",{staticClass:"mb-0"},[e._v("User "),r("vue-fontawesome",{staticClass:"px-1",attrs:{icon:"caret-right",size:"1"}}),e._v(e._s(this.lable))],1),r("div",[r("CButton",{staticClass:"btn_custom mr-1",on:{click:e.submitFormData}},[e._v("Submit")]),e._v(" "),r("router-link",{attrs:{to:{name:"users"}}},[r("CButton",{attrs:{color:"light"}},[e._v("Back")])],1)],1)])]),e._v(" "),r("CCol",{staticClass:"px-2",attrs:{sm:"8"}},[r("CCard",[r("CCardHeader",{staticClass:"p-2 bg_themes"},[r("strong",[e._v(e._s(this.lable)+" User")])]),e._v(" "),r("CCardBody",{staticClass:"px-1 py-2"},[r("CForm",{attrs:{method:"POST"}},[r("CRow",{staticClass:"m-0"},[r("CCol",{staticClass:"form-group px-1",attrs:{sm:"6",lg:"6",md:"6"}},[r("CInput",{staticClass:"mb-0",class:[e.ajax_error.errors.first_name?"formError":""],attrs:{label:"First Name",placeholder:"Enter first name"},on:{keypress:function(t){return e.isLetter(t)}},model:{value:e.formData.first_name,callback:function(t){e.$set(e.formData,"first_name",t)},expression:"formData.first_name"}}),e._v(" "),e.ajax_error.errors.first_name?r("small",{staticClass:"text-danger"},[e._v(e._s(e.ajax_error.errors.first_name[0]))]):e._e()],1),e._v(" "),r("CCol",{staticClass:"form-group px-1",attrs:{sm:"6",lg:"6",md:"6"}},[r("CInput",{staticClass:"mb-0",class:[e.ajax_error.errors.last_name?"formError":""],attrs:{label:"Last Name",placeholder:"Enter last name"},on:{keypress:function(t){return e.isLetter(t)}},model:{value:e.formData.last_name,callback:function(t){e.$set(e.formData,"last_name",t)},expression:"formData.last_name"}}),e._v(" "),e.ajax_error.errors.last_name?r("small",{staticClass:"text-danger"},[e._v(e._s(e.ajax_error.errors.last_name[0]))]):e._e()],1),e._v(" "),r("CCol",{staticClass:"form-group px-1",attrs:{sm:"6",lg:"6",md:"6"}},[r("CInput",{staticClass:"mb-0",class:[e.ajax_error.errors.phone_number?"formError":""],attrs:{label:"Phone Number",maxlength:"12",placeholder:"Enter Number"},on:{blur:e.acceptNumber,input:e.acceptNumber,keypress:function(t){return e.onlyNumric(t)}},model:{value:e.formData.phone_number,callback:function(t){e.$set(e.formData,"phone_number",t)},expression:"formData.phone_number"}}),e._v(" "),e.ajax_error.errors.phone_number?r("small",{staticClass:"text-danger"},[e._v(e._s(e.ajax_error.errors.phone_number[0]))]):e._e()],1),e._v(" "),r("CCol",{staticClass:"form-group px-1",attrs:{sm:"6",lg:"6",md:"6"}},[r("label",[e._v("Select Status ")]),e._v(" "),r("div",{staticClass:"form-group"},[r("select",{directives:[{name:"model",rawName:"v-model",value:e.formData.status,expression:"formData.status"}],staticClass:"form-control",on:{change:function(t){var r=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.$set(e.formData,"status",t.target.multiple?r:r[0])}}},[r("option",{attrs:{value:"0"}},[e._v("Active ")]),e._v(" "),r("option",{attrs:{value:"1"}},[e._v("IN-Active")])])])]),e._v(" "),r("CCol",{staticClass:"form-group px-1",attrs:{sm:"6",lg:"6",md:"6"}},[r("CInput",{staticClass:"mb-0",class:[e.ajax_error.errors.email?"formError":""],attrs:{label:"Email Id",type:"email",placeholder:"Enter email id",autocomplete:"email"},model:{value:e.formData.email,callback:function(t){e.$set(e.formData,"email",t)},expression:"formData.email"}}),e._v(" "),e.ajax_error.errors.email?r("small",{staticClass:"text-danger"},[e._v(e._s(e.ajax_error.errors.email[0]))]):e._e()],1)],1)],1)],1)],1)],1),e._v(" "),""==e.user_id?r("CCol",{staticClass:"px-2",attrs:{sm:"4"}},[r("CCard",[r("CCardBody",{staticClass:"p-2"},[r("CForm",{attrs:{method:"POST"}},[r("CRow",{staticClass:"m-0"},[r("CCol",{staticClass:"form-group px-0",attrs:{sm:"12",lg:"12",md:"12"}},[r("CInput",{staticClass:"mb-0",class:[e.ajax_error.errors.password?"formError":""],attrs:{label:"Password",type:"password",placeholder:"Enter password",autocomplete:"current-password"},model:{value:e.formData.password,callback:function(t){e.$set(e.formData,"password",t)},expression:"formData.password"}}),e._v(" "),e.ajax_error.errors.password?r("small",{staticClass:"text-danger"},[e._v(e._s(e.ajax_error.errors.password[0]))]):e._e()],1),e._v(" "),r("CCol",{staticClass:"form-group px-0",attrs:{sm:"12",lg:"12",md:"12"}},[r("CInput",{staticClass:"mb-0",class:[e.ajax_error.errors.password_confirmation?"formError":""],attrs:{label:"Confirm Password",type:"password",placeholder:"Confirm password",autocomplete:"current-password"},model:{value:e.formData.password_confirmation,callback:function(t){e.$set(e.formData,"password_confirmation",t)},expression:"formData.password_confirmation"}}),e._v(" "),e.ajax_error.errors.password_confirmation?r("small",{staticClass:"text-danger"},[e._v(e._s(e.ajax_error.errors.password_confirmation[0]))]):e._e()],1)],1)],1)],1)],1)],1):e._e()],1)],1)}),[],!1,null,null,null);t.default=f.exports}}]);