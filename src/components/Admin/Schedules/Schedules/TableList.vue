<template>
    <div class="row col-12 justify-end">
        <q-btn @click="openAddEventDialog" color="positive" label="Add Schedule" class="q-my-md" />
    </div>

    <div class="event-cards-container">
        <div v-for="(eventType, index) in uniqueEventTypes" :key="index" class="event-card">
            <q-card>
                <q-card-section class="scrollable-card-section">
                    <h2>{{ eventType }} Schedule</h2>
                    <p><strong>Description:</strong> {{ eventType.description }}</p>
                    <p><strong>Date and Time:</strong> {{ eventType.start }}</p>

                    <div v-for="event in getTableData(eventType)" :key="event.id">
                        <div class="participant-item">
                            <p><strong>Participants:</strong> {{ event.audience }}</p>
                        </div>
                    </div>
                </q-card-section>
            </q-card>
        </div>
    </div>
    <q-dialog v-model="addEventDialog" position="standard">
        <q-card>
            <q-card-section>
                <q-card-title class="text-h6">Event Data</q-card-title>
                <q-input v-model="newEvent.type" label="Event Name" />
                <q-input v-model="newEvent.description" label="Event Description" />
                <q-input v-model="newEvent.start" label="Date and Time" mask="datetime">
                    <template v-slot:append>
                        <q-icon name="event" class="cursor-pointer">
                            <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                <div class="q-gutter-md">
                                    <q-date v-model="newEvent.start" mask="YYYY/MM/DD HH:mm" />
                                    <div class="row items-center justify-end">
                                        <q-btn v-close-popup label="Close" color="primary" flat />
                                    </div>
                                </div>
                            </q-popup-proxy>
                        </q-icon>
                    </template>
                    <template v-slot:prepend>
                        <q-icon name="schedule" class="cursor-pointer">
                            <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                <div class="q-gutter-md">
                                    <q-time v-model="newEvent.start" mask="YYYY/MM/DD HH:mm" />
                                    <div class="row items-center justify-end">
                                        <q-btn v-close-popup label="Close" color="primary" flat />
                                    </div>
                                </div>
                            </q-popup-proxy>
                        </q-icon>
                    </template>
                </q-input>


                <q-select v-model="newEvent.audience" label="Participants" :options="audienceOptions" :rules="[v => !!v]"
                    dense />

                <q-select v-if="newEvent.audience === 'Students'" v-model="selectedStudents" label="Select Students"
                    use-input use-chips multiple :options="studentOptions" />
            </q-card-section>

            <q-card-actions align="right">
                <q-btn label="Cancel" color="negative" v-close-popup />
                <q-btn :label="editMode ? 'Edit Event' : 'Add Event'" :color="editMode ? 'primary' : 'positive'"
                    @click="addOrEditEvent" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>
  
<script setup>
import axios from 'axios';
import { ref, onMounted, computed } from 'vue';

const audienceOptions = ['All', 'Students', 'Coaches', 'Parents/Guardians', 'Staff'];
const selectedStudents = ref([]);
const studentOptions = ref([]);

const uniqueEventTypes = computed(() => Array.from(new Set(tableData.value.map(event => event.type))));

const getTableData = (eventType) => {
    return tableData.value.filter((event) => event.type === eventType);
};
const getTableRowKey = (eventType) => {
    return (row) => `${eventType}_${row.name}`;
};

const columns = [
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
    audience: '',
    type: '',
    description: '',
    start: '',
});

const openAddEventDialog = async () => {
    editMode.value = false;
    addEventDialog.value = true;
    newEvent.value = {
        audience: '',
        type: '',
        description: '',
        start: '',
    };

    try {
        const studentsResponse = await axios.get('/getstudentdata');
        studentOptions.value = studentsResponse.data.map(student => ({
            value: student.id,
            label: `${student.firstname} ${student.lastname}`,
        }));
    } catch (error) {
        console.error('Error fetching students data:', error);
    }
};

// Define the created lifecycle hook
onMounted(async () => {
    try {
        const response = await axios.get('getstudentschedule');
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
        await axios.delete(`deletestudentschedule/${event.id}`);
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
            await axios.put(`updatestudentschedule/${newEvent.value.id}`, newEvent.value);
        } else {
            // If the audience is 'Students', send selectedStudents instead of newEvent.value
            if (newEvent.value.audience === 'Students') {
                const studentsData = {
                    type: newEvent.value.type,
                    description: newEvent.value.description,
                    start: newEvent.value.start,
                    audience: selectedStudents.value.map(student => student.value),
                };

                await axios.post('addstudentschedule', studentsData);
            } else {
                // Call your API endpoint to add a section
                await axios.post('addstudentschedule', newEvent.value);
            }
        }

        // Refresh the section data after adding/editing a section
        const response = await axios.get('getstudentschedule');
        tableData.value = response.data;

        // Close the dialog after successfully adding/editing a section
        addEventDialog.value = false;
    } catch (error) {
        console.error(`Error ${editMode.value ? 'editing' : 'adding'} event:`, error);
    }
};

</script>

<style lang="sass">
.scrollable-card-section
  max-height: 300px
  overflow-y: auto

.my-sticky-last-column-table
  thead tr:last-child th:last-child
    td:last-child
  th:last-child,
  td:last-child
    position: sticky
    right: 0
    z-index: 1
.scrollable-card-section
  max-height: 300px
  height: 300px
  overflow-y: auto

.event-cards-container
  display: grid
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr))
  gap: 20px

.event-card
  width: 100%
  box-sizing: border-box

.participant-item
  margin-bottom: 10px
</style>