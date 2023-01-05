import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData      : [],
//   rolesData       : [],
//   patientsData    : [],
//   returnArr       : {},
//   paymentArr      :{},
//   consaltionArr   :{},
//   medicalhistoryArr:{},
//   editArr         : [],
//   doctorSuggestArr: [],
  ajax_error      : { message: "", errors: [] },
};

export const getters = {
  result          : state => state.resultData,
//   returnData      : state  => state.returnArr,
//   patientsResult  : state => state.patientsData,
//   ajax_error      : state => state.ajax_error,
//   editData        : (state) => state.editArr,
//   doctorSuggestData: (state) => state.doctorSuggestArr,
//   paymentData      : state  => state.paymentArr,
//   consaltionData      : state  => state.consaltionArr,
//   medicalhistoryData : state  =>state.medicalhistoryArr,
};




export const mutations = {

   [types.DOCTOR_PAYOUT](state, payload) {
      state.resultData  = payload;
   },
  
  

  [types.MULTI_ACTION](state, payload) {
        state.returnArr = payload;
  },



  

  
  [types.AJAX_ERROR](state, payload) {
    let message   = payload.response.data.message || payload.message;
    let errors    = payload.response.data.errors;
    state.ajax_error  = {
      message: message,
      errors: errors
    };
  },
};

export const actions = {

    doctorPayout: ({ commit, dispatch }, payload) => {
      if (payload.keyword == undefined) {
         payload.keyword = '';
      }
      if (payload.drType == undefined) {
         payload.drType = 0;
      }
      if (payload.SearchDoctor == undefined) {
         payload.SearchDoctor = '';
      }
      if (payload.SearchMonthYear == undefined) {
         payload.SearchMonthYear = '';
      }
      
    axios.get("/api/payout/doctorPayout?page=" + payload.page + '&keyword=' + payload.keyword + '&drType=' + payload.drType+ '&SearchDoctor=' + payload.SearchDoctor+ '&SearchMonthYear=' + payload.SearchMonthYear)
      .then(response => {
        commit(types.DOCTOR_PAYOUT, response.data);
      })  
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
      })
      .finally(() => {
      });
  },



  
    

};  