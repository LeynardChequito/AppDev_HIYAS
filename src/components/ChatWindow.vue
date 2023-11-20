<template>
  <div class="q-pa-md row justify-start" ref="chatContainer" style="overflow-y: auto; max-height: 70vh;">
    <div style="width: 100%;">
      <q-chat-message v-for="message in messages" :key="message.id" :name="message.sender_name" :text="[message.message]"
        :sent="isSent(message.sender_name)" :bg-color="isSent(message.sender_name) ? 'blue' : 'grey'" />
      <div v-if="loading" class="text-center">
        Loading...
      </div>
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
      loading: false, // Add loading state
    };
  },

  methods: {
    async getUser() {
      try {
        this.loading = true; // Set loading to true while fetching messages
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
      } finally {
        this.loading = false; // Set loading to false after fetching messages
      }
    },

    isSent(senderId) {
      return senderId === this.currentUserId;
    },

    scrollToBottom() {
      // Scroll to the bottom using the ref
      const chatContainer = this.$refs.chatContainer;
      chatContainer.scrollTop = chatContainer.scrollHeight;
    },
  },

  watch: {
    // Watch for changes in the messages prop and scroll to the bottom when it changes
    messages: {
      handler() {
        this.$nextTick(() => {
          this.scrollToBottom();
        });
      },
      deep: true,
    },
  },

  updated() {
    // Scroll to the bottom after the component is updated
    this.scrollToBottom();
  },

  created() {
    // Call the getUser method when the component is created
    this.getUser();
  },
};
</script>

<style scoped>
/* You can add additional styles if needed */
</style>
