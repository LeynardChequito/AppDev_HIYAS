<template>
    <div>
        <div class="row col-12 justify-end">
            <q-btn @click="openAddSectionDialog" color="positive" label="Add Section" class="q-my-md" />
        </div>
        <q-table title="" :rows="tableData" :columns="columns" row-key="name" class="my-sticky-last-column-table">
            <template #body-cell-actions="props">
                <q-td :props="props">
                    <q-btn flat round icon="edit" @click="editSection(props.row)" />
                    <q-btn flat round icon="delete" @click="deleteSection(props.row)" color="negative" />
                </q-td>
            </template>
        </q-table>

        <!-- Add Section Dialog -->
        <q-dialog v-model="addSectionDialog" position="standard">
            <q-card>
                <q-card-section>
                    <q-card-title class="text-h6">Section Data</q-card-title>
                    <q-input v-model="newSection.name" label="Section Name" />
                    <q-select v-model="newSection.coach" label="Coach" :options="coachOptions" />
                    <q-input v-model="newSection.age_group" label="Age group" />
                    <q-input v-model="newSection.quantity" label="Total" />
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn label="Cancel" color="negative" v-close-popup />
                    <q-btn :label="editMode ? 'Edit Section' : 'Add Section'" :color="editMode ? 'primary' : 'positive'"
                        @click="addOrEditSection" />
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
    {
        name: 'actions',
        label: 'Actions',
        field: 'actions',
        align: 'center',
        sortable: false,
        bodySlot: 'actions',
    },
];

const editMode = ref(false);

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
    editMode.value = false;
    // Show the dialog
    addSectionDialog.value = true;
    newSection.value = {
        name: '',
        coach: '',
        age_group: '',
        quantity: '',
    };


    // Fetch the list of coaches and populate the options
    axios.get('getcoachdata')
        .then(response => {
            coachOptions.value = response.data.map(coach => ({
                label: `${coach.firstname} ${coach.lastname}`,
                value: coach.id,
            }));
            // Set to "Add" mode by default

        })
        .catch(error => {
            console.error('Error fetching coach data:', error);
        });
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


const editSection = async (section) => {
    try {
        // Set to "Edit" mode

        // Open the addSectionDialog in "Edit" mode
        openAddSectionDialog();

        // Update the newSection object with the selected section's data
        newSection.value = { ...section };

        editMode.value = true;
        // Note: You may need to adjust the API endpoint based on your actual implementation
    } catch (error) {
        console.error('Error fetching section data for editing:', error);
    }
};



const deleteSection = async (section) => {
    try {
        // Call your API endpoint to delete a coach
        await axios.delete(`deletesection/${section.id}`);
        // Remove the deleted coach from the tableData
        tableData.value = tableData.value.filter(item => item.id !== section.id);
    } catch (error) {
        console.error('Error deleting coach:', error);
    }
};


const addOrEditSection = async () => {
    try {
        if (editMode.value) {
            // Call your API endpoint to update a coach
            await axios.put(`updatesection/${newSection.value.id}`, newSection.value);
        } else {
            // Call your API endpoint to add a section
            await axios.post('addsection', newSection.value);
        }

        // Refresh the section data after adding/editing a section
        const response = await axios.get('getsection');
        tableData.value = response.data;

        // Close the dialog after successfully adding/editing a section
        addSectionDialog.value = false;
    } catch (error) {
        console.error(`Error ${editMode.value ? 'editing' : 'adding'} section:`, error);
    }
};

</script>
<style lang="sass">
.my-sticky-last-column-table
  /* specifying max-width so the example can
    highlight the sticky column on any browser window */

  thead tr:last-child th:last-child
    /* bg color is important for th; just specify one */

  th:last-child,
  td:last-child
    position: sticky
    right: 0
    z-index: 1
</style>