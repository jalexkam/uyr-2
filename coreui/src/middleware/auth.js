//import store from '~/store';

import router from './../router'
import store from './../store'

export default ({ to, from, next }) => {
  // Your custom if statement

  if(localStorage.getItem('is_login') !='Yes'){
     next("/login")
     return false
  }

  /*if (!store.getters['auth/check']) {
    next("/login")
    return false
  }*/
 else {
    //console.log(localStorage.getItem('is_login'));

        next();
       
    }
}

/*
router.beforeEach((to, from, next) => {
    if (to.path !== '/login') {
        auth.check()
    }
    next()
});
*/

/*
export default ({ store, next }) => {
  if (!store.state.user.loggedIn) {
    next("/login")
    return false
  }
  next()
}*/



/*export default async (to, from, next) => {

    if (!store.getters['auth/check']) {
        next({ name: 'login' });
    } else {
        next();
    }
};*/
