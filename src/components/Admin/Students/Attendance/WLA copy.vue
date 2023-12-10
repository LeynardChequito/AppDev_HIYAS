<template>
  <div>
    <div class="row col-12 justify-end">
      <q-btn @click="openAddAttendanceDialog" color="positive" label="Add Student" class="q-my-md" />
    </div>
    <q-table title="" :rows="tableData" :columns="columns" row-key="name" class="my-sticky-last-column-table">
      <template #body-cell-actions="props">
        <q-td :props="props">
          <q-btn flat round icon="edit" @click="editAttendance(props.row)" />
          <q-btn flat round icon="delete" @click="deleteAttendance(props.row)" color="negative" />
        </q-td>
      </template>
    </q-table>

    <q-dialog v-model="addAttendanceDialog" position="standard">
      <q-card>
        <q-card-section>
          <q-card-title class="text-h6">Attendance Data</q-card-title>
          <q-select v-model="newAttendance.student" label="Student" :options="studentOptions" />
          <q-select v-model="newAttendance.event_type" label="Type" disabled />
          <!-- <q-select v-model="newAttendance.section" label="Section" :options="sectionOptions" /> -->
          <q-select v-model="newAttendance.status" label="Status" :options="statusOptions" :rules="[v => !!v]" dense />
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
        </q-card-section>

        <q-card-actions align="right">
          <q-btn label="Cancel" color="negative" v-close-popup />
          <q-btn :label="editMode ? 'Edit Attendance' : 'Add Attendance'" :color="editMode ? 'primary' : 'positive'"
            @click="addOrEditAttendance" />
        </q-card-actions>
      </q-card>
    </q-dialog>
    <apexchart type="pie" width="500" :options="chartOptions" :series="chartSeries" />

  </div>
</template>

<script setup>
import axios from 'axios';
import VueApexCharts from 'vue3-apexcharts';

import { ref, onMounted, watch } from 'vue'


const columns = [
  { name: 'student', label: 'Student', field: 'student', align: 'left', sortable: true },
  { name: 'section', label: 'Section', field: 'section', align: 'left', sortable: true },
  { name: 'status', label: 'Status', field: 'status', align: 'left', sortable: true },
  { name: 'date', label: 'Date', field: 'date', align: 'left', sortable: true },
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
const studentOptions = ref([]);
const sectionFilter = ref([]);
const statusOptions = ['Present', 'Absent', 'Late', 'Excused'];
const tableData = ref([]);
const addAttendanceDialog = ref(false);
const newAttendance = ref({
  student: '',
  status: '',
  date: '',
  event_type: 'WLA',
});


const openAddAttendanceDialog = async () => {
  // Reset the newSection object when opening the dialog
  editMode.value = false;
  // Show the dialog
  addAttendanceDialog.value = true;
  newAttendance.value = {
    student: '',
    status: '',
    date: '',
    event_type: 'WLA',
  };


  axios.get('getstudentdata')
    .then(response => {
      studentOptions.value = response.data.map(student => ({
        label: `${student.firstname} ${student.lastname}`,
        value: student.id,
      }));

    })
    .catch(error => {
      console.error('Error fetching coach data:', error);
    });

  axios.get('getsection')
    .then(response => {
      sectionFilter.value = response.data.map(section => ({
        label: `${section.name}`,
        value: section.id,
      }));
    })
    .catch(error => {
      console.error('Error fetching coach data:', error);
    });
};
// Define the created lifecycle hook
onMounted(async () => {
  try {
    const response = await axios.get('studentAttendance');
    // Filter the data to keep only entries with event_type "WLA"
    tableData.value = response.data.filter(student => student.event_type === 'WLA');
  } catch (error) {
    console.error('Error fetching data:', error);
  }
});

const editAttendance = async (student_attendance) => {
  try {
    // Set to "Edit" mode

    // Open the addattendanceDialog in "Edit" mode
    openAddAttendanceDialog();

    // Update the newattendance object with the selected student_attendance's data
    newAttendance.value = { ...student_attendance };

    editMode.value = true;
    // Note: You may need to adjust the API endpoint based on your actual implementation
  } catch (error) {
    console.error('Error fetching attendance data for editing:', error);
  }
};



const deleteAttendance = async (student_attendance) => {
  try {
    // Call your API endpoint to delete a coach
    await axios.delete(`deletestudentattendance/${student_attendance.id}`);

    // Remove the deleted coach from the tableData
    tableData.value = tableData.value.filter(item => item.id !== student_attendance.id);
  } catch (error) {
    console.error('Error deleting attendance:', error);
  }
};


const addOrEditAttendance = async () => {
  try {
    if (editMode.value) {
      // Call your API endpoint to update a coach
      await axios.put(`updatestudentattendance/${newAttendance.value.id}`, newAttendance.value);

    } else {
      // Call your API endpoint to add a attendance
      await axios.post('addstudentattendance', newAttendance.value);
    }

    // Refresh the attendance data after adding/editing a attendance
    const response = await axios.get('studentAttendance');
    tableData.value = response.data;

    // Close the dialog after successfully adding/editing a attendance
    addAttendanceDialog.value = false;
  } catch (error) {
    console.error(`Error ${editMode.value ? 'editing' : 'adding'} attendance:`, error);
  }
};

const chartOptions = ref({
  labels: statusOptions,
  colors: ['#36a2eb', '#ff6384', '#4caf50', '#ffcc29'],
});

const chartSeries = ref([]);

onMounted(() => {
  // Update the pie chart when the component is mounted
  updatePieChart();
});

watch(tableData, () => {
  // Update the pie chart whenever the tableData changes
  updatePieChart();
});

const updatePieChart = () => {
  const statusCounts = {};
  tableData.value.forEach(attendance => {
    const status = attendance.status;
    statusCounts[status] = (statusCounts[status] || 0) + 1;
  });

  chartSeries.value = Object.values(statusCounts);
};

</script>


<script>
import VueApexCharts from 'vue3-apexcharts';

const { onBeforeMount } = require('vue');

export default {
  components: {
    apexchart: VueApexCharts,
  },
  setup() {
    onBeforeMount(() => {
      VueApexCharts.component('apexchart', VueApexCharts);
    });
  },
};
</script>

<style lang="sass">
.my-sticky-last-column-table
  /* specifying max-width so the example can
    highlight the sticky column on any browser window */

  thead tr:last-child th:last-child
  background-color: white

    /* bg color is important for th; just specify one */

  td:last-child
    background-color: white

  th:last-child,
  td:last-child
    position: sticky
    background-color: white
    right: 0
    z-index: 1
</style>


