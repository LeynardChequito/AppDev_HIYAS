<template>
  <q-layout view="lHr LpR fFr" class="bg-grey-10">

    <!-- Only show the Navbar component if the user role is 'Staff' -->
    <!-- <Navbar/> -->
    <Navbar  />

    <Drawer />
    <q-resize-observer @resize="onResize" />
    <q-page-container>
      <router-view />
    </q-page-container>

  </q-layout>
</template>

<script setup>
import Navbar from '@/components/Admin/Navbar.vue';
import Drawer from '@/components/Admin/Drawer.vue';
</script>

<style scoped>
.sticky {
  position: sticky;
  top: 0;
  background-color: white;
  width: 100%;
}
</style>
