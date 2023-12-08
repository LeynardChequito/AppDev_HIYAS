// store/index.js
import { createStore } from 'vuex';

const loadFromLocalStorage = () => {
  const drawerOpen = localStorage.getItem('drawerOpen');
  const link = localStorage.getItem('activeLink');
  
  return {
    drawerOpen: drawerOpen ? JSON.parse(drawerOpen) : false,
    link: link || null,
  };
};

const store = createStore({
  state: loadFromLocalStorage(),
  mutations: {
    toggleDrawer(state) {
      state.drawerOpen = !state.drawerOpen;
      localStorage.setItem('drawerOpen', JSON.stringify(state.drawerOpen));
    },
    setLink(state, link) {
      state.link = link;
      localStorage.setItem('activeLink', link);
    },
  },
});

export default store;
