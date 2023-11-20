<!-- q-chat-message.vue -->

<template>
    <div class="q-chat-message" :class="{ 'sent-message': sent, 'received-message': !sent }">
      <div class="message-content">
        <p>{{ text }}</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      name: String,
      text: String,
      sent: Boolean,
      bgColor: String, // Add bgColor prop
    },
  };
  </script>
  
  <style scoped>
  .q-chat-message {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
  }
  
  .sent-message {
    background-color: blue; /* Set the background color for sent messages */
    color: white; /* Set the text color for sent messages */
  }
  
  .received-message {
    background-color: grey; /* Set the background color for received messages */
    color: black; /* Set the text color for received messages */
  }
  
  .message-content {
    /* Add any other styles for the message content */
  }
  </style>
  