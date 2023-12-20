<template>
  <div class="q-pa-md row justify-center">
    <div class="col-12 item-start">
      <GChatWindow :messages="messages" />
      <div class="q-pa-md">
        <q-input rounded outlined bottom-slots v-model="newMessage" label="Send Message" :dense="dense">
          <template v-slot:after>
            <q-btn @click="sendMessage" round dense flat icon="send" />
          </template>
        </q-input>
      </div>
    </div>
  </div>
</template>

<script>
import GChatWindow from '@/components/GChatWindow.vue';
import axios from 'axios';

export default {
  components: {
    GChatWindow,
  },

  data() {
    return {
      messages: [],
      newMessage: '',
      groupId: null, // Initialize groupId as null
    };
  },

  methods: {
    async sendMessage() {
      try {
        const token = localStorage.getItem('token');

        if (token) {
          axios.defaults.headers.common['Authorization'] = `${token}`;
        } else {
          console.error('No token available.');
          return;
        }

        // Check if groupId is defined before making the request
        if (this.groupId !== null) {
          await axios.post('sendGroupMessage', {
            message: this.newMessage,
            groupId: this.groupId,
          });

          await this.fetchMessages();

          // Clear the input field
          this.newMessage = '';
        } else {
          console.error('Group ID is undefined.');
        }
      } catch (error) {
        console.error('Error sending message:', error);
      }
    },

    async fetchMessages() {
      try {
        const token = localStorage.getItem('token');

        if (token) {
          axios.defaults.headers.common['Authorization'] = `${token}`;
        } else {
          console.error('No token available.');
          return;
        }

        // Check if groupId is defined before making the request
        if (this.groupId !== null) {
          // Perform the Axios GET request to fetch messages for the specific group
          const response = await axios.get(`getGroupMessages/${this.groupId}`);
          this.messages = response.data;

          // Emit a custom event to notify the parent component
          this.$emit('messages-fetched', this.messages);
        } else {
          console.error('Group ID is undefined.');
        }
      } catch (error) {
        console.error('Error fetching messages:', error);
      }
    },
    getSectionIdForCurrentUser() {
      // Fetch the section ID of the logged-in user from your authentication system
      // Replace this with your actual logic to get the section ID
      const sectionId = 123; // Replace with your actual logic
      return sectionId;
    },
  },

  mounted() {
    this.groupId = this.getSectionIdForCurrentUser();

    if (this.groupId !== null) {
      this.fetchMessages();

      setInterval(() => {
        this.fetchMessages();
      }, 500);
    } else {
      console.error('Group ID is undefined.');
    }
  },
};
</script>

<style scoped>
/* Add your scoped styles here */
</style>
