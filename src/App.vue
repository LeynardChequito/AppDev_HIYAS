<template>
  <q-layout view="hHh lpR lfr">
    <Header />
    <Drawer />


    <q-page-container>
      <router-view />
    </q-page-container>


  </q-layout>
</template>

<script>
import Header from '@/components/Header.vue'
import Drawer from '@/components/Drawer.vue'

export default {
  components: {
    Header,
    Drawer
  },
}
</script>