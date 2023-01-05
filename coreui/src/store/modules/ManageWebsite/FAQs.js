import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData            : [],
   getFaqData           : [],
   returnFaqData        : {},
   returnArr            : {},
    editArr             : [],
  ajax_error            : { message: "", errors: [] },
}; 

export const getters = {
  result                  : state => state.resultData,
  returnData              : state => state.returnArr,
  FaqResult               : state => state.getFaqData,
  //returnData         : state => state.returnFaqData,
   editData               : state => state.editArr  ,
  ajax_error              : state => state.ajax_error,
};

export const mutations = {
  [types.MASTER_FAQ_LIST](state, payload) {
    state.resultData  = payload;
  },
  [types.MASTER_FAQ_DATA](state, payload) {
    state.editArr = payload;
  },
  [types.MASTER_CREATE_FAQ](state, payload) {
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
  // FAQ LIST
  list: ({ commit, dispatch }, payload) => {
	  
	// alert("Hello");
    axios.get("/api/manageWebsite/faq?page=" + payload.page + '&keyword=' + payload.keyword)
      .then(response => {
        commit(types.MASTER_FAQ_LIST, response.data);
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
                .get('/api/manageWebsite/faq/' + payload)
                .then((response) => {
                    commit(types.MASTER_FAQ_DATA, response.data);
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
              .delete('/api/manageWebsite/faq/' + payload.id + '?action=' + payload.action)
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
 

   getRoles: ({ commit, dispatch }, payload) => {
    axios.get("/api/manageWebsite/addfaq/getRoles")
      .then(response => {
        commit(types.GET_ROLES_DATA, response.data);
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
            if (payload.id == '') {
                var post_url = axios.post('/api/manageWebsite/faq', payload);
            } else {
                var post_url = axios.patch('/api/manageWebsite/faq/' + payload.id, payload);
            }
            return post_url
                .then((response) => {
                    if (response.data.status == 'error') {
                        commit(types.AJAX_ERROR, response.data);
                        reject(true);
                    } else {
                        commit(types.MASTER_CREATE_FAQ, response.data);
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