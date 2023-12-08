<template>
    <div>
        <q-btn @click="openAddCoachDialog" color="primary" label="Add Coach" class="q-mt-md" />
        <q-table title="" :rows="tableData" :columns="columns" row-key="name" />

        <!-- Add Coach Dialog -->
        <q-dialog v-model="addCoachDialog" position="standard">
            <q-card>
                <q-card-section>
                    <q-card-title class="text-h6">Add Coach</q-card-title>
                    <q-input v-model="newCoach.firstname" label="First Name" />
                    <q-input v-model="newCoach.lastname" label="Last Name" />
                    <q-input v-model="newCoach.age" label="Age" />
                    <q-input v-model="newCoach.birthday" label="Birthday" />
                    <q-input v-model="newCoach.phone" label="Phone" />
                    <q-input v-model="newCoach.gender" label="Gender" />
                    <q-input v-model="newCoach.date_hired" label="Date Hired" />
                    <q-input v-model="newCoach.coach_id" label="Coach ID" />
                    <q-input v-model="newCoach.address" label="Address" />
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn label="Cancel" color="negative" v-close-popup />
                    <q-btn label="Add Coach" color="primary" @click="addCoach" />
                </q-card-actions>
            </q-card>
        </q-dialog>
    </div>
</template>
  
<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';


const columns = [
    { name: 'firstname', label: 'First Name', field: 'firstname', align: 'left', sortable: true },
    { name: 'lastname', label: 'Last Name', field: 'lastname', align: 'left', sortable: true },
    { name: 'age', label: 'Age', field: 'age', align: 'left', sortable: true },
    { name: 'birthday', label: 'Birthday', field: 'birthday', align: 'left', sortable: true },
    { name: 'phone', label: 'Phone', field: 'phone', align: 'left', sortable: true },
    { name: 'gender', label: 'Gender', field: 'gender', align: 'left', sortable: true },
    { name: 'date_hired', label: 'Date Hired', field: 'date_hired', align: 'left', sortable: true },
    { name: 'coach_id', label: 'Coach ID', field: 'coach_id', align: 'left', sortable: true },
    { name: 'address', label: 'Address', field: 'address', align: 'left', sortable: true },
];

const tableData = ref([]);
const addCoachDialog = ref(false);
const newCoach = ref({
    firstname: '',
    lastname: '',
    age: '',
    birthday: '',
    phone: '',
    gender: '',
    date_hired: '',
    coach_id: '',
    address: '',

});

const openAddCoachDialog = () => {
    // Reset the newCoach object when opening the dialog
    newCoach.value = {
        firstname: '',
        lastname: '',
        age: '',
        birthday: '',
        phone: '',
        gender: '',
        date_hired: '',
        coach_id: '',
        address: '',
        // Reset other fields as needed
    };
    addCoachDialog.value = true;
};

const addCoach = async () => {
    try {
        // Call your API endpoint to add a coach
        await axios.post('addcoach', newCoach.value);
        // Refresh the coach data after adding a new coach
        const response = await axios.get('getcoachdata');
        tableData.value = response.data;
        // Close the dialog after successfully adding a coach
        addCoachDialog.value = false;
    } catch (error) {
        console.error('Error adding coach:', error);
    }
};
// Define the created lifecycle hook
onMounted(async () => {
    try {
        const response = await axios.get('getcoachdata');
        // Filter the data to keep only entries with event_type "WLA"
        tableData.value = response.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});

</script>
    