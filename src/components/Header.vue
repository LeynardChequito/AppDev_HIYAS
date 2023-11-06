<template>
  <q-header reveal class="bg-white text-black" height-hint="98">
    <q-toolbar>
      <div class="row items-start col-4 two self-start">
        <q-avatar class="logo q-ml-md q-pt-sm">
          <img src="@/assets/images/hiyas-logo-wt-bg.jpg" alt="Hiyas Logo" class="logo" @click="logoClicked"
            style="cursor: pointer;" />
        </q-avatar>

        <q-input rounded dark dense standout v-model="text" input-class="text-right" class="q-pt-sm q-ml-md q-mr-sm"
          bg-color="grey-3">
          <template v-slot:append>
            <q-icon v-if="text === ''" name="search" color="black" /> <!-- Change the color attribute to "grey" -->
            <q-icon v-else name="clear" class="cursor-pointer" @click="text = ''" color="black" />
            <!-- Change the color attribute to "grey" -->
          </template>
        </q-input>
      </div>
      <div class="row col-5 justify-center three self-start q-pt-sm">
        <q-tabs align="left">
          <q-route-tab to="/home" label="Page One" />
          <q-route-tab to="/manage" label="Page Two" />
          <q-route-tab to="/reports" label="Page Three" />
        </q-tabs>
      </div>

      <div class="row col-3 justify-end items-start four self-center q-mt-sm">
        <q-btn dense color="" round class="q-mr-md" @click="widgetsClicked">
          <q-icon name="widgets" style="color: black;" />
        </q-btn>
        <Chats />
        <Notifications />
        <Account />
      </div>

    </q-toolbar>

  </q-header>
</template>

<script>

import Notifications from '@/components/Notifications.vue'
import Account from '@/components/Account.vue'
import Chats from '@/components/Chats.vue'
import { ref } from 'vue'
import { useRouter } from 'vue-router';

export default {
  components: {
    Notifications,
    Chats,
    Account
  },
}
</script>

<style scoped>
.q-toolbar {
  border-bottom: 1px solid #ccc;
}
</style>