<template>
  <div>
    <div class="row col-12 justify-end">
      <q-btn @click="openCreateAttendanceDialog" color="positive" label="Create Attendance" class="q-my-md" />
    </div>

    <q-dialog v-model="createAttendanceDialog" position="standard">
      <q-card>
        <q-card-section>
          <q-card-title class="text-h6">Create Attendance</q-card-title>
          <q-input v-model="newAttendance.date" label="Date" mask="date" :rules="['date']">
            <template v-slot:append>
              <q-icon name="event" class="cursor-pointer">
                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                  <q-date v-model="newAttendance.date">
                    <div class="row items-center justify-end">
                      <q-btn v-close-popup label="Close" color="primary" flat />
                    </div>
                  </q-date>
                </q-popup-proxy>
              </q-icon>
            </template>
          </q-input>
          <q-select v-model="newAttendance.section" label="Section" :options="sectionOptions" />
        </q-card-section>

        <q-card-actions align="right">
          <q-btn label="Cancel" color="negative" v-close-popup />
          <q-btn label="Create" color="positive" @click="createAttendance" />
        </q-card-actions>
      </q-card>
    </q-dialog>

    <!-- Display Table -->
    <div class="q-pa-md">
      <!-- Remove filter-related code here -->
    </div>
    <!-- Display Table -->
    <!-- Display Table -->
    <div v-for="sectionId in sectionOptions" :key="sectionId" class="q-mb-md">
      <q-table :rows="getTableData(sectionId)" :columns="columns" :rows-per-page-options="[10, 20, 30]"
        :pagination.sync="getPagination(sectionId)" :sorting.sync="sorting" :filter.sync="filter"
        class="my-sticky-last-column-table">
        <template #body-cell-actions="props">
          <q-td :props="props">
            <q-radio v-model="props.row.action" val="Present" label="P" dense class="q-mr-sm" />
            <q-radio v-model="props.row.action" val="Absent" label="A" dense class="q-mr-sm" />
            <q-radio v-model="props.row.action" val="Late" label="L" dense class="q-mr-sm" />
            <q-radio v-model="props.row.action" val="Excused" label="E" dense class="q-mr-sm" />
          </q-td>
        </template>
      </q-table>
    </div>

    <div class="row col-12 justify-end ">
      <q-btn label="Save" color="positive" @click="saveAttendance" class="q-mt-md q-mr-md" />
    </div>
  </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';

const columns = [
  { name: 'student', label: 'Student', field: 'student', align: 'left', sortable: true },
  { name: 'section', label: 'Section', field: 'section', align: 'left', sortable: true },
  { name: 'status', label: 'Status', field: 'status', align: 'left', sortable: true, },
  { name: 'date', label: 'Date', field: 'date', align: 'left', sortable: true },
  {
    name: 'actions',
    label: 'Actions',
    field: 'actions',
    align: 'center',
    sortable: false,
    bodySlot: 'action',
  },
];


const createAttendanceDialog = ref(false);
const newAttendance = ref({ date: '', section: '', event_type: 'WLA' });
const sectionOptions = ref([]);
const tableData = ref([]);
const pagination = ref({ page: 1, rowsPerPage: 10 });
const sorting = ref({ sortBy: 'date', descending: false });
const filter = ref('');
const filterBy = ref('date'); // Initial filter option
const filterValue = ref('');

const filterOptions = [
  { label: 'Filter by Date', value: 'date' },
  { label: 'Filter by Section', value: 'section' },
];

const openCreateAttendanceDialog = async () => {
  createAttendanceDialog.value = true;

  try {
    const response = await axios.get('getsection');
    sectionOptions.value = response.data.map(section => ({ label: section.name, value: section.id }));
  } catch (error) {
    console.error('Error fetching section data:', error);
  }
};

onMounted(async () => {
  try {
    const response = await axios.get('studentAttendance');
    // Filter the data to keep only entries with event_type "WLA"
    tableData.value = response.data.map(entry => ({
      ...entry,
      action: entry.status, // Initialize action with the current status value
    }));
  } catch (error) {
    console.error('Error fetching data:', error);
  }
});

const createAttendance = async () => {
  try {
    console.log('Creating attendance...');

    // Set event_type to 'WLA' if it's not already set
    if (!newAttendance.value.event_type) {
      newAttendance.value.event_type = 'WLA';
    }

    console.log('New Attendance:', newAttendance.value);

    // Your API call to create attendance goes here
    const response = await axios.post('createattendance', newAttendance.value);
    console.log('API Response:', response.data);

    // Fetch and update tableData with student names
    await updateTableData(newAttendance.value.section);

    const attendanceResponse = await axios.get('studentAttendance');
    tableData.value = attendanceResponse.data;

    // Close the dialog after successfully creating attendance
    createAttendanceDialog.value = false;
  } catch (error) {
    console.error('Error creating attendance:', error);
  }
};

const updateTableData = async (sectionId) => {
  try {
    console.log('Updating table data for section:', sectionId);
    const response = await axios.get(`getstudentsforattendance/${sectionId}`);
    const updatedTableData = response.data.map(student => ({
      student: `${student.firstname} ${student.lastname}`,
      section: sectionId,
    }));

    // Find the index of the existing data for the section
    const sectionIndex = tableData.value.findIndex(entry => entry.section === sectionId);

    // If the section exists in the current tableData, update it; otherwise, append
    if (sectionIndex !== -1) {
      tableData.value.splice(sectionIndex, 1, ...updatedTableData);
    } else {
      tableData.value.push(...updatedTableData);
    }

    console.log('Table data updated:', tableData.value);
  } catch (error) {
    console.error(`Error fetching data for section ${sectionId}:`, error);
  }
};
const saveAttendance = async (sectionId) => {
  try {
    console.log(`Saving attendance for section ${sectionId}...`);

    // Filter out entries without changes for the specific section
    const changedEntries = tableData.value.filter(
      (entry) => entry.section === sectionId && entry.status !== entry.action
    );

    if (changedEntries.length === 0) {
      console.log('No changes to save for section', sectionId);
      return;
    }

    // Prepare data for API update
    const updateData = changedEntries.map((entry) => ({
      id: entry.id,
      student: entry.student,
      status: entry.action,
      date: entry.date,
      event_type: entry.event_type,
    }));

    // Your API call to update attendance goes here
    const response = await axios.put('updatestatus', updateData);
    console.log('API Response:', response.data);

    // Fetch and update tableData with updated attendance data for the specific section
    await updateTableData(sectionId);

    console.log(`Attendance saved successfully for section ${sectionId}`);
  } catch (error) {
    console.error(`Error saving attendance for section ${sectionId}:`, error);
  }
};



const getTableData = (sectionId) => {
  return tableData.value.filter((entry) => entry.section === sectionId);
};

const getPagination = (sectionId) => {
  const sectionRowCount = tableData.value.filter((entry) => entry.section === sectionId).length;
  return { page: 1, rowsPerPage: 10, rowsNumber: sectionRowCount };
};

</script>

<style lang="sass">
.my-sticky-last-column-table
  thead tr:last-child th:last-child
    background-color: white

  td:last-child
    background-color: white

  th:last-child,
  td:last-child
    position: sticky
    background-color: white
    right: 0
    z-index: 1
</style>
