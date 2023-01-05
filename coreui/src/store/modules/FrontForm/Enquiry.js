import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData      : [],
  returnArr       : {},
  editArr         : [],
  ajax_error      : { message: "", errors: [] },
};

export const getters = {
  result          : state => state.resultData,
  returnData      : state  => state.returnArr,
  ajax_error      : state => state.ajax_error,
  editData        : (state) => state.editArr,
};

export const mutations = {
  
  [types.CAREERS_LIST](state, payload) {
    state.resultData  = payload;
  },

   [types.EDIT_CAREERS](state, payload) {
    state.editArr = payload;
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

  list: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
    axios.get("/api/enquiry?page=" + payload.page + '&keyword=' + payload.keyword)
      .then(response => {
        commit(types.CAREERS_LIST, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
      })
      .finally(() => {
      });
  },
  
  edit: ({ commit }, payload) => {
    return new Promise((resolve, reject) => {
        axios
            .get('/api/enquiry/' + payload)
            .then((response) => {
                commit(types.EDIT_CAREERS, response.data);
                resolve();
            })
            .catch((error) => {
                commit(types.AJAX_ERROR, error);
                reject(true);
            });
    });
  },

    UpdateMultiAction: ({ commit, dispatch }, payload) => {
      return new Promise((resolve, reject) => {
          axios.delete('/api/enquiry/' + payload.id + '?action=' + payload.action)
                .then((response) => {
                  commit(types.MULTI_ACTION, response.data);
                  resolve();
              })
              .catch((error) => {
                  commit(types.AJAX_ERROR, error);
                  reject(true);
              })
              .finally(() => {
              });
      });
    },


};  