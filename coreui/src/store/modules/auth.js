import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

// state
export const state = {
  user        : null,
  token       : Cookies.get("token"),
  ajax_error  : {
    message   : "",
    errors    : []
  },
  returnArr   : {},
  userRole    : [],
  returnForgotPassword :[],
  returnResetPassword :[],
  returnOtpArr :[],
  returnrResendOtpArr : [],
  returnCheckVerifiedArr : [],
}

// getters
export const getters = {
  user             : state => state.user,
  token            : state => state.token,
  check            : state => state.user !== null,
  login_ajax_error : state => state.ajax_error,
  ajax_error       : state => state.ajax_error,
  returnData       : state => state.returnArr,
  userRoleData     : state => state.userRole,
  forgotPasswordResult    : state => state.returnForgotPassword,
  resetPasswordResult     : state => state.returnResetPassword,
  otpResultData           : state => state.returnOtpArr,
  resendOtpResultData     : state => state.returnrResendOtpArr,
  checkVerifiedResultData : state => state.returnCheckVerifiedArr,
}

// mutations
export const mutations = {

  [types.LOGIN](state, payload) {
    state.returnArr   = payload;
    //state.ajax_error  = { message: "", errors: {} };
  },

  [types.SAVE_TOKEN] (state, { token, remember }) {
    state.token = token
    Cookies.set('token', token, { expires: remember ? 365 : null })
  },

  [types.FETCH_USER_SUCCESS] (state, { user }) {
    state.user = user
  },

  [types.UPDATE_ROLE_USER](state, payload) {
    state.userRole = payload;
  },
  [types.FORGOT_PASSWORD](state, payload) {
    state.returnForgotPassword = payload;
  },
  [types.RESET_PASSWORD_EMAIL](state, payload) {
    state.returnResetPassword = payload;
  },
  [types.VALIDATE_OTP](state, payload) {
    state.returnOtpArr = payload;
  },
  [types.RESEND_OTP](state, payload) {
    state.returnrResendOtpArr = payload;
  },
  [types.CHECK_IF_ALREADY_VERIFIED](state, payload) {
    state.returnCheckVerifiedArr = payload;
  },
  [types.FETCH_USER_FAILURE] (state) {
    state.token = null
    Cookies.remove('token')
  },

  [types.LOGOUT] (state) {
    state.user = null
    state.token = null

    Cookies.remove('token')
  },

  [types.UPDATE_USER] (state, { user }) {
    state.user = user
  },

 [types.MULTI_ACTION](state, payload) {
    state.returnArr = payload;
  },
  
  [types.AJAX_ERROR](state, payload) {
    let message = payload.response.data.message || payload.message;
    let errors = payload.response.data.errors;
    state.ajax_error = {
      message: message,
      errors: errors
    };
  },

  resetState(state,resp) {
    state.addData           =  [],
    state.editArr           =  [],
    state.returnArr         =  {},
    state.ajax_error        =  { message : "", errors  : [] }
  }
}

// actions
export const actions = {
  
  login({ commit, dispatch }, payload) {
    return new Promise((resolve, reject) => {
      axios
        .post("/api/login", payload)
        .then(response => {
          commit(types.LOGIN, response.data);
          resolve();
        })
        .catch(error => {
          commit(types.AJAX_ERROR, error);
          reject(true);
        })
        .finally(() => {
          // commit('setLoading', false)
        });
    });
  },


  //registerUser
  
    registerUser: ({ commit, dispatch }, payload) => {
        return new Promise((resolve, reject) => {
            axios
                .post('/api/register', payload)
                .then((response) => {
                    commit(types.MULTI_ACTION, response);
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


    registerDoctor: ({ commit, dispatch }, payload) => {
        return new Promise((resolve, reject) => {
            axios
                .post('/api/registerDoctor', payload)
                .then((response) => {
                    commit(types.MULTI_ACTION, response);
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
    


  saveToken ({ commit, dispatch }, payload) {
    commit(types.SAVE_TOKEN, payload)
  },



  async fetchUser ({ commit }) {
    try {
      const { data } = await axios.get('/api/get_user')

      commit(types.FETCH_USER_SUCCESS, { user: data })
    } catch (e) {
      commit(types.FETCH_USER_FAILURE)
    }
  },


   get_user: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios
        .get("/api/get_user", payload)
        .then(response => {
          commit(types.FETCH_USER_SUCCESS, response);
          resolve();
        })
        .catch(error => {
          commit(types.AJAX_ERROR, error);
          reject(true);
        })
        .finally(() => {
          // commit('setLoading', false)
        });
    });
  },

  validateUserOtp: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios
          .post('/api/validateOtp', payload)
          .then((response) => {
              commit(types.VALIDATE_OTP, response);
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

  resendUserOtp: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios
          .post('/api/resendOtp', payload)
          .then((response) => {
              commit(types.RESEND_OTP, response);
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

  checkIfAlreadyVerified: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios
          .post('/api/checkIfAlreadyVerified/'+payload)
          .then((response) => {
              commit(types.CHECK_IF_ALREADY_VERIFIED, response);
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

  forgotPasswordEmail: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios
        .post('/api/forgotPassword', payload)
        .then((response) => {
            commit(types.FORGOT_PASSWORD, response);
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

  resetPassword: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios
          .post('/api/resetPassword', payload)
          .then((response) => {
              commit(types.RESET_PASSWORD_EMAIL, response);
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
 

   validateLogin: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios
        .post("/api/validateLogin", payload)
        .then(response => {
          commit(types.MULTI_ACTION, response);
          resolve();
        })
        .catch(error => {
          commit(types.AJAX_ERROR, error);
          reject(true);
        })
        .finally(() => {
          // commit('setLoading', false)
        });
    });
  },

  validateUser: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios
        .post("/api/validateUser", payload)
        .then(response => {
          commit(types.MULTI_ACTION, response);
          resolve();
        })
        .catch(error => {
          commit(types.AJAX_ERROR, error);
          reject(true);
        })
        .finally(() => {
          // commit('setLoading', false)
        });
    });
  },

  async logout ({ commit }) {
    try {
      await axios.c('/api/logout')
    } catch (e) { }

    commit(types.LOGOUT)
  },

  resetState: ({ commit }) => {
    commit("resetState");
  },
}
