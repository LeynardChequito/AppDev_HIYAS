<template>
    <q-page>
      <!-- Filter options -->
      <q-form @submit.prevent="submitFilter">
        <q-select v-model="selectedStudent" :options="students" label="Select Student"></q-select>
        <q-select v-model="selectedSection" :options="sections" label="Select Section"></q-select>
        <q-date v-model="selectedDate" label="Select Time" class="text-black"></q-date>
        <q-btn type="submit" label="Apply Filters" color="primary"></q-btn>
      </q-form>
  
      <!-- Weekly Attendance Table -->
      <q-table :rows="groupedAttendance" :columns="columns" row-key="id" :filter="filter" :search="search">
        <template v-slot:top="props">
          <q-toolbar>
            <q-toolbar-title>Weekly Attendance</q-toolbar-title>
            <q-btn flat dense round icon="search" @click="props.toggleTop"></q-btn>
          </q-toolbar>
          <q-space></q-space>
        </template>
      </q-table>
  
      <!-- Weekly Attendance Graph (Replace with your preferred chart library) -->
      <q-card class="q-mt-md text-black">
        <q-card-section>
          <q-card-title>Attendance Graph</q-card-title>
          <apexchart v-for="data in groupedAttendance" :key="data.section" type="line" :options="chartOptions" :series="data.chartData"></apexchart>
        </q-card-section>
      </q-card>
    </q-page>
  </template>
  
  
<script setup>
import { ref, computed } from 'vue';
import apexchart from 'vue3-apexcharts';

const students = ref([
    { label: 'Student A', value: 1 },
    { label: 'Student B', value: 2 },
    { label: 'Student C', value: 3 },
    { label: 'Student D', value: 4 },
    // Add more students
]);

let dates = [];
const chartData = ref([]);
const sections = ref(['A', 'B', 'C']);

const selectedStudent = ref(null);
const selectedSection = ref(null);
const selectedDate = ref(null);
const search = ref('');
const filter = ref('');

const columns = ref([
    { name: 'date', label: 'Date', align: 'left', field: 'date', sortable: true },
    { name: 'studentName', label: 'Student Name', align: 'left', field: 'studentName', sortable: true },
    { name: 'section', label: 'Section', align: 'left', field: 'section', sortable: true },
    { name: 'status', label: 'Attendance Status', align: 'left', field: 'status', sortable: true },
]);

const attendance = ref([
    { id: 1, date: '2023-01-07', studentName: 'Student A', section: 'A', status: 'Present' },
    { id: 2, date: '2023-01-07', studentName: 'Student B', section: 'B', status: 'Absent' },
    { id: 3, date: '2023-01-07', studentName: 'Student C', section: 'B', status: 'Present' },
    { id: 4, date: '2023-01-07', studentName: 'Student D', section: 'B', status: 'Absent' },
    { id: 5, date: '2023-01-14', studentName: 'Student A', section: 'A', status: 'Present' },
    { id: 6, date: '2023-01-14', studentName: 'Student B', section: 'B', status: 'Present' },
    { id: 7, date: '2023-01-14', studentName: 'Student C', section: 'B', status: 'Present' },
    { id: 8, date: '2023-01-14', studentName: 'Student D', section: 'B', status: 'Present' },
    { id: 9, date: '2023-01-21', studentName: 'Student A', section: 'A', status: 'Absent' },
    { id: 10, date: '2023-01-21', studentName: 'Student B', section: 'B', status: 'Absent' },
    { id: 11, date: '2023-01-21', studentName: 'Student C', section: 'B', status: 'Absent' },
    { id: 12, date: '2023-01-21', studentName: 'Student D', section: 'B', status: 'Absent' },
    { id: 13, date: '2023-01-28', studentName: 'Student A', section: 'A', status: 'Present' },
    { id: 14, date: '2023-01-28', studentName: 'Student B', section: 'B', status: 'Absent' },
    { id: 15, date: '2023-01-28', studentName: 'Student C', section: 'B', status: 'Absent' },
    { id: 16, date: '2023-01-28', studentName: 'Student D', section: 'B', status: 'Present' },
    { id: 17, date: '2023-02-04', studentName: 'Student A', section: 'A', status: 'Present' },
    { id: 18, date: '2023-02-04', studentName: 'Student B', section: 'B', status: 'Present' },
    { id: 19, date: '2023-02-04', studentName: 'Student C', section: 'B', status: 'Present' },
    { id: 20, date: '2023-02-04', studentName: 'Student D', section: 'B', status: 'Present' },
    { id: 21, date: '2023-02-11', studentName: 'Student A', section: 'A', status: 'Present' },
    { id: 22, date: '2023-02-11', studentName: 'Student B', section: 'B', status: 'Present' },
    { id: 23, date: '2023-02-11', studentName: 'Student C', section: 'B', status: 'Present' },
    { id: 24, date: '2023-02-11', studentName: 'Student D', section: 'B', status: 'Present' },
    // Add more attendance data
]);


const rows = ref(attendance.value); // Initialize rows with the full attendance data

chartData.value = generateChartData(attendance.value);

function generateChartData(attendanceData) {
  dates = Array.from(new Set(attendanceData.map(item => item.date)));

  const series = students.value.map(student => {
    const studentAttendance = attendanceData.filter(item => item.studentName === student.label);

    const attendancePercentages = dates.map((date, index) => {
      const dateAttendance = studentAttendance.filter(item => item.date === date);
      const presentCount = dateAttendance.filter(item => item.status === 'Present').length;
      const totalDays = dateAttendance.length;
      const percentage = (totalDays === 0) ? 0 : (presentCount / totalDays) * 100;

      return percentage;
    });

    return {
      name: student.label,
      data: attendancePercentages,
    };
  });

  return series;
}

const chartOptions = ref({
  chart: {
    type: 'line',
    height: 350,
  },
  xaxis: {
    categories: dates,
  },
  yaxis: {
    title: {
      text: 'Attendance Percentage',
    },
  },
});

// Computed property to filter attendance and chart data based on the selected section
const filteredAttendance = computed(() => {
  if (!selectedSection.value) {
    // If no section is selected, return the full attendance data
    return attendance.value;
  }

  return attendance.value.filter(item => item.section === selectedSection.value);
});

const filteredChartData = computed(() => {
  return generateChartData(filteredAttendance.value);
});

// Computed property to group attendance data by section
const groupedAttendance = computed(() => {
  const groupedData = [];
  sections.value.forEach(section => {
    const sectionAttendance = attendance.value.filter(item => item.section === section);
    const sectionChartData = generateChartData(sectionAttendance);
    groupedData.push({ section, attendance: sectionAttendance, chartData: sectionChartData });
  });
  return groupedData;
});

const submitFilter = () => {
  // Update the rows with the filtered data
  rows.value = filteredAttendance.value;
};

</script>