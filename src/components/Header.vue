<template>
  <div class="header-container q-pt-md row justify-center one">
    <q-toolbar class="bg-transparent text-white">
      <div class="row items-start col-4 two self-start">
        <q-avatar class="logo q-ml-md">
          <img src="@/assets/images/hiyas-logo-wt-bg.jpg" alt="Hiyas Logo" class="logo" @click="logoClicked"
            style="cursor: pointer;" />
        </q-avatar>
        <q-input rounded dark dense standout v-model="text" input-class="text-right" class="q-ml-md q-mr-sm">
          <template v-slot:append>
            <q-icon v-if="text === ''" name="search" />
            <q-icon v-else name="clear" class="cursor-pointer" @click="text = ''" />
          </template> </q-input>
      </div>
      <!-- <q-toolbar-title class="title"><b>Hiyas ng Tahanan</b></q-toolbar-title> -->
      <div class="row col-5 justify-center three self-start">
        <q-tabs v-model="tab" shrink>
          <router-link to="/home"> <!-- Use router-link to navigate to /home -->
            <q-tab name="home" label="Home" />
          </router-link>
          <router-link to="/manage"> <!-- Use router-link to navigate to /manage -->
            <q-tab name="manage" label="Manage" />
          </router-link>
          <router-link to="/reports"> <!-- Use router-link to navigate to /reports -->
            <q-tab name="reports" label="Reports" />
          </router-link>
        </q-tabs>
      </div>

      <div class="row col-3 justify-end items-start four self-start q-mt-sm">
        <q-btn dense color="" round icon="widgets" class="q-mr-md" @click="widgetsClicked" />
        <Chats />
        <Notifications />
        <Account />
      </div>

    </q-toolbar>

  </div>
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
  setup() {
    const dialog = ref(false)
    const position = ref('top')
    const router = useRouter()

    return {
      tab: ref('tab1'),
      text: ref(''),

      dialog,
      position,


      open(pos) {
        position.value = pos
        dialog.value = true
      }
    }
  },

  methods: {
    searchClicked() {
      // Handle the search icon click event here
      // You can open a search input or perform any desired action
    },
    accountClicked() {
      console.log('Icon clicked');
      this.$router.push({ name: 'login' });
    },
    logoClicked() {
      this.$router.push({ name: 'home' });
    },
  }
}
</script>

<style lang="sass" scoped>
.logo 
  width: 40px
  height: 40px

.one
  background-color: black





</style>


