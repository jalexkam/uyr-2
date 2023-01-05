import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData      : {},
  doctorslotData  : {},
  PatientDoctorArr: {},
  statusArr      : {},
  rolesData       : [],
  doctorData      : [],
  returnEquipArr  : [],
  returnArr       : {},
  prescriptionArr :{},
  arrreturn       : {},
  ajax_error      : { message: "", errors: [] },
};

export const getters = {
  result          : state => state.resultData,
  getSlotData     : state => state.doctorslotData,
  PatientDoctor   : state => state.PatientDoctorArr,
  prescriptionData: state => state.prescriptionArr,
  statusData    : state => state.statusArr,
  returnData      : state  => state.returnArr,
  rolesResult     : state => state.rolesData,
  doctorResult    : state => state.doctorData,
  equipListResult : state => state.returnEquipArr,
  Datareturn      : state => state.arrreturn,
  ajax_error      : state => state.ajax_error,
};

export const mutations = {
  [types.DOCTOR_LIST](state, payload) {
    state.resultData  = payload;
  },

  [types.DOCTOR_BOOK_SLOTS](state, payload) {
    state.doctorslotData  = payload;
  },

  [types.GET_PATIENT_APPOINTMENT_DATA](state, payload) {
    state.resultData  = payload;
  },

   [types.GET_PATIENT_DOCTOR_DATA](state, payload) {
    state.PatientDoctorArr  = payload;
  },


 [types.GET_PRESCRIPTION_DATA](state, payload) {
    state.prescriptionArr  = payload;
  },

   [types.DOCTOR_STATUS](state, payload) {
    state.returnArr  = payload;
  },

  [types.GET_ROLES_DATA](state, payload) {
    state.rolesData   = payload;
  },
  [types.CREATE_DOCTOR](state, payload) {
    state.returnArr = payload;
  },

   [types.ATTACH_RECORD](state, payload) {
    state.returnArr = payload;
  },

   [types.PRESCRIPTION_ADD](state, payload) {
    state.returnArr = payload;
  },
  [types.GET_EQUIPMENT_LIST](state, payload) {
    state.returnEquipArr = payload;
  },

  [types.DELETE_DOCTOR](state, payload) {
    state.returnArr = payload;
  },
  [types.GET_DOCTOR_DATA](state, payload) {
    state.doctorData = payload;
  },
  [types.CHANGE_PASSWORD](state, payload) {
    state.returnArr = payload;
  },
  [types.DOC_STATUS](state, payload) {
    state.arrreturn  = payload;
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
  
    list: ({ commit, dispatch }, payload) => {
    if (payload.keyword == undefined) {
          payload.keyword = '';
      }
    axios.get("/api/doctor?page=" + payload.page + '&keyword=' + payload.keyword)
      .then(response => {
        commit(types.DOCTOR_LIST, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
        // console.log(message);
      })
      .finally(() => {
      });
  },

 get_doctor_bookSlots: ({ commit, dispatch }, payload) => {
    if (payload.appointment_date == undefined) {
          payload.appointment_date = '';
      }
    axios.get("/api/doctors/doctor_booking_slot?appointment_date=" + payload.appointment_date + '&doctor_id=' + payload.doctor_id)
      .then(response => {
        commit(types.DOCTOR_BOOK_SLOTS, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
        // console.log(message);
      })
      .finally(() => {
      });
  },

  //GET ROLES DATA
  getRoles: ({ commit, dispatch }, payload) => {
    axios.get("/api/doctor/getRoles")
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
          var post_url = axios.post("/api/doctor", payload.newData);
           //var post_url = axios.post("/api/doctor/adddoctor", payload.newData);
            return post_url
        .then(response => {
          commit(types.CREATE_DOCTOR, response.data);
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

  //ADD AND EDIT FORM
   submitDoctorUpdateForm: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
          var post_url = axios.post("/api/doctor/updateDoctor/" + payload.id, payload.newData);
            return post_url
        .then(response => {
          commit(types.CREATE_DOCTOR, response.data);
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

   changeAccount_Status: ({ commit, dispatch }, payload) => {
   if (payload.status_id == undefined) {
          payload.status_id = '';
      }
      
    return new Promise((resolve, reject) => {
           axios.get("/api/doctor/change_account_status/"+payload.id+'?status_id=' + payload.status_id)
        .then(response => {
          commit(types.DOCTOR_STATUS, response.data);
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


 UpdateMultiAction: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
        axios.delete('/api/doctor/' + payload.id + '?action=' + payload.action)
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


  // Get User Data
  getdoctorData: ({ commit }, payload) => {
        return new Promise((resolve, reject) => {
            axios
                .get('/api/doctor/' + payload)
                .then((response) => {
                    commit(types.GET_DOCTOR_DATA, response.data);
                    resolve();
                })
                .catch((error) => {
                    commit(types.AJAX_ERROR, error);
                    reject(true);
                });
        });
    },


   getDoctorProfile: ({ commit }, payload) => {
        return new Promise((resolve, reject) => {
            axios
                .get('/api/doctor/getDoctorProfile/' + payload)
                .then((response) => {
                    commit(types.GET_DOCTOR_DATA, response.data);
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
      axios .post("/api/doctor/changePassword/" +payload.id, payload.formData)
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

  aprovedDocument: ({ commit, dispatch }, payload) => {
    // console.log(payload);
    return new Promise((resolve, reject) => {
      axios .post("/api/doctor/changeDocStatus/" +payload.id, payload)
        .then(response => {
          commit(types.DOC_STATUS, response.data);
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

  //CHNAGE PASSWORD 
  profileSettings: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios .post("/api/doctor/profileSettings/" +payload.id, payload.newData)
        .then(response => {
          commit(types.PROFILE_SETTINGS, response.data);
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
  getPatientAppointmentData: ({ commit }, payload) => {
        return new Promise((resolve, reject) => {
            axios
                .get('/api/doctor/getPatientAppointment/' + payload)
                .then((response) => {
                    commit(types.GET_PATIENT_APPOINTMENT_DATA, response.data);
                    resolve();
                })
                .catch((error) => {
                    commit(types.AJAX_ERROR, error);
                    reject(true);
                });
        });
    },

   submitMedicalReport: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
          var post_url = axios.post("/api/doctor/patientMedicalReport/" + payload.appointment_id, payload.newData);
            return post_url
        .then(response => {
          commit(types.ATTACH_RECORD, response.data);
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


 DeleteAttachment: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
          var post_url = axios.post("/api/doctor/deleteMedicalReport/" + payload.id);
            return post_url
        .then(response => {
          commit(types.MULTI_ACTION, response.data);
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


  getPatientDoctorinfoAppointment: ({ commit }, payload) => {
        return new Promise((resolve, reject) => {
            axios
                .get('/api/doctor/getPatientDoctorinfoAppointment/' + payload)
                .then((response) => {
                    commit(types.GET_PATIENT_DOCTOR_DATA, response.data);
                    resolve();
                })
                .catch((error) => {
                    commit(types.AJAX_ERROR, error);
                    reject(true);
                });
        });
    },


    getPrescriptionData: ({ commit }, payload) => {
      return new Promise((resolve, reject) => {
          axios
              .get('/api/doctor/getPrescriptionData/' + payload)
              .then((response) => {
                  commit(types.GET_PRESCRIPTION_DATA, response.data);
                  resolve();
              })
              .catch((error) => {
                  commit(types.AJAX_ERROR, error);
                  reject(true);
              });
      });
    },

    
  submitPrescriptionForm: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
          var post_url = axios.post("/api/doctor/patientPrescriptionAdd/" + payload.appointment_id, payload.newData);
            return post_url
        .then(response => {
          commit(types.PRESCRIPTION_ADD, response.data);
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

  //Equipments List
  getEquipmentList: ({ commit, dispatch }, payload) => {
    axios.get("/api/getEquipmentList")
    .then(response => {
    commit(types.GET_EQUIPMENT_LIST, response.data);
    })
    .catch(error => {
    message = error.response.data.message || error.message;
    commit(types.AJAX_ERROR, message);
    })
    .finally(() => {
    });
 },



};  