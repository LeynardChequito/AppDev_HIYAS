<template>
  <q-layout view="lHr LpR fFr" class="bg-grey-10">

    <Navbar />
    <Drawer />
    <q-resize-observer @resize="onResize" />
    <q-page-container>
      <router-view />
    </q-page-container>

  </q-layout>
</template>

<script setup>
import Navbar from '@/components/Admin/Navbar.vue'
import Drawer from '@/components/Admin/Drawer.vue'

</script>

<style scoped>
.sticky{
  position: sticky;
  top: 0;
  background-color: white; /* Add a background color for visibility */
  width: 100%; 
}
</style>