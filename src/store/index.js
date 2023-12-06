// src/store/index.js
import { createStore } from "vuex";

const store = createStore({
  state: {
    
    activeLink: localStorage.getItem("activeLink") || "",
    activeTab: "default",
    dynamicName: "",
    drawer: true,
  },
  mutations: {
    setDrawer(state, value) {
        state.drawer = value;
      },
    toggleDrawer(state) {
        state.drawer = !state.drawer;
      },
    setDynamicName(state, name) {
      state.dynamicName = name;
    },
    setActiveLink(state, newLink) {
      state.activeLink = newLink;
    },
    setActiveTab(state, tabName) {
      state.activeTab = tabName;
    },
  },
  actions: {
    updateDynamicName({ commit }, name) {
      commit("setDynamicName", name);
    },
    updateActiveLink({ commit }, newLink) {
      commit("setActiveLink", newLink);
      localStorage.setItem("activeLink", newLink);
    },
    // updateActiveLink({ commit }, newLink) {
    //     commit('setActiveLink', newLink);
    //     commit('setDynamicName', newLink === 'dashboard' ? 'Dashboard' : newLink === 'students' ? 'Students' : '');
    //   },
  },
  getters: {
    getDynamicName: (state) => state.dynamicName,
    getActiveLink: (state) => state.activeLink,
    activeTab: (state) => state.activeTab,
    tabs: (state) => state.tabs,
    visibleTabs: (state) => state.tabs.filter((tab) => tab.visible),
    drawer: (state) => state.drawer,
  },
});

export default store;
