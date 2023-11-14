import { createApp } from "vue";
import App from "./App.vue";
import "./registerServiceWorker";
import router from "./router";
import axios from "axios";
import { Quasar } from "quasar";
import quasarUserOptions from "./quasar-user-options";
import VueApexCharts from 'vue3-apexcharts'; // Update import statement

axios.defaults.baseURL = "http://cibackend.test/";

createApp(App)
  .use(Quasar, quasarUserOptions)
  .use(router)
  .component('apexchart', VueApexCharts) // Register the VueApexCharts component globally
  .mount("#app");

  