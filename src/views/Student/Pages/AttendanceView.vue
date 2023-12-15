<template>
    <q-toolbar-title class="text-start bg-green-3 text-bold text-black"
        style="position: fixed; width: 100%; z-index: 4; padding-left: 40px">
        My Attendance
    </q-toolbar-title>

    <div class="q-pt-xl">
        <div class="row col-12 justify-end q-pa-md sticky-save-btn">
            <q-btn @click="openReport" color="negative" label="Something is not right" icon="warning" class="q-my-md" />
        </div>
        <div v-if="attendanceData" class="q-pa-md">
            <q-table v-if="attendanceData.rows" :rows="formattedAttendanceData" :columns="columns" row-key="date"
                :rows-per-page-options="[5, 10, 15]" hide-bottom class="q-mb-md">
            </q-table>
            <div v-else>
                Loading attendance data...
            </div>
        </div>
        <div v-else>
            Loading student data...
        </div>
    </div>
</template>

  
<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import jwtDecode from 'jsonwebtoken/decode';

const attendanceData = ref(null);

const columns = [
    { name: 'date', label: 'Date', align: 'left', field: 'date', sortable: true },
    { name: 'event_type', label: 'Event Type', align: 'left', field: 'event_type', sortable: true },
    { name: 'status', label: 'Status', align: 'left', field: 'status', sortable: true },
];
onMounted(async () => {
    try {
        // Retrieve the user ID from the JWT payload
        const token = localStorage.getItem('token');
        if (token) {
            const decodedToken = jwtDecode(token);
            const userId = decodedToken.id;

            console.log('User ID:', userId);

            // Make API request to get student data
            const response = await axios.get('/getstudentdata');
            console.log('Student Data:', response.data);

            if (response.data && response.data.length > 0) {
                // Find the student data based on the user ID
                const student = response.data.find(student => student.account === userId);
                console.log('Found Student:', student);

                if (student) {
                    // Set the student name in the attendanceData ref
                    attendanceData.value = { student: `${student.firstname} ${student.lastname}` };
                    console.log('Student Name Set:', attendanceData.value.student);

                    // Now, make another API request to get attendance data
                    const attendanceResponse = await axios.get('/studentAttendance');
                    console.log('All Attendance Data:', attendanceResponse.data);

                    // Filter the attendance data for the specific student
                    const filteredAttendanceData = attendanceResponse.data.filter(
                        entry => entry.student === `${student.firstname} ${student.lastname}`
                    );

                    console.log('Filtered Attendance Data:', filteredAttendanceData);

                    // Set the filtered attendance data in the attendanceData ref
                    attendanceData.value = { rows: filteredAttendanceData };
                }
            }
        }
    } catch (error) {
        console.error('Error fetching attendance data:', error);
        // Handle the error as needed
    }
});

const formattedAttendanceData = computed(() => {
    if (!attendanceData.value || !attendanceData.value.rows) {
        return null;
    }

    return attendanceData.value.rows.map(entry => ({
        ...entry,
        date: formatDateString(entry.date),
    }));
});

const formatDateString = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', options);
};

</script>
  

<style lang="sass">
/* ... your existing styles ... */

.sticky-save-btn
  position: absolute
  bottom: 50px
  right: 20px
  z-index: 1000
</style>