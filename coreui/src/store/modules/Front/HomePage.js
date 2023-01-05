import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData      : [],
  ajax_error      : { message: "", errors: [] },
  editArr:[],
  returnArr      : {},
};

export const getters = {
  result          : state => state.resultData,
  ajax_error      : state => state.ajax_error,
  getArticalviewData : (state) => state.editArr,
  returnData         : state => state.returnArr,
};

export const mutations = {
  [types.HOMEPAGE_DATA](state, payload) {
    state.resultData  = payload;
  },

  [types.VIEW_ARTICEL](state, payload) {
    state.editArr = payload;
  },

  [types.CREATE_CONTACTUS](state, payload) {
    state.returnArr  = payload;
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
  gethomePageData: ({ commit, dispatch }, payload) => {
    axios.get("/api/front/gethomePageData")
      .then(response => {
        commit(types.HOMEPAGE_DATA, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
      })
      .finally(() => {
      });
  },


  getArticalview: ({ commit }, payload) => {
    return new Promise((resolve, reject) => {
        axios
            .get('/api/front/getArticalview/' + payload)
            .then((response) => {
                commit(types.VIEW_ARTICEL, response.data);
                resolve();
            })
            .catch((error) => {
                commit(types.AJAX_ERROR, error);
                reject(true);
            });
    });
    },

    submitContactUsForm: ({ commit, dispatch }, payload) => {
      return new Promise((resolve, reject) => {
              var post_url = axios.post('/api/front/insertContactus', payload);
          return post_url
              .then((response) => {
                  if (response.data.status == 'error') {
                      commit(types.AJAX_ERROR, response.data);
                      reject(true);
                  } else {
                      commit(types.CREATE_CONTACTUS, response.data);
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


  submitCareerForm: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
            var post_url = axios.post('/api/front/insertCareerForm', payload.newData);
        return post_url
            .then((response) => {
                if (response.data.status == 'error') {
                    commit(types.AJAX_ERROR, response.data);
                    reject(true);
                } else {
                    commit(types.CREATE_CONTACTUS, response.data);
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