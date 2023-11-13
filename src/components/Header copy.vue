<template>
  <q-header fixed reveal class="bg-white text-black" height-hint="98" v-show="!$q.screen.lt.md">
    <q-toolbar>
      <div class="row items-start col-12 col-md-5 self-start q-ml-md">
        <q-avatar class="logo q-pt-sm">
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

      <div class="row col-12 col-md-7 justify-between self-center q-pt-sm">
        <q-tabs align="left" class="" inline-label>
          <q-route-tab to="/home" icon="home" label="Home" />
          <q-route-tab to="/manage" icon="tune" label="Manage" />
          <q-route-tab to="/reports" icon="analytics" label="Reports" />
        </q-tabs>

        <div class="row justify-end items-start four self-center">
          <q-btn dense color="" round class="q-mr-md" @click="widgetsClicked">
            <q-icon name="widgets" style="color: black;" />
          </q-btn>
          <Chats />
          <Notifications />
          <Account />
        </div>
      </div>
    </q-toolbar>
  </q-header>


  <q-header fixed reveal class="bg-white text-black" height-hint="98" v-if="$q.screen.lt.md">
    <q-toolbar class="row col-12">
      <div class="row items-start col-sm-2 self-start">
        <q-avatar class="logo q-pt-sm">
          <img src="@/assets/images/hiyas-logo-wt-bg.jpg" alt="Hiyas Logo" class="logo" @click="logoClicked"
            style="cursor: pointer;" />
        </q-avatar>
      </div>
      <q-space></q-space>
      <div class="row justify-end col-sm-10 self-center">
        <q-btn dense round icon="widgets" class="q-mr-sm" />
        <q-btn dense round icon="search" class="q-mr-sm" />
        <q-btn dense round icon="chat" class="" />
      </div>
    </q-toolbar>


    <q-toolbar>
      <div class="row col-sm-12 col-12 justify-center self-center">
        <q-tabs stretch>
          <q-route-tab to="/home">
            <q-icon name="home" size="sm" />
          </q-route-tab>
          <q-route-tab to="/manage">
            <q-icon name="tune" size="sm" />
          </q-route-tab>

          <q-route-tab to="/reports">
            <q-icon name="analytics" size="sm" />
          </q-route-tab>

          <q-route-tab to="/notifications">
            <q-icon name="notifications" size="sm" />
          </q-route-tab>
          <q-route-tab to="/account">
            <q-icon name="account_circle" size="sm" />
          </q-route-tab>

        </q-tabs>
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
  border-bottom: 1px solid black;
}

</style>