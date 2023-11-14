<template>
    <div>
      <FinanceF v-model="selectedTimeframe" />
      <!-- ApexCharts -->
      <apexchart height="400" width="600" type="line" :options="options" :series="series"></apexchart>
    </div>
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  import FinanceF from '@/components/FinanceF.vue';
  
  export default defineComponent({
    components: {
      FinanceF,
    },
    data() {
      return {
        selectedTimeframe: 'weekly',
        series: [],
        options: {
          title: {
            text: 'Expense Trends',
            fontSize: '40px',
            align: 'left',
          },
          chart: {
            id: 'apex-line-chart',
          },
          colors: ['#2E7D32', '#4CAF50', '#8BC34A', '#CDDC39', '#FFEB3B', '#FFC107'],
          markers: {
            size: 4,
            hover: {
              sizeOffset: 6,
            },
          },
          xaxis: {
            categories: [
              'Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5',
              'Week 6', 'Week 7', 'Week 8', 'Week 9', 'Week 10',
            ], // Adjust based on your time periods
          },
          yaxis: {
            title: {
              text: 'Expense Amount',
            },
          },
          legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
            markers: {
              fillColors: ['#2E7D32', '#4CAF50', '#8BC34A', '#CDDC39', '#FFEB3B', '#FFC107'],
            },
          },
          plotOptions: {
            line: {
              dataLabels: {
                position: 'top',
              },
            },
          },
        },
      };
    },
    created() {
      this.updateSeriesData('weekly');
    },
    watch: {
      selectedTimeframe(newTimeframe) {
        this.updateSeriesData(newTimeframe);
      },
    },
    methods: {
      async updateSeriesData(timeframe) {
        if (timeframe === 'weekly') {
          this.series = [
            { name: 'Education', data: [200, 150, 100, 50, 20, 30, 40, 50, 60, 70] },
            { name: 'Health', data: [100, 120, 80, 40, 60, 30, 40, 50, 60, 70] },
            { name: 'Recreation', data: [50, 60, 40, 20, 30, 10, 20, 30, 40, 50] },
            { name: 'Food', data: [80, 100, 60, 30, 40, 20, 30, 40, 50, 60] },
            { name: 'Miscellaneous', data: [30, 40, 20, 10, 15, 5, 10, 15, 20, 25] },
          ];
        } else if (timeframe === 'monthly') {
          this.series = [
            { name: 'Education', data: [800, 600, 400, 200, 80, 120, 180, 240, 300, 360] },
            { name: 'Health', data: [400, 480, 320, 160, 240, 120, 180, 240, 300, 360] },
            { name: 'Recreation', data: [200, 240, 160, 80, 120, 60, 90, 120, 150, 180] },
            { name: 'Food', data: [320, 400, 240, 120, 160, 80, 120, 160, 200, 240] },
            { name: 'Miscellaneous', data: [120, 160, 80, 40, 60, 30, 40, 50, 60, 70] },
          ];
        } else if (timeframe === 'quarterly') {
          this.series = [
            { name: 'Education', data: [1600, 1200, 800, 400, 160, 240, 360, 480, 600, 720] },
            { name: 'Health', data: [800, 960, 640, 320, 480, 240, 360, 480, 600, 720] },
            { name: 'Recreation', data: [400, 480, 320, 160, 240, 120, 180, 240, 300, 360] },
            { name: 'Food', data: [640, 800, 480, 240, 320, 160, 240, 320, 400, 480] },
            { name: 'Miscellaneous', data: [240, 320, 160, 80, 120, 60, 90, 120, 150, 180] },
          ];
        } else if (timeframe === 'yearly') {
          this.series = [
            { name: 'Education', data: [6400, 4800, 3200, 1600, 640, 960, 1440, 1920, 2400, 2880] },
            { name: 'Health', data: [3200, 3840, 2560, 1280, 1920, 960, 1440, 1920, 2400, 2880] },
            { name: 'Recreation', data: [1600, 1920, 1280, 640, 960, 480, 720, 960, 1200, 1440] },
            { name: 'Food', data: [2560, 3200, 1920, 960, 1280, 640, 960, 1280, 1600, 1920] },
            { name: 'Miscellaneous', data: [960, 1280, 640, 320, 480, 240, 360, 480, 600, 720] },
          ];
        }
      },
    },
  });
  </script>
  