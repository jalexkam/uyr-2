(window.webpackJsonp=window.webpackJsonp||[]).push([[35],{10:function(t,e,s){"use strict";var r=s(4),a=s.n(r),i=Object.defineProperty,o=Object.prototype.hasOwnProperty,n=Object.getOwnPropertySymbols,c=Object.prototype.propertyIsEnumerable,l=(t,e,s)=>e in t?i(t,e,{enumerable:!0,configurable:!0,writable:!0,value:s}):t[e]=s,u=(t,e)=>{for(var s in e||(e={}))o.call(e,s)&&l(t,s,e[s]);if(n)for(var s of n(e))c.call(e,s)&&l(t,s,e[s]);return t};const d=t=>void 0===t,h=t=>Array.isArray(t),p=t=>t&&"number"==typeof t.size&&"string"==typeof t.type&&"function"==typeof t.slice,m=(t,e,s,r)=>((e=e||{}).indices=!d(e.indices)&&e.indices,e.nullsAsUndefineds=!d(e.nullsAsUndefineds)&&e.nullsAsUndefineds,e.booleansAsIntegers=!d(e.booleansAsIntegers)&&e.booleansAsIntegers,e.allowEmptyArrays=!d(e.allowEmptyArrays)&&e.allowEmptyArrays,s=s||new FormData,d(t)||(null===t?e.nullsAsUndefineds||s.append(r,""):(t=>"boolean"==typeof t)(t)?e.booleansAsIntegers?s.append(r,t?1:0):s.append(r,t):h(t)?t.length?t.forEach((t,a)=>{const i=r+"["+(e.indices?a:"")+"]";m(t,e,s,i)}):e.allowEmptyArrays&&s.append(r+"[]",""):(t=>t instanceof Date)(t)?s.append(r,t.toISOString()):!(t=>t===Object(t))(t)||(t=>p(t)&&"string"==typeof t.name&&("object"==typeof t.lastModifiedDate||"number"==typeof t.lastModified))(t)||p(t)?s.append(r,t):Object.keys(t).forEach(a=>{const i=t[a];if(h(i))for(;a.length>2&&a.lastIndexOf("[]")===a.length-2;)a=a.substring(0,a.length-2);m(i,e,s,r?r+"["+a+"]":a)})),s);var f={serialize:m};function g(t){if(null===t||"object"!=typeof t)return t;const e=Array.isArray(t)?[]:{};return Object.keys(t).forEach(s=>{e[s]=g(t[s])}),e}function b(t){return Array.isArray(t)?t:[t]}class y{constructor(){this.errors={},this.errors={}}set(t,e){"object"==typeof t?this.errors=t:this.set(u(u({},this.errors),{[t]:b(e)}))}all(){return this.errors}has(t){return Object.prototype.hasOwnProperty.call(this.errors,t)}hasAny(...t){return t.some(t=>this.has(t))}any(){return Object.keys(this.errors).length>0}get(t){if(this.has(t))return this.getAll(t)[0]}getAll(t){return b(this.errors[t]||[])}only(...t){const e=[];return t.forEach(t=>{const s=this.get(t);s&&e.push(s)}),e}flatten(){return Object.values(this.errors).reduce((t,e)=>t.concat(e),[])}clear(t){const e={};t&&Object.keys(this.errors).forEach(s=>{s!==t&&(e[s]=this.errors[s])}),this.set(e)}}class v{constructor(t={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new y,this.progress=void 0,this.update(t)}static make(t){return new this(t)}update(t){this.originalData=Object.assign({},this.originalData,g(t)),Object.assign(this,t)}fill(t={}){this.keys().forEach(e=>{this[e]=t[e]})}data(){return this.keys().reduce((t,e)=>u(u({},t),{[e]:this[e]}),{})}keys(){return Object.keys(this).filter(t=>!v.ignore.includes(t))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout(()=>{this.recentlySuccessful=!1},v.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter(t=>!v.ignore.includes(t)).forEach(t=>{this[t]=g(this.originalData[t])})}get(t,e={}){return this.submit("get",t,e)}post(t,e={}){return this.submit("post",t,e)}patch(t,e={}){return this.submit("patch",t,e)}put(t,e={}){return this.submit("put",t,e)}delete(t,e={}){return this.submit("delete",t,e)}submit(t,e,s={}){return this.startProcessing(),s=u({data:{},params:{},url:this.route(e),method:t,onUploadProgress:this.handleUploadProgress.bind(this)},s),"get"===t.toLowerCase()?s.params=u(u({},this.data()),s.params):(s.data=u(u({},this.data()),s.data),function t(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find(e=>t(e))}(s.data)&&!s.transformRequest&&(s.transformRequest=[t=>f.serialize(t)])),new Promise((t,e)=>{(v.axios||a.a).request(s).then(e=>{this.finishProcessing(),t(e)}).catch(t=>{this.handleErrors(t),e(t)})})}handleErrors(t){this.busy=!1,this.progress=void 0,t.response&&this.errors.set(this.extractErrors(t.response))}extractErrors(t){return t.data&&"object"==typeof t.data?t.data.errors?u({},t.data.errors):t.data.message?{error:t.data.message}:u({},t.data):{error:v.errorMessage}}handleUploadProgress(t){this.progress={total:t.total,loaded:t.loaded,percentage:Math.round(100*t.loaded/t.total)}}route(t,e={}){let s=t;return Object.prototype.hasOwnProperty.call(v.routes,t)&&(s=decodeURI(v.routes[t])),"object"!=typeof e&&(e={id:e}),Object.keys(e).forEach(t=>{s=s.replace(`{${t}}`,e[t])}),s}onKeydown(t){const e=t.target;e.name&&this.errors.clear(e.name)}}v.routes={},v.errorMessage="Something went wrong. Please try again.",v.recentlySuccessfulTimeout=2e3,v.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"],e.a=v},180:function(t,e,s){var r=s(448);"string"==typeof r&&(r=[[t.i,r,""]]);var a={hmr:!0,transform:void 0,insertInto:void 0};s(16)(r,a);r.locals&&(t.exports=r.locals)},447:function(t,e,s){"use strict";s(180)},448:function(t,e,s){(t.exports=s(15)(!1)).push([t.i,"\n.blog-img{\n      display: -webkit-box;\n      display: -ms-flexbox;\n      display: flex;\n      -webkit-box-align: center;\n          -ms-flex-align: center;\n              align-items: center;\n}\n.blogimg {\n    width: 320px;\n    height: 200px;\n    border: 2px solid #2c449e;\n    overflow: hidden;\n    margin-right: 16px;\n}\n.blogimg img {\n    width: 100%;\n    height: 100%;\n    -o-object-fit: cover;\n    object-fit: cover;\n}\n.blog-img .file {\n    position: relative;\n}\n.blog-img .file input {\n    position: absolute;\n    opacity: 0;\n    right: 0;\n    top: 0;\n    cursor: pointer;\n    width: 100%;\n    height: 100%;\n}\n",""])},877:function(t,e,s){"use strict";s.r(e);var r=s(5),a=s.n(r),i=s(10),o=s(33),n=s(1);function c(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,r)}return s}function l(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?c(s,!0).forEach((function(e){u(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):c(s).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}function u(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}var d={components:{VueEditor:o.a},data:function(){return u({id:"",show:!1,showModal:!0,formData:new i.a({id:"",title:"",description:"",author_name:""}),picture:"",imageDoc:[]},"id",0)},created:function(){""!=this.$route.params.id&&null!=this.$route.params.id&&(this.id=this.$route.params.id,this.getFormData(this.$route.params.id))},computed:l({},Object(n.c)("ManageWebsite/Blog",["returnData","editData"])),methods:l({},Object(n.b)("ManageWebsite/Blog",["submitForm","edit"]),{getFormData:function(t){var e=this;this.edit(t).then((function(){e.formData.keys().forEach((function(t){e.formData[t]=e.editData[t]}))}))},onImageChange:function(t){var e=this;this.picture=t.target.files[0];var s=new FileReader;s.onload=function(t){e.imageDoc=t.target.result},s.readAsDataURL(this.picture)},submitFormData:function(){var t=this,e=new FormData;e.append("file",this.picture),e.append("formData",JSON.stringify(this.formData)),this.id=this.formData.id,this.submitForm({newData:e,id:this.id}).then((function(){"success"==t.returnData.status&&(a.a.$toast.open({message:t.returnData.message,type:t.returnData.status,position:"bottom-left",duration:5e3}),t.$router.push({name:"manage-website-blog"}))})).catch((function(t){}))}})},h=(s(447),s(6)),p=Object(h.a)(d,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[s("CRow",{staticClass:"m-0"},[s("CCol",{staticClass:"px-2 btn-sticky",attrs:{sm:"12"}},[s("div",{staticClass:"d-flex justify-content-between py-2 align-items-center"},[s("h5",{staticClass:"mb-0"},[t._v("Blog "),s("vue-fontawesome",{staticClass:"px-1",attrs:{icon:"caret-right",size:"1"}}),t._v("Add")],1),t._v(" "),s("div",{},[s("router-link",{attrs:{to:{name:"manage-website-blog"}}},[s("CButton",{attrs:{size:"sm",color:"light"}},[t._v("Back")])],1)],1)])]),t._v(" "),s("CCol",{staticClass:"p-2",attrs:{sm:"9"}},[s("CCard",{staticClass:"mb-0"},[s("CCardHeader",{staticClass:"p-2 px-3 bg_themes"},[s("div",[s("strong",[t._v("Blog Details")])])]),t._v(" "),s("CCardBody",{staticClass:"px-1 py-2"},[s("CForm",[s("CRow",{staticClass:"m-0"},[s("CCol",{staticClass:"px-2",attrs:{sm:"12",md:"12"}},[s("div",{staticClass:"form-group"},[s("label",[t._v("Blog Image")]),t._v(" "),s("div",{staticClass:"blog-img rounded p-1"},[s("div",{staticClass:"blogimg"},[t.editData.image_name&&""==t.imageDoc?s("img",{attrs:{src:"uploads/blog/"+t.editData.id+"/"+t.editData.image_name}}):t.imageDoc&&""!=t.imageDoc?s("img",{staticClass:"img-fluid",attrs:{src:t.imageDoc}}):s("img",{attrs:{src:"/images/dummy_banner.jpg"}})]),t._v(" "),s("button",{staticClass:"file btn btn-sm upload_btn text-center"},[s("vue-fontawesome",{staticClass:"px-1 mr-2",attrs:{icon:"upload",size:"0.8"}}),t._v("\n                              Upload Image\n                              "),s("input",{attrs:{type:"file",name:"profile_picture"},on:{change:t.onImageChange}})],1)])])]),t._v(" "),s("CCol",{staticClass:"px-2",attrs:{sm:"6",md:"6"}},[s("CInput",{attrs:{label:"Title",placeholder:""},model:{value:t.formData.title,callback:function(e){t.$set(t.formData,"title",e)},expression:"formData.title"}})],1),t._v(" "),s("CCol",{staticClass:"px-2",attrs:{sm:"6",md:"6"}},[s("CInput",{attrs:{label:"Author Name",placeholder:""},model:{value:t.formData.author_name,callback:function(e){t.$set(t.formData,"author_name",e)},expression:"formData.author_name"}})],1),t._v(" "),s("CCol",{staticClass:"px-2",attrs:{sm:"12"}},[s("div",{staticClass:"form-group"},[s("label",[t._v("Blog Description")]),t._v(" "),s("vue-editor",{model:{value:t.formData.description,callback:function(e){t.$set(t.formData,"description",e)},expression:"formData.description"}})],1)])],1)],1)],1)],1)],1),t._v(" "),s("CCol",{staticClass:"p-2",attrs:{sm:"3"}},[s("CCard",[s("CCardBody",{staticClass:"p-2"},[s("CButton",{staticClass:"text-white mx-auto d-block w-75 p-2 mb-3",attrs:{size:"sm",color:"info"},on:{click:t.submitFormData}},[s("vue-fontawesome",{staticClass:"mr-1",attrs:{icon:"upload",size:"0.8"}}),t._v("Publish")],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null);e.default=p.exports}}]);