<template>
  <div class="q-pa-md row justify-center">
    <div class="col-4 one">
      <ChatList />
    </div>
    <div class="col-8 item-start">
      <!-- <div class="col-12 text-center">
        <h3>{{ receiverName }}</h3> 
      </div> -->
      <chat-window :messages="messages" />
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
import ChatWindow from '@/components/ChatWindow.vue';
import ChatList from '@/components/ChatList.vue';
import axios from 'axios';

export default {
  components: {
    ChatWindow,
    ChatList
  },

  data() {
    return {
      messages: [],
      newMessage: '',
      receiver: this.$route.params.id, // Use the ID from the route as the default receiver
      receiverName: '', // Add receiverName data property
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

        await axios.post('sendMessage', {
          message: this.newMessage,
          receiver: this.receiver,
        });

        await this.fetchMessages();

        this.$emit('messages-fetched', this.messages);
        this.$emit('message-sent', this.newMessage);

        // Clear the input field
        this.newMessage = '';
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

        // Perform the Axios GET request to fetch messages for the specific user
        const response = await axios.get(`getUserMessages/${this.receiver}`);
        this.messages = response.data;

        // Emit a custom event to notify the parent component
        this.$emit('messages-fetched', this.messages);
      } catch (error) {
        console.error('Error fetching messages:', error);
      }
    },

    async fetchReceiverName() {
      try {
        const token = localStorage.getItem('token');

        if (token) {
          axios.defaults.headers.common['Authorization'] = `${token}`;
        } else {
          console.error('No token available.');
          return;
        }

        // Perform the Axios GET request to fetch the receiver's information
        const response = await axios.get(`getUserMessages/${this.receiver}`);
        this.receiverName = response.data[0].receiver_name;

      } catch (error) {
        console.error('Error fetching receiver name:', error);
      }
    },
  },

  watch: {
    // Watch for changes in the route params and update the receiver ID accordingly
    '$route.params.id': function (newUserId) {
      this.receiver = newUserId;
      // Fetch messages and receiver name for the new user when the route changes
      this.fetchMessages();
      this.fetchReceiverName();
    },
  },

  mounted() {
    this.fetchMessages();
    this.fetchReceiverName();

    setInterval(() => {
      this.fetchMessages();
    }, 10000);
  },
};
</script>

<style scoped>
/* Add your scoped styles here */
</style>
