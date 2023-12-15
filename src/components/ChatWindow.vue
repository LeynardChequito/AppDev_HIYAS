<template>
  <div class="q-pa-md row justify-center">
    <div style="width: 100%; max-width: 400px">
      <q-chat-message name="me" :text="['hey, how are you?']" sent />
      <q-chat-message name="Jane" :text="['doing fine, how r you?']" />
    </div>
  </div>
</template>


<script setup>
import axios from 'axios';
import jwtDecode from 'jsonwebtoken/decode';
const userId = ref(''); // Initialize with an appropriate default value

const token = localStorage.getItem('token');
const decodedToken = jwtDecode(token);
userId.value = decodedToken.id;


</script>