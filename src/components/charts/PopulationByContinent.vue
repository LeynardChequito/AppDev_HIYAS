<template>
  <div>

<Filter/>
    <!-- ApexCharts -->
    <apexchart height="300" type="pie" :options="options" :series="series"></apexchart>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import { getCssVar } from 'quasar'
import Filter from '@/components/Filter.vue'

export default defineComponent({
  name: 'PopulationByContinent',
  components: {
    Filter
  },
  data() {
    return {

      options: {
        title: {
          text: 'Total Number of Students',
          align: 'left'
        },
        chart: {
          id: 'apex-donut'
        },
        colors: [
          getCssVar('secondary'),
          getCssVar('accent'),
          getCssVar('positive'),
          getCssVar('primary'),
          getCssVar('negative'),
          getCssVar('info')
        ],
        markers: {
          size: 4,
          hover: {
            sizeOffset: 6
          }
        },
        labels: [
          'Asia',
          'Africa',
          'Europe',
          'North America',
          'South America',
          'Oceania'
        ]
      },
      series: [
        /**
         * Data source:
         * https://en.wikipedia.org/wiki/List_of_continents_and_continental_subregions_by_population
         */
        4694576167,
        1393676444,
        745173774,
        595783465,
        434254119,
        44491724
      ]
    }
  }
})
</script>
