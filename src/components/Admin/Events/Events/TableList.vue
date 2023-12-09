<template>
    <div>
        <div class="row col-12 justify-end">
            <q-btn @click="openAddEventDialog" color="positive" label="Add Event" class="q-my-md" />
        </div>
        <q-table title="" :rows="tableData" :columns="columns" row-key="name" class="my-sticky-last-column-table">
            <template #body-cell-actions="props">
                <q-td :props="props">
                    <q-btn flat round icon="edit" @click="editEvent(props.row)" />
                    <q-btn flat round icon="delete" @click="deleteEvent(props.row)" color="negative" />
                </q-td>
            </template>
        </q-table>

        <q-dialog v-model="addEventDialog" position="standard">
            <q-card>
                <q-card-section>
                    <q-card-title class="text-h6">Event Data</q-card-title>
                    <q-input v-model="newEvent.name" label="Event Name" />
                    <q-input v-model="newEvent.description" label="Event Description" />
                    <q-input filled v-model="newEvent.start" label="Event Start">
                        <template v-slot:prepend>
                            <q-icon name="event" class="cursor-pointer">
                                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                    <q-date v-model="newEvent.start" mask="YYYY-MM-DD HH:mm">
                                        <div class="row items-center justify-end">
                                            <q-btn v-close-popup label="Close" color="primary" flat />
                                        </div>
                                    </q-date>
                                </q-popup-proxy>
                            </q-icon>
                        </template>

                        <template v-slot:append>
                            <q-icon name="access_time" class="cursor-pointer">
                                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                    <q-time v-model="newEvent.start" mask="YYYY-MM-DD HH:mm">
                                        <div class="row items-center justify-end">
                                            <q-btn v-close-popup label="Close" color="primary" flat />
                                        </div>
                                    </q-time>
                                </q-popup-proxy>
                            </q-icon>
                        </template>
                    </q-input>
                    <q-input filled v-model="newEvent.end" label="Event Start">
                        <template v-slot:prepend>
                            <q-icon name="event" class="cursor-pointer">
                                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                    <q-date v-model="newEvent.end" mask="YYYY-MM-DD HH:mm">
                                        <div class="row items-center justify-end">
                                            <q-btn v-close-popup label="Close" color="primary" flat />
                                        </div>
                                    </q-date>
                                </q-popup-proxy>
                            </q-icon>
                        </template>

                        <template v-slot:append>
                            <q-icon name="access_time" class="cursor-pointer">
                                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                    <q-time v-model="newEvent.end" mask="YYYY-MM-DD HH:mm">
                                        <div class="row items-center justify-end">
                                            <q-btn v-close-popup label="Close" color="primary" flat />
                                        </div>
                                    </q-time>
                                </q-popup-proxy>
                            </q-icon>
                        </template>
                    </q-input>
                    <!-- <q-date v-model="newEvent.end" label="Event End" mask="YYYY-MM-DDTHH:mm:ss" color="positive" /> -->
                    <q-input v-model="newEvent.audience" label="Participants" />
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn label="Cancel" color="negative" v-close-popup />
                    <q-btn :label="editMode ? 'Edit Event' : 'Add Event'" :color="editMode ? 'primary' : 'positive'"
                        @click="addOrEditEvent" />
                </q-card-actions>
            </q-card>
        </q-dialog>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';

const columns = [
    { name: 'name', label: 'Event', field: 'name', align: 'left', sortable: true },
    { name: 'description', label: 'Description', field: 'description', align: 'left', sortable: true },
    { name: 'start', label: 'Event Start', field: 'start', align: 'left', sortable: true },
    { name: 'end', label: 'Event End', field: 'end', align: 'left', sortable: true },
    { name: 'audience', label: 'Participants', field: 'audience', align: 'left', sortable: true },
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
const addEventDialog = ref(false);
const newEvent = ref({
    name: '',
    description: '',
    start: '',
    end: '',
    audience: '',
});


const openAddEventDialog = async () => {
    // Reset the newSection object when opening the dialog
    editMode.value = false;
    // Show the dialog
    addEventDialog.value = true;
    newEvent.value = {
        name: '',
        description: '',
        start: '',
        end: '',
        audience: '',
    };

};



// Define the created lifecycle hook
onMounted(async () => {
    try {
        const response = await axios.get('getevent');
        // Filter the data to keep only entries with event_type "WLA"
        tableData.value = response.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});


const editEvent = async (event) => {
    try {
        // Set to "Edit" mode

        // Open the addSectionDialog in "Edit" mode
        openAddEventDialog();

        // Update the newSection object with the selected section's data
        newEvent.value = { ...event };

        editMode.value = true;
        // Note: You may need to adjust the API endpoint based on your actual implementation
    } catch (error) {
        console.error('Error fetching section data for editing:', error);
    }
};



const deleteEvent = async (event) => {
    try {
        // Call your API endpoint to delete a coach
        await axios.delete(`deleteevent/${event.id}`);
        // Remove the deleted coach from the tableData
        tableData.value = tableData.value.filter(item => item.id !== event.id);
    } catch (error) {
        console.error('Error deleting coach:', error);
    }
};


const addOrEditEvent = async () => {
    try {
        if (editMode.value) {
            // Call your API endpoint to update a coach
            await axios.put(`updateevent/${newEvent.value.id}`, newEvent.value);
        } else {
            // Call your API endpoint to add a section
            await axios.post('addevent', newEvent.value);
        }

        // Refresh the section data after adding/editing a section
        const response = await axios.get('getevent');
        tableData.value = response.data;

        // Close the dialog after successfully adding/editing a section
        addEventDialog.value = false;
    } catch (error) {
        console.error(`Error ${editMode.value ? 'editing' : 'adding'} event:`, error);
    }
};

</script>
<style lang="sass">
.my-sticky-last-column-table
  /* specifying max-width so the example can
    highlight the sticky column on any browser window */

  thead tr:last-child th:last-child
    /* bg color is important for th; just specify one */

  td:last-child

  th:last-child,
  td:last-child
    position: sticky
    right: 0
    z-index: 1
</style>