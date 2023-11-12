<template>
  <q-form @submit.prevent="login" class="row justify-center login-page">
    <div class="row col-6 one justify-center">
      <!--image here-->
      <!-- <img src="@/assets/images/hiyas-banner.png" alt="Hiyas ng Tahanan" /> -->
      <q-img src="@/assets/images/hiyas-banner.png" class="q-mb-lg" @click="logoClicked" style="cursor: pointer;" />
    </div>



    <!--

    -->
    <div class="row col-6 two justify-center ">
      <q-card class="login-card text-center">

        <q-card-section>
          <q-input v-model="mobile_or_email" outlined label="Mobile or Email" dense debounce="300" class="q-mb-md" />
          <q-input v-model="password" outlined label="Password" type="password" dense debounce="300" />
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
import axios from 'axios'
export default {
  name: 'login',
  data() {
    return {
      mobile_or_email: '',
      password: '',
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('/login', {
          mobile_or_email: this.mobile_or_email,
          password: this.password,
        });

        // Handle the response from the server, e.g., show a success message or redirect to another page
        console.log('Login successful:', response.data);

        // For example, redirect to the user's dashboard after successful login
        this.$router.push({ name: 'home' });
      } catch (error) {
        console.error('Error logging in:', error);
        // Handle the error, e.g., display an error message to the user
      }
    },
    createAccount() {
      // Add your create account logic here
      this.$router.push({ name: 'register' });
    },
    logoClicked() {
      this.$router.push({ name: 'home' });
    }
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

.one {
  /* background-color: blue; */
}
</style>
