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
      <q-form @submit.prevent="applyFilter">
        <q-input v-model="filterValue" label="Filter Value" dense />
        <q-btn type="submit" label="Apply Filter" color="primary" dense />
      </q-form>
    </div>

    <div class="q-pa-md">
      <q-btn-group>
        <q-btn-toggle v-model="filterBy" :options="filterOptions" flat color="primary" dense />
      </q-btn-group>
    </div>

    <!-- Display Table -->
    <q-table
      :rows="filteredTableData"
      :columns="columns"
      :rows-per-page-options="[10, 20, 30]"
      row-key="name"
      :pagination.sync="pagination"
      :sorting.sync="sorting"
      :filter.sync="filter"
      class="my-sticky-last-column-table"
    >
      <!-- ... (unchanged code for table actions) ... -->
    </q-table>
  </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted, computed } from 'vue';

const columns = [
  { name: 'student', label: 'Student', field: 'student', align: 'left', sortable: true },
  { name: 'section', label: 'Section', field: 'section', align: 'left', sortable: true },
  { name: 'status', label: 'Status', field: 'status', align: 'left', sortable: true },
  { name: 'date', label: 'Date', field: 'date', align: 'left', sortable: true },
];

const createAttendanceDialog = ref(false);
const newAttendance = ref({ date: '', section: '' });
const sectionOptions = ref([]);
const tableData = ref([]);
const pagination = ref({ page: 1, rowsPerPage: 10 });
const sorting = ref({ sortBy: 'date', descending: false });
const filter = ref('');
const filterBy = ref('date'); // Initial filter option
const filterValue = ref(''); // Input value for filter

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
    tableData.value = response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
});

const createAttendance = async () => {
  try {
    console.log('Creating attendance...');
    // Your API call to create attendance goes here
    await axios.post('createattendance', newAttendance.value);

    // Fetch and update tableData with student names
    await updateTableData(newAttendance.value.section);

    const response = await axios.get('studentAttendance');
    tableData.value = response.data;

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

// Computed property to filter table data based on selected filter option and value
const filteredTableData = computed(() => {
  const filterLower = filterValue.value.toLowerCase();
  const filterByLower = filterBy.value.toLowerCase();

  return tableData.value.filter(entry => {
    const valueLower = entry[filterByLower].toString().toLowerCase();
    return valueLower.includes(filterLower);
  });
});

const applyFilter = () => {
  // You can add more advanced filtering logic if needed
  filter.value = filterValue.value;
};

// Rest of your methods (editAttendance, deleteAttendance) remain unchanged
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