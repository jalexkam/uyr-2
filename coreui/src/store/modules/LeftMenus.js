import axios from "axios";
import * as types from '../mutation-types'
export const state = {
  left_menus: []
};

export const getters = {
  tabs: state => state.left_menus
};

export const mutations = {
  getLeftMenus(state, payload) {
    state.left_menus = payload;
  }
};

export const actions = {
   getLeftMenus:({ commit, dispatch }, payload) => {
     return new Promise((resolve, reject) => {
     axios.get("/api/left_menus?token=" + localStorage.getItem('api_token'))
        .then(response => {
        commit("getLeftMenus",response.data);
          resolve();
        })
        .catch(error => {
          reject(true);
        })
        .finally(() => {});
    });
  },
};
