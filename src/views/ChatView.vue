<template>
  <div class="q-pa-md row justify-center">
    <div class="col-12">
      <chat-window :messages="messages" />
    </div>
    <input v-model="newMessage" />
    <select v-model="receiver" placeholder="Select Receiver">
      <option v-for="number in [1, 2, 3, 4, 5, 6, 7]" :key="number" :value="number">{{ number }}</option>
    </select>
    <button @click="sendMessage">Send</button>
  </div>
</template>

<script>
import ChatWindow from '@/components/ChatWindow.vue';
import axios from 'axios';

export default {
  components: {
    ChatWindow,
  },

  data() {
    return {
      messages: [],
      newMessage: '',
      receiver: '', // Assuming receiver is a number
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
          axios.defaults.headers.common['Authorization'] = `${token}`;
        } else {
          console.error('No token available.');
          return;
        }

        // Perform the Axios POST request to send the message
        await axios.post('sendMessage', {
          message: this.newMessage,
          receiver: this.receiver, // Include the receiver ID
        });

        // Assuming you want to fetch updated messages after sending
        await this.fetchMessages();

        // Optionally, you can emit an event to inform parent components
        this.$emit('messages-fetched', this.messages);
        this.$emit('message-sent', this.newMessage);

        // Clear the input fields
        this.newMessage = '';
        this.receiver = '';
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
          axios.defaults.headers.common['Authorization'] = `${token}`;
        } else {
          console.error('No token available.');
          return;
        }

        // Perform the Axios GET request to fetch messages
        const response = await axios.get('getMessage');
        this.messages = response.data;

        // Emit a custom event to notify the parent component
        this.$emit('messages-fetched', this.messages);
      } catch (error) {
        console.error('Error fetching messages:', error);
      }
    },
  },

  mounted() {
    // Fetch messages when the component is mounted
    this.fetchMessages();

    // Automatically fetch messages every 5 seconds
    setInterval(() => {
      this.fetchMessages();
    }, 5000);
  },
};
</script>
