<template>
    <q-header bordered class="text-white bg-blue-grey-10">
        <q-toolbar>
            <q-toolbar-title>
                <div class="self-center q-gutter-lg row justify-center">
                    <q-btn flat dense round :icon="accIcon" class="text-white" @click="accClicked" no-capture>

                        <q-menu class="bg-blue-grey-5" :offset="[25, 0]" style="width: 350px">
                            <div class="row q-pa-md">
                                <div class="row justify-between">
                                    <div class="text-h6 q-mb-md text-white col-12">My Account</div>
                                    <div class="col-12">
                                    </div>
                                    <q-separator />
                                    <div class="col-12">
                                        <q-btn flat dense icon="logout" class="text-white" @click="logout">Logout</q-btn>
                                    </div>
                                </div>
                            </div>
                        </q-menu>
                    </q-btn>
                    <q-btn flat dense round :icon="msgIcon" class="text-white" @click="msgClicked" no-capture>
                        <q-menu class="bg-blue-grey-5" :offset="[103, 0]" style="width: 350px">
                            <div class="row q-pa-md">
                                <div class="row justify-end">
                                    <div class="text-h6 q-mb-md text-white col-11">Messages</div>
                                    <div class="col-1 justify-end">
                                        <q-btn flat dense round icon="fullscreen" class="text-white"
                                            @click="goToChatsFullScreen" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ChatList class="col-12" />
                                </div>
                                <q-separator />
                                <div class="col-12">
                                    <!-- Full-screen button -->

                                </div>
                            </div>
                        </q-menu>
                    </q-btn>
                    <q-btn flat dense round :icon="notifIcon" @click="notifClicked" class="text-white">
                        <q-menu class="bg-blue-grey-5" :offset="[140, 0]" style="width: 350px">
                            <div class="row q-pa-md">
                                <div class="row justify-between">
                                    <div class="text-h6 q-mb-md text-white col-12">Notifications</div>
                                    <div class="col-12">
                                    </div>
                                    <q-separator />
                                    <div class="col-12">
                                        <!-- Full-screen button -->

                                    </div>
                                </div>
                            </div>
                        </q-menu>
                    </q-btn>
                    <q-btn flat dense round :icon="appIcon" @click="appClicked" class="text-white">
                        <q-menu class="bg-blue-grey-5" :offset="[198, 0]" style="width: 350px">
                            <div class="row q-pa-md">
                                <div class="row justify-between">
                                    <div class="text-h6 q-mb-md text-white col-12">Quick Tools</div>
                                    <div class="col-12">
                                    </div>
                                    <q-separator />
                                    <div class="col-12">
                                        <!-- Full-screen button -->

                                    </div>
                                </div>
                            </div>
                        </q-menu>
                    </q-btn>
                    <q-btn dense flat round :icon="menuIcon" class="text-end" @click="toggleDrawer" />
                </div>
            </q-toolbar-title>
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
import { useRouter } from 'vue-router';
const router = useRouter();
import axios from 'axios';

const store = useStore();
const menuIcon = ref('menu_open');
const notifIcon = ref('notifications');
const msgIcon = ref('messages');
const accIcon = ref('account_circle');
const appIcon = ref('grid_view');


const goToChatsFullScreen = () => {
    router.push({ name: 'chats', params: { id: 'all' } });
};

const toggleDrawer = () => {
    store.commit('toggleDrawer');
    menuIcon.value = menuIcon.value === 'menu_open' ? 'menu' : 'menu_open';
};

const notifClicked = () => {
    notifIcon.value = notifIcon.value === 'notifications' ? 'notifications_active' : 'notifications';
};

const msgClicked = () => {
    msgIcon.value = msgIcon.value === 'messages' ? 'sms' : 'messages';
};

const accClicked = () => {
    accIcon.value = accIcon.value === 'account_circle' ? 'person_pin' : 'account_circle';
};

const appClicked = () => {
    appIcon.value = appIcon.value === 'grid_view' ? 'widgets' : 'grid_view';
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
        { name: 'events', label: 'Events' },
        // Add more items as needed
    ];

    const selectedItem = sidebarItems.find(item => item.name === activeLink);
    return selectedItem ? selectedItem.label : 'Default Name'; // Replace 'Default Name' with your desired default name
});

const logout = async () => {
    try {
        // Retrieve the token from localStorage
        const token = localStorage.getItem('token');

        if (!token) {
            console.error('Token not found in localStorage');
            return;
        }

        // Make an API call to your backend's logout endpoint with the token in the headers
        await axios.post('/logout', {}, {
            headers: {
                Authorization: `${token}`,
            },
        });

        // Clear the authentication token from localStorage
        localStorage.removeItem('token');

        // Emit a global event to notify other components about the logout
        window.dispatchEvent(new Event('logout'));
        router.push('/login');

        // Close the notification card
    } catch (error) {
        console.error('Error during logout:', error);
        // Handle the error as needed
    }
};
</script>
  
<style scoped>
.q-btn:hover {
    background: none;
    box-shadow: none;
}

.q-btn:hover .q-avatar {
    filter: none;
}

.q-btn .q-avatar {
    filter: none;
}

.q-btn:hover .q-avatar {
    filter: none;
}
</style>