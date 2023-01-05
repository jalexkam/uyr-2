import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData      : [],
  rolesData       : [],
  patientsData    : [],
  returnArr       : {},
  paymentArr      :{},
  consaltionArr   :{},
  medicalhistoryArr:{},
  editArr         : [],
  doctorSuggestArr: [],
  ajax_error      : { message: "", errors: [] },
};

export const getters = {
  result          : state => state.resultData,
  returnData      : state  => state.returnArr,
  patientsResult  : state => state.patientsData,
  ajax_error      : state => state.ajax_error,
  editData        : (state) => state.editArr,
  doctorSuggestData: (state) => state.doctorSuggestArr,
  paymentData      : state  => state.paymentArr,
  consaltionData      : state  => state.consaltionArr,
  medicalhistoryData : state  =>state.medicalhistoryArr,
};




export const mutations = {
  [types.REQUEST_APPOINTMENT_LIST](state, payload) {
    state.resultData  = payload;
  },

  [types.PATIENT_APPOINTMENT](state, payload) {
    state.resultData  = payload;
  },

   [types.DOCTOR_APPOINTMENT](state, payload) {
    state.resultData  = payload;
  },
  
  [types.GET_BOOKING_DETAILS](state, payload) {
    state.resultData = payload;
  },

   [types.SUGGEST_TO_PATIENT](state, payload) {
    state.returnArr  = payload;
  },
  
   [types.CREATE_APPOINTMENT](state, payload) {
    state.returnArr  = payload;
  },

  [types.APPOINTMENT_STATUS](state, payload) {
    state.returnArr  = payload;
  },

  [types.SUGGEST_DOCTORS](state, payload) {
    state.returnArr = payload;
  },

  [types.GET_DOCTOR_SUGGEST](state, payload) {
    state.doctorSuggestArr = payload;
  },

  [types.PAYMENT_ORDER](state, payload) {
        state.paymentArr = payload;
  },

  [types.GET_MEDICALHISTORY](state, payload) {
        state.medicalhistoryArr = payload;
  },

  [types.SUBMIT_CONSULTATON_FORM](state, payload) {
        state.consaltionArr = payload;
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

  requestAppointmentsList: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
       if (payload.drType == undefined) {
          payload.drType = 0;
      }
      
    axios.get("/api/requestAppointments?page=" + payload.page + '&keyword=' + payload.keyword + '&drType=' + payload.drType)
      .then(response => {
        commit(types.REQUEST_APPOINTMENT_LIST, response.data);
      })  
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
      })
      .finally(() => {
      });
  },

  patientAppointment: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
       if (payload.drType == undefined) {
          payload.drType = 0;
      }
      
    axios.get("/api/appointment/patientAppointment?page=" + payload.page + '&keyword=' + payload.keyword + '&drType=' + payload.drType)
      .then(response => {
        commit(types.PATIENT_APPOINTMENT, response.data);
      })  
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
      })
      .finally(() => {
      });
  },

    doctorAppointment: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
       if (payload.drType == undefined) {
          payload.drType = 0;
      }
      
    axios.get("/api/appointment/doctorAppointment?page=" + payload.page + '&keyword=' + payload.keyword + '&drType=' + payload.drType)
      .then(response => {
        commit(types.DOCTOR_APPOINTMENT, response.data);
      })  
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
      })
      .finally(() => {
      });
  },



  searchDoctor: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
       if (payload.drType == undefined) {
          payload.drType = 0;
      }

    axios.get("/api/appointment/searchDoctor?page=" + payload.page + '&keyword=' + payload.keyword + '&drType=' + payload.drType+ '&doctor_suggest_id=' + payload.doctor_suggest_id)
      .then(response => {
        commit(types.REQUEST_APPOINTMENT_LIST, response.data);
      })  
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
      })
      .finally(() => {
      });
  },


  suggest_To_Patient: ({ commit, dispatch }, payload) => {
      return new Promise((resolve, reject) => {
          axios
             axios.get("/api/appointment/sent_suggestToPatient?suggest_id=" + payload.suggest_id + '&doctor_id=' + payload.doctor_id+ '&doctor_ids=' + payload.doctor_ids+ '&type=' + payload.type )
             .then((response) => {
                  commit(types.SUGGEST_TO_PATIENT, response.data);
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

  create_appointment: ({ commit, dispatch }, payload) => {
      return new Promise((resolve, reject) => {
          axios
             axios.get("/api/appointment/create_appointment?appointment_date=" + payload.appointment_date + '&appointment_time=' + payload.appointment_time+ '&doctor_suggest_id=' + payload.doctor_suggest_id+ '&doctor_id=' + payload.doctor_id )
             .then((response) => {
                  commit(types.CREATE_APPOINTMENT, response.data);
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


  


    changeAppointmentStatus: ({ commit, dispatch }, payload) => {
      return new Promise((resolve, reject) => {
          axios
             axios.get("/api/appointment/changeAppointmentStatus?id=" + payload.id + '&patient_id=' + payload.patient_id + '&appointment_date=' + payload.appointment_date+ '&appointment_time=' + payload.appointment_time+ '&action=' + payload.action )
             .then((response) => {
                  commit(types.APPOINTMENT_STATUS, response.data);
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

    // Get User Data
    getBookingData: ({ commit }, payload) => {
        return new Promise((resolve, reject) => {
          axios
              .get('/api/appointment/getBookingData/' + payload)
              .then((response) => {
                  commit(types.GET_BOOKING_DETAILS, response.data);
                  resolve();
              })
              .catch((error) => {
                  commit(types.AJAX_ERROR, error);
                  reject(true);
              });
        });
    },


    orderPayment: ({ commit, dispatch }, payload) => {
        return new Promise((resolve, reject) => {
          console.log(payload);
            if (payload.id == '') {
                var post_url = axios.post('/api/payment/order_payment', payload);
            } else {
                var post_url = axios.patch('/api/payment/order_payment/' + payload.id, payload);
            }
            return post_url
                .then((response) => {
                    if (response.data.status == 'error') {
                        commit(types.AJAX_ERROR, response.data);
                        reject(true);
                    } else {
                        commit(types.PAYMENT_ORDER, response.data);
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


      orderPaymentBKK: ({ commit, dispatch }, payload) => {
      return new Promise((resolve, reject) => {
       
        axios.post("/api/payment/order_payment",payload)
          .then(response => {
            commit(types.PAYMENT_ORDER, response.data);
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


     getMedicalHistory: ({ commit, dispatch }, payload) => {
    axios.get("/api/appointment/getMedicalHistory")
      .then(response => {
        commit(types.GET_MEDICALHISTORY, response.data);
      })  
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
      })
      .finally(() => {
      });
  },


    submitConsultationForm: ({ commit, dispatch }, payload) => {
        return new Promise((resolve, reject) => {
          console.log(payload);
            if (payload.id == '') {
                var post_url = axios.post('/api/appointment/submitConsultationForm', payload);
            } else {
                var post_url = axios.post('/api/appointment/submitConsultationForm/' + payload.id, payload);
            }
            return post_url
                .then((response) => {
                    if (response.data.status == 'error') {
                        commit(types.AJAX_ERROR, response.data);
                        reject(true);
                    } else {
                        commit(types.SUBMIT_CONSULTATON_FORM, response.data);
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


    submitConsultationComment: ({ commit, dispatch }, payload) => {
        return new Promise((resolve, reject) => {
           var post_url = axios.post('/api/appointment/submitConsultationComment',payload);
            return post_url
                .then((response) => {
                    if (response.data.status == 'error') {
                        commit(types.AJAX_ERROR, response.data);
                        reject(true);
                    } else {
                        commit(types.SUBMIT_CONSULTATON_FORM, response.data);
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