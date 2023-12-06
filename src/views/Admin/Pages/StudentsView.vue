<template>

    <q-tab-panels v-model="tab" animated class="bg-grey-10 text-white">
        <q-tab-panel name="default">
            <Attendance />
        </q-tab-panel>
    </q-tab-panels>

    <q-tab-panels v-model="tab" animated class="bg-grey-10 text-white">
        <q-tab-panel name="profile">
            some things hahaha
        </q-tab-panel>
    </q-tab-panels>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { tab, tabs } from '@/assets/store';
import Attendance from '@/components/Admin/Students/Attendance';


onMounted(() => {
    // Add the dynamic tabs to the store
    tabs.value = [
        { name: 'default', label: 'Attendance' },
        { name: 'profile', label: 'Profile' },
        { name: 'development', label: 'Development' },
    ];
});
</script>
