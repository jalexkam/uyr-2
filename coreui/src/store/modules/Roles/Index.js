import axios from "axios";
import * as types from '../../mutation-types'

export const state = {
  resultData: [],
  ajax_error: "",
  menuTabs:[],
  item: {
    id: null,
      name: null,
      status: 1,
      permission:[]
    },
  ajax_error: { message: "", errors: [] },
};

function setTabs(id,temp){
  if(temp == 0){
    for( var i = 0; i < state.item['permission'].length; i++){ 
         if ( state.item['permission'][i] === id) {
           state.item['permission'].splice(i, 1); 
         }
      }
  }
  else{
    state.item['permission'].push(id);
  }
}
function setField(params) {
  for (let fieldName in state.item) {
    if(fieldName == 'permission'){
        for (let index in state.item.permission) {
            params.set('permission['+index+']', state.item.permission[index])
        }
    }
    else{
      let fieldValue = state.item[fieldName];
      if(typeof fieldValue !== "object") {
        params.set(fieldName, fieldValue);
      } else {
        if (fieldValue && typeof fieldValue[0] !== "object") {
          params.set(fieldName, fieldValue);
        } else {
          for (let index in fieldValue) {
            params.set(fieldName + "[" + index + "]", fieldValue[index]);
          }
        }
      }
    }
  }
  return params;
}

export const getters = {
  result: state => state.resultData,
  returnData    : state  => state.returnArr,
  menuTabs: state => state.menuTabs,
  item: state => state.item,
  returnData: state => state.returnData,
  ajax_error    : state => state.ajax_error,
};
// console.log(return_data);

export const mutations = {
  [types.ROLES_LIST](state, payload) {
    state.resultData = payload;
  },
   [types.AJAX_ERROR](state, payload) {
    let message = payload.response.data.message || payload.message;
    let errors = payload.response.data.errors;
    state.ajax_error = {
      message: message,
      errors: errors
    };
  },
  [types.CREATE_ROLE](state, payload) {
    state.returnArr = payload;
  },
  [types.EDIT_ROLE](state, payload) {
    state.editArr = payload;
  },
  [types.DELETE_ROLE](state, payload) {
    state.returnArr = payload;
  },
  setMenus(state, payload) {
      state.menuTabs = payload;
  },
  setFormStates(state, payload) {
    for (var prop in payload) {
      state.item[prop] = payload[prop];
    }
  },
  setItem(state, item) {
    item.permission = item.permission_arg;
    state.item       = item;
    state.returnData = item.response;
  },
};

export const actions = {
  // ROLES LIST
  list: ({ commit, dispatch }, payload) => {
    axios
      .get("/api/roles/index")
      .then(response => {
        commit(types.ROLES_LIST, response.data);
      })
      .catch(error => {
        message = error.response.data.message || error.message;
        commit(types.AJAX_ERROR, message);
        console.log(message);
      })
      .finally(() => {
      });
  },

  setMenus(state, payload) {
      state.menuTabs = payload;
  },

  //GET MENU DATA 
  setMenus:({ commit, dispatch }, payload) => {
     return new Promise((resolve, reject) => {
     axios.get("/api/roles/get_menus/"+payload.id)
        .then(response => {
        commit("setMenus",response.data);
          resolve();
        })
        .catch(error => {
          commit(types.AJAX_ERROR, error);
          reject(true);
        })
        .finally(() => {});
    });
  },

   checkAllData:({ commit, dispatch }, payload)  => {
     return new Promise((resolve, reject) => {
        var args = state.menuTabs;
        args.data[payload.pid].parent.temp=payload.temp;
        setTabs(args.data[payload.pid].parent.id, payload.temp);
         args.data[payload.pid].child.map((row,index) => {
             args.data[payload.pid].child[index].temp = payload.temp;
             setTabs(args.data[payload.pid].child[index].id, payload.temp);
          });
      commit("setMenus",args);
    });
  },

 checkData:({ commit, dispatch }, payload)  => {
     return new Promise((resolve, reject) => {
       var args = state.menuTabs;
       args.data[payload.pid].child[payload.cid].temp = payload.temp;
       if(payload.temp == 0){
         args.data[payload.pid].parent.temp=1;
         setTabs(args.data[payload.pid].parent.id,1);
       }
       setTabs(args.data[payload.pid].child[payload.cid].id, payload.temp);
      // setTabs(args.data[payload.pid].parent.id, payload.temp);
       commit("setMenus",args);
    });
  },

  storeData: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      let params = new FormData();
      params = setField(params);
      axios
        .post("/api/roles/store_roles", params)
        .then(response => {
          commit("setItem", response.data);
          resolve();
        })
        .catch(error => {
          commit(types.AJAX_ERROR, error);
          reject(error.response.data.errors);
        })
        .finally(error => { });
    });
  },

  setFormStates: ({ commit }, payload) => {
    commit("setFormStates", payload);
  },

  deleteRole: ({ commit, dispatch }, payload) => {
    return new Promise((resolve, reject) => {
      axios .post("/api/roles/deleterole/" +payload.id)
        .then(response => {
          commit(types.DELETE_ROLE, response.data);
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

  fetchData: ({ commit, dispatch }, id) => {
    axios.get("/api/roles/fetcheditdata/" + id).then(response => {
      commit("setItem", response.data.data);
    });
  },

  updateData: ({ commit, state, dispatch }) => {
    return new Promise((resolve, reject) => {
      let params = new FormData();
      params.set("_method", "POST");
      params = setField(params);
      params.set("status", state.item.status ? 1 : 0);
      axios
        .post("/api/roles/update_role/" + state.item.id, params)
        .then(response => {
          commit("setItem", response.data);
          resolve();
        })
        .catch(error => {
          commit(types.AJAX_ERROR, error);
          reject(true);
        })
        .finally(() => {});
    });
  },
};
