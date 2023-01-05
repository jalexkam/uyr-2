import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData      : {},
  statusArr      : {},
  rolesData       : [],
  doctorData      : [],
  returnArr       : {},
  arrreturn       : {},
  ajax_error      : { message: "", errors: [] },
};

export const getters = {
  result          : state => state.resultData,
  statusData    : state => state.statusArr,
  returnData      : state  => state.returnArr,
  rolesResult     : state => state.rolesData,
  doctorResult    : state => state.doctorData,
  Datareturn      : state => state.arrreturn,
  ajax_error      : state => state.ajax_error,
};

export const mutations = {
  [types.DOCTOR_LIST](state, payload) {
    state.resultData  = payload;
  },

   [types.DOCTOR_STATUS](state, payload) {
    state.returnArr  = payload;
  },

  [types.GET_ROLES_DATA](state, payload) {
    state.rolesData   = payload;
  },
  [types.CREATE_DOCTOR](state, payload) {
    state.returnArr = payload;
  },
  [types.DELETE_DOCTOR](state, payload) {
    state.returnArr = payload;
  },
  [types.GET_DOCTOR_DATA](state, payload) {
    state.doctorData = payload;
  },
  [types.CHANGE_PASSWORD](state, payload) {
    state.returnArr = payload;
  },
  [types.DOC_STATUS](state, payload) {
    state.arrreturn  = payload;
  },
  [types.PROFILE_SETTINGS](state, payload) {
    state.returnArr = payload;
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
   list: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
    axios.get("/api/mediatorDoctor?page=" + payload.page + '&keyword=' + payload.keyword)
      .then(response => {
        commit(types.DOCTOR_LIST, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
        // console.log(message);
      })
      .finally(() => {
      });
  },
  
  //ADD AND EDIT FORM
   submitForm: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
          var post_url = axios.post("/api/mediatorDoctor", payload.newData);
            return post_url
        .then(response => {
          commit(types.CREATE_DOCTOR, response.data);
          resolve();
        })
        .catch(error => {
          commit(types.AJAX_ERROR, error);
          reject(true);
        })
        .finally(() => {
        });
    });
  },

  // Get User Data
  getMediatorData: ({ commit }, payload) => {
        return new Promise((resolve, reject) => {
            axios
                .get('/api/mediatorDoctor/' + payload)
                .then((response) => {
                    commit(types.GET_DOCTOR_DATA, response.data);
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
        axios.delete('/api/mediatorDoctor/' + payload.id + '?action=' + payload.action)
              .then((response) => {
                commit(types.MULTI_ACTION, response.data);
                resolve();
            })
            .catch((error) => {
                commit(types.AJAX_ERROR, error);
                reject(true);
            })
            .finally(() => {
                // commit('setLoading', false)
            });
    });
},



   submitMediatorUpdateForm: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
          var post_url = axios.post("/api/mediatorDoctor/updateMediator/" + payload.id, payload.newData);
            return post_url
        .then(response => {
          commit(types.CREATE_DOCTOR, response.data);
          resolve();
        })
        .catch(error => {
          commit(types.AJAX_ERROR, error);
          reject(true);
        })
        .finally(() => {
        });
    });
  },



};  