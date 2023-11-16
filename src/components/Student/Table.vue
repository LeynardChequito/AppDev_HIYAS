
<template>
    <div class="q-pa-md">
        <div class="q-ma-sm row justify-end">
            <q-btn color="green" @click="navigateToManage">
                Manage
                <q-icon class="q-ml-sm" name="tune"></q-icon>
            </q-btn>
        </div>
        <q-table class="my-sticky-header-last-column-table" flat bordered :rows="info" :columns="columns" row-key="id">
            <template v-slot:body="props">
                <q-tr :props="props">
                    <q-td v-for="col in columns" :key="col.name" :props="props">
                        {{ props.row[col.name] }}
                    </q-td>
                    <q-td>
                        <q-btn icon="visibility" round flat @click="handleRowClick(props.row)"></q-btn>
                        <q-btn icon="edit" round flat @click="deleteRow()"></q-btn>
                        <q-btn icon="delete" round flat @click="deleteRow()"></q-btn>
                        <!-- Add more buttons as needed -->
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
    { name: 'id_number', label: 'Id Number', align: 'left', field: 'id_number', sortable: true },
    { name: 'lastname', label: 'Lastname', align: 'left', field: 'lastname', sortable: true },
    { name: 'firstname', label: 'Firstname', align: 'left', field: 'firstname', sortable: true },
    { name: 'birthday', label: 'Birthday', align: 'left', field: 'birthday', sortable: true },
    { name: 'age', label: 'Age', align: 'left', field: 'age', sortable: true },
    { name: 'gender', label: 'Gender', align: 'left', field: 'gender', sortable: true },
    { name: 'address', label: 'Address', align: 'left', field: 'address', sortable: true },
    { name: 'contact_info', label: 'Contact Info', align: 'left', field: 'contact_info', sortable: true },
    { name: 'guardian/parents', label: 'Parent/Guardian', align: 'left', field: 'guardian/parents', sortable: true },
    { name: 'school', label: 'School', align: 'left', field: 'school', sortable: true },
    { name: 'grade_level', label: 'Grade Level', align: 'left', field: 'grade_level', sortable: true },
    { name: 'coach', label: 'Coach', align: 'left', field: 'coach', sortable: true },
    { name: 'section', label: 'Section', align: 'left', field: 'section', sortable: true },
    { name: 'sponsor', label: 'Sponsor', align: 'left', field: 'sponsor', sortable: true },
    { name: 'staff', label: 'Staff', align: 'left', field: 'staff', sortable: true },
    { name: 'fam_number', label: 'Number in Family', align: 'center', field: 'fam', sortable: true },
    { label: 'Action', align: 'center', },
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
        navigateToManage() {
            this.$router.push('/manage/students');
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

<style lang="sass">
.my-sticky-header-last-column-table
  /* height or max-height is important */

  /* specifying max-width so the example can
    highlight the sticky column on any browser window */

  td:last-child
    /* bg color is important for td; just specify one */
    background-color: #EEEE

  tr th
    position: sticky
    /* higher than z-index for td below */
    z-index: 2
    /* bg color is important; just specify one */
    background: #EEEEEE

  /* this will be the loading indicator */
  thead tr:last-child th
    /* height of all previous header rows */
    top: 48px
    /* highest z-index */
    z-index: 3
  thead tr:first-child th
    top: 0
    z-index: 1
  tr:last-child th:last-child
    /* highest z-index */
    z-index: 3

  td:last-child
    z-index: 1

  td:last-child, th:last-child
    position: sticky
    right: 0

  /* prevent scrolling behind sticky top row on focus */
  tbody
    /* height of all previous header rows */
    scroll-margin-top: 48px
</style>
  