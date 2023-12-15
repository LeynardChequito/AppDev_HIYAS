<template>
  <div class="q-pa-md row justify-center">
    <div style="width: 100%; max-width: 400px">
      <q-chat-message v-for="message in messages" :key="message.id" :name="message.sender" :text="[message.message]"
        :sent="message.sender === userId" />
      <q-input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type your message..." />
    </div>
  </div>
</template>
<script setup>
import axios from 'axios';
import jwtDecode from 'jsonwebtoken/decode';
import { useRoute } from 'vue-router';
import { ref, onMounted, watchEffect } from 'vue';

const route = useRoute();
const userId = ref('');
const messages = ref([]);
const newMessage = ref('');

watchEffect(() => {
  // Retrieve the user role from your token or another source
  // For example, you can decode the token and get the user role
  const storedToken = localStorage.getItem('token');
  if (storedToken) {
    const decodedToken = jwtDecode(storedToken);
    userId.value = decodedToken.sender;
  }
});

// Extract the 'id' parameter from the route
const routeUserId = ref(route.params.id);

// Fetch messages when the component is mounted
onMounted(() => {
  getMessages();
});

// Function to fetch messages
const getMessages = async () => {
  try {
    const response = await axios.get(`/getMessages/${userId.value}`);
    messages.value = response.data;
  } catch (error) {
    console.error('Error fetching messages:', error);
  }
};

// Function to send a new message
const sendMessage = async () => {
  try {
    if (routeUserId.value) {
      const response = await axios.post('sendMessage', {
        sender: userId.value,
        receiver: routeUserId.value,
        message: newMessage.value,
      });

      // Assuming the API response includes the newly created message
      // messages.value.push(response.data);

      // Clear the input field after sending the message
      newMessage.value = '';
    } else {
      console.warn('No user selected. Please select a user to chat.');
      // Handle the case when no user is selected, e.g., display a message to the user
    }
  } catch (error) {
    console.error('Error sending message:', error);
  }
};
</script>

