<template>
  <q-layout view="hHh lpR lfr">
    <Header v-if="$route.name !== 'login' && $route.name !== 'register'" /> 
    <Drawer v-if="$route.name !== 'login' && $route.name !== 'register' && $route.name !== 'home' " /> 


    <q-page-container class="custom-background">
      <router-view />
    <NewDrawer/>
    </q-page-container>

    <Footer />
  </q-layout>
</template>

<script>
import Header from '@/components/Header.vue'
import Drawer from '@/components/Drawer.vue'
import Footer from '@/components/Footer.vue'
import NewDrawer from '@/components/NewDrawer.vue'

export default {
  components: {
    Header,
    Drawer,
    Footer,
    NewDrawer
  },
}
</script>

<style scoped>
.custom-background {
  background-color: #EEEEEE;
}
</style>