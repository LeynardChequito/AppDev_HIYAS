<template>
    <q-header bordered class="text-white bg-blue-grey-10">
        <q-toolbar>
            <q-toolbar-title>
                <div class="self-center q-gutter-lg ">
                    <q-avatar class="q-mx-lg">
                        <img src="@/assets/images/coach1.png" alt="Profile Image">
                    </q-avatar>
                    <q-icon name="message" class="text-white" />
                    <q-icon name="notifications" class="text-white" />
                    <q-icon name="widgets" class="text-white" />
                </div>
            </q-toolbar-title>
            <q-btn dense flat round icon="menu" @click="toggleDrawer" />
        </q-toolbar>
        <q-toolbar-title class="text-center bg-blue-grey-9">
            {{ dynamicName }}
        </q-toolbar-title>
        <q-tabs v-model="tab" dense class="bg-blue-grey-9 text-grey-5" bordered active-color="yellow"
            indicator-color="yellow" align="justify">
            <q-tab v-for="t in tabs" :key="t.name" :name="t.name" :label="t.label" />
        </q-tabs>
    </q-header>

    <q-tab-panels v-model="tab" animated class="bg-grey-10 text-white">
        <q-tab-panel name="attendance">
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
import { ref, watch } from 'vue';
import { drawer, activeLink, dynamicName, tabs } from '@/assets/store';

const tab = ref('');

const toggleDrawer = () => {
    drawer.value = !drawer.value;
};

watch(activeLink, (newLink) => {
    if (newLink === 'students') {
        tabs.value.forEach((t) => {
            // Add conditions to show/hide tabs based on the view
            t.visible = true; // Example: show all tabs for the Students view
        });
    } else {
        tabs.value.forEach((t) => {
            t.visible = false; // Hide tabs for other views
        });
    }
});
</script>