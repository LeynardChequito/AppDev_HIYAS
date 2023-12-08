<template>
    <q-header bordered class="text-white bg-blue-grey-10">
        <q-toolbar>
            <q-toolbar-title>
                <div class="self-center q-gutter-lg">
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
    </q-header>
</template>
  
<script setup>
import { useStore } from 'vuex';
import { computed } from 'vue';

const store = useStore();

const toggleDrawer = () => {
    store.commit('toggleDrawer');
};

const dynamicName = computed(() => {
    const activeLink = store.state.link;
    const sidebarItems = [
        { name: 'dashboard', label: 'Dashboard' },
        { name: 'students', label: 'Students' },
        { name: 'help', label: 'Help' },
        { name: 'coaches', label: 'Coaches' },
        { name: 'parents', label: 'Parents' },
        { name: 'sections', label: 'Sections' },
        // Add more items as needed
    ];

    const selectedItem = sidebarItems.find(item => item.name === activeLink);
    return selectedItem ? selectedItem.label : 'Default Name'; // Replace 'Default Name' with your desired default name
});
</script>
  