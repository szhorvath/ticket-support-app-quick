import Vue from "vue";
import App from "./components/App";
import router from "./router";
import store from "./store";
import wait from "./plugins/vuewait";

import "./plugins";
import "./components";

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  wait,
  ...App
});
