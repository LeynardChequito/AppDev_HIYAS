<template>
  <q-form @submit.prevent="signup" class="row justify-center signup-page">
      <div class="row col-1 justify-center">
          <q-img src="@/assets/images/hiyas-logo-wt-bg.jpg" class="q-mt-lg hiyas-logo" @click="logoClicked"
              style="cursor: pointer;" />
      </div>
      <div class="col-12 row justify-center q-mt-lg q-mb-lg items-start">
          <q-card class="signup-card items-start">
              <q-card-section>
                  <div class="text-h5 text-center"><b>Create a new account</b></div>
              </q-card-section>
              <hr>

            <q-card-section class="q-gutter-xs"> 
                  <div class="row">
                      <div class="col-6 q-pr-xs"> 
                        <q-input v-model="firstname" outlined label="First Name" dense debounce="300" :rules="[v => !!v ]" />
                      </div>
                      <div class="col-6 q-pl-xs"> 
                        <q-input v-model="lastname" outlined label="Last Name" dense debounce="300" :rules="[v => !!v ]" />
                      </div>
                  </div>
                  <q-input v-model="mobile_or_email" outlined label="Mobile Number or Email" dense debounce="300" :rules="[v => !!v ]" class="q-mr-sm" />
                  <q-input v-model="password" :type="showPassword ? 'text' : 'password'" outlined label="New Password" dense debounce="300" :rules="[v => !!v ]" class="q-mr-sm">
                      <template v-slot:append>
                        <q-icon :name="showPassword ? 'visibility' : 'visibility_off'" @click="togglePassword" style="cursor: pointer;" />
                      </template>
                  </q-input>

                  <div class="row items-center">
                    <div class="text-caption col-2 text-weight-thin">Birthday</div>

                    <div class="col-3 q-pr-xs"> 
                      <q-select v-model="birthMonth" outlined label="Month" :options="months" dense class="q-mr-sm" rules="[]" />
                    </div>
                    <div class="col-3 q-pr-xs"> 
                      <q-select v-model="birthday" outlined label="Day" :options="days" dense class="q-mr-sm" rules="[]" />
                    </div>
                    <div class="col-3">
                      <q-select v-model="birthYear" outlined label="Year" :options="years" dense :rules="[validateBirthday]" />
                    </div>
                    <div class="text-caption col-2 text-weight-thin">Gender</div>
                    <div class="col-1">
                      <q-btn-toggle unelevated class="q-ml-sm my-custom-toggle" v-model="gender" no-caps
                                    toggle-color="primary" color="white" text-color="black"
                                    :options="[ { label: 'M', value: 'male' }, { label: 'F', value: 'female' } ]"/>
                    </div>
                  </div>
                  <div class="col-12">
                      <q-select v-model="barangay" outlined label="Barangay" :options="barangayOptions" :rules="[v => !!v ]" dense />
                  </div>
                  <div class="col-12">
                      <q-select v-model="user_role" outlined label="Role" :options="userModeOptions" :rules="[v => !!v ]" dense />
                  </div>
                  
    <div class="col-12">
      <q-checkbox
        dense
        v-model="teal"
        label="By checking the box, I affirm that all provided registration information is accurate. I understand that supplying false details violates terms of use, leading to consequences like account suspension or termination. I accept responsibility for any inaccuracies, subject to applicable laws."
        color="danger"
        class="text-caption text-justify"
        style="color: gray; font-size: 12px;"
        :rules="[v => !!v || { tealError }]"
      />
      
    </div>

    <div class="col-12 text-center">
      <q-btn
        no-caps
        rounded
        color="green"
        label="Sign Up"
        type="submit"
        class="q-mt-sm"
        style="width: 70%"
      />
      <br /><br />
      <a href="/login" class="text-body2" style="text-decoration: none;">Already have an account?</a>
    </div>
              </q-card-section>
          </q-card>
      </div>
  </q-form>
</template>

  
<script>
import axios from 'axios';
import { ref } from 'vue';

export default {
name: 'signup',

data() {
  const currentYear = new Date().getFullYear();
  const years = Array.from({ length: 100 }, (_, index) => (currentYear - index).toString());
  const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  const currentDate = new Date();
  const days = Array.from({ length: 31 }, (_, index) => (index + 1).toString());

  return {
    firstname: '',
    lastname: '',
    mobile_or_email: '',
    password: '',
    gender: 'male',
    user_role: '',
    barangay: '',
    userModeOptions: ['Student', 'Coach', 'Staff', 'Parent/Guardian', 'Other'],
    barangayOptions: [
      'Balite',
      'Baruyan',
      'Bayanan I',
      'Bayanan II',
      'Calero',
      'Camilmil',
      'Canubing I',
      'Canubing II',
      'Guinobatan',
      'GulodIbaba East',
      'Ibaba West',
      'Ilaya',
      'Lalud',
      'Lazareto',
      'Lumangbayan',
      'Masipit',
      'Pachoca',
      'San Antonio',
      'Suqui',
      'Tawagan',
      'Tawiran',
      'Tibag',
    ],
    birthMonth: months[currentDate.getMonth()],
    birthday: currentDate.getDate().toString(),
    birthYear: currentDate.getFullYear().toString(),
    months,
    days,
    years,
    gender: ref('male'),
    teal: ref(false),
    showPassword: false,
  };
},

computed: {
  tealError() {
    if (!this.firstname || !this.lastname || !this.mobile_or_email || !this.password || !this.user_role || !this.barangay) {
      return 'Please fill in all required fields before checking this box.';
    }
    return '';
  },
},

methods: {
  async signup() {
    try {
      const response = await axios.post('register', {
        firstname: this.firstname,
        lastname: this.lastname,
        mobile_or_email: this.mobile_or_email,
        password: this.password,
        birthday: `${this.birthYear}-${this.months.indexOf(this.birthMonth) + 1}-${this.birthday}`, // Format the birthday
        gender: this.gender,
        user_role: this.user_role,
        barangay: this.barangay,
      });

      // Clear local storage after successful signup
      localStorage.clear();
      // Handle the response from the server, e.g., show a success message or redirect to another page
      // console.log('Signup successful:', response.data);

      // For example, redirect to the login page after successful signup
      this.$router.push({ name: 'login' });
    } catch (error) {
      console.error('Error signing up:', error);
      // Handle the error, e.g., display an error message to the user
    }
  },

  logoClicked() {
    this.$router.push({ name: 'home' });
  },

  validateBirthday(value) {
    const birthDate = new Date(`${value}-${this.months.indexOf(this.birthMonth) + 1}-${this.birthday}`);
    const currentDate = new Date();

    // Calculate age
    const age = currentDate.getFullYear() - birthDate.getFullYear();

    // Check if the user is at least 5 years old
    if (age < 5) {
      return 'Must be at least 5 years old.';
    }

    // Return true if the validation passes
    return true;
  },

  togglePassword() {
    this.showPassword = !this.showPassword;
  },
},
};
</script>
  
<style scoped>
.signup-page {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #EFEFEF;
}

.signup-card {
  max-width: 450px;
  width: 100%;
}

.my-custom-toggle {
  border: 1px solid black;
}

.hiyas-logo {
  width: 100%;
  height: 100%;
  object-fit: cover;
  /* Maintain image aspect ratio */
  border-radius: 50%;
  /* Make the image itself rounded */
}

@media (max-width: 576px) {
.signup-card {
  max-width: 100%;
}
}
</style>