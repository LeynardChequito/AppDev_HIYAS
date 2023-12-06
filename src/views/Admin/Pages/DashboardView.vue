<template>
    <q-tabs v-model="tab" dense class="bg-blue-grey-9 text-grey-5" bordered active-color="yellow" indicator-color="yellow"
        align="justify">

    </q-tabs>

    <q-tab-panels v-model="tab" animated class="bg-grey-10 text-white">
        <q-tab-panel name="default">
            mema
        </q-tab-panel>
    </q-tab-panels>

    
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { tab, tabs } from '@/assets/store';


onMounted(() => {
    // Add the dynamic tabs to the store
    tabs.value = [
        { name: 'default', label: 'HEHE' },
        { name: 'try', label: 'Js' },
    ];
});
</script>
