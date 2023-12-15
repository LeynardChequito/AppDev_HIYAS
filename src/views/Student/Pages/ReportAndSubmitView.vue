<template>
    <div>
        <q-toolbar-title class="text-start bg-green-3 text-bold text-black"
            style="position: fixed; width: 100%; z-index: 4; padding-left: 40px">
            Request or Submit
        </q-toolbar-title>

        <div style="padding-top: 35px">
            <q-tabs v-model="tab" dense class="bg-grey-3 text-black" active-color="white" indicator-color="transparent"
                active-bg-color="green" align="justify">
                <q-tab name="health" label="health" style="border-radius: 30px;" class="q-mx-sm bg-white" />
                <q-tab name="school" label="school" style="border-radius: 30px;" class="q-mx-sm bg-white" />
                <q-tab name="events" label="events" style="border-radius: 30px;" class="q-mx-sm bg-white" />
            </q-tabs>
        </div>

        <div class="q-pt-xl">
            <q-tab-panels v-model="tab" animated class="bg-green-2 text-grey">
                <q-tab-panel name="section" class="q-pa-md">
                    <!-- Content for section tab -->
                </q-tab-panel>
                <q-tab-panel name="attendance" class="q-pa-md">
                    <!-- Content for attendance tab -->
                </q-tab-panel>
            </q-tab-panels>
        </div>
    </div>
</template>
  
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import jwtDecode from 'jsonwebtoken/decode';

const tab = ref('health');
const studentData = ref(null);

onMounted(async () => {
    try {
        // Retrieve the user ID from the JWT payload
        const token = localStorage.getItem('token');
        if (token) {
            const decodedToken = jwtDecode(token);
            const userId = decodedToken.id;

            // Make API request to get student data
            const response = await axios.get(`/getstudentdata`);
            if (response.data && response.data.length > 0) {
                // Find the student data based on the user ID
                const student = response.data.find(student => student.account === userId);
                if (student) {
                    // Set the studentData ref with the found student data
                    studentData.value = student;
                }
            }
        }
    } catch (error) {
        console.error('Error fetching student data:', error);
        // Handle the error as needed
    }
});
</script>
  
<style>
/* Custom styles for pill-shaped tabs */
</style>
  