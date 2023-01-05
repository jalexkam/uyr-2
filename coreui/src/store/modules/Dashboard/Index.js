import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData      : [],
  returnArr       : {},
  ajax_error      : { message: "", errors: [] },
};

export const getters = {
  result          : state => state.resultData,
  returnData      : state  => state.returnArr,
  ajax_error      : state => state.ajax_error,
  
};

export const mutations = {
  [types.DASHBOARD_LIST](state, payload) {
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
  // USERS LIST
/*  getDashboardData: ({ commit, dispatch }, payload) => {
    
    axios.get("/api/getDashboardData")
      .then(response => {
        commit(types.DASHBOARD_LIST, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
        // console.log(message);
      })
      .finally(() => {
      });
  },
*/



    getDashboardData: ({ commit }, payload) => {
    return new Promise((resolve, reject) => {
        axios.get("/api/getDashboardData")
            .then((response) => {
                commit(types.DASHBOARD_LIST, response.data);
                resolve();
            })
            .catch((error) => {
                commit(types.AJAX_ERROR, error);
                reject(true);
            });
    });
    },
    

};  