<template>
  <div>
    <h1>Hello, {{ userName }}</h1>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      userName: null,
    };
  },
  mounted() {
    this.fetchUserName();
  },
  methods: {
    async fetchUserName() {
      try {
        const token = localStorage.getItem('token');

        if (!token) {
          console.error('No token available.');
          return;
        }

        const response = await axios.get('getUser', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        // Assuming the server responds with user data
        const user = response.data.user;
        this.userName = user.firstname || 'Guest'; // Replace 'firstname' with the actual property name in your user data
      } catch (error) {
        console.error('Error getting user data:', error);
      }
    },
  },
};
</script>

<style scoped>
/* Your component styles go here */
</style>
