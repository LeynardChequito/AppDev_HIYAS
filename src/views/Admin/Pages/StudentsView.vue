<template>
    <div class="bg-grey-10">

        <q-tabs v-model="tab" dense class="bg-grey-10 text-grey" active-color="yellow" indicator-color="yellow"
            align="justify">
            <q-tab name="students" label="Students" />
            <q-tab name="attendance" label="Attendance" />
            <q-tab name="development" label="Development" />
        </q-tabs>


        <q-tab-panels v-model="tab" animated>
            <q-tab-panel name="attendance" class="q-pa-none">

                <q-splitter v-model="splitterModel" class="bg-grey-10 text-grey">

                    <template v-slot:before>
                        <q-tabs v-model="innerTab" vertical active-color="yellow" indicator-color="yellow">
                            <q-tab name="AttendanceWLA" icon="mail" label="WLA" />
                            <q-tab name="AttendanceEvents" icon="alarm" label="Events" />
                            <q-tab name="AttendanceChurch" icon="movie" label="Church" />
                        </q-tabs>
                    </template>

                    <template v-slot:after>
                        <q-tab-panels v-model="innerTab" animated transition-prev="slide-down" transition-next="slide-up"
                            class="bg-grey-10 text-white">
                            <q-tab-panel name="AttendanceWLA">
                                <AttendanceWLA />
                            </q-tab-panel>
                            <q-tab-panel name="AttendanceEvents">
                                <AttendanceEvents />
                            </q-tab-panel>

                        </q-tab-panels>
                    </template>

                </q-splitter>
            </q-tab-panel>

            <q-tab-panel name="students" class="q-pa-none">
                <TableList />
            </q-tab-panel>

        </q-tab-panels>
    </div>
</template>
  
<script setup>
import { ref } from 'vue';
import AttendanceWLA from '@/components/Admin/Students/Attendance/WLA.vue';
import AttendanceEvents from '@/components/Admin/Students/Attendance/Events.vue';
import TableList from '@/components/Admin/Students/Students/TableList.vue';

const tab = ref('students');
const innerTab = ref('AttendanceWLA');
const splitterModel = ref(10);
</script>
  