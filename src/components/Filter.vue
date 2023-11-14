<template>
    <div class="q-gutter-md row items-start justify-end q-pa-sm">
        <q-select filled v-model="single" :options="optionsq" label="Filter" style="width: 250px">
            <template v-slot:append>
                <q-icon v-if="model !== null" class="cursor-pointer" name="clear" @click.stop.prevent="single = null" />
            </template>
        </q-select>
    </div>
</template>

<script>
import { ref } from 'vue'

export default ({
    setup() {
        return {
            single: ref(null),
            optionsq: [
                'Google', 'Facebook', 'Twitter', 'Apple', 'Oracle'
            ],
        }
    }
})
</script>