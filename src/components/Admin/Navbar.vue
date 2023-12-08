<template>
    <q-header bordered class="text-white bg-blue-grey-10">
        <q-toolbar>
            <q-toolbar-title>
                <div class="self-center q-gutter-lg">
                    <q-btn flat dense rounded :ripple="false" no-capture>
                        <q-avatar class="q-mx-lg">
                            <img src="@/assets/images/coach1.png" alt="Profile Image">
                        </q-avatar>
                    </q-btn>
                    <q-btn flat dense round icon="message" class="text-white" no-capture>
                        <q-menu class="bg-blue-grey-8">
                            <div class="row q-pa-md">
                                <div class="col-12">
                                    <div class="text-h6 q-mb-md text-white">Messages</div>
                                </div>
                                <div class="col-12">
                                    <ChatList class="col-12" />
                                </div>
                                <q-separator />
                                <div>
                                </div>
                            </div>
                        </q-menu>
                    </q-btn>
                    <q-btn flat dense round icon="notifications" class="text-white">
                        <q-menu :offset="[58, 0]">
                            <div class="row no-wrap q-pa-md">
                                <div class="column">
                                    <div class="text-h6 q-mb-md">Notifications</div>
                                    <q-toggle v-model="mobileData" label="Use Mobile Data" />
                                    <q-toggle v-model="bluetooth" label="Bluetooth" />
                                </div>

                                <q-separator vertical inset class="q-mx-lg" />

                                <div class="column items-center">
                                    <q-avatar size="72px">
                                        <img src="https://cdn.quasar.dev/img/avatar4.jpg">
                                    </q-avatar>

                                    <div class="text-subtitle1 q-mt-md q-mb-xs">John Doe</div>

                                    <q-btn color="primary" label="Logout" push size="sm" v-close-popup />
                                </div>
                            </div>
                        </q-menu>
                    </q-btn>
                    <q-btn flat dense round icon="widgets" class="text-white">
                        <q-menu :offset="[116, 0]">
                            <div class="row no-wrap q-pa-md">
                                <div class="column">
                                    <div class="text-h6 q-mb-md">Settings</div>
                                    <q-toggle v-model="mobileData" label="Use Mobile Data" />
                                    <q-toggle v-model="bluetooth" label="Bluetooth" />
                                </div>

                                <q-separator vertical inset class="q-mx-lg" />

                                <div class="column items-center">
                                    <q-avatar size="72px">
                                        <img src="https://cdn.quasar.dev/img/avatar4.jpg">
                                    </q-avatar>

                                    <div class="text-subtitle1 q-mt-md q-mb-xs">John Doe</div>

                                    <q-btn color="primary" label="Logout" push size="sm" v-close-popup />
                                </div>
                            </div>
                        </q-menu>
                    </q-btn>
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
import { computed, ref } from 'vue';
import ChatList from '@/components/ChatList.vue'

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
  