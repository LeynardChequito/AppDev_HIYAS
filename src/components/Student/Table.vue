
<template>
    <div class="q-pa-md">
        <q-table :rows="info" :columns="columns" row-key="id">
            <template v-slot:body="props">
                <q-tr :props="props" @click="handleRowClick(props.row)">
                    <q-td v-for="col in columns" :key="col.name" :props="props">
                        {{ props.row[col.name] }}
                    </q-td>
                </q-tr>
            </template>
        </q-table>
    </div>
</template>
  
<script>
import axios from 'axios';

// Define the columns outside the data method
const columns = [
    { name: 'id_number', label: 'Id Number', align: 'left', field: 'id_number' },
    { name: 'lastname', label: 'Lastname', align: 'left', field: 'lastname' },
    { name: 'firsname', label: 'Firsname', align: 'left', field: 'firsname' },
    { name: 'age', label: 'Age', align: 'left', field: 'age' },
    { name: 'birthday', label: 'Birthday', align: 'left', field: 'birthday' },
    { name: 'gender', label: 'Gender', align: 'left', field: 'gender' },
    { name: 'address', label: 'Address', align: 'left', field: 'address' },
    { name: 'contact_info', label: 'Contact Info', align: 'left', field: 'contact_info' },
    { name: 'guardian/parents', label: 'Parent/Guardian', align: 'left', field: 'guardian/parents' },
    { name: 'coach', label: 'Coach', align: 'left', field: 'coach' },
    { name: 'section', label: 'Section', align: 'left', field: 'section' },
    { name: 'sponsor', label: 'Sponsor', align: 'left', field: 'sponsor' },
    { name: 'staff', label: 'Staff', align: 'left', field: 'staff' },
    // Add more columns as needed
];

export default {
    data() {
        return {
            info: [],
        };
    },
    created() {
        this.getInfo();
    },
    methods: {
        async getInfo() {
            try {
                const response = await axios.get('getstudentdata');
                this.info = response.data;
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        },
        handleRowClick(row) {
            // Assuming the id property is present in the row object
            const id = row.id;

            // Navigate to the new route
            this.$router.push(`/reports/students/${id}`);
        },
    },

    // Bind the columns to the component
    computed: {
        columns() {
            return columns;
        },
    },
};
</script>
  