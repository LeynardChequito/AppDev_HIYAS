<template>
    <div class="bg-grey-10">

        <q-tabs v-model="tab" dense class="bg-grey-10 text-grey" active-color="yellow" indicator-color="yellow"
            align="justify">
            <q-tab name="accounts" label="Accounts" />
        </q-tabs>


        <q-tab-panels v-model="tab" animated class="bg-grey-10 text-grey">

            <q-tab-panel name="accounts" class="q-pa-md">
                <TableList />
            </q-tab-panel>

        </q-tab-panels>
    </div>
</template>
  
<script setup>
import { ref } from 'vue';
import TableList from '@/components/Admin/Accounts/Accounts/TableList.vue';

const tab = ref('accounts');
const innerTab = ref('AttendanceWLA');
const splitterModel = ref(10);
</script>
  