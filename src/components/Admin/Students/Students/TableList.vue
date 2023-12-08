<template>
    <div>
        <q-table title="Student List" :rows="tableData" :columns="columns" row-key="name" />
    </div>
</template>
  
<script setup>
import VueApexCharts from 'vue3-apexcharts';
import axios from 'axios';
import { ref, onMounted } from 'vue';

const columns = [
    { name: 'firstname', label: 'First Name', field: 'firstname', align: 'left', sortable: true },
    { name: 'lastname', label: 'Last Name', field: 'lastname', align: 'left', sortable: true },
    { name: 'age', label: 'Age', field: 'age', align: 'left', sortable: true },
    { name: 'birthday', label: 'Birthday', field: 'birthday', align: 'left', sortable: true },
    { name: 'gender', label: 'Gender', field: 'gender', align: 'left', sortable: true },
    { name: 'address', label: 'Address', field: 'address', align: 'left', sortable: true },
    { name: 'contact_info', label: 'Contact Info', field: 'contact_info', align: 'left', sortable: true },
    { name: 'parent_guardian', label: 'Parent/Guardian', field: 'parent/guardian', align: 'left', sortable: true },
    { name: 'coach', label: 'Coach', field: 'coach', align: 'left', sortable: true },
    { name: 'section', label: 'Section', field: 'section', align: 'left', sortable: true },
    { name: 'sponsor', label: 'Sponsor', field: 'sponsor', align: 'left', sortable: true },
    { name: 'id_number', label: 'ID Number', field: 'id_number', align: 'left', sortable: true },
    { name: 'school', label: 'School', field: 'school', align: 'left', sortable: true },
    { name: 'grade_level', label: 'Grade Level', field: 'grade_level', align: 'left', sortable: true },
    { name: 'fam_number', label: 'Number in Family', field: 'fam', align: 'center', sortable: true },
    { name: 'staff', label: 'Staff', field: 'staff', align: 'left', sortable: true },
];

const tableData = ref([]);

// Define the created lifecycle hook
onMounted(async () => {
    try {
        const response = await axios.get('getstudentdata');
        // Filter the data to keep only entries with event_type "WLA"
        tableData.value = response.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});

</script>
    