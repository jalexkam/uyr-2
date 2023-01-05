import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultServiceArr      : [],
  resultData            : [],
   editArr              : [],
   returnArr            : {},
  ajax_error            : { message: "", errors: [] },
}; 

export const getters = {
  resultContactUs   : state => state.resultContactUsArr,
  result           : state => state.resultData,
   returnData       : state => state.returnArr,
  editData         : state => state.editArr,
  ajax_error       : state => state.ajax_error,
};

export const mutations = {
  [types.MASTER_ASSOCIATE_PARTNERS_LIST](state, payload) {
    state.resultData  = payload;
  },
  [types.MASTER_ASSOCIATE_PARTNERS_DATA](state, payload) {
    state.editArr  = payload;
  },
  [types.MASTER_CREATE_ASSOCIATE_PARTNERS](state, payload) {
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
  // Contact Us LIST
   list: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
    axios.get("/api/manageWebsite/associate_partners?page=" + payload.page + '&keyword=' + payload.keyword)
      .then(response => {
        commit(types.MASTER_ASSOCIATE_PARTNERS_LIST, response.data);
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
                .get('/api/manageWebsite/associate_partners/' + payload)
                .then((response) => {
                    commit(types.MASTER_ASSOCIATE_PARTNERS_DATA, response.data);
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
              .delete('/api/manageWebsite/associate_partners/' + payload.id + '?action=' + payload.action)
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
            var post_url = axios.post('/api/manageWebsite/associate_partners', payload.newData);
        } else {
            var post_url = axios.post('/api/manageWebsite/associate_partners/update/' + payload.id, payload.newData);
        }
        return post_url
            .then((response) => {
                if (response.data.status == 'error') {
                    commit(types.AJAX_ERROR, response.data);
                    reject(true);
                } else {
                    commit(types.MASTER_CREATE_ASSOCIATE_PARTNERS, response.data);
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