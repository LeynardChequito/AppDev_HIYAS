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
      loading: false,
      lastMessageCount: 0, // Track the count of messages
    };
  },

  methods: {
    async getUser() {
      try {
        this.loading = true;
        const token = localStorage.getItem('token');
        const response = await axios.get('getUser', {
          headers: {
            Authorization: `${token}`,
          },
        });

        this.currentUserId = response.data.user.firstname;

        this.$emit('user-loaded');
      } catch (error) {
        console.error('Error fetching user:', error);
      } finally {
        this.loading = false;
      }
    },

    isSent(senderId) {
      return senderId === this.currentUserId;
    },

    scrollToBottom() {
      const chatContainer = this.$refs.chatContainer;
      chatContainer.scrollTop = chatContainer.scrollHeight;
    },
  },

  watch: {
    messages(newMessages) {
      // Check for new incoming messages
      if (newMessages.length > this.lastMessageCount) {
        this.lastMessageCount = newMessages.length;
        this.$nextTick(() => {
          this.scrollToBottom();
        });
      }
    },
  },

  updated() {
    // Uncomment this line if scrollToBottom should happen after each update
    // this.scrollToBottom();
  },

  created() {
    this.getUser();
    // Uncomment this line if scrollToBottom should happen on component creation
    // this.scrollToBottom();
  },
};
</script>

<style scoped>
/* You can add additional styles if needed */
</style>
