<template>
    <div>
      <FinanceF v-model="selectedTimeframe" />
      <!-- ApexCharts -->
      <apexchart height="475" type="radialBar" :options="options" :series="series" :total="totalSum"></apexchart>
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
        totalSum: 0,
        options: {
          title: {
            text: 'Savings Growth',
            fontSize: '40px',
            align: 'left',
          },
          chart: {
            id: 'apex-radial-bar',
          },
          colors: ['#2E7D32', '#4CAF50', '#8BC34A', '#CDDC39', '#FFEB3B', '#FFC107'],
          markers: {
            size: 4,
            hover: {
              sizeOffset: 6,
            },
          },
          labels: ['Education', 'Health', 'Recreation', 'Food', 'Miscellaneous'],
          legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
            markers: {
              fillColors: ['#2E7D32', '#4CAF50', '#8BC34A', '#CDDC39', '#FFEB3B', '#FFC107'],
            },
          },
          plotOptions: {
            radialBar: {
              hollow: {
                size: '50%',
              },
              dataLabels: {
                name: {
                  offsetY: -21,
                  show: true,
                  color: '#888',
                  fontSize: '30px',
                },
                value: {
                  offsetY: 0,
                  fontSize: '40px',
                  color: '#111',
                  formatter: function (val) {
                    return val;
                  },
                },
                total: {
                  show: true,
                  label: 'TOTAL',
                  color: '#888',
                  formatter: function (w) {
                    return `${w.globals.seriesTotals.reduce((a, b) => a + b, 0)}`;
                  },
                },
              },
            },
          },
          fill: {
            colors: ['#2E7D32', '#4CAF50', '#8BC34A', '#CDDC39', '#FFEB3B', '#FFC107'],
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
          this.series = [200, 150, 100, 50, 20];
        } else if (timeframe === 'monthly') {
          this.series = [800, 600, 400, 200, 80];
        } else if (timeframe === 'quarterly') {
          this.series = [1600, 1200, 800, 400, 160];
        } else if (timeframe === 'yearly') {
          this.series = [6400, 4800, 3200, 1600, 640];
        }
  
        this.totalSum = this.series.reduce((acc, val) => acc + val, 0);
      },
    },
  });
  </script>
  