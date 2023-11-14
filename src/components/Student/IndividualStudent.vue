<template>
    <div class="q-pa-md row justify-center">
        <div class="col-md-2 items-center text-center hey">
            <q-img width="50" height="50" scale-down src="@/assets/images/coach1.png">
            </q-img>

        </div>
        <div class="col-md-10 heyq">
            {{ info.firsname }}
        </div>





    </div>
    <div>{{ info.address }}</div>
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
                // Get the id parameter from the URL
                const studentId = parseInt(this.$route.params.id);

                // Fetch data based on the id parameter
                const response = await axios.get('getstudentdata/${studentId}');
                this.info = response.data;
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        },
    },
    computed: {
        // No need for filteredInfo computed property since getInfo fetches data based on the id
        // Bind the columns to the component
        columns() {
            return columns;
        },
    },
};
</script>
  
<style scoped>
.hey{
    background-color:green;
}
.heyq{
    background-color:blue;
}
</style>