<template>
  <div class="q-pa-md row justify-start" ref="chatContainer" style="overflow-y: auto; max-height: 70vh;">
    <div style="width: 100%;">
      <q-chat-message v-for="message in messages" :key="message.id"
        :name="isSent(message.sender_name) ? 'me' : message.sender_name" :text="[message.message]"
        :sent="isSent(message.sender_name)" :bg-color="isSent(message.sender_name) ? 'blue' : 'grey'"
        :text-color="isSent(message.sender_name) ? 'white' : 'black'"
        :align="isSent(message.sender_name) ? 'right' : 'left'" />
      <div v-if="loading" class="text-center">
        Loading...
      </div>
    </div>
  </div>
</template>

<script>
import jwtDecode from 'jsonwebtoken/decode';

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
    getUser() {
      try {
        this.loading = true;
        const storedToken = localStorage.getItem('token');

        if (storedToken) {
          const decodedToken = jwtDecode(storedToken);
          this.currentUserId = decodedToken.firstname;

          // Log the current user id to the console
          console.log('Current User ID:', this.currentUserId);
        }
      } catch (error) {
        console.error('Error fetching user:', error);
      } finally {
        this.loading = false;
      }
    }, 
    
    isSent(senderId) {
      console.log('Current User ID:', this.currentUserId);
      console.log('Sender ID:', senderId);

      if (this.currentUserId !== null && senderId === this.currentUserId) {
        console.log('Message sent by current user');
        return true;
      }

      console.log('Message not sent by current user');
      return false;
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
.q-chat-message.right {
  background-color: blue;
  color: white;
  text-align: right;
}
</style>
