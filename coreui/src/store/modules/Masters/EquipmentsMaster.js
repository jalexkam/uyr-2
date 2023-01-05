import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
   resultData           : [],
   editArr              : [],
   returnEquipmentData  : {},
   returnArr            : {},
  ajax_error            : { message: "", errors: [] },
}; 

export const getters = {
  result                  : state => state.resultData,
  returnData              : state => state.returnArr,
  editData                : (state) => state.editArr,
  returnEquipmentResult   : state => state.returnEquipmentData,
  ajax_error              : state => state.ajax_error,
};

export const mutations = {
  [types.MASTER_EQUIPMENT_LIST](state, payload) {
    state.resultData  = payload;
  },
  [types.MASTER_EQUIPMENT_DATA](state, payload) {
    state.editArr = payload;
  },
  [types.MASTER_CREATE_EQUIPMENT](state, payload) {
    state.returnArr = payload;
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

   // EQUIPMENT  LIST
  list: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
    axios.get("/api/masters/equipment?page=" + payload.page + '&keyword=' + payload.keyword)
      .then(response => {
        commit(types.MASTER_EQUIPMENT_LIST, response.data);
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
                .get('/api/masters/equipment/' + payload)
                .then((response) => {
                    commit(types.MASTER_EQUIPMENT_DATA, response.data);
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
              .delete('/api/masters/equipment/' + payload.id + '?action=' + payload.action)
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
            var post_url = axios.post('/api/masters/equipment', payload);
        } else {
            var post_url = axios.patch('/api/masters/equipment/' + payload.id, payload);
        }
        return post_url
            .then((response) => {
                if (response.data.status == 'error') {
                    commit(types.AJAX_ERROR, response.data);
                    reject(true);
                } else {
                    commit(types.MASTER_CREATE_EQUIPMENT, response.data);
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