<template>
  <div>
    <!-- <Slider /> -->
  </div>
  <AnnouncementsAndEvents />
  <Sections />
  <div class="col-12">
    <q-btn flat dense icon="logout" class="text-white" @click="logout">Logout</q-btn>
  </div>
</template>
<script>
import Header from '@/components/Header.vue'
import Slider from '@/components/Slider.vue'
import AnnouncementsAndEvents from '@/components/AnnouncementsAndEvents.vue'
import Sections from '@/components/Sections.vue'
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
  name: 'home',
  components: {
    Header,
    Slider,
    AnnouncementsAndEvents,
    Sections,
  },

  setup() {
    const router = useRouter();
    const loading = ref(false);

    const logout = async () => {
      try {
        loading.value = true;
        // Retrieve the token from localStorage
        const token = localStorage.getItem('token');

        if (!token) {
          console.error('Token not found in localStorage');
          return;
        }

        // Make an API call to your backend's logout endpoint with the token in the headers
        await axios.post('/logout', {}, {
          headers: {
            Authorization: `${token}`,
          },
        });

        // Clear the authentication token from localStorage
        localStorage.removeItem('token');

        // Use router to navigate to the login page
        router.push('/login');

        // Emit a global event to notify other components about the logout
        window.dispatchEvent(new Event('logout'));

        // Close the notification card
      } catch (error) {
        console.error('Error during logout:', error);
        // Handle the error as needed
      } finally {
        // Set loading back to false after the process completes
        loading.value = false;
      }
    };

    return { logout, loading };
  },
};
</script>


<style lang="sass" scoped>
.header-container 
  position: absolute
  top: 0
  left: 0
  right: 0
  z-index: 2
.slider-container 
  position: relative 
  z-index: 1

</style>


  