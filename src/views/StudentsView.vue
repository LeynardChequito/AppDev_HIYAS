<template>
    <q-page padding>
      <div class="row q-col-gutter-sm">
        <div class="col-md-6 col-xs-12">
          <q-card>
            <GdpChinaUsa />
          </q-card>
        </div>

        <div class="col-md-6 col-xs-12">
          <q-card>
            <PopulationByContinent/>
          </q-card>
        </div>


        <div class="col-md-12 col-xs-12">
          <q-card>
            <Table/>
          </q-card>
        </div>
      </div>
    </q-page>
  </template>

<script>
import { defineComponent, defineAsyncComponent } from 'vue'

import GdpChinaUsa from '@/components/charts/GdpChinaUsa.vue'
import PopulationByContinent from '@/components/charts/PopulationByContinent.vue'
import Table from '@/components/Student/Table.vue'


export default defineComponent({
  name: 'LineCharts',
  components: {
    GdpChinaUsa,
    PopulationByContinent,
    Table
  }
})
</script>


<style></style>