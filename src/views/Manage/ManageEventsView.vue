<template>
    <div class="col-md-12 col-xs-12">
        <q-card>
            <MEvents />
        </q-card>
    </div>
</template>
<script>
import MEvents from '@/components/MEvents.vue'

export default ({
    name: 'LineCharts',
    components: {
        MEvents
    }
})
</script>