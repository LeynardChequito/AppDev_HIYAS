<template>
    <div class="bg-grey-10">

        <q-tabs v-model="tab" dense class="bg-grey-10 text-grey" active-color="yellow" indicator-color="yellow"
            align="justify">
            <q-tab name="parents" label="Coaches" />
            <q-tab name="attendance" label="Attendance" />
        </q-tabs>


        <q-tab-panels v-model="tab" animated class="bg-grey-10 text-grey">

            <q-tab-panel name="parents" class="q-pa-md">
                <TableList />
            </q-tab-panel>

        </q-tab-panels>
    </div>
</template>
  
<script setup>
import { ref } from 'vue';
import TableList from '@/components/Admin/Parents/Parents/TableList.vue';

const tab = ref('parents');
const innerTab = ref('AttendanceWLA');
const splitterModel = ref(10);
</script>
  