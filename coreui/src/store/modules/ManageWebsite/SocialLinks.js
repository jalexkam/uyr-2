import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultServiceArr      : [],
   editArr              : [],
   returnArr            : {},
  ajax_error            : { message: "", errors: [] },
}; 

export const getters = {
  resultContactUs   : state => state.resultContactUsArr,
  returnData       : state => state.returnArr,
  editData         : state => state.editArr,
  ajax_error       : state => state.ajax_error,
};

export const mutations = {
  [types.MASTER_ABOUT_US_DATA](state, payload) {
    state.editArr  = payload;
  },
  [types.MASTER_CREATE_ABOUT_US](state, payload) {
    state.returnArr  = payload;
  },
   [types.MULTI_ACTION](state, payload) {
        state.returnArr = payload;;
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
  edit: ({ commit }, payload) => {
        return new Promise((resolve, reject) => {
            axios
                .get('/api/manageWebsite/socialLinks/' + payload)
                .then((response) => {
                    commit(types.MASTER_ABOUT_US_DATA, response.data);
                    resolve();
                })
                .catch((error) => {
                    commit(types.AJAX_ERROR, error);
                    reject(true);
                });
        });
    },


 submitForm: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
          var post_url = axios.patch('/api/manageWebsite/socialLinks/' + payload.id, payload);
        return post_url
            .then((response) => {
                if (response.data.status == 'error') {
                    commit(types.AJAX_ERROR, response.data);
                    reject(true);
                } else {
                    commit(types.MASTER_CREATE_ABOUT_US, response.data);
                    resolve();
                }
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