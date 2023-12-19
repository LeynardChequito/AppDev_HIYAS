<template>
    <q-page class="q-pa-md">
        <div class="row">
            <q-col class="col-md-2 col-lg-2 col-xl-2 order-0 mb-4">
                <q-card>
                    <q-card-section class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h6 class="m-0 me-2">Total Students</h6>
                        </div>
                        <div class="d-flex flex-column align-items-center gap-1 justify-content-center text-center">
                            <h4 class="mb-2">{{ totalStudents }}</h4>
                        </div>
                    </q-card-section>
                </q-card>
            </q-col>

            <q-col class="col-md-2 col-lg-2 col-xl-2 order-0 mb-4 q-ml-sm">
                <q-card>
                    <q-card-section class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h6 class="m-0 me-2">Total Parents</h6>
                        </div>
                        <div class="d-flex flex-column align-items-center gap-1 justify-content-center text-center">
                            <h4 class="mb-2">{{ totalParents }}</h4>
                        </div>
                    </q-card-section>
                </q-card>
            </q-col>

            <q-col class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4 q-ml-sm">

                <q-card>
                    <q-card-section>
                        <div class="card-title mb-0">
                            <h6 class="m-0 me-2">Schedule</h6>
                        </div>
                        <ul>
                            <li v-for="eventType in uniqueEventTypes" :key="eventType">
                                {{ eventType }}
                            </li>
                        </ul>
                    </q-card-section>
                </q-card>
            </q-col>
        </div>

        <div class="row">
            <q-col class="col-md-2 col-lg-2 col-xl-2 order-0 mb-4 q-mt-sm">
                <q-card class="small-card-chart">
                    <q-card-section>
                        <div class="card-title mb-0">
                            <h6 class="m-0 me-2">Students' BMI</h6>
                        </div>
                        <!-- Use the apexchart component with your BMI chart data and options -->
                        <apexchart class="small-card-chart" :type="bmiChartOptions.chart.type" :options="bmiChartOptions"
                            :series="bmiChartData.series" />
                    </q-card-section>
                </q-card>
            </q-col>

            <q-col class="col-md-2 col-lg-2 col-xl-2 mb-4 q-mt-sm" style="margin-left: 240px;">
                <q-card class="small-card-chart">
                    <q-card-section>
                        <div class="card-title mb-0">
                            <h6 class="m-0 me-2">Attendance Line Chart</h6>
                        </div>
                        <!-- Attendance Line Chart -->
                        <apexchart class="small-card-chart" :type="attendanceLineChartOptions.chart.type"
                            :options="attendanceLineChartOptions" :series="attendanceLineChartData.series" />
                    </q-card-section>
                </q-card>
            </q-col>
        </div>
    </q-page>
</template>
  
<script>
import axios from 'axios';
import VueApexCharts from 'vue3-apexcharts';

export default {
    components: {
        apexchart: VueApexCharts,
    },
    data() {
        return {
            totalStudents: 0,
            totalParents: 0,
            students: [],
            studentsInModal: [],
            showModal: false,
            bmiChartData: {
                series: [],
            },
            bmiChartOptions: {
                chart: {
                    type: 'pie',
                },
                labels: ['Underweight', 'Normal Weight', 'Overweight', 'Obesity'],
                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: val => val + ' students',
                    },
                },
            },
            scheduleData: [],
            attendanceLineChartData: {
                series: [],
            },
            attendanceLineChartOptions: {
                chart: {
                    type: 'line',
                },
                xaxis: {
                    categories: [], // Dates will go here
                },
            },
        };
    },
    computed: {
        uniqueEventTypes() {
            // Extract unique event types from scheduleData
            const uniqueTypes = new Set(this.scheduleData.map((event) => event.type));
            return Array.from(uniqueTypes);
        },
    },
    mounted() {
        this.fetchTotalStudents();
        this.fetchTotalParents();
        this.fetchBMIChartData();
        this.fetchScheduleData();
        this.fetchAttendanceChartData();
    },
    methods: {
        async fetchTotalStudents() {
            try {
                const response = await axios.get('/gettotalstudents');
                this.totalStudents = response.data.totalStudents;
            } catch (error) {
                console.error('Error fetching total students:', error);
            }
        },
        async fetchTotalParents() {
            try {
                const response = await axios.get('/gettotalparents');
                this.totalParents = response.data.totalParents;
            } catch (error) {
                console.error('Error fetching total parents:', error);
            }
        },
        async fetchBMIChartData() {
            try {
                const response = await axios.get('/getstudentdata');
                this.students = response.data; // Assuming the response is an array of students

                // Process BMI data and categorize into classes
                const bmiClasses = [0, 0, 0, 0]; // [Underweight, Normal Weight, Overweight, Obesity]

                this.students.forEach(student => {
                    const bmi = this.calculateBMI(student.height, student.weight);
                    const bmiClass = this.categorizeBMI(bmi);
                    bmiClasses[bmiClass]++;
                });

                // Update chart series
                this.bmiChartData.series = bmiClasses;
            } catch (error) {
                console.error('Error fetching BMI data:', error);
            }
        },

        calculateBMI(height, weight) {
            // BMI formula: weight (kg) / (height (m) * height (m))
            const heightInMeters = height / 100; // Convert height from cm to meters
            return weight / (heightInMeters * heightInMeters);
        },
        categorizeBMI(bmi) {
            if (bmi < 18.5) {
                return 0; // Underweight
            } else if (bmi < 24.9) {
                return 1; // Normal Weight
            } else if (bmi < 29.9) {
                return 2; // Overweight
            } else {
                return 3; // Obesity
            }

        },
        async fetchScheduleData() {
            try {
                const response = await axios.get('/getstudentschedule');
                const rawScheduleData = response.data;

                // Group events based on type
                const groupedScheduleData = {};
                rawScheduleData.forEach(event => {
                    const eventType = event.type;

                    if (!groupedScheduleData[eventType]) {
                        groupedScheduleData[eventType] = [];
                    }

                    groupedScheduleData[eventType].push(event);
                });

                // Flatten the grouped data into a single array
                this.scheduleData = Object.values(groupedScheduleData).flatMap(events => events);
            } catch (error) {
                console.error('Error fetching schedule data:', error);
            }
        },
        async fetchAttendanceChartData() {
            try {
                const response = await axios.get('/studentAttendance');
                const attendanceData = response.data;
                console.log('Attendance Chart Data:', response.data);

                // Process attendance data
                const presentCounts = {};
                const dates = [];

                attendanceData.forEach(entry => {
                    const date = new Date(entry.date); // Convert date string to date object
                    const status = entry.status;

                    // Assuming status 'Present' represents 'Present'
                    if (status === 'Present') {
                        const dateString = this.formatDate(date); // Format date as 'YYYY-MM-DD'
                        if (!presentCounts[dateString]) {
                            presentCounts[dateString] = 1;
                        } else {
                            presentCounts[dateString]++;
                        }
                    }

                    // Add unique dates
                    if (!dates.find(d => d.getTime() === date.getTime())) {
                        dates.push(new Date(date)); // Ensure each date is a new instance
                    }
                });

                // Sort dates chronologically
                dates.sort((a, b) => a - b);

                // Prepare data for the line chart
                const seriesData = dates.map(date => presentCounts[this.formatDate(date)] || 0);

                // Convert dates to formatted strings for x-axis labels
                const formattedDates = dates.map(date => this.formatDate(date));

                console.log('Formatted Dates:', formattedDates);
                this.attendanceLineChartData.series = [{ name: 'Present Students', data: seriesData }];
                this.attendanceLineChartOptions.xaxis.categories = formattedDates;

                console.log('eme', this.attendanceLineChartOptions.xaxis.labels);
            } catch (error) {
                console.error('Error fetching attendance chart data:', error);
            }
        },


        formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },



    },
};
</script>
  


<style scoped>
.small-card-chart {
    width: 400px;
    height: 400px;
    /* Set the width as needed */
    /* Set the maximum width as needed */
    margin: 0 auto;
    /* Center the card and chart */
}

.small-card-chart .apexcharts {
    /* height: 5000; */
    /* Set the maximum height of the chart */
}
small-card-chart {
  width: 400px; /* Set the width as needed */
  height: 400px; /* Set the height as needed */
  margin: 0 auto; /* Center the card and chart */
}

.small-card-chart + .small-card-chart {
  margin-left: 20px; /* Add margin to the left of the second chart */
}

.small-card-chart .apexcharts {
  /* Adjust height or other styles if needed */
}
</style>