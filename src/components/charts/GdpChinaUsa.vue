<template>
  <Filter />

  <apexchart height="300" type="line" :options="options" :series="series"></apexchart>
</template>

<script>
import { defineComponent } from 'vue'
import Filter from '@/components/Filter.vue'


export default defineComponent({
  name: 'gdp',
  components: {
    Filter
  },
  data() {
    return {
      options: {
        title: {
          text: '4 Aspects',
          align: 'left'
        },
        chart: {
          id: 'gdp-china-usa'
        },
        colors: ['#AA381E', '#1e90aa', '#aa7e1e', '#1eaa7e'],
        dataLabels: {
          enabled: true
        },
        xaxis: {
          categories: [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
          ]
        },
        toolbar: {
          show: false
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          }
        },
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          floating: true,
          offsetY: -25,
          offsetX: -5
        }
      },
      series: [
        /**
         * Data source:
         * https://databank.worldbank.org/
         */
        {
          name: 'Spiritual',
          data: [
            0,
            0,
            7.86,
            7.76,
            7.42,
            7.04,
            6.84,
            6.94,
            6.74,
            5.95,
            2.23,
            8.10
          ]
        },
        {
          name: 'Physical',
          data: [ 
            5.67,
            2.24
          ]
        },
        {
          name: 'Socio-emotional',
          data: [
            0,
            0,
            1.84,
            2.28,
            2.28,
            2.25,
            2.70,
            -3.4,
            5.67,
            2.28,
            2.91,
            1.66,
          ]
        },
        {
          name: 'Cognitive',
          data: [
            0,
            0,
            -3.4,
            2.28,
            2.28,
            2.25,
            1.84,
            1.66,
            2.70,
            2.28,
            5.67,
            2.91,
          ]
        },

      ]
    }
  }
})
</script>
