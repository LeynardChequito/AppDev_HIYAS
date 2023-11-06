// In your App.vue file

<template>
  <div>
    <Header v-if="showHeader" />
    <router-view />
  </div>
</template>

<script>
import Header from '@/components/Header.vue';

export default {
  components: {
    Header,
  },
  data() {
    return {
      showHeader: true, // Initialize to true by default
    };
  },
  created() {
    // Add a navigation guard to hide the header on the /login route
    this.$router.beforeEach((to, from, next) => {
      if ((to.path === '/login') || (to.path === '/register') || (to.path === '/exp') ) {
        this.showHeader = false; // Hide the header on the /login route
      } else {
        this.showHeader = true; // Show the header on other routes
      }
      next();
    });
  },
};
</script>

<style lang="sass" scoped>
.header-container 
  position: absolute
  top: 0
  left: 0
  right: 0
  z-index: 3
.slider-container 
  position: relative 
  z-index: 1
</style>