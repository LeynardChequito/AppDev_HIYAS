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

<script>
import axios from 'axios';

export default {
  name: 'login',
  data() {
    return {
      mobile_or_email: '',
      password: '',
      errors: {
        mobile_or_email: '',
        password: '',
      },
      showPassword: false,
    };
  },
  methods: {
    async login() {
      // Clear previous error messages
      this.errors.mobile_or_email = '';
      this.errors.password = '';

      // Perform validation
      if (!this.mobile_or_email) {
        this.errors.mobile_or_email = 'Mobile or Email is required.';
      }

      if (!this.password) {
        this.errors.password = 'Password is required.';
      }

      // If there are validation errors, stop the login process
      if (this.errors.mobile_or_email || this.errors.password) {
        return;
      }

      try {
        const response = await axios.post('/login', {
          mobile_or_email: this.mobile_or_email,
          password: this.password,
        });

        // Assuming your server sends the token in the response
        const token = response.data.token;

        // Store the token securely (e.g., in local storage)
        localStorage.setItem('token', token);
        // axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        // Handle the response from the server, e.g., show a success message or redirect to another page
        console.log('Login successful:', response.data);

        // For example, redirect to the user's dashboard after a successful login
        this.$router.push({ name: 'home' });
      } catch (error) {
        console.error('Error logging in:', error);
        // Handle the error, e.g., display an error message to the user
      }

      // Simulate an incorrect email or password for demonstration
      if (this.mobile_or_email !== 'correct@email.com' || this.password !== 'correctpassword') {
        this.errors.mobile_or_email = 'Mobile or Email is incorrect.';
        this.errors.password = 'Password is incorrect.';
        return;
      }
    },
    createAccount() {
      // Add your create account logic here
      this.$router.push({ name: 'register' });
    },
    logoClicked() {
      this.$router.push({ name: 'home' });
    },
    togglePassword() {
      this.showPassword = !this.showPassword;
    },
  },
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
