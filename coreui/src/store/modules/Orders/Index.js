import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData      : [],
  getPatientCondtionArr  : [],
  getConsultationArr:[],
  patientsData    : [],
  returnArr       : {},
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
  getPatientCondtionData: state  => state.getPatientCondtionArr,
  getConsultationData: state  => state.getConsultationArr,
  

  
};

export const mutations = {
  [types.GET_CONDTION](state, payload) {
    state.getPatientCondtionArr  = payload;
  },

  [types.GET_CONSULTATION](state, payload) {
    state.getConsultationArr  = payload;
  },

  [types.ORDERS_BOOKING](state, payload) {
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

   bookingOrders: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
       if (payload.drType == undefined) {
          payload.drType = 0;
      }
      if (payload.tabID == undefined) {
          payload.tabID = 0;
      }
    
    axios.get("/api/Orders/OrdersBooking?page=" + payload.page + '&keyword=' + payload.keyword + '&drType=' + payload.drType + '&tabID=' + payload.tabID)
      .then(response => {
        commit(types.ORDERS_BOOKING, response.data);
      })  
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
      })
      .finally(() => {
      });
  },

    updateStatus: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
        axios.get('/api/Orders/updateStatus/' + payload.id + '?action=' + payload.action)
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

  getPatientCondtion: ({ commit }, payload) => {
      return new Promise((resolve, reject) => {
          axios
              .get('/api/Orders/getPatientCondtion/' + payload)
              .then((response) => {
                  commit(types.GET_CONDTION, response.data);
                  resolve();
              })
              .catch((error) => {
                  commit(types.AJAX_ERROR, error);
                  reject(true);
              });
      });
    },



  getConsultation: ({ commit }, payload) => {
      return new Promise((resolve, reject) => {
          axios
              .get('/api/Orders/getConsultation/' + payload)
              .then((response) => {
                  commit(types.GET_CONSULTATION, response.data);
                  resolve();
              })
              .catch((error) => {
                  commit(types.AJAX_ERROR, error);
                  reject(true);
              });
      });
    },








  /*requestAppointmentsList: ({ commit, dispatch }, payload) => {
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
*/
 

  /*  doctorAppointment: ({ commit, dispatch }, payload) => {
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
  },*/



 /* searchDoctor: ({ commit, dispatch }, payload) => {
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
*/

/*  suggest_To_Patient: ({ commit, dispatch }, payload) => {
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
  },*/

/*  create_appointment: ({ commit, dispatch }, payload) => {
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
*/

  

/*
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
  },*/

    // Get User Data
/*    getBookingData: ({ commit }, payload) => {
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
*/


  
  
    



};  