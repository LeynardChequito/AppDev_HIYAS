<template>
    <div class="col-md-12 col-xs-12">
        <q-card>
            <MPGTable />
        </q-card>
    </div>
</template>
<script>
import MPGTable from '@/components/Student/MPGTable.vue'

export default ({
    name: 'LineCharts',
    components: {
        MPGTable
    }
})
</script>