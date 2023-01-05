import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData      : [],
  rolesData       : [],
  usersData       : [],
  returnArr       : {},
  editArr         : [],
  ajax_error      : { message: "", errors: [] },
};

export const getters = {
  result          : state => state.resultData,
  returnData      : state  => state.returnArr,
  rolesResult     : state => state.rolesData,
  usersResult     : state => state.usersData,
  ajax_error      : state => state.ajax_error,
  editData        : (state) => state.editArr,
};

export const mutations = {
  [types.USERS_LIST](state, payload) {
    state.resultData  = payload;
  },
  [types.GET_ROLES_DATA](state, payload) {
    state.rolesData   = payload;
  },
  [types.CREATE_USER](state, payload) {
    state.returnArr = payload;
  },
  [types.DELETE_USER](state, payload) {
    state.returnArr = payload;
  },
  [types.EDIT_USER](state, payload) {
    state.editArr = payload;
  },
  [types.CHANGE_PASSWORD](state, payload) {
    state.returnArr = payload;
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
    axios.get("/api/admin?page=" + payload.page + '&keyword=' + payload.keyword)
      .then(response => {
        commit(types.USERS_LIST, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
        // console.log(message);
      })
      .finally(() => {
      });
  },


  UpdateMultiAction: ({ commit, dispatch }, payload) => {
      return new Promise((resolve, reject) => {
          axios
              .get('/api/admin/delete/' + payload.id + '?action=' + payload.action)
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

  //GET ROLES DATA
  getRoles: ({ commit, dispatch }, payload) => {
    axios.get("/api/admin/getRoles")
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
                var post_url = axios.post('/api/admin', payload);
            } else {
                var post_url = axios.patch('/api/admin/' + payload.id, payload);
            }
            return post_url
                .then((response) => {
                    if (response.data.status == 'error') {
                        commit(types.AJAX_ERROR, response.data);
                        reject(true);
                    } else {
                        commit(types.CREATE_USER, response.data);
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



  //Delete User 
  deleteUser: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios .post("/api/admin/delete/" +payload.id)
        .then(response => {
          commit(types.DELETE_USER, response.data);
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
    // Edit
    edit: ({ commit }, payload) => {
        return new Promise((resolve, reject) => {
            axios
                .get('/api/admin/' + payload)
                .then((response) => {
                    commit(types.EDIT_USER, response.data);
                    resolve();
                })
                .catch((error) => {
                    commit(types.AJAX_ERROR, error);
                    reject(true);
                });
        });
    },




//CHNAGE PASSWORD 
  changePassword: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios .post("/api/admin/changePassword/" +payload.id, payload.formData)
        .then(response => {
          commit(types.CHANGE_PASSWORD, response.data);
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