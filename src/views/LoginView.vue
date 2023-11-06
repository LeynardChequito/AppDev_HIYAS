<template>
  <div class="row justify-center login-page">
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
          <q-input v-model="username" outlined label="Username" dense debounce="300" class="q-mb-md" />
          <q-input v-model="password" outlined label="Password" type="password" dense debounce="300" />
          <q-btn rounded color="primary" label="Log in" @click="login" class="q-mt-md q-mb-sm" style="width: 100%" />
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
  </div>
</template>


<script>
export default {
  name: 'login',
  data() {
    return {
      username: '',
      password: '',
    };
  },
  methods: {
    login() {
      // Add your login logic here
      // Typically, you would make an API request to authenticate the user
      // For this example, we'll just log the username and password
      console.log('Username:', this.username);
      console.log('Password:', this.password);
    },
    createAccount() {
      // Add your create account logic here
      this.$router.push({ name: 'register' });
      console.log('Create new account clicked');
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
