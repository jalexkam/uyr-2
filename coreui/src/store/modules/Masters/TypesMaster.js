import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
   resultData         : [],
    resultTypeArr         : [],
    editArr           : [],
   returnTypeData     : {},
   returnArr          : {},
  ajax_error          : { message: "", errors: [] },
}; 

export const getters = {
  resultType              : state => state.resultTypeArr,
  result                  : state => state.resultData,
  returnData              : state => state.returnArr,
  editData                : state => state.editArr  ,
  returnTypeResult        : state => state.returnTypeData,
  ajax_error              : state => state.ajax_error,
};

export const mutations = {
  [types.MASTER_TYPE_ALL_LIST](state, payload) {
    state.resultTypeArr  = payload;
  },

  [types.MASTER_TYPE_LIST](state, payload) {
    state.resultData  = payload;
  },
   [types.MASTER_TYPE_DATA](state, payload) {
    state.editArr = payload;
  },

  [types.MASTER_CREATE_TYPE](state, payload) {
    state.returnArr  = payload;
  },
   [types.MULTI_ACTION](state, payload) {
        state.returnArr = payload;
    },
  [types.AJAX_ERROR](state, payload) {
    console.log('payload'+payload);
    let message   = payload.response.data.message || payload.message;
    let errors    = payload.response.data.errors;
    state.ajax_error  = {
      message: message,
      errors: errors
    };
  },
};

export const actions = {

  TypeList: ({ commit, dispatch }, payload) => {
    axios.get("/api/masters/getTypesList")
      .then(response => {
        commit(types.MASTER_TYPE_ALL_LIST, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
        // console.log(message);
      })
      .finally(() => {
      });
  },


  list: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
    axios.get("/api/masters/types?page=" + payload.page + '&keyword=' + payload.keyword)
      .then(response => {
        commit(types.MASTER_TYPE_LIST, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
        // console.log(message);
      })
      .finally(() => {
      });
  },


   edit: ({ commit }, payload) => {
        return new Promise((resolve, reject) => {
            axios
                .get('/api/masters/types/' + payload)
                .then((response) => {
                    commit(types.MASTER_TYPE_DATA, response.data);
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
          axios
              .delete('/api/masters/types/' + payload.id + '?action=' + payload.action)
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

 
    submitForm: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
        if (payload.id == '') {
            var post_url = axios.post('/api/masters/types', payload);
        } else {
            var post_url = axios.patch('/api/masters/types/' + payload.id, payload);
        }
        return post_url
            .then((response) => {
                if (response.data.status == 'error') {
                    commit(types.AJAX_ERROR, response.data);
                    reject(true);
                } else {
                    commit(types.MASTER_CREATE_TYPE, response.data);
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