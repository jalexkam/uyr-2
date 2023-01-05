(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[106],{

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

/***/ "../coreui/src/views/components/w3wMap.vue":
/*!*************************************************!*\
  !*** ../coreui/src/views/components/w3wMap.vue ***!
  \*************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _w3wMap_vue_vue_type_template_id_07f14a00___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./w3wMap.vue?vue&type=template&id=07f14a00& */ "../coreui/src/views/components/w3wMap.vue?vue&type=template&id=07f14a00&");
/* harmony import */ var _w3wMap_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./w3wMap.vue?vue&type=script&lang=js& */ "../coreui/src/views/components/w3wMap.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _w3wMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./w3wMap.vue?vue&type=style&index=0&lang=css& */ "../coreui/src/views/components/w3wMap.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _laravel_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../laravel/node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_laravel_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _w3wMap_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _w3wMap_vue_vue_type_template_id_07f14a00___WEBPACK_IMPORTED_MODULE_0__["render"],
  _w3wMap_vue_vue_type_template_id_07f14a00___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "coreui/src/views/components/w3wMap.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "../coreui/src/views/components/w3wMap.vue?vue&type=script&lang=js&":
/*!**************************************************************************!*\
  !*** ../coreui/src/views/components/w3wMap.vue?vue&type=script&lang=js& ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _laravel_node_modules_babel_loader_lib_index_js_ref_4_0_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_w3wMap_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../laravel/node_modules/babel-loader/lib??ref--4-0!../../../../laravel/node_modules/vue-loader/lib??vue-loader-options!./w3wMap.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/components/w3wMap.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_laravel_node_modules_babel_loader_lib_index_js_ref_4_0_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_w3wMap_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "../coreui/src/views/components/w3wMap.vue?vue&type=style&index=0&lang=css&":
/*!**********************************************************************************!*\
  !*** ../coreui/src/views/components/w3wMap.vue?vue&type=style&index=0&lang=css& ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _laravel_node_modules_style_loader_index_js_laravel_node_modules_css_loader_index_js_ref_6_1_laravel_node_modules_vue_loader_lib_loaders_stylePostLoader_js_laravel_node_modules_postcss_loader_src_index_js_ref_6_2_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_w3wMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../laravel/node_modules/style-loader!../../../../laravel/node_modules/css-loader??ref--6-1!../../../../laravel/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../laravel/node_modules/postcss-loader/src??ref--6-2!../../../../laravel/node_modules/vue-loader/lib??vue-loader-options!./w3wMap.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/components/w3wMap.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _laravel_node_modules_style_loader_index_js_laravel_node_modules_css_loader_index_js_ref_6_1_laravel_node_modules_vue_loader_lib_loaders_stylePostLoader_js_laravel_node_modules_postcss_loader_src_index_js_ref_6_2_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_w3wMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_laravel_node_modules_style_loader_index_js_laravel_node_modules_css_loader_index_js_ref_6_1_laravel_node_modules_vue_loader_lib_loaders_stylePostLoader_js_laravel_node_modules_postcss_loader_src_index_js_ref_6_2_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_w3wMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _laravel_node_modules_style_loader_index_js_laravel_node_modules_css_loader_index_js_ref_6_1_laravel_node_modules_vue_loader_lib_loaders_stylePostLoader_js_laravel_node_modules_postcss_loader_src_index_js_ref_6_2_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_w3wMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _laravel_node_modules_style_loader_index_js_laravel_node_modules_css_loader_index_js_ref_6_1_laravel_node_modules_vue_loader_lib_loaders_stylePostLoader_js_laravel_node_modules_postcss_loader_src_index_js_ref_6_2_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_w3wMap_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "../coreui/src/views/components/w3wMap.vue?vue&type=template&id=07f14a00&":
/*!********************************************************************************!*\
  !*** ../coreui/src/views/components/w3wMap.vue?vue&type=template&id=07f14a00& ***!
  \********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _laravel_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_w3wMap_vue_vue_type_template_id_07f14a00___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../laravel/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../laravel/node_modules/vue-loader/lib??vue-loader-options!./w3wMap.vue?vue&type=template&id=07f14a00& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/components/w3wMap.vue?vue&type=template&id=07f14a00&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _laravel_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_w3wMap_vue_vue_type_template_id_07f14a00___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _laravel_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_laravel_node_modules_vue_loader_lib_index_js_vue_loader_options_w3wMap_vue_vue_type_template_id_07f14a00___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/components/w3wMap.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!../coreui/src/views/components/w3wMap.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "Autosuggest",
  props: {
    autoSuggest: Boolean,
    mapDiv: Boolean,
    mapId: String,
    w3words: String,
    lat: [Number, String],
    lng: [Number, String]
  },
  data: function data() {
    return {
      navigator: false // words: null,
      // lat: null,
      // lng: null,
      // allData: null,

    };
  },
  methods: {
    switchNav: function switchNav() {
      this.navigator = !this.navigator;
    }
  },
  watch: {},
  mounted: function mounted() {
    this.$nextTick(function () {
      var _this = this;

      var w3wMap = document.getElementById(this.mapId);
      w3wMap.addEventListener("selected_square", function (data) {
        // this.lat = await w3wMap.getLat();
        // this.lng = await w3wMap.getLng();
        _this.$emit('getmapdata', data.detail);
      });
    });
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/components/w3wMap.vue?vue&type=style&index=0&lang=css&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!../coreui/src/views/components/w3wMap.vue?vue&type=style&index=0&lang=css& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../laravel/node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n#map {\n  width: 100%;\n  height: 80vh;\n}\nhtml,\nbody {\n  padding: 0px;\n  margin: 0px;\n  height: 100%;\n}\n.ButtonIcon-Label {\n    font-size: 8px;\n    color: #000;\n}\n.ButtonIcon svg {\n    background-color: #fff;\n    width: 48px;\n    height: 48px;\n    border-radius: 4px;\n    margin-top:5px;\n}\n.ButtonIcon svg:hover {\n    -webkit-box-shadow: 0 0px 10px 0 #0000003d;\n            box-shadow: 0 0px 10px 0 #0000003d;\n    background-color: #fff;\n}\n.navigate-btn{\n    width: 100%;\n    background-color: #005379;\n    display: block;\n    padding: 10px 20px;\n    color: #fff;\n    text-align: center;\n}\n.borderr-bottom {\n  border-bottom: 4px solid #e11f26;\n  -webkit-transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;\n  transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;\n}\n.navigate-btn i {\n    margin-right: 8px;\n    font-size: 20px !important;\n    margin-left: 0px;\n}\n.navigate-btn{\n  color:#fff !important;\n}\n.boxshadow {\n  text-align: center;\n    -webkit-box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 0px rgb(0 0 0 / 14%), 0px 1px 3px 0px rgb(0 0 0 / 12%);\n            box-shadow: 0px 2px 1px -1px rgb(0 0 0 / 20%), 0px 1px 1px 0px rgb(0 0 0 / 14%), 0px 1px 3px 0px rgb(0 0 0 / 12%);\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/components/w3wMap.vue?vue&type=style&index=0&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!../coreui/src/views/components/w3wMap.vue?vue&type=style&index=0&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../laravel/node_modules/css-loader??ref--6-1!../../../../laravel/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../laravel/node_modules/postcss-loader/src??ref--6-2!../../../../laravel/node_modules/vue-loader/lib??vue-loader-options!./w3wMap.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/components/w3wMap.vue?vue&type=style&index=0&lang=css&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!../coreui/src/views/components/w3wMap.vue?vue&type=template&id=07f14a00&":
/*!**************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!../coreui/src/views/components/w3wMap.vue?vue&type=template&id=07f14a00& ***!
  \**************************************************************************************************************************************************************************************************************/
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
    "what3words-map",
    {
      attrs: {
        current_location: !_vm.w3words ? true : false,
        current_location_control_position: "2",
        id: _vm.mapId,
        api_key: "CVQHCR0K",
        map_api_key: "AIzaSyAONdWlvzm8Jc8elwxfe4_hQwcjZDnAH38",
        zoom: "8",
        selected_zoom: "20",
        search_control_position: "5",
        zoom_control: "",
        fullscreen_control: "",
        fullscreen_control_position: "9",
        words: _vm.w3words,
        street_view_control: "true",
        map_type_control_position: "1"
      }
    },
    [
      _c("div", {
        style: !this.mapDiv && "display:none",
        attrs: { slot: "map", id: "map" },
        slot: "map"
      }),
      _vm._v(" "),
      this.autoSuggest
        ? _c(
            "div",
            { attrs: { slot: "search-control" }, slot: "search-control" },
            [
              _c("what3words-autosuggest", { attrs: { id: "what3words" } }, [
                _c("input", { attrs: { type: "text" } })
              ]),
              _vm._v(" "),
              _c(
                "a",
                {
                  staticClass: "font-weight-bold navigate-btn",
                  class: { "borderr-bottom": _vm.navigator },
                  attrs: { href: "javascript:void(0)" },
                  on: { click: _vm.switchNav }
                },
                [
                  _c("vue-fontawesome", { attrs: { icon: "compass" } }),
                  _vm._v("Navigate")
                ],
                1
              ),
              _vm._v(" "),
              _vm.navigator
                ? _c("div", { staticClass: "boxshadow" }, [
                    _c(
                      "a",
                      {
                        attrs: {
                          href:
                            "https://www.google.com/maps/dir/?api=1&destination=" +
                            _vm.lat +
                            "," +
                            _vm.lng,
                          target: "_blank",
                          rel: "noopener noreferrer"
                        }
                      },
                      [
                        _c(
                          "div",
                          {
                            staticClass: "ButtonIcon",
                            attrs: { "data-testid": "ButtonIcon-google" }
                          },
                          [
                            _c(
                              "svg",
                              {
                                staticClass: "MuiSvgIcon-root",
                                attrs: {
                                  viewBox: "0 0 56 56",
                                  width: "1em",
                                  height: "1em"
                                }
                              },
                              [
                                _c("path", {
                                  attrs: {
                                    d:
                                      "M21.2 38.5c1.3 1.7 2.7 3.8 3.4 5 .9 1.6 1.2 2.8 1.9 4.7.4 1.1.7 1.4 1.5 1.4s1.2-.6 1.5-1.4c.6-1.9 1.1-3.3 1.8-4.7 1.4-2.6 3.3-4.9 5.1-7.1.5-.6 3.6-4.3 5-7.2 0 0 1.7-3.2 1.7-7.6 0-4.2-1.7-7.1-1.7-7.1l-4.9 1.3-3 7.8-.7 1.1-.2.2-.2.2-.3.4-.5.5-2.6 2.2-6.6 3.8-1.2 6.5z",
                                    fill: "#34a853"
                                  }
                                }),
                                _c("path", {
                                  attrs: {
                                    d:
                                      "M14.3 28.7c1.6 3.7 4.7 6.9 6.8 9.8l11.2-13.3s-1.6 2.1-4.4 2.1c-3.2 0-5.8-2.5-5.8-5.7 0-2.2 1.3-3.7 1.3-3.7l-7.6 2-1.5 8.8z",
                                    fill: "#fbbc04"
                                  }
                                }),
                                _c("path", {
                                  attrs: {
                                    d:
                                      "M32.5 7.1c3.7 1.2 6.9 3.7 8.8 7.4l-8.9 10.7s1.3-1.5 1.3-3.7c0-3.3-2.8-5.7-5.7-5.7-2.8 0-4.4 2-4.4 2v-6.7l8.9-4z",
                                    fill: "#4285f4"
                                  }
                                }),
                                _c("path", {
                                  attrs: {
                                    d:
                                      "M16.4 11.8c2.2-2.6 6.1-5.4 11.5-5.4 2.6 0 4.6.7 4.6.7l-9 10.7h-6.4l-.7-6z",
                                    fill: "#1a73e8"
                                  }
                                }),
                                _c("path", {
                                  attrs: {
                                    d:
                                      "M14.3 28.7s-1.5-2.9-1.5-7.1c0-4 1.6-7.5 3.5-9.7l7.1 6-9.1 10.8z",
                                    fill: "#ea4335"
                                  }
                                })
                              ]
                            ),
                            _c("div", { staticClass: "ButtonIcon-Label" }, [
                              _vm._v("Google Maps")
                            ])
                          ]
                        )
                      ]
                    )
                  ])
                : _vm._e()
            ],
            1
          )
        : _vm._e()
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);