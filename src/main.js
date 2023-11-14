import { createApp } from "vue";
import App from "./App.vue";
import "./registerServiceWorker";
import router from "./router";
import axios from "axios";
import { Quasar } from "quasar";
import quasarUserOptions from "./quasar-user-options";
// import VueNativeSock from "vue-native-websocket";

axios.defaults.baseURL = "http://cibackend.test/";

createApp(App)
  .use(Quasar, quasarUserOptions)
  .use(router)
  .mount("#app");
