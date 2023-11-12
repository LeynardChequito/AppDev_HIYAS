<template>
    <div class="row justify-center signup-page">
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

                <q-card-section class="q-gutter-sm">
                    <div class="row">
                        <div class="col-6">
                            <q-input v-model="firstName" outlined label="First Name" dense debounce="300" class="q-mr-sm" />
                        </div>
                        <div class="col-6">
                            <q-input v-model="lastName" outlined label="Last Name" dense debounce="300" />
                        </div>
                    </div>
                    <q-input v-model="mobileOrEmail" outlined label="Mobile Number or Email" dense debounce="300" />
                    <q-input v-model="newPassword" outlined label="New Password" type="password" dense debounce="300" />
                    <div class="row items-center">
                        <div class="text-caption col-9 text-weight-thin">Birthday</div>
                        <div class="text-caption col-3 text-weight-thin">Gender</div>
                        <div class="col-3">
                            <q-select v-model="birthMonth" outlined label="Month" :options="months" dense class="q-mr-sm" />
                        </div>
                        <div class="col-3">
                            <q-select v-model="birthDay" outlined label="Day" :options="days" dense class="q-mr-sm" />
                        </div>
                        <div class="col-3">
                            <q-select v-model="birthYear" outlined label="Year" :options="years" dense />
                        </div>
                        <div class="col-3">
                            <q-btn-toggle unelevated class="q-ml-sm my-custom-toggle" v-model="model" no-caps
                                toggle-color="primary" color="white" text-color="black" :options="[
                                    { label: 'M', value: 'male' },
                                    { label: 'F', value: 'female' }
                                ]" />
                        </div>
                    </div>
                    <div class="col-12">
                        <q-select v-model="barangay" outlined label="Barangay" :options="barangayOptions" dense />
                    </div>

                    <q-checkbox dense v-model="teal"
                        label="Lahat ng nakalagay ay tama at naiintindihan ko na kung may mali akong nilagay, lagot ay ako ang mananagot"
                        color="primary" class="text-caption" style="color: gray; font-size: 10px;" />



                    <div class="col-12 text-center">
                        <q-btn no-caps rounded color="green" label="Sign Up" @click="signup" class="q-mt-sm "
                            style="width: 70%" />

                        <br><br><a href="/login" class="text-body2" style="text-decoration: none;">Already have an
                            account?</a>

                    </div>
                </q-card-section>
            </q-card>
        </div>
    </div>
</template>

    
<script>
import axios from 'axios'
import { ref } from 'vue'
export default {
    name: 'signup',
    data() {
        const currentYear = new Date().getFullYear();
        const years = Array.from({ length: 100 }, (_, index) => (currentYear - index).toString());
        const months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        const currentDate = new Date();
        const days = Array.from({ length: 31 }, (_, index) => (index + 1).toString());

        return {
            firstName: '',
            lastName: '',
            mobileOrEmail: '',
            newPassword: '',
            gender: 'male',
            userMode: '',
            barangay: '',
            userModeOptions: ['Student', 'Coach', 'Staff', 'Parent/Guardian', 'Other'],
            barangayOptions: ['Balite', 'Baruyan', 'Bayanan I', 'Bayanan II', 'Calero', 'Camilmil', 'Canubing I', 'Canubing II', 'Guinobatan', 'GulodIbaba East', 'Ibaba West', 'Ilaya', 'Lalud', 'Lazareto', 'Lumangbayan', 'Masipit', 'Pachoca', 'San Antonio', 'Suqui', 'Tawagan', 'Tawiran', 'Tibag'
            ],
            birthMonth: months[currentDate.getMonth()],
            birthDay: currentDate.getDate().toString(),
            birthYear: currentDate.getFullYear().toString(),
            months,
            days,
            years,
            model: ref('male'),
            teal: ref(false),

        };
    },



    methods: {
        async signup() {
            try {
                const response = await axios.post('register', {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    mobileOrEmail: this.mobileOrEmail,
                    newPassword: this.newPassword,
                    birthday: `${this.birthYear}-${this.months.indexOf(this.birthMonth) + 1}-${this.birthDay}`, // Format the birthday
                    gender: this.model,
                    userMode: this.userMode,
                    barangay: this.barangay,
                });

                // Handle the response from the server, e.g., show a success message or redirect to another page
                console.log('Signup successful:', response.data);

                // For example, redirect to login page after successful signup
                this.$router.push({ name: 'login' });
            } catch (error) {
                console.error('Error signing up:', error);
                // Handle the error, e.g., display an error message to the user
            }
        },
        logoClicked() {
            this.$router.push({ name: 'home' });
        }
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
</style>
    