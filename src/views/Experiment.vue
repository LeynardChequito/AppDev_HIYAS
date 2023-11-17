<template>
  <div>
    <div v-if="loading">Loading...</div>
    <div v-else>
      <h1>Welcome, {{ user.firstname }}!</h1>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
// import jwt_decode from 'jwt-decode'; // Use jwt-decode library for decoding
import * as jwt_decode from 'jwt-decode';

export default {
  data() {
    return {
      loading: true,
      user: null,
    };
  },
  mounted() {
    this.getUserData();
  },
  methods: {
    async getUserData() {
      try {
        const token = localStorage.getItem('token');

        // Check if the token is available
        if (token) {
          // Decode the token to get user data using jwt-decode
          const decodedToken = jwt_decode(token);

          // Check if the decoded token is valid
          if (decodedToken) {
            // Adjust the API endpoint based on your application structure
            const response = await axios.get('getUser');
            
            this.user = {
              id: decodedToken.id,
              email: decodedToken.email,
              firstname: decodedToken.firstname,
              // Add other properties as needed
            };
          } else {
            console.error('Invalid token');
          }
        } else {
          console.error('Token not available');
        }

        this.loading = false;
      } catch (error) {
        console.error('Error fetching user data:', error);
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
