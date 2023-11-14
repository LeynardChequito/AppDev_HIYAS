<template>
    <q-page padding>
      <div class="row q-col-gutter-sm q-pt-md">
        <!-- <div class="col-md-8 col-xs-12">
          <q-card>
            <GdpChinaUsa />
          </q-card>
        </div> -->

        <div class="col-md-4 col-xs-12">
          <q-card>
            <SavingsFin/>
          </q-card>
        </div>


        <div class="col-md-5 col-xs-12">
          <q-card>
            <DonationsFin />
          </q-card>
        </div>
      </div>
    </q-page>
  </template>

<script>
import { defineComponent, defineAsyncComponent } from 'vue'

import SavingsFin from '@/components/charts/SavingsFin.vue'
import DonationsFin from '@/components/charts/DonationsFin.vue'


export default defineComponent({
  name: 'FinancialChart',
  components: {
    SavingsFin,
    DonationsFin
  }
})
</script>
<style>

</style>