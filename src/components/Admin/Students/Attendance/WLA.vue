<template>
  <div>
    <q-table title="WLA Student Attendance" :rows="tableData" :columns="columns" row-key="name" />
    <q-card style="max-width: 500px">
      <apexchart type="pie" :options="pieChartOptions" :series="pieChartSeries" />
    </q-card>
    <q-card style="max-width: 500px">
      <apexchart type="bar" :options="barChartOptions" :series="barChartSeries" />
    </q-card>
  </div>
</template>

<script setup>
import VueApexCharts from 'vue3-apexcharts';
import axios from 'axios';
import { ref, onMounted, computed } from 'vue';

const columns = [
  { name: 'student', label: 'Student', field: 'student', align: 'left', sortable: true },
  { name: 'section', label: 'Section', field: 'section', sortable: true },
  { name: 'status', label: 'Status', field: 'status', sortable: true },
  { name: 'date', label: 'Date', field: 'date', sortable: true },
];

const tableData = ref([]);

const attendanceStatuses = computed(() => Array.from(new Set(tableData.value.map(student => student.status))));
const dates = computed(() => Array.from(new Set(tableData.value.map(student => student.date))));

const pieChartOptions = {
  chart: {
    type: 'pie'
  },
  labels: attendanceStatuses.value,
};

const pieChartSeries = computed(() => attendanceStatuses.value.map(status => {
  const attendanceCount = tableData.value.filter(student => student.status === status).length;
  return attendanceCount;
}));

const barChartOptions = {
  chart: {
    type: 'bar'
  },
  xaxis: {
    categories: dates.value,
  }
};

const barChartSeries = computed(() => attendanceStatuses.value.map(status => {
  return {
    name: status,
    data: dates.value.map(date => {
      const presentCount = tableData.value.filter(student => student.status === status && student.date === date).length;
      return presentCount;
    })
  };
}));

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

</script>

<script>
export default {
  components: {
    apexchart: VueApexCharts
  }
};
</script>
