<template>
  <q-form @submit.prevent="login" class="row justify-center login-page">
    <div class="row col-6 one justify-center">
      <q-img src="@/assets/images/hiyas-banner.png" class="q-mb-lg" @click="logoClicked" style="cursor: pointer;" />
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


const errors = {
  mobile_or_email: ref(''),
  password: ref(''),
};

const login = async () => {
  // Clear previous error messages
  errors.mobile_or_email = '';
  errors.password = '';

  // Perform validation
  if (!mobile_or_email.value) {
    errors.mobile_or_email = 'Mobile or Email is required.';
  }

  if (!password.value) {
    errors.password = 'Password is required.';
  }

  // If there are validation errors, stop the login process
  if (errors.mobile_or_email || errors.password) {
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

    // Redirect to the desired route (replace 'website' with your route name)
    router.push({ name: 'admin' });
  } catch (error) {
    console.error('Error logging in:', error);
  }

  // Simulate an incorrect email or password for demonstration
  if (mobile_or_email.value !== 'correct@email.com' || password.value !== 'correctpassword') {
    errors.mobile_or_email = 'Mobile or Email is incorrect.';
    errors.password = 'Password is incorrect.';
    return;
  }
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

/* .one {
  background-color: blue;
} */
</style>
