import axios from "axios";
import * as types from '../../mutation-types'
export const state = {
  resultData            : [],
   getContactUsData     : [],
   returnContactUsData  : {},
   returnArr            : {},
  ajax_error            : { message: "", errors: [] },
}; 

export const getters = {
  result                  : state => state.resultData,
  returnData              : state => state.returnArr,
  contactUsResult         : state => state.getContactUsData,
  returnContactUsResult   : state => state.returnContactUsData,
  ajax_error              : state => state.ajax_error,
};

export const mutations = {
  [types.MASTER_CONTACT_US_LIST](state, payload) {
    state.resultData  = payload;
  },
  [types.MASTER_CONTACT_US_DATA](state, payload) {
    state.getContactUsData  = payload;
  },
  [types.MASTER_CREATE_CONTACT_US](state, payload) {
    state.returnContactUsData  = payload;
  },
  [types.MASTER_DELETE_CONTACT_US](state, payload) {
    state.returnArr  = payload;
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
  // Contact Us LIST
  ContactUsList: ({ commit, dispatch }, payload) => {
	  
	// alert("Hello");
   
    axios.get("/api/masters/contactUsMaster/contactUsList")
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

  getContactUsDetails: ({ commit }, payload) => {
    // console.log(payload);
    return new Promise((resolve, reject) => {
      axios
        .get("/api/masters/contactUsMaster/getData/" + payload)
        .then(response => {
          commit(types.MASTER_CONTACT_US_DATA, response.data);
          resolve();
        })
        .catch(error => {
          commit(types.AJAX_ERROR, error);
          reject(true);
        });
    });
  },
  
  deleteContactUs: ({ commit, dispatch }, payload) => {
	 return new Promise((resolve, reject) => {
      axios .post("/api/masters/contactUsMaster/delete/" +payload.id)
        .then(response => {
          commit(types.MASTER_DELETE_CONTACT_US, response.data);
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

  submitContactUsForm: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
        var post_url = axios.post("/api/masters/contactUsMaster/contactUsForm/" +payload.id, payload.formData);
      return post_url
        .then(response => {
          commit(types.MASTER_CREATE_CONTACT_US, response.data);
          resolve();
        })
        .catch(error => {
          console.log('error'+error);
          commit(types.AJAX_ERROR, error);
          reject(true);
        })
        .finally(() => {
        });
    });
  },
};  