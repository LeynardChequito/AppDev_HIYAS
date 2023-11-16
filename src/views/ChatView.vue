<template>
  <div>
    <chat-window :messages="messages" />
    <input v-model="newMessage" />
    <button @click="sendMessage">Send</button>
  </div>
</template>

<script>
import ChatWindow from '@/components/ChatWindow.vue';
import axios from 'axios';
import axiosInstance from '../views/LoginView.vue';

export default {
  components: {
    ChatWindow,
  },

  data() {
    return {
      messages: [],
      newMessage: '',
    };
  },

  methods: {
    async sendMessage() {
      try {
        // Get the token from local storage
        const token = localStorage.getItem('token');

        // Check if the token is available
        if (token) {
          // Set the Authorization header for the 'sendMessage' request
          axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        } else {
          console.error('No token available.');
          return;
        }

        // Perform the Axios POST request to send the message
        console.log('Headers before sendMessage:', axios.defaults.headers.common);
        await axios.post('sendMessage', { message: this.newMessage });

        // Assuming you want to fetch updated messages  after sending
        await this.fetchMessages();

        // Optionally, you can emit an event to inform parent components
        this.$emit('message-sent', this.newMessage);

        // Clear the input field
        this.newMessage = '';
      } catch (error) {
        console.error('Error sending message:', error);
      }
    },

    async fetchMessages() {
      try {
        // Get the token from local storage
        const token = localStorage.getItem('token');

        // Check if the token is available
        if (token) {
          // Set the Authorization header for the 'getMessage' request
          axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        } else {
          console.error('No token available.');
          return;
        }

        // Perform the Axios GET request to fetch messages
        const response = await axios.get('getMessage');
        this.messages = response.data;
      } catch (error) {
        console.error('Error fetching messages:', error);
      }
    },
  },

  mounted() {
    this.fetchMessages();
  },
};
</script>
