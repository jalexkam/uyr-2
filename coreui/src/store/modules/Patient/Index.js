import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData      : [],
  rolesData       : [],
  patientsData    : [],
  returnArr       : {},
  patientArr      :[],
  editArr         : [],
  favDoctorResult : [],
  ajax_error      : { message: "", errors: [] },
};

export const getters = {
  result          : state => state.resultData,
  patientList          : state => state.patientArr,
  returnData      : state  => state.returnArr,
  patientsResult  : state => state.patientsData,
  ajax_error      : state => state.ajax_error,
  editData        : (state) => state.editArr,
  getFavDoctorResult   : state => state.favDoctorResult,
};

export const mutations = {
  [types.DOCTOR_SEARCH_LIST](state, payload) {
    state.resultData  = payload;
  },

[types.GET_PATIENT_LIST](state, payload) {
    state.patientArr  = payload;
  },

  [types.PATIENT_LIST](state, payload) {
    state.resultData  = payload;
  },

  [types.GET_FAVORITE_DOCTOR_LIST](state, payload) {
    state.resultData  = payload;
  },
  [types.GET_FAVORITE_DOCTOR_DATA](state, payload) {
    state.favDoctorResult  = payload;
  },

  [types.CREATE_PATIENT](state, payload) {
    state.returnArr = payload;
  },

  [types.SUGGEST_DOCTORS](state, payload) {
    state.returnArr = payload;
  },

   [types.BOOKING_REQUEST](state, payload) {
    state.returnArr = payload;
  },


  [types.DELETE_PATIENT](state, payload) {
    state.returnArr = payload;
  },
  [types.GET_PATIENT_DATA](state, payload) {
    state.resultData = payload;
  },

  [types.GET_PATIENT_DETAILS](state, payload) {
    state.resultData = payload;
  },

  [types.GET_DOCTORS_DETAILS](state, payload) {
    state.resultData = payload;
  },
  
   [types.EDIT_PATIENT](state, payload) {
    state.editArr = payload;
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

  list: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
    axios.get("/api/patients?page=" + payload.page + '&keyword=' + payload.keyword)
      .then(response => {
        commit(types.PATIENT_LIST, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
      })
      .finally(() => {
      });
  },

   getPatientsList: ({ commit }, payload) => {
        return new Promise((resolve, reject) => {
        axios
            .get('/api/getPatientsList'  )
            .then((response) => {
                commit(types.GET_PATIENT_LIST, response.data);
                resolve();
            })
            .catch((error) => {
                commit(types.AJAX_ERROR, error);
                reject(true);
            });
        });
    },


   searchDoctor: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
    if (payload.drType == undefined) {
        payload.drType = '';
    }
      
    axios.get("/api/patient/searchDoctor?page=" + payload.page + '&keyword=' + payload.keyword+ 
      '&type_specialist=' + payload.type_specialist+ '&doctor_suggest_id=' + payload.doctor_suggest_id+ '&distance=' + payload.distance+ '&patient_id=' + payload.patient_id)
      .then(response => {
        commit(types.DOCTOR_SEARCH_LIST, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
      })
      .finally(() => {
      });
  },

    submitForm: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
        if (payload.id == '') {
            var post_url = axios.post('/api/patients', payload.newData);
        } else {
            var post_url = axios.patch('/api/patients/' + payload.id, payload.newData);
        }
        return post_url
            .then((response) => {
                if (response.data.status == 'error') {
                    commit(types.AJAX_ERROR, response.data);
                    reject(true);
                } else {
                    commit(types.CREATE_PATIENT, response.data);
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

    submitPatientsUpdateForm: ({ commit, dispatch }, payload) => {
        return new Promise((resolve, reject) => {
            var post_url = axios.post("/api/patients/updatePatients/" + payload.id, payload.newData);
              return post_url
          .then(response => {
            commit(types.CREATE_PATIENT, response.data);
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

    submitSuggestDoctorForm: ({ commit, dispatch }, payload) => {
        return new Promise((resolve, reject) => {
            var post_url = axios.post("/api/patients/suggestDoctor/" + payload.id, payload.newData);
              return post_url
          .then(response => {
            commit(types.SUGGEST_DOCTORS, response.data);
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


        submitBookingRequestForm: ({ commit, dispatch }, payload) => {
          return new Promise((resolve, reject) => {
              var post_url = axios.post("/api/patients/bookingRequest", payload.newData);
                return post_url
            .then(response => {
              commit(types.BOOKING_REQUEST, response.data);
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

    




    


    edit: ({ commit }, payload) => {
    return new Promise((resolve, reject) => {
        axios
            .get('/api/patients/' + payload)
            .then((response) => {
                commit(types.EDIT_PATIENT, response.data);
                resolve();
            })
            .catch((error) => {
                commit(types.AJAX_ERROR, error);
                reject(true);
            });
    });
    },

  // Get User Data
  getPatientData: ({ commit }, payload) => {
        return new Promise((resolve, reject) => {
            axios
                .get('/api/patients/' + payload)
                .then((response) => {
                    commit(types.GET_PATIENT_DATA, response.data);
                    resolve();
                })
                .catch((error) => {
                    commit(types.AJAX_ERROR, error);
                    reject(true);
                });
        });
    },

      // Get User Data
      getPatientDetailsData: ({ commit }, payload) => {
            return new Promise((resolve, reject) => {
              axios
                  .get('/api/patients/details/' + payload)
                  .then((response) => {
                      commit(types.GET_PATIENT_DETAILS, response.data);
                      resolve();
                  })
                  .catch((error) => {
                      commit(types.AJAX_ERROR, error);
                      reject(true);
                  });
            });
        },

      getdoctorData: ({ commit }, payload) => {
            return new Promise((resolve, reject) => {
            axios
                .get('/api/patients/getdoctorData/' + payload)
                .then((response) => {
                    commit(types.GET_DOCTORS_DETAILS, response.data);
                    resolve();
                })
                .catch((error) => {
                    commit(types.AJAX_ERROR, error);
                    reject(true);
                });
            });
        },

      getFavoriteDoctorList: ({ commit, dispatch }, payload) => {
        if (payload.keyword == undefined) {
              payload.keyword = '';
          }
        axios.get("/api/getFavoriteDoctorList?page=" + payload.page + '&keyword=' + payload.keyword)
          .then(response => {
            commit(types.GET_FAVORITE_DOCTOR_LIST, response.data);
          })
          .catch(error => {
            message = error.response.data.message || error.message;
            commit(types.AJAX_ERROR, message);
          })
          .finally(() => {
          });
      },

        favoriteStatusChange: ({ commit, dispatch }, payload) => {
          return new Promise((resolve, reject) => {
              axios.get('/api/favoriteStatusChange?doctor_id='+payload.doctor_id +'&patient_id=' + payload.patient_id+'&action=' + payload.action)
                    .then((response) => {
                      commit(types.MULTI_ACTION, response.data);
                      resolve();
                  })
                  .catch((error) => {
                      commit(types.AJAX_ERROR, error);
                      reject(true);
                  })
                  .finally(() => {
                  });
          });
        },

    UpdateMultiAction: ({ commit, dispatch }, payload) => {
      return new Promise((resolve, reject) => {
          axios.delete('/api/patients/' + payload.id + '?action=' + payload.action)
                .then((response) => {
                  commit(types.MULTI_ACTION, response.data);
                  resolve();
              })
              .catch((error) => {
                  commit(types.AJAX_ERROR, error);
                  reject(true);
              })
              .finally(() => {
              });
      });
    },

    getFavDoctorData: ({ commit }, payload) => {
      return new Promise((resolve, reject) => {
      axios
          .get('/api/patients/getFavDoctorData/' + payload)
          .then((response) => {
              commit(types.GET_FAVORITE_DOCTOR_DATA, response.data);
              resolve();
          })
          .catch((error) => {
              commit(types.AJAX_ERROR, error);
              reject(true);
          });
      });
  },
    


};  