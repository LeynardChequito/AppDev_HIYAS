<template>
    <q-splitter v-model="splitterModel"  style="margin-top: -20px; margin-left: -10px;">

        <template v-slot:before>
            <q-tabs v-model="vTab" vertical class="text-grey-5 q-mb-lg" active-color="yellow" indicator-color="yellow">
                <q-tab name="WLA" label="WLA" />
                <q-tab name="events" label="Events" />
                <q-tab name="church" label="Church" />
            </q-tabs>
        </template>

        <template v-slot:after>
            <q-tab-panels v-model="vTab" vertical class="bg-grey-10 text-white">
                <q-tab-panel name="WLA">
                    <WLA />
                </q-tab-panel>

                <q-tab-panel name="events">
                    <div class="text-h4 q-mb-md">Alarms</div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis praesentium cumque magnam odio iure
                        quidem, quod illum numquam possimus obcaecati commodi minima assumenda consectetur culpa fuga nulla
                        ullam. In, libero.</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis praesentium cumque magnam odio iure
                        quidem, quod illum numquam possimus obcaecati commodi minima assumenda consectetur culpa fuga nulla
                        ullam. In, libero.</p>
                </q-tab-panel>

                <q-tab-panel name="church">
                    <div class="text-h4 q-mb-lg">Movies</div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis praesentium cumque magnam odio iure
                        quidem, quod illum numquam possimus obcaecati commodi minima assumenda consectetur culpa fuga nulla
                        ullam. In, libero.</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis praesentium cumque magnam odio iure
                        quidem, quod illum numquam possimus obcaecati commodi minima assumenda consectetur culpa fuga nulla
                        ullam. In, libero.</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis praesentium cumque magnam odio iure
                        quidem, quod illum numquam possimus obcaecati commodi minima assumenda consectetur culpa fuga nulla
                        ullam. In, libero.</p>
                </q-tab-panel>
            </q-tab-panels>
        </template>

    </q-splitter>
</template>

<script setup>
import { ref } from 'vue';
import WLA from '@/components/Admin/Students/Attendance/WLA.vue';

const vTab = ref('WLA');
const splitterModel = ref(10);
</script>