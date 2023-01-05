(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[129],{

/***/ "../coreui/node_modules/vform/dist/vform.es.js":
/*!*****************************************************!*\
  !*** ../coreui/node_modules/vform/dist/vform.es.js ***!
  \*****************************************************/
/*! exports provided: default, Errors, Form */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/var/www/html/uyr/coreui/node_modules/vform/dist/vform.es.js'");

/***/ }),

/***/ "../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css&":
/*!************************************************************************************************************!*\
  !*** ../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css& ***!
  \************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _laravel_node_modules_style_loader_index_js_laravel_node_modules_css_loader_index_js_ref_6_1_laravel_node_modules_vue_loader_lib_loaders_stylePostLoader_js_laravel_node_modules_postcss_loader_src_index_js_ref_6_2_vue_multiselect_min_css_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../laravel/node_modules/style-loader!../../../../laravel/node_modules/css-loader??ref--6-1!../../../../laravel/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../laravel/node_modules/postcss-loader/src??ref--6-2!./vue-multiselect.min.css?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css&");
/* harmony import */ var _laravel_node_modules_style_loader_index_js_laravel_node_modules_css_loader_index_js_ref_6_1_laravel_node_modules_vue_loader_lib_loaders_stylePostLoader_js_laravel_node_modules_postcss_loader_src_index_js_ref_6_2_vue_multiselect_min_css_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_laravel_node_modules_style_loader_index_js_laravel_node_modules_css_loader_index_js_ref_6_1_laravel_node_modules_vue_loader_lib_loaders_stylePostLoader_js_laravel_node_modules_postcss_loader_src_index_js_ref_6_2_vue_multiselect_min_css_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _laravel_node_modules_style_loader_index_js_laravel_node_modules_css_loader_index_js_ref_6_1_laravel_node_modules_vue_loader_lib_loaders_stylePostLoader_js_laravel_node_modules_postcss_loader_src_index_js_ref_6_2_vue_multiselect_min_css_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _laravel_node_modules_style_loader_index_js_laravel_node_modules_css_loader_index_js_ref_6_1_laravel_node_modules_vue_loader_lib_loaders_stylePostLoader_js_laravel_node_modules_postcss_loader_src_index_js_ref_6_2_vue_multiselect_min_css_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.js":
/*!**************************************************************************!*\
  !*** ../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.js ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/var/www/html/uyr/coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.js'");

/***/ }),

/***/ "../coreui/src/global_helper/helpers.js":
/*!**********************************************!*\
  !*** ../coreui/src/global_helper/helpers.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = {
  //Get Slug
  onlyNumric: function onlyNumric(evt) {
    evt = evt ? evt : window.event;
    var charCode = evt.which ? evt.which : evt.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 46) {
      evt.preventDefault();
    } else {
      return true;
    }
  },
  hashkey: function hashkey() {
    var randomstring = Math.random().toString(36).slice(-8);
    return randomstring;
  },
  isMobile: function isMobile() {
    var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || width < 768) {
      return true;
    } else {
      return false;
    }
  },
  VueMetaData: function VueMetaData(metaData) {},
  getPrice: function getPrice(val) {
    if (val >= 10000000) {
      val = (val / 10000000).toFixed(2);
      var num1 = val.split('.');

      if (num1[1] > 0) {
        var val = val + ' Cr';
      } else {
        var val = num1[0] + ' Cr';
      }
    } else if (val >= 100000) {
      var val = (val / 100000).toFixed(2);
      var num1 = val.split('.');

      if (num1[1] > 0) {
        var val = val + ' Lacs';
      } else {
        var val = num1[0] + ' Lacs';
      } //val = (val/100000).toFixed(2) + ' Lacs';

    } else if (val >= 1000) {
      var val = (val / 1000).toFixed(2);
      var num1 = val.split('.');

      if (num1[1] > 0) {
        var val = val + ' K';
      } else {
        var val = num1[0] + ' K';
      } //val = (val/1000).toFixed(2) + ' K';

    }

    return val;
  },
  isPhone: function isPhone(val) {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      return true;
    } else {
      return false;
    }
  }
};

/***/ }),

/***/ "../coreui/src/views/settings/update_doctor.vue":
/*!******************************************************!*\
  !*** ../coreui/src/views/settings/update_doctor.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _update_doctor_vue_vue_type_template_id_32f719f3___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./update_doctor.vue?vue&type=template&id=32f719f3& */ "../coreui/src/views/settings/update_doctor.vue?vue&type=template&id=32f719f3&");
/* harmony import */ var _update_doctor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./update_doctor.vue?vue&type=script&lang=js& */ "../coreui/src/views/settings/update_doctor.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var vue_multiselect_dist_vue_multiselect_min_css_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css& */ "../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css&");
/* harmony import */ var _laravel_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../laravel/node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_laravel_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _update_doctor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _update_doctor_vue_vue_type_template_id_32f719f3___WEBPACK_IMPORTED_MODULE_0__["render"],
  _update_doctor_vue_vue_type_template_id_32f719f3___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "coreui/src/views/settings/update_doctor.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "../coreui/src/views/settings/update_doctor.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ../coreui/src/views/settings/update_doctor.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _laravel_node_modules_babel_loader_lib_index_js_ref_4_0_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_update_doctor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../laravel/node_modules/babel-loader/lib??ref--4-0!../../../../laravel/node_modules/vue-loader/lib??vue-loader-options!./update_doctor.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/settings/update_doctor.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_laravel_node_modules_babel_loader_lib_index_js_ref_4_0_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_update_doctor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "../coreui/src/views/settings/update_doctor.vue?vue&type=template&id=32f719f3&":
/*!*************************************************************************************!*\
  !*** ../coreui/src/views/settings/update_doctor.vue?vue&type=template&id=32f719f3& ***!
  \*************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _laravel_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_update_doctor_vue_vue_type_template_id_32f719f3___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../laravel/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../laravel/node_modules/vue-loader/lib??vue-loader-options!./update_doctor.vue?vue&type=template&id=32f719f3& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/settings/update_doctor.vue?vue&type=template&id=32f719f3&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _laravel_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_update_doctor_vue_vue_type_template_id_32f719f3___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _laravel_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_update_doctor_vue_vue_type_template_id_32f719f3___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/settings/update_doctor.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!../coreui/src/views/settings/update_doctor.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "../coreui/node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue */ "../coreui/node_modules/vue/dist/vue.common.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var vform__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vform */ "../coreui/node_modules/vform/dist/vform.es.js");
/* harmony import */ var vue_multiselect__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vue-multiselect */ "../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.js");
/* harmony import */ var vue_multiselect__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(vue_multiselect__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _global_helper_helpers_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./../../global_helper/helpers.js */ "../coreui/src/global_helper/helpers.js");
/* harmony import */ var _global_helper_helpers_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_global_helper_helpers_js__WEBPACK_IMPORTED_MODULE_4__);
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(source, true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(source).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//






/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    Multiselect: vue_multiselect__WEBPACK_IMPORTED_MODULE_3___default.a
  },
  data: function data() {
    var _ref;

    return {
      address: "",
      autocompleteOptions: {
        componentRestrictions: {//country:  'UK',
        }
      },
      ADDRESS_COMPONENTS: {
        subpremise: "short_name",
        street_number: "short_name",
        route: "long_name",
        locality: "long_name",
        administrative_area_level_1: "long_name",
        administrative_area_level_2: "long_name",
        sublocality_level_2: "long_name",
        sublocality_level_1: "long_name",
        area: "long_name",
        country: "long_name",
        postal_code: "short_name"
      },
      center: {
        lat: 0,
        lng: 0
      },
      currentPlace: null,
      markers: [],
      places: [],
      formData: new vform__WEBPACK_IMPORTED_MODULE_2__["default"]((_ref = {
        id: "",
        user_id: "",
        first_name: "",
        last_name: "",
        user_name: "",
        email: "",
        phone_number: "",
        age: "",
        gender: "",
        certificate_awarding_university: "",
        speciality_diploma: "",
        copy_of_registration: "",
        medical_council_regn: "",
        current_clinic_hospital: "",
        medical_license_number: ""
      }, _defineProperty(_ref, "medical_license_number", ""), _defineProperty(_ref, "registration_no", ""), _defineProperty(_ref, "experience", ""), _defineProperty(_ref, "willing_to_serve_as", "0"), _defineProperty(_ref, "brief_summary", ""), _defineProperty(_ref, "terms_and_conditions", ""), _defineProperty(_ref, "address", ""), _defineProperty(_ref, "address2", ""), _defineProperty(_ref, "area", ""), _defineProperty(_ref, "city", ""), _defineProperty(_ref, "country", ""), _defineProperty(_ref, "state", ""), _defineProperty(_ref, "zip_code", ""), _defineProperty(_ref, "date_of_registration", ""), _defineProperty(_ref, "type", ""), _defineProperty(_ref, "status", 0), _defineProperty(_ref, "latitude", ""), _defineProperty(_ref, "longitude", ""), _defineProperty(_ref, "type", ""), _defineProperty(_ref, "availability_time_from", ""), _defineProperty(_ref, "equipment", ""), _ref)),
      uploadedDoc: "",
      specialty: "",
      registration: "",
      profile_picture: "",
      imageData: [],
      docData: [],
      dataDoc: [],
      imageDoc: [],
      equipmentArr: [],
      options: "",
      isActive: false
    };
  },
  created: function created() {
    this.autocompleteOptions = {
      componentRestrictions: {// country:  'UK'
      }
    };
    this.ServiceList();
    this.TypeList();
    this.AvailabilityList();
    this.getEquipmentList();
  },
  mounted: function mounted() {
    if (this.$route.params.id != "") {
      this.getDoctorProfileFormData(this.$route.params.id);
    }
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])("Doctor/Index", ["returnData", "ajax_error", "doctorResult", "equipListResult"]), {}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])("auth", ["user"]), {}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])("Masters/ServicesMaster", ["resultService"]), {}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])("Masters/TypesMaster", ["resultType"]), {}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])("Masters/AvailabilityMaster", ["resultAvailability"])),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])("Doctor/Index", ["submitDoctorUpdateForm", "getDoctorProfile", "getEquipmentList"]), {}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])("Masters/ServicesMaster", ["ServiceList"]), {}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])("Masters/TypesMaster", ["TypeList"]), {}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])("Masters/AvailabilityMaster", ["AvailabilityList"]), {
    onlyNumric: function onlyNumric(evt) {
      return _global_helper_helpers_js__WEBPACK_IMPORTED_MODULE_4___default.a.onlyNumric(evt);
    },
    acceptNumber: function acceptNumber() {
      var x = this.formData.phone_number.replace(/\D/g, "").match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
      this.formData.phone_number = !x[2] ? x[1] : "" + x[1] + "-" + x[2] + (x[3] ? "-" + x[3] : "");
    },
    atChangeEquipment: function atChangeEquipment() {
      if (this.equipmentArr.length >= 0) {
        var deptIds = [];

        for (var c = 0; c < this.equipmentArr.length; c++) {
          deptIds.push(this.equipmentArr[c].id);
        }

        this.formData.equipment = deptIds.toString(); //  console.log(this.formData.equipment);
      }
    },
    getDoctorProfileFormData: function getDoctorProfileFormData(id) {
      var _this = this;

      this.getDoctorProfile(id).then(function () {
        _this.formData.keys().forEach(function (key) {
          _this.formData[key] = _this.doctorResult[key];
        });

        _this.formData.id = _this.doctorResult.doctor_info_id;
        _this.equipmentArr = _this.doctorResult.equipmentArr;
        var lat = parseFloat(_this.doctorResult.latitude);
        var lng = parseFloat(_this.doctorResult.longitude);
        _this.markers = [];
        var marker = {
          lat: lat,
          lng: lng
        };

        _this.markers.push({
          position: marker
        });

        _this.center = marker;
      });
    },
    cirtificatefile: function cirtificatefile(e) {
      var _this2 = this;

      this.uploadedDoc = e.target.files[0];
      var reader = new FileReader();

      reader.onload = function (e) {
        _this2.imageData = e.target.result;
      };

      reader.readAsDataURL(this.uploadedDoc);
    },
    copyOfSpecialty: function copyOfSpecialty(e) {
      var _this3 = this;

      this.specialty = e.target.files[0];
      var reader = new FileReader();

      reader.onload = function (e) {
        _this3.docData = e.target.result;
      };

      reader.readAsDataURL(this.specialty);
    },
    CopyOfRegistration: function CopyOfRegistration(e) {
      var _this4 = this;

      this.registration = e.target.files[0];
      var reader = new FileReader();

      reader.onload = function (e) {
        _this4.dataDoc = e.target.result;
      };

      reader.readAsDataURL(this.registration);
    },
    onImageChange: function onImageChange(e) {
      var _this5 = this;

      this.profile_picture = e.target.files[0];
      var reader = new FileReader();

      reader.onload = function (e) {
        _this5.imageDoc = e.target.result;
      };

      reader.readAsDataURL(this.profile_picture);
    },
    checkAll: function checkAll() {
      var inlineCheckbox1 = new Array();
      $("input:checked").each(function () {
        inlineCheckbox1.push($(this).val());
      });
    },
    submitFormData: function submitFormData() {
      var _this6 = this;

      var newData = new FormData();
      newData.append("cirtificatefile", this.uploadedDoc);
      newData.append("specialtyfile", this.specialty);
      newData.append("registrationfile", this.registration);
      newData.append("profilefile", this.profile_picture);
      this.isActive = true;
      newData.append("formData", JSON.stringify(this.formData));
      this.submitDoctorUpdateForm({
        newData: newData,
        id: this.formData.id
      }).then(function () {
        if (_this6.returnData.status == "success") {
          // this.$router.push({name:"profileSettings"});
          _this6.isActive = false;
          vue__WEBPACK_IMPORTED_MODULE_1___default.a.$toast.open({
            message: _this6.returnData.message,
            type: _this6.returnData.status
          });
        }
      })["catch"](function (error) {
        window.scrollTo(0, 0);
        _this6.isActive = false;
      });
    },
    //google data
    setPlace: function setPlace(place) {
      var singleValues = $("#google_autosearch_address").val();
      this.formData.full_address = singleValues;
      this.markers = [];
      this.currentPlace = place;
      this.addMarker();
    },
    addMarker: function addMarker() {
      if (this.currentPlace) {
        var marker = {
          lat: this.currentPlace.geometry.location.lat(),
          lng: this.currentPlace.geometry.location.lng()
        };
        this.markers.push({
          position: marker
        });
        this.places.push(this.currentPlace);
        this.center = marker;
        var returnData = {};

        for (var i = 0; i < this.currentPlace.address_components.length; i++) {
          var addressType = this.currentPlace.address_components[i].types[0];

          if (this.ADDRESS_COMPONENTS[addressType]) {
            var val = this.currentPlace.address_components[i][this.ADDRESS_COMPONENTS[addressType]];
            returnData[addressType] = val;
          }
        }

        this.formData.address = this.currentPlace.formatted_address;
        var city,
            state = "";
        city = returnData.locality;

        if (city == undefined || city == null) {
          city = returnData.administrative_area_level_1;
        }

        if (returnData.sublocality_level_2) this.formData.state = returnData.sublocality_level_2;else if (returnData.sublocality_level_1) this.formData.state = returnData.sublocality_level_1;else if (returnData.locality) this.formData.state = returnData.locality;
        if (returnData.route) this.formData.address2 = returnData.route;
        if (returnData.sublocality_level_1) this.formData.area = returnData.sublocality_level_1;
        if (returnData.country) this.formData.country = returnData.country;
        if (returnData.administrative_area_level_1) this.formData.state = returnData.administrative_area_level_1;
        if (returnData.locality) this.formData.city = returnData.locality;
        if (returnData.postal_code) this.formData.zip_code = returnData.postal_code;
        this.formData.latitude = this.currentPlace.geometry.location.lat();
        this.formData.longitude = this.currentPlace.geometry.location.lng(); //End

        this.currentPlace = null;
        var location = this.formData.state + ", " + this.formData.city;
      }
    },
    updateCoordinates: function updateCoordinates(location) {
      this.center = {
        lat: location.latLng.lat(),
        lng: location.latLng.lng()
      };
      this.formData.latitude = location.latLng.lat();
      this.formData.longitude = location.latLng.lng();
    }
  })
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css&":
/*!*****************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css& ***!
  \*****************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/postcss-loader/src/index.js):\nError: ENOENT: no such file or directory, open '/var/www/html/uyr/coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.css'");

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../laravel/node_modules/css-loader??ref--6-1!../../../../laravel/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../laravel/node_modules/postcss-loader/src??ref--6-2!./vue-multiselect.min.css?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!../coreui/node_modules/vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../laravel/node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/settings/update_doctor.vue?vue&type=template&id=32f719f3&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!../coreui/src/views/settings/update_doctor.vue?vue&type=template&id=32f719f3& ***!
  \*******************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("CRow", { staticClass: "m-0" }, [
        _c(
          "form",
          {
            staticClass: "validate-form",
            on: {
              submit: function($event) {
                $event.preventDefault()
                return _vm.submitFormData.apply(null, arguments)
              }
            }
          },
          [
            _c(
              "CCol",
              { staticClass: "px-2 btn-sticky", attrs: { sm: "12" } },
              [
                _c(
                  "div",
                  {
                    staticClass:
                      "d-flex justify-content-between py-2 align-items-center"
                  },
                  [
                    _c(
                      "h5",
                      { staticClass: "mb-0" },
                      [
                        _vm._v("Doctor "),
                        _c("vue-fontawesome", {
                          staticClass: "px-1",
                          attrs: { icon: "caret-right", size: "1" }
                        }),
                        _vm._v("Update")
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {},
                      [
                        _c(
                          "CButton",
                          {
                            staticClass: "btn_custom",
                            attrs: {
                              size: "sm",
                              type: "submit",
                              disabled: _vm.isActive
                            }
                          },
                          [_vm._v("Submit ")]
                        ),
                        _vm._v(" "),
                        _c(
                          "router-link",
                          { attrs: { to: { name: "profileSettings" } } },
                          [
                            _c(
                              "CButton",
                              { attrs: { size: "sm", color: "light" } },
                              [_vm._v("Back")]
                            )
                          ],
                          1
                        )
                      ],
                      1
                    )
                  ]
                )
              ]
            ),
            _vm._v(" "),
            _c(
              "CCol",
              { staticClass: "p-2", attrs: { sm: "12" } },
              [
                _c(
                  "CCard",
                  { staticClass: "mb-0" },
                  [
                    _c("CCardHeader", { staticClass: "p-2 px-3 bg_themes" }, [
                      _c("div", [
                        _c("strong", [_vm._v("Personal / General Info")])
                      ])
                    ]),
                    _vm._v(" "),
                    _c(
                      "CCardBody",
                      { staticClass: "px-1 py-2" },
                      [
                        _c(
                          "CRow",
                          { staticClass: "m-0" },
                          [
                            _c(
                              "CCol",
                              {
                                staticClass: "px-1",
                                attrs: { sm: "12", md: "3" }
                              },
                              [
                                _c("div", { staticClass: "form-group" }, [
                                  _c("label", [
                                    _vm._v(
                                      "Upload photo (With Coat and stethoscope)"
                                    ),
                                    _c("span", [_vm._v("*")])
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    {
                                      staticClass:
                                        "profile-img border rounded p-1"
                                    },
                                    [
                                      _c("div", { staticClass: "w-100" }, [
                                        _c(
                                          "div",
                                          { staticClass: "profileimg mx-auto" },
                                          [
                                            _vm.doctorResult.profile_photo &&
                                            _vm.imageDoc == ""
                                              ? _c("img", {
                                                  attrs: {
                                                    src:
                                                      "uploads/doctor/" +
                                                      _vm.doctorResult.user_id +
                                                      "/" +
                                                      _vm.doctorResult
                                                        .profile_photo
                                                  }
                                                })
                                              : _vm.imageDoc &&
                                                _vm.imageDoc != ""
                                              ? _c("img", {
                                                  staticClass: "img-fluid",
                                                  attrs: { src: _vm.imageDoc }
                                                })
                                              : _c("img", {
                                                  attrs: {
                                                    src:
                                                      "/uploads/profile/default-profile.png"
                                                  }
                                                })
                                          ]
                                        )
                                      ]),
                                      _vm._v(" "),
                                      _c(
                                        "button",
                                        {
                                          staticClass:
                                            "file btn btn-sm upload_btn text-center mx-auto mt-2"
                                        },
                                        [
                                          _c("vue-fontawesome", {
                                            staticClass: "px-1 mr-2",
                                            attrs: {
                                              icon: "upload",
                                              size: "0.8"
                                            }
                                          }),
                                          _vm._v(
                                            "\n                      Upload Photo\n                      "
                                          ),
                                          _c("input", {
                                            attrs: {
                                              type: "file",
                                              name: "profile_picture"
                                            },
                                            on: { change: _vm.onImageChange }
                                          })
                                        ],
                                        1
                                      )
                                    ]
                                  )
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "12", md: "9" }
                              },
                              [
                                _c(
                                  "CRow",
                                  { staticClass: "m-0" },
                                  [
                                    _c(
                                      "CCol",
                                      {
                                        staticClass: "px-2",
                                        attrs: { sm: "6", md: "4" }
                                      },
                                      [
                                        _c("label", [
                                          _vm._v("First Name "),
                                          _c(
                                            "span",
                                            { staticClass: "text-danger" },
                                            [_vm._v("*")]
                                          )
                                        ]),
                                        _vm._v(" "),
                                        _c("CInput", {
                                          class: [
                                            _vm.ajax_error.errors.first_name
                                              ? "formError"
                                              : ""
                                          ],
                                          attrs: { placeholder: "" },
                                          model: {
                                            value: _vm.formData.first_name,
                                            callback: function($$v) {
                                              _vm.$set(
                                                _vm.formData,
                                                "first_name",
                                                $$v
                                              )
                                            },
                                            expression: "formData.first_name"
                                          }
                                        }),
                                        _vm._v(" "),
                                        _vm.ajax_error.errors.first_name
                                          ? _c(
                                              "span",
                                              { staticClass: "text-danger" },
                                              [
                                                _vm._v(
                                                  _vm._s(
                                                    _vm.ajax_error.errors
                                                      .first_name[0]
                                                  )
                                                )
                                              ]
                                            )
                                          : _vm._e()
                                      ],
                                      1
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "CCol",
                                      {
                                        staticClass: "px-2",
                                        attrs: { sm: "6", md: "4" }
                                      },
                                      [
                                        _c("label", [
                                          _vm._v("Last Name "),
                                          _c(
                                            "span",
                                            { staticClass: "text-danger" },
                                            [_vm._v("*")]
                                          )
                                        ]),
                                        _vm._v(" "),
                                        _c("CInput", {
                                          class: [
                                            _vm.ajax_error.errors.last_name
                                              ? "formError"
                                              : ""
                                          ],
                                          attrs: { placeholder: "" },
                                          model: {
                                            value: _vm.formData.last_name,
                                            callback: function($$v) {
                                              _vm.$set(
                                                _vm.formData,
                                                "last_name",
                                                $$v
                                              )
                                            },
                                            expression: "formData.last_name"
                                          }
                                        }),
                                        _vm._v(" "),
                                        _vm.ajax_error.errors.last_name
                                          ? _c(
                                              "span",
                                              { staticClass: "text-danger" },
                                              [
                                                _vm._v(
                                                  _vm._s(
                                                    _vm.ajax_error.errors
                                                      .last_name[0]
                                                  )
                                                )
                                              ]
                                            )
                                          : _vm._e()
                                      ],
                                      1
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "CCol",
                                      {
                                        staticClass: "px-2",
                                        attrs: { sm: "6", md: "4" }
                                      },
                                      [
                                        _c("label", [
                                          _vm._v("Email"),
                                          _c(
                                            "span",
                                            { staticClass: "text-danger" },
                                            [_vm._v("*")]
                                          )
                                        ]),
                                        _vm._v(" "),
                                        _c("CInput", {
                                          class: [
                                            _vm.ajax_error.errors.email
                                              ? "formError"
                                              : ""
                                          ],
                                          attrs: { placeholder: "" },
                                          model: {
                                            value: _vm.formData.email,
                                            callback: function($$v) {
                                              _vm.$set(
                                                _vm.formData,
                                                "email",
                                                $$v
                                              )
                                            },
                                            expression: "formData.email"
                                          }
                                        }),
                                        _vm._v(" "),
                                        _vm.ajax_error.errors.email
                                          ? _c(
                                              "span",
                                              { staticClass: "text-danger" },
                                              [
                                                _vm._v(
                                                  _vm._s(
                                                    _vm.ajax_error.errors
                                                      .email[0]
                                                  )
                                                )
                                              ]
                                            )
                                          : _vm._e()
                                      ],
                                      1
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "CCol",
                                      {
                                        staticClass: "px-2",
                                        attrs: { sm: "6", md: "4" }
                                      },
                                      [
                                        _c("label", [
                                          _vm._v("Phone No"),
                                          _c(
                                            "span",
                                            { staticClass: "text-danger" },
                                            [_vm._v("*")]
                                          )
                                        ]),
                                        _vm._v(" "),
                                        _c("CInput", {
                                          class: [
                                            _vm.ajax_error.errors.phone_number
                                              ? "formError"
                                              : ""
                                          ],
                                          attrs: {
                                            maxlength: "12",
                                            placeholder: "Enter Phone No"
                                          },
                                          on: {
                                            blur: _vm.acceptNumber,
                                            input: _vm.acceptNumber,
                                            keypress: function($event) {
                                              return _vm.onlyNumric($event)
                                            }
                                          },
                                          model: {
                                            value: _vm.formData.phone_number,
                                            callback: function($$v) {
                                              _vm.$set(
                                                _vm.formData,
                                                "phone_number",
                                                $$v
                                              )
                                            },
                                            expression: "formData.phone_number"
                                          }
                                        }),
                                        _vm._v(" "),
                                        _vm.ajax_error.errors.phone_number
                                          ? _c(
                                              "span",
                                              { staticClass: "text-danger" },
                                              [
                                                _vm._v(
                                                  _vm._s(
                                                    _vm.ajax_error.errors
                                                      .phone_number[0]
                                                  )
                                                )
                                              ]
                                            )
                                          : _vm._e()
                                      ],
                                      1
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "CCol",
                                      {
                                        staticClass: "px-2",
                                        attrs: { sm: "6", md: "4" }
                                      },
                                      [
                                        _c("label", [_vm._v("Age")]),
                                        _vm._v(" "),
                                        _c("CInput", {
                                          attrs: { placeholder: "" },
                                          model: {
                                            value: _vm.formData.age,
                                            callback: function($$v) {
                                              _vm.$set(_vm.formData, "age", $$v)
                                            },
                                            expression: "formData.age"
                                          }
                                        }),
                                        _vm._v(" "),
                                        _vm.ajax_error.errors.age
                                          ? _c(
                                              "span",
                                              { staticClass: "text-danger" },
                                              [
                                                _vm._v(
                                                  _vm._s(
                                                    _vm.ajax_error.errors.age[0]
                                                  )
                                                )
                                              ]
                                            )
                                          : _vm._e()
                                      ],
                                      1
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "CCol",
                                      {
                                        staticClass: "px-2",
                                        attrs: { sm: "6", md: "3" }
                                      },
                                      [
                                        _c(
                                          "div",
                                          { staticClass: "form-group" },
                                          [
                                            _c("label", [
                                              _vm._v("Gender"),
                                              _c("span", [_vm._v("*")])
                                            ]),
                                            _c("br"),
                                            _vm._v(" "),
                                            _c(
                                              "div",
                                              {
                                                staticClass:
                                                  "custom-control custom-radio custom-control-inline"
                                              },
                                              [
                                                _c("input", {
                                                  directives: [
                                                    {
                                                      name: "model",
                                                      rawName: "v-model",
                                                      value:
                                                        _vm.formData.gender,
                                                      expression:
                                                        "formData.gender"
                                                    }
                                                  ],
                                                  staticClass:
                                                    "custom-control-input",
                                                  attrs: {
                                                    type: "radio",
                                                    value: "0",
                                                    id: "customRadioInline1",
                                                    name: "gender"
                                                  },
                                                  domProps: {
                                                    checked: _vm._q(
                                                      _vm.formData.gender,
                                                      "0"
                                                    )
                                                  },
                                                  on: {
                                                    change: function($event) {
                                                      return _vm.$set(
                                                        _vm.formData,
                                                        "gender",
                                                        "0"
                                                      )
                                                    }
                                                  }
                                                }),
                                                _vm._v(" "),
                                                _c(
                                                  "label",
                                                  {
                                                    staticClass:
                                                      "custom-control-label",
                                                    attrs: {
                                                      for: "customRadioInline1"
                                                    }
                                                  },
                                                  [_vm._v("Male")]
                                                )
                                              ]
                                            ),
                                            _vm._v(" "),
                                            _c(
                                              "div",
                                              {
                                                staticClass:
                                                  "custom-control custom-radio custom-control-inline"
                                              },
                                              [
                                                _c("input", {
                                                  directives: [
                                                    {
                                                      name: "model",
                                                      rawName: "v-model",
                                                      value:
                                                        _vm.formData.gender,
                                                      expression:
                                                        "formData.gender"
                                                    }
                                                  ],
                                                  staticClass:
                                                    "custom-control-input",
                                                  attrs: {
                                                    type: "radio",
                                                    value: "1",
                                                    name: "gender",
                                                    id: "customRadioInline2"
                                                  },
                                                  domProps: {
                                                    checked: _vm._q(
                                                      _vm.formData.gender,
                                                      "1"
                                                    )
                                                  },
                                                  on: {
                                                    change: function($event) {
                                                      return _vm.$set(
                                                        _vm.formData,
                                                        "gender",
                                                        "1"
                                                      )
                                                    }
                                                  }
                                                }),
                                                _vm._v(" "),
                                                _c(
                                                  "label",
                                                  {
                                                    staticClass:
                                                      "custom-control-label",
                                                    attrs: {
                                                      for: "customRadioInline2"
                                                    }
                                                  },
                                                  [_vm._v("Female")]
                                                )
                                              ]
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _vm.ajax_error.errors.gender
                                          ? _c(
                                              "span",
                                              { staticClass: "text-danger" },
                                              [
                                                _vm._v(
                                                  _vm._s(
                                                    _vm.ajax_error.errors
                                                      .gender[0]
                                                  )
                                                )
                                              ]
                                            )
                                          : _vm._e()
                                      ]
                                    )
                                  ],
                                  1
                                )
                              ],
                              1
                            )
                          ],
                          1
                        )
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "CCard",
                  { staticClass: "mb-0" },
                  [
                    _c("CCardHeader", { staticClass: "p-2 px-3 bg_themes" }, [
                      _c("div", [
                        _c("strong", [
                          _vm._v("Location"),
                          _c("span", [_vm._v("*")])
                        ])
                      ])
                    ]),
                    _vm._v(" "),
                    _c(
                      "CCardBody",
                      { staticClass: "px-1 py-2" },
                      [
                        _c(
                          "CRow",
                          { staticClass: "m-0" },
                          [
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "3" }
                              },
                              [
                                _c("label", [
                                  _vm._v("Select Address"),
                                  _c("span", { staticClass: "text-danger" }, [
                                    _vm._v("*")
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("gmap-autocomplete", {
                                  staticClass: "form-control",
                                  attrs: {
                                    autocomplete: "off",
                                    id: "google_autosearch_address",
                                    options: _vm.autocompleteOptions
                                  },
                                  on: { place_changed: _vm.setPlace }
                                })
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "3" }
                              },
                              [
                                _c("label", [
                                  _vm._v("Address"),
                                  _c("span", { staticClass: "text-danger" }, [
                                    _vm._v("*")
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("CInput", {
                                  class: [
                                    _vm.ajax_error.errors.address
                                      ? "formError"
                                      : ""
                                  ],
                                  attrs: { placeholder: "" },
                                  model: {
                                    value: _vm.formData.address,
                                    callback: function($$v) {
                                      _vm.$set(_vm.formData, "address", $$v)
                                    },
                                    expression: "formData.address"
                                  }
                                }),
                                _vm._v(" "),
                                _vm.ajax_error.errors.address
                                  ? _c("span", { staticClass: "text-danger" }, [
                                      _vm._v(
                                        _vm._s(_vm.ajax_error.errors.address[0])
                                      )
                                    ])
                                  : _vm._e()
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "3" }
                              },
                              [
                                _c("label", [
                                  _vm._v("City"),
                                  _c("span", { staticClass: "text-danger" }, [
                                    _vm._v("*")
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("CInput", {
                                  class: [
                                    _vm.ajax_error.errors.city
                                      ? "formError"
                                      : ""
                                  ],
                                  attrs: { placeholder: "" },
                                  model: {
                                    value: _vm.formData.city,
                                    callback: function($$v) {
                                      _vm.$set(_vm.formData, "city", $$v)
                                    },
                                    expression: "formData.city"
                                  }
                                }),
                                _vm._v(" "),
                                _vm.ajax_error.errors.city
                                  ? _c("span", { staticClass: "text-danger" }, [
                                      _vm._v(
                                        _vm._s(_vm.ajax_error.errors.city[0])
                                      )
                                    ])
                                  : _vm._e()
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "3" }
                              },
                              [
                                _c("label", [
                                  _vm._v("Country"),
                                  _c("span", { staticClass: "text-danger" }, [
                                    _vm._v("*")
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("CInput", {
                                  class: [
                                    _vm.ajax_error.errors.country
                                      ? "formError"
                                      : ""
                                  ],
                                  attrs: { placeholder: "" },
                                  model: {
                                    value: _vm.formData.country,
                                    callback: function($$v) {
                                      _vm.$set(_vm.formData, "country", $$v)
                                    },
                                    expression: "formData.country"
                                  }
                                }),
                                _vm._v(" "),
                                _vm.ajax_error.errors.country
                                  ? _c("span", { staticClass: "text-danger" }, [
                                      _vm._v(
                                        _vm._s(_vm.ajax_error.errors.country[0])
                                      )
                                    ])
                                  : _vm._e()
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "3" }
                              },
                              [
                                _c("label", [_vm._v("State")]),
                                _vm._v(" "),
                                _c("CInput", {
                                  attrs: { placeholder: "" },
                                  model: {
                                    value: _vm.formData.state,
                                    callback: function($$v) {
                                      _vm.$set(_vm.formData, "state", $$v)
                                    },
                                    expression: "formData.state"
                                  }
                                }),
                                _vm._v(" "),
                                _vm.ajax_error.errors.state
                                  ? _c("span", { staticClass: "text-danger" }, [
                                      _vm._v(
                                        _vm._s(_vm.ajax_error.errors.state[0])
                                      )
                                    ])
                                  : _vm._e()
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "3" }
                              },
                              [
                                _c("label", [_vm._v("Zip code")]),
                                _vm._v(" "),
                                _c("CInput", {
                                  attrs: { placeholder: "" },
                                  model: {
                                    value: _vm.formData.zip_code,
                                    callback: function($$v) {
                                      _vm.$set(_vm.formData, "zip_code", $$v)
                                    },
                                    expression: "formData.zip_code"
                                  }
                                }),
                                _vm._v(" "),
                                _vm.ajax_error.errors.zip_code
                                  ? _c("span", { staticClass: "text-danger" }, [
                                      _vm._v(
                                        _vm._s(
                                          _vm.ajax_error.errors.zip_code[0]
                                        )
                                      )
                                    ])
                                  : _vm._e()
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "3" }
                              },
                              [
                                _c("label", [_vm._v("latitude")]),
                                _vm._v(" "),
                                _c("CInput", {
                                  attrs: { placeholder: "" },
                                  model: {
                                    value: _vm.formData.latitude,
                                    callback: function($$v) {
                                      _vm.$set(_vm.formData, "latitude", $$v)
                                    },
                                    expression: "formData.latitude"
                                  }
                                }),
                                _vm._v(" "),
                                _vm.ajax_error.errors.latitude
                                  ? _c("span", { staticClass: "text-danger" }, [
                                      _vm._v(
                                        _vm._s(
                                          _vm.ajax_error.errors.latitude[0]
                                        )
                                      )
                                    ])
                                  : _vm._e()
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "3" }
                              },
                              [
                                _c("label", [_vm._v("longitude")]),
                                _vm._v(" "),
                                _c("CInput", {
                                  attrs: { placeholder: "" },
                                  model: {
                                    value: _vm.formData.latitude,
                                    callback: function($$v) {
                                      _vm.$set(_vm.formData, "latitude", $$v)
                                    },
                                    expression: "formData.latitude"
                                  }
                                }),
                                _vm._v(" "),
                                _vm.ajax_error.errors.longitude
                                  ? _c("span", { staticClass: "text-danger" }, [
                                      _vm._v(
                                        _vm._s(
                                          _vm.ajax_error.errors.longitude[0]
                                        )
                                      )
                                    ])
                                  : _vm._e()
                              ],
                              1
                            )
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _vm.markers.length > 0
                          ? _c(
                              "div",
                              { staticClass: "col-md-12" },
                              [
                                _c(
                                  "gmap-map",
                                  {
                                    staticStyle: {
                                      width: "100%",
                                      height: "400px"
                                    },
                                    attrs: { center: _vm.center, zoom: 17 }
                                  },
                                  _vm._l(_vm.markers, function(m, index) {
                                    return _c("gmap-marker", {
                                      key: index,
                                      attrs: {
                                        position: m.position,
                                        draggable: true,
                                        clickable: true
                                      },
                                      on: {
                                        click: function($event) {
                                          _vm.center = m.position
                                        },
                                        dragend: _vm.updateCoordinates
                                      }
                                    })
                                  }),
                                  1
                                )
                              ],
                              1
                            )
                          : _vm._e()
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "CCard",
                  { staticClass: "mb-0" },
                  [
                    _c("CCardHeader", { staticClass: "p-2 px-3 bg_themes" }, [
                      _c("div", [
                        _c("strong", [_vm._v("ID and Licensing Credentials")])
                      ])
                    ]),
                    _vm._v(" "),
                    _c(
                      "CCardBody",
                      { staticClass: "px-1 py-2" },
                      [
                        _c(
                          "CRow",
                          { staticClass: "m-0" },
                          [
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c("div", { staticClass: "form-group" }, [
                                  _c("label", [_vm._v("Type")]),
                                  _vm._v(" "),
                                  _c(
                                    "select",
                                    {
                                      directives: [
                                        {
                                          name: "model",
                                          rawName: "v-model",
                                          value: _vm.formData.type,
                                          expression: "formData.type"
                                        }
                                      ],
                                      staticClass: "form-control",
                                      on: {
                                        change: function($event) {
                                          var $$selectedVal = Array.prototype.filter
                                            .call(
                                              $event.target.options,
                                              function(o) {
                                                return o.selected
                                              }
                                            )
                                            .map(function(o) {
                                              var val =
                                                "_value" in o
                                                  ? o._value
                                                  : o.value
                                              return val
                                            })
                                          _vm.$set(
                                            _vm.formData,
                                            "type",
                                            $event.target.multiple
                                              ? $$selectedVal
                                              : $$selectedVal[0]
                                          )
                                        }
                                      }
                                    },
                                    _vm._l(_vm.resultType, function(
                                      type,
                                      index
                                    ) {
                                      return _c(
                                        "option",
                                        { domProps: { value: type.id } },
                                        [_vm._v(_vm._s(type.type_name))]
                                      )
                                    }),
                                    0
                                  ),
                                  _vm._v(" "),
                                  _vm.ajax_error.errors.type
                                    ? _c(
                                        "span",
                                        { staticClass: "text-danger" },
                                        [
                                          _vm._v(
                                            _vm._s(
                                              _vm.ajax_error.errors.type[0]
                                            )
                                          )
                                        ]
                                      )
                                    : _vm._e()
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c("div", { staticClass: "form-group" }, [
                                  _c("label", [
                                    _vm._v("Certificate awarding University")
                                  ]),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "file-upload" }, [
                                    _c("div", { staticClass: "file-select" }, [
                                      _c(
                                        "div",
                                        {
                                          staticClass: "file-select-button",
                                          attrs: { id: "fileName" }
                                        },
                                        [_vm._v("Choose File")]
                                      ),
                                      _vm._v(" "),
                                      _c("div", {
                                        staticClass: "file-select-name",
                                        attrs: { id: "noFile" }
                                      }),
                                      _vm._v(" "),
                                      _c("input", {
                                        attrs: {
                                          type: "file",
                                          name: "uploadedDoc"
                                        },
                                        on: { change: _vm.cirtificatefile }
                                      })
                                    ])
                                  ]),
                                  _vm._v(" "),
                                  _vm.formData.certificate_awarding_university
                                    ? _c(
                                        "a",
                                        {
                                          attrs: {
                                            href:
                                              "uploads/doctor/" +
                                              _vm.formData.user_id +
                                              "/" +
                                              _vm.formData
                                                .certificate_awarding_university,
                                            download: ""
                                          }
                                        },
                                        [
                                          _vm._v(" Download "),
                                          _c("CIcon", {
                                            attrs: { name: "cil-file" }
                                          })
                                        ],
                                        1
                                      )
                                    : _vm._e(),
                                  _vm._v(" "),
                                  _vm.ajax_error.errors
                                    .certificate_awarding_university
                                    ? _c(
                                        "span",
                                        { staticClass: "text-danger" },
                                        [
                                          _vm._v(
                                            _vm._s(
                                              _vm.ajax_error.errors
                                                .certificate_awarding_university[0]
                                            )
                                          )
                                        ]
                                      )
                                    : _vm._e()
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c("div", { staticClass: "form-group" }, [
                                  _c("label", [
                                    _vm._v("Copy of specialty diploma")
                                  ]),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "file-upload" }, [
                                    _c("div", { staticClass: "file-select" }, [
                                      _c(
                                        "div",
                                        {
                                          staticClass: "file-select-button",
                                          attrs: { id: "fileName" }
                                        },
                                        [_vm._v("Choose File")]
                                      ),
                                      _vm._v(" "),
                                      _c("div", {
                                        staticClass: "file-select-name",
                                        attrs: { id: "noFile" }
                                      }),
                                      _vm._v(" "),
                                      _c("input", {
                                        attrs: {
                                          type: "file",
                                          name: "specialty"
                                        },
                                        on: { change: _vm.copyOfSpecialty }
                                      })
                                    ])
                                  ]),
                                  _vm._v(" "),
                                  _vm.formData.speciality_diploma
                                    ? _c(
                                        "a",
                                        {
                                          attrs: {
                                            href:
                                              "uploads/doctor/" +
                                              _vm.formData.user_id +
                                              "/" +
                                              _vm.formData.speciality_diploma,
                                            download: ""
                                          }
                                        },
                                        [
                                          _vm._v(" Download "),
                                          _c("CIcon", {
                                            attrs: { name: "cil-file" }
                                          })
                                        ],
                                        1
                                      )
                                    : _vm._e(),
                                  _vm._v(" "),
                                  _vm.ajax_error.errors.speciality_diploma
                                    ? _c(
                                        "span",
                                        { staticClass: "text-danger" },
                                        [
                                          _vm._v(
                                            _vm._s(
                                              _vm.ajax_error.errors
                                                .speciality_diploma[0]
                                            )
                                          )
                                        ]
                                      )
                                    : _vm._e()
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c("div", { staticClass: "form-group" }, [
                                  _c("label", [
                                    _vm._v(
                                      "Copy of registration in the doctor’s council (Medical council)"
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "file-upload" }, [
                                    _c("div", { staticClass: "file-select" }, [
                                      _c(
                                        "div",
                                        {
                                          staticClass: "file-select-button",
                                          attrs: { id: "fileName" }
                                        },
                                        [_vm._v("Choose File")]
                                      ),
                                      _vm._v(" "),
                                      _c("div", {
                                        staticClass: "file-select-name",
                                        attrs: { id: "noFile" }
                                      }),
                                      _vm._v(" "),
                                      _c("input", {
                                        attrs: {
                                          type: "file",
                                          name: "registration"
                                        },
                                        on: { change: _vm.CopyOfRegistration }
                                      })
                                    ])
                                  ]),
                                  _vm._v(" "),
                                  _vm.formData.copy_of_registration
                                    ? _c(
                                        "a",
                                        {
                                          attrs: {
                                            href:
                                              "uploads/doctor/" +
                                              _vm.formData.user_id +
                                              "/" +
                                              _vm.formData.copy_of_registration,
                                            download: ""
                                          }
                                        },
                                        [
                                          _vm._v(" Download "),
                                          _c("CIcon", {
                                            attrs: { name: "cil-file" }
                                          })
                                        ],
                                        1
                                      )
                                    : _vm._e(),
                                  _vm._v(" "),
                                  _vm.ajax_error.errors.copy_of_registration
                                    ? _c(
                                        "span",
                                        { staticClass: "text-danger" },
                                        [
                                          _vm._v(
                                            _vm._s(
                                              _vm.ajax_error.errors
                                                .copy_of_registration[0]
                                            )
                                          )
                                        ]
                                      )
                                    : _vm._e()
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c("label", [
                                  _vm._v("Enter your medical license number"),
                                  _c("span", { staticClass: "text-danger" }, [
                                    _vm._v("*")
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("CInput", {
                                  class: [
                                    _vm.ajax_error.errors.medical_license_number
                                      ? "formError"
                                      : ""
                                  ],
                                  attrs: { placeholder: "" },
                                  model: {
                                    value: _vm.formData.medical_license_number,
                                    callback: function($$v) {
                                      _vm.$set(
                                        _vm.formData,
                                        "medical_license_number",
                                        $$v
                                      )
                                    },
                                    expression:
                                      "formData.medical_license_number"
                                  }
                                }),
                                _vm._v(" "),
                                _vm.ajax_error.errors.medical_license_number
                                  ? _c("span", { staticClass: "text-danger" }, [
                                      _vm._v(
                                        _vm._s(
                                          _vm.ajax_error.errors
                                            .medical_license_number[0]
                                        )
                                      )
                                    ])
                                  : _vm._e()
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c(
                                  "div",
                                  {
                                    staticClass: "form-group",
                                    class: [
                                      _vm.ajax_error.errors.date_of_registration
                                        ? "formError"
                                        : ""
                                    ]
                                  },
                                  [
                                    _c("label", [
                                      _vm._v("Date of registration")
                                    ]),
                                    _vm._v(" "),
                                    _c("input", {
                                      directives: [
                                        {
                                          name: "model",
                                          rawName: "v-model",
                                          value:
                                            _vm.formData.date_of_registration,
                                          expression:
                                            "formData.date_of_registration"
                                        }
                                      ],
                                      staticClass: "form-control",
                                      class: [
                                        _vm.ajax_error.errors
                                          .date_of_registration
                                          ? "formError"
                                          : ""
                                      ],
                                      attrs: { type: "date", name: "" },
                                      domProps: {
                                        value: _vm.formData.date_of_registration
                                      },
                                      on: {
                                        input: function($event) {
                                          if ($event.target.composing) {
                                            return
                                          }
                                          _vm.$set(
                                            _vm.formData,
                                            "date_of_registration",
                                            $event.target.value
                                          )
                                        }
                                      }
                                    }),
                                    _vm._v(" "),
                                    _vm.ajax_error.errors.date_of_registration
                                      ? _c(
                                          "span",
                                          { staticClass: "text-danger" },
                                          [
                                            _vm._v(
                                              _vm._s(
                                                _vm.ajax_error.errors
                                                  .date_of_registration[0]
                                              )
                                            )
                                          ]
                                        )
                                      : _vm._e()
                                  ]
                                )
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c("label", [
                                  _vm._v("Registration No"),
                                  _c("span", { staticClass: "text-danger" }, [
                                    _vm._v("*")
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("CInput", {
                                  class: [
                                    _vm.ajax_error.errors.registration_no
                                      ? "formError"
                                      : ""
                                  ],
                                  attrs: { placeholder: "" },
                                  model: {
                                    value: _vm.formData.registration_no,
                                    callback: function($$v) {
                                      _vm.$set(
                                        _vm.formData,
                                        "registration_no",
                                        $$v
                                      )
                                    },
                                    expression: "formData.registration_no"
                                  }
                                }),
                                _vm._v(" "),
                                _vm.ajax_error.errors.registration_no
                                  ? _c("span", { staticClass: "text-danger" }, [
                                      _vm._v(
                                        _vm._s(
                                          _vm.ajax_error.errors
                                            .registration_no[0]
                                        )
                                      )
                                    ])
                                  : _vm._e()
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c("label", [
                                  _vm._v("Years of experience"),
                                  _c("span", { staticClass: "text-danger" }, [
                                    _vm._v("*")
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("CInput", {
                                  class: [
                                    _vm.ajax_error.errors.experience
                                      ? "formError"
                                      : ""
                                  ],
                                  model: {
                                    value: _vm.formData.experience,
                                    callback: function($$v) {
                                      _vm.$set(_vm.formData, "experience", $$v)
                                    },
                                    expression: "formData.experience"
                                  }
                                }),
                                _vm._v(" "),
                                _vm.ajax_error.errors.experience
                                  ? _c("span", { staticClass: "text-danger" }, [
                                      _vm._v(
                                        _vm._s(
                                          _vm.ajax_error.errors.experience[0]
                                        )
                                      )
                                    ])
                                  : _vm._e()
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c("label", [
                                  _vm._v("Current Clinic/hospital of work"),
                                  _c("span", { staticClass: "text-danger" }, [
                                    _vm._v("*")
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("CInput", {
                                  attrs: { placeholder: "" },
                                  model: {
                                    value: _vm.formData.current_clinic_hospital,
                                    callback: function($$v) {
                                      _vm.$set(
                                        _vm.formData,
                                        "current_clinic_hospital",
                                        $$v
                                      )
                                    },
                                    expression:
                                      "formData.current_clinic_hospital"
                                  }
                                }),
                                _vm._v(" "),
                                _vm.ajax_error.errors.current_clinic_hospital
                                  ? _c("span", { staticClass: "text-danger" }, [
                                      _vm._v(
                                        _vm._s(
                                          _vm.ajax_error.errors
                                            .current_clinic_hospital[0]
                                        )
                                      )
                                    ])
                                  : _vm._e()
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c("div", { staticClass: "sub-filter" }, [
                                  _c(
                                    "div",
                                    { staticClass: "form-group" },
                                    [
                                      _c("label", [
                                        _vm._v(
                                          "Select equipment available at your current clinic/hospital \n                      "
                                        )
                                      ]),
                                      _vm._v(" "),
                                      _vm.equipListResult
                                        ? _c("multiselect", {
                                            attrs: {
                                              options: _vm.equipListResult,
                                              multiple: true,
                                              taggable: true,
                                              "close-on-select": false,
                                              "options-limit": 300,
                                              label: "equipment_name",
                                              "track-by": "equipment_name",
                                              "preselect-first": false
                                            },
                                            on: {
                                              input: function($event) {
                                                return _vm.atChangeEquipment()
                                              }
                                            },
                                            model: {
                                              value: _vm.equipmentArr,
                                              callback: function($$v) {
                                                _vm.equipmentArr = $$v
                                              },
                                              expression: "equipmentArr"
                                            }
                                          })
                                        : _vm._e()
                                    ],
                                    1
                                  )
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c(
                                  "div",
                                  {
                                    staticClass: "form-group",
                                    class: [
                                      _vm.ajax_error.errors.willing_to_serve_as
                                        ? "formError"
                                        : ""
                                    ]
                                  },
                                  [
                                    _c("label", [
                                      _vm._v("Willing to serve as"),
                                      _c("span", [_vm._v("*")])
                                    ]),
                                    _vm._v(" "),
                                    _c(
                                      "select",
                                      {
                                        directives: [
                                          {
                                            name: "model",
                                            rawName: "v-model",
                                            value:
                                              _vm.formData.willing_to_serve_as,
                                            expression:
                                              "formData.willing_to_serve_as"
                                          }
                                        ],
                                        staticClass: "form-control",
                                        on: {
                                          change: function($event) {
                                            var $$selectedVal = Array.prototype.filter
                                              .call(
                                                $event.target.options,
                                                function(o) {
                                                  return o.selected
                                                }
                                              )
                                              .map(function(o) {
                                                var val =
                                                  "_value" in o
                                                    ? o._value
                                                    : o.value
                                                return val
                                              })
                                            _vm.$set(
                                              _vm.formData,
                                              "willing_to_serve_as",
                                              $event.target.multiple
                                                ? $$selectedVal
                                                : $$selectedVal[0]
                                            )
                                          }
                                        }
                                      },
                                      _vm._l(_vm.resultService, function(
                                        services,
                                        index
                                      ) {
                                        return _c(
                                          "option",
                                          {
                                            key: index,
                                            domProps: { value: services.id }
                                          },
                                          [
                                            _vm._v(
                                              _vm._s(services.service_name)
                                            )
                                          ]
                                        )
                                      }),
                                      0
                                    ),
                                    _vm._v(" "),
                                    _vm.ajax_error.errors.willing_to_serve_as
                                      ? _c(
                                          "span",
                                          { staticClass: "text-danger" },
                                          [
                                            _vm._v(
                                              _vm._s(
                                                _vm.ajax_error.errors
                                                  .willing_to_serve_as[0]
                                              )
                                            )
                                          ]
                                        )
                                      : _vm._e()
                                  ]
                                )
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              {
                                staticClass: "px-2",
                                attrs: { sm: "6", md: "4" }
                              },
                              [
                                _c("div", { staticClass: "form-group" }, [
                                  _c("label", [
                                    _vm._v("Account Status "),
                                    _c("span")
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "select",
                                    {
                                      directives: [
                                        {
                                          name: "model",
                                          rawName: "v-model",
                                          value: _vm.formData.status,
                                          expression: "formData.status"
                                        }
                                      ],
                                      staticClass: "form-control",
                                      on: {
                                        change: function($event) {
                                          var $$selectedVal = Array.prototype.filter
                                            .call(
                                              $event.target.options,
                                              function(o) {
                                                return o.selected
                                              }
                                            )
                                            .map(function(o) {
                                              var val =
                                                "_value" in o
                                                  ? o._value
                                                  : o.value
                                              return val
                                            })
                                          _vm.$set(
                                            _vm.formData,
                                            "status",
                                            $event.target.multiple
                                              ? $$selectedVal
                                              : $$selectedVal[0]
                                          )
                                        }
                                      }
                                    },
                                    [
                                      _c("option", { attrs: { value: "0" } }, [
                                        _vm._v("Pending")
                                      ]),
                                      _vm._v(" "),
                                      _c("option", { attrs: { value: "1" } }, [
                                        _vm._v("Rejected")
                                      ]),
                                      _vm._v(" "),
                                      _c("option", { attrs: { value: "2" } }, [
                                        _vm._v("Approved")
                                      ])
                                    ]
                                  )
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              { staticClass: "px-2", attrs: { sm: "12" } },
                              [
                                _c("div", { staticClass: "form-group" }, [
                                  _c("label", [
                                    _vm._v(
                                      "Brief summary about yourself (150 words)"
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c("textarea", {
                                    directives: [
                                      {
                                        name: "model",
                                        rawName: "v-model",
                                        value: _vm.formData.brief_summary,
                                        expression: "formData.brief_summary"
                                      }
                                    ],
                                    staticClass: "form-control",
                                    attrs: { rows: "6" },
                                    domProps: {
                                      value: _vm.formData.brief_summary
                                    },
                                    on: {
                                      input: function($event) {
                                        if ($event.target.composing) {
                                          return
                                        }
                                        _vm.$set(
                                          _vm.formData,
                                          "brief_summary",
                                          $event.target.value
                                        )
                                      }
                                    }
                                  })
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "CCol",
                              { staticClass: "px-2", attrs: { sm: "12" } },
                              [
                                _c("div", { staticClass: "form-group" }, [
                                  _c("label", [
                                    _vm._v(
                                      "Terms and condition (policy and procedure of working together)"
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c("textarea", {
                                    directives: [
                                      {
                                        name: "model",
                                        rawName: "v-model",
                                        value:
                                          _vm.formData.terms_and_conditions,
                                        expression:
                                          "formData.terms_and_conditions"
                                      }
                                    ],
                                    staticClass: "form-control",
                                    attrs: { rows: "6" },
                                    domProps: {
                                      value: _vm.formData.terms_and_conditions
                                    },
                                    on: {
                                      input: function($event) {
                                        if ($event.target.composing) {
                                          return
                                        }
                                        _vm.$set(
                                          _vm.formData,
                                          "terms_and_conditions",
                                          $event.target.value
                                        )
                                      }
                                    }
                                  })
                                ])
                              ]
                            )
                          ],
                          1
                        )
                      ],
                      1
                    )
                  ],
                  1
                )
              ],
              1
            )
          ],
          1
        )
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);