<template>
  <q-layout view="lHr LpR fFr">

    <!-- Only show the Navbar component if the user role is 'Staff' -->
    <!-- <Navbar/> -->
    <Navbar v-if="userRole === 'Staff'" />
    <Drawer v-if="userRole === 'Staff'" />


    <SNavbar v-if="userRole === 'Student'" />
    <SDrawer v-if="userRole === 'Student'" />


    <PNavbar v-if="userRole === 'Parent/Guardian'" />
    <PDrawer v-if="userRole === 'Parent/Guardian'" />

    <q-resize-observer @resize="onResize" />
    <q-page-container>
      <router-view />
    </q-page-container>

  </q-layout>
</template>

<script setup>
import Navbar from '@/components/Admin/Navbar.vue';
import Drawer from '@/components/Admin/Drawer.vue';

import SNavbar from '@/components/Students/Navbar.vue';
import SDrawer from '@/components/Students/Drawer.vue';

import PNavbar from '@/components/Parent/Navbar.vue';
import PDrawer from '@/components/Parent/Drawer.vue';

import { ref, watchEffect } from 'vue'
import jwtDecode from 'jsonwebtoken/decode';

const userRole = ref(''); // Initialize with an appropriate default value

watchEffect(() => {
  // Retrieve the user role from your token or another source
  // For example, you can decode the token and get the user role
  const storedToken = localStorage.getItem('token');
  if (storedToken) {
    const decodedToken = jwtDecode(storedToken);
    userRole.value = decodedToken.user_role;
  }
});
</script>

<style scoped>
.sticky {
  position: sticky;
  top: 0;
  background-color: white;
  width: 100%;
}
</style>
