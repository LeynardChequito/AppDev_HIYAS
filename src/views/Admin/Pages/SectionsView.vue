<template>
    <div class="bg-grey-10">

        <q-tabs v-model="tab" dense class="bg-grey-10 text-grey" active-color="yellow" indicator-color="yellow"
            align="justify">
            <q-tab name="sections" label="sections" />
            <q-tab name="attendance" label="attendance" />
        </q-tabs>


        <q-tab-panels v-model="tab" animated class="bg-grey-10 text-grey">

            <q-tab-panel name="sections" class="q-pa-md">
                <TableList />
            </q-tab-panel>

        </q-tab-panels>
    </div>
</template>
  
<script setup>
import { ref } from 'vue';
import TableList from '@/components/Admin/Sections/Sections/TableList.vue';

const tab = ref('sections');
const innerTab = ref('AttendanceWLA');
const splitterModel = ref(10);
</script>
  
