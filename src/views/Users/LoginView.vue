<template>
  <div v-if="loading" class="loading-overlay">
    <img src="@/assets/images/loading.gif" alt="Loading..." style="width: 200px; height: 200px" />
  </div>
  <q-form @submit.prevent="login" class="row justify-center login-page">
    <div class="row col-6 one justify-center">
      <q-img src="@/assets/images/hiyas-banner.png" class="q-mb-lg" @click="" style="cursor: pointer;" />
    </div>
    <div class="row col-6 two justify-center ">
      <q-card class="login-card text-center">
        <q-card-section>
          <q-input v-model="mobile_or_email" outlined label="Mobile or Email" dense debounce="300"
            :error="errors.mobile_or_email ? 'Mobile or Email is incorrect.' : false" />
          <q-input v-model="password" :type="showPassword ? 'text' : 'password'" outlined label="Password" dense
            debounce="300" :error="errors.password ? 'Password is incorrect.' : false">
            <template v-slot:append>
              <q-icon :name="showPassword ? 'visibility' : 'visibility_off'" @click="togglePassword"
                style="cursor: pointer;" />
            </template>
          </q-input>

          <div class="error-message">{{ errors.mobile_or_email }}</div>
          <div class="error-message">{{ errors.password }}</div>
          <q-btn rounded color="primary" label="Log in" type="submit" class="q-mt-md q-mb-sm" style="width: 100%" />
          <q-space />
          <a href="#" class="q-mt-md text-caption" style="text-decoration: none;">Forgot Password?</a>
        </q-card-section>
        <div class="hr-container">
          <hr class="hr-line">
        </div>
        <q-card-section>
          <q-btn rounded color="green" label="Create New Account" @click="createAccount" class="text-caption"
            style="width: 70%" />
        </q-card-section>
      </q-card>
    </div>
  </q-form>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import jwtDecode from 'jsonwebtoken/decode';

const mobile_or_email = ref('');
const password = ref('');
const showPassword = ref(false);
const router = useRouter();

const loading = ref(false);
const errors = {
  mobile_or_email: ref(),
  password: ref(),
};
const login = async () => {
  // Clear previous error messages
  errors.mobile_or_email = '';
  errors.password = '';

  // Set loading to true when starting the login process
  loading.value = true;

  // Perform validation
  if (!mobile_or_email.value) {
    errors.mobile_or_email = 'Mobile or Email is required.';
    loading.value = false; // Set loading back to false if there's a validation error
    return;
  }

  if (!password.value) {
    errors.password = 'Password is required.';
    loading.value = false; // Set loading back to false if there's a validation error
    return;
  }

  try {
    const response = await axios.post('login', {
      mobile_or_email: mobile_or_email.value,
      password: password.value,
    });

    // Check if the response contains a token
    const token = response.data.token;

    // Store the token securely, e.g., in localStorage
    localStorage.setItem('token', token);

    // Decode the token to access user data
    const decodedToken = jwtDecode(token);
    console.log('Decoded Token:', decodedToken);

    // Reload the page after successful login
    window.location.reload();

    // Redirect to the desired route (replace 'website' with your route name)
    router.push({ name: 'admin-dashboard' });
  } catch (error) {
    console.error('Error logging in:', error);
  } finally {
    // Set loading back to false after the login process completes
    loading.value = false;
  }

  // Simulate an incorrect email or password for demonstration
  // if (mobile_or_email.value !== 'correct@email.com' || password.value !== 'correctpassword') {
  //   errors.mobile_or_email = 'Mobile or Email is incorrect.';
  //   errors.password = 'Password is incorrect.';
  //   return;
  // }
};


const createAccount = () => {
  // Add your create account logic here
  router.push({ name: 'register' });
};

const logoClicked = () => {
  router.push({ name: 'home' });
};

const togglePassword = () => {
  showPassword.value = !showPassword.value;
};
</script>


<style scoped>
.login-page {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #EFEFEF;
}

.login-card {
  max-width: 400px;
  width: 100%;
}

.create-account-card {
  max-width: 300px;
  width: 100%;
}

.hr-line {
  border: 0;
  border-top: 1px solid #ccc;
  flex-grow: 1;
  width: 80%;
}

.hr-container {
  align-items: center;
}

.error-message {
  color: red;
  font-size: 0.75rem;
  margin-top: 4px;
}

.loading-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(142, 142, 141, 0.8);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

.loading-overlay img {
  width: 50px;
  /* Adjust the width and height based on your loading GIF dimensions */
  height: 50px;
}
</style>
