import axios from "axios";
import * as types from "../../mutation-types";
export const state = {
   editArr: [],
   returnArr: {},
   ajax_error: { message: "", errors: [] },
};

export const getters = {
   returnData: (state) => state.returnArr,
   editData: (state) => state.editArr,
   ajax_error: (state) => state.ajax_error,
};

export const mutations = {
   [types.EDIT_EMAIL_SETTINGS](state, payload) {
      state.editArr = payload;
   },
   [types.CREATE_EMAIL_SETTINGS](state, payload) {
      state.returnArr = payload;
   },

   [types.AJAX_ERROR](state, payload) {
      console.log("payload" + payload);
      let message = payload.response.data.message || payload.message;
      let errors = payload.response.data.errors;
      state.ajax_error = {
         message: message,
         errors: errors,
      };
   },
};

export const actions = {
   edit: ({ commit }, payload) => {
      return new Promise((resolve, reject) => {
         axios
            .get("/api/emailSettings/getEmailSettings")
            .then((response) => {
               commit(types.EDIT_EMAIL_SETTINGS, response.data);
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
         if (payload.id == "") {
            var post_url = axios.post("/api/emailSettings", payload);
         } else {
            var post_url = axios.patch("/api/emailSettings/" + payload.id, payload);
         }
         return post_url
            .then((response) => {
               if (response.data.status == "error") {
                  commit(types.AJAX_ERROR, response.data);
                  reject(true);
               } else {
                  commit(types.CREATE_EMAIL_SETTINGS, response.data);
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
};
