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
  [types.MASTER_CONTACT_US_LIST](state, payload) {
    state.resultData  = payload;
  },
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
  // Contact Us LIST
   list: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
    axios.get("/api/manageWebsite/contactUs?page=" + payload.page + '&keyword=' + payload.keyword)
      .then(response => {
        commit(types.MASTER_CONTACT_US_LIST, response.data);
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
                .get('/api/manageWebsite/aboutUs/' + payload)
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


    termsconditionedit: ({ commit }, payload) => {
      return new Promise((resolve, reject) => {
          axios
              .get('/api/manageWebsite/termsconditionedit/' + payload)
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

  
  privacypolicyedit: ({ commit }, payload) => {
    return new Promise((resolve, reject) => {
        axios
            .get('/api/manageWebsite/privacypolicyedit/' + payload)
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


whyusedit: ({ commit }, payload) => {
  return new Promise((resolve, reject) => {
      axios
          .get('/api/manageWebsite/whyusedit/' + payload)
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
          var post_url = axios.post('/api/manageWebsite/aboutUs/update/' + payload.id, payload.newData);
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