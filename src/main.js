import { createApp } from "vue";
import App from "./App.vue";
import axios from "axios";
import VueApexCharts from "vue3-apexcharts"; // Update import statement
import router from "./router";
import { Quasar } from "quasar";
import quasarUserOptions from "./quasar-user-options";
import store from './store';
// import io from 'socket.io-client'

// const socket = io('http://localhost:3000')

// Set the default base URL for Axios
axios.defaults.baseURL = "http://cibackend.test/";

// Create the Vue app
const app = createApp(App);
// Use plugins and components
app
  .use(router)
  .use(store)
  .use(Quasar, quasarUserOptions)
  .component("apexchart", VueApexCharts)
// Mount the app to the specified element
app.mount("#app");
