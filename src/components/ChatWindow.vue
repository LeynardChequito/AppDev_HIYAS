<template>
  <div class="q-pa-md row justify-start" style="overflow-y: auto; max-height: 70vh;">
    <div style="width: 100%;">
      <q-chat-message v-for="message in messages" :key="message.id" :name="message.sender_name" :text="[message.message]"
        :sent="isSent(message.sender_name)" :bg-color="isSent(message.sender_name) ? 'blue' : 'grey'" />
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['messages'],

  data() {
    return {
      currentUserId: null,
    };
  },

  methods: {
    async getUser() {
      try {
        const token = localStorage.getItem('token');
        // Make an API call to retrieve the user information
        const response = await axios.get('getUser', {
          headers: {
            Authorization: `${token}`,
          },
        });

        // Set the currentUserId based on the retrieved user information
        this.currentUserId = response.data.user.firstname;

        // Emit an event to notify the parent component
        this.$emit('user-loaded');
      } catch (error) {
        console.error('Error fetching user:', error);
      }
    },

    isSent(senderId) {
      return senderId === this.currentUserId;
    },
  },

  mounted() {
    // Call the getUser method when the component is mounted
    this.getUser();
  },
};
</script>

<style scoped>
/* You can add additional styles if needed */
</style>
