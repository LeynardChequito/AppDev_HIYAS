<template>
    <div>
        <q-btn @click="openAddSectionDialog" color="primary" label="Add Section" class="q-mt-md" />
        <q-table title="" :rows="tableData" :columns="columns" row-key="name" />

        <!-- Add Section Dialog -->
        <q-dialog v-model="addSectionDialog" position="standard">
            <q-card class="q-pa-md" style="width: 600px;">
                <q-card-section >
                    <q-card-title class="text-h6">Add Section</q-card-title>
                    <q-input filled v-model="newSection.name" label="Section Name" style="margin-bottom: 5px; color: primary;" label-color="black" class="bg-grey-2" />
                    <q-select filled
                        v-model="newSection.coach"
                        label="Coach"
                        :options="coachOptions"
                    style="margin-bottom: 5px; color: primary;" label-color="black" class="bg-grey-2" />
                    <q-input filled v-model="newSection.age_group" label="Range of Age " style="margin-bottom: 5px; color: primary;" label-color="black" class="bg-grey-2" />
                    <q-input filled v-model="newSection.quantity" label="Total Students" style="margin-bottom: 5px; color: primary;" label-color="black" class="bg-grey-2" />
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn label="Cancel" color="negative" v-close-popup style="margin-bottom: 5px; color: primary;" label-color="black" filled-color="grey-4" />
                    <q-btn label="Add Section" color="primary" @click="addSection" style="margin-bottom: 5px; color: primary;" label-color="black" filled-color="grey-4" />
                </q-card-actions>
            </q-card>
        </q-dialog>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';

const columns = [
    { name: 'name', label: 'Section', field: 'name', align: 'left', sortable: true },
    { name: 'coach', label: 'Coach', field: 'coach', align: 'left', sortable: true },
    { name: 'age_group', label: 'Age Group', field: 'age_group', align: 'left', sortable: true },
    { name: 'quantity', label: 'Total Students', field: 'quantity', align: 'left', sortable: true },
];

const tableData = ref([]);
const addSectionDialog = ref(false);
const newSection = ref({
    name: '',
    coach: '',
    age_group: '',
    quantity: '',
});

const coachOptions = ref([]);

const openAddSectionDialog = async () => {
    // Reset the newSection object when opening the dialog
    newSection.value = {
        name: '',
        coach: '',
        age_group: '',
        quantity: '',
    };
    // Fetch the list of coaches and populate the options
    const response = await axios.get('getcoachdata');
    coachOptions.value = response.data.map(coach => ({
        label: `${coach.firstname} ${coach.lastname}`,
        value: coach.id, // Assuming coach.id is the coach's unique identifier
    }));
    addSectionDialog.value = true;
};

const addSection = async () => {
    try {
        // Call your API endpoint to add a section
        await axios.post('addsection', newSection.value);
        // Refresh the section data after adding a new section
        const response = await axios.get('getsection');
        tableData.value = response.data;
        // Close the dialog after successfully adding a section
        addSectionDialog.value = false;
    } catch (error) {
        console.error('Error adding section:', error);
    }
};

// Define the created lifecycle hook
onMounted(async () => {
    try {
        const response = await axios.get('getsection');
        // Filter the data to keep only entries with event_type "WLA"
        tableData.value = response.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});
</script>
