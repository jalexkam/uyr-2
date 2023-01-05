import axios from "axios";
import * as types from "../../mutation-types";
/**
  Set all variable here
*/
export const state = {
   returnArr    : {},
   getBankArr    : [],
   ajax_error   : { message: "", errors: [] },
};

/**
  Its only make your function global so that you can access the states
  Simple Global Functions
*/
export const getters = {
   returnData     : (state) => state.returnArr,
   editData       : (state) => state.getBankArr,
   ajax_error     : (state) => state.ajax_error,
};

/**
  Mutuation Editing the data changing the states and track the changes in to
  data
*/
export const mutations = {
   [types.MULTI_ACTION](state, payload) {
      state.returnArr = payload;
      state.ajax_error = { message: "", errors: {} };
   },
   [types.GET_BANK_DETAILS](state, payload) {
      state.getBankArr = payload;
   },
   [types.ADD_BANK_DETAILS](state, payload) {
      state.returnArr = payload;
   },
   [types.AJAX_ERROR](state, payload) {
      let message = payload.response.data.message || payload.message;
      let errors = payload.response.data.errors;
      state.ajax_error = {
         message: message,
         errors: errors,
      };
   },
   resetState(state, resp) {
      state.ajax_error = { message: "", errors: [] };
   },
};

/**
  Mutuation are not good for async events that is reason we are using action.
  First call action and action call Mutuation to set the data in state
 */
export const actions = {
   // List
   submitFormSetting: ({ commit, dispatch }, payload) => {
      return new Promise((resolve, reject) => {
         axios
            .post("/api/settings/save_profile", payload)
            .then((response) => {
               commit(types.MULTI_ACTION, response.data);
               resolve();
            })
            .catch((error) => {
               commit(types.AJAX_ERROR, error);
               reject(true);
            })
            .finally(() => {});
      });
   },

   save_profile_photo: ({ commit, dispatch }, payload) => {
      return new Promise((resolve, reject) => {
         axios
            .post("/api/settings/save_profile_photo", payload.newData)
            .then((response) => {
               commit(types.MULTI_ACTION, response.data);
               resolve();
            })
            .catch((error) => {
               commit(types.AJAX_ERROR, error);
               reject(true);
            })
            .finally(() => {});
      });
   },

   getBankDetails: ({ commit }, payload) => {
      return new Promise((resolve, reject) => {
         axios
            .get("/api/settings/getBankDetails")
            .then((response) => {
               commit(types.GET_BANK_DETAILS, response.data);
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
         var post_url = axios.post("/api/settings/addBankDetails/" + payload.user_id, payload);         
         return post_url
            .then((response) => {
               if (response.data.status == "error") {
                  commit(types.AJAX_ERROR, response.data);
                  reject(true);
               } else {
                  commit(types.ADD_BANK_DETAILS, response.data);
                  resolve();
               }
            })
            .catch((error) => {
               commit(types.AJAX_ERROR, error);
               reject(true);
            })
            .finally(() => {});
      });
   },

   getAppointmentSlot: ({ commit }, payload) => {
      return new Promise((resolve, reject) => {
         axios
            .get("/api/settings/getAppointmentSlot")
            .then((response) => {
               commit(types.GET_BANK_DETAILS, response.data);
               resolve();
            })
            .catch((error) => {
               commit(types.AJAX_ERROR, error);
               reject(true);
            });
      });
   },

   submitTimeSlotForm: ({ commit, dispatch }, payload) => {
      return new Promise((resolve, reject) => {         
         var post_url = axios.post("/api/settings/submitTimeSlotForm/" + payload.user_id, payload);         
         return post_url
            .then((response) => {
               if (response.data.status == "error") {
                  commit(types.AJAX_ERROR, response.data);
                  reject(true);
               } else {
                  commit(types.ADD_BANK_DETAILS, response.data);
                  resolve();
               }
            })
            .catch((error) => {
               commit(types.AJAX_ERROR, error);
               reject(true);
            })
            .finally(() => {});
      });
   },

   resetState: ({ commit }) => {
      commit("resetState");
   },
};
