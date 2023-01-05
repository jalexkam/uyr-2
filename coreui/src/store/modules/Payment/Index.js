import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData      : [],
  ajax_error      : { message: "", errors: [] },
};

export const getters = {
  result          : state => state.resultData,
};

export const mutations = {

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

  
    // orderPayment: ({ commit, dispatch }, payload) => {
    //   return new Promise((resolve, reject) => {
    //     axios.post("/api/payment/order_payment",payload)
    //       .then(response => {
    //         commit(types.MULTI_ACTION, response.data);
    //         resolve();
    //       })
    //       .catch(error => {
    //         commit(types.AJAX_ERROR, error);
    //         reject(true);
    //       })
    //       .finally(() => {
    //         // commit('setLoading', false)
    //       });
    //   });
    // },





};  