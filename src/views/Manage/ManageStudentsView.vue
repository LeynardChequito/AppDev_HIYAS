<template>
    <div class="col-md-12 col-xs-12">
        <q-card>
            <Table />
        </q-card>
    </div>
</template>
<script>
import Table from '@/components/Student/Table.vue'


export default ({
    name: 'LineCharts',
    components: {
        Table
    }
})
</script>