<template>
    <div v-if="loading" class="loading-overlay">
        <img src="@/assets/images/loading.gif" alt="Loading..." style="width: 200px; height: 200px" />
    </div>

    <q-header bordered class="text-black bg-amber">
        <q-toolbar>
            <q-toolbar-title>
                <div class="self-center q-gutter-lg row justify-center">
                    <q-btn flat dense round :icon="accIcon" @click="accClicked" no-capture>

                        <q-menu class="bg-yellow-4" :offset="[25, 0]" style="width: 350px">
                            <div class="row no-wrap q-pa-md">
                                <div class="col-6">
                                    <div class="text-h6 q-mb-md">My Account</div>
                                    <div class="text-subtitle1 q-mt-md text-bold">Jan Dyze Malaluan</div>
                                    <div class="text-subtitle2 text-italic q-mb-xs">Role </div>
                                </div>
                                <div class="col-1 justify-end text-black"
                                    style="top: 5px; right: 5px; position: absolute;">
                                    <q-btn flat dense round icon="fullscreen" @click="goToChatsFullScreen" />
                                </div>
                                <q-separator vertical inset class="" />
                                <div class="col-6 items-center">
                                    <div class="flex justify-center items-center"> <!-- Centering container -->
                                        <q-avatar size="72px">
                                            <img src="https://cdn.quasar.dev/img/avatar4.jpg" />
                                        </q-avatar>
                                    </div>
                                    <div class="flex justify-center items-center q-pt-sm"> <!-- Centering container -->
                                        <q-btn color="negative" dense @click="logout">Logout</q-btn>
                                    </div>
                                </div>
                            </div>
                        </q-menu>




                    </q-btn>
                    <q-btn flat dense round :icon="msgIcon" @click="msgClicked">
                        <q-menu class="bg-yellow-4" :offset="[103, 0]" style="width: 350px">
                            <div class="row q-pa-md">
                                <div class="row justify-end">
                                    <div class="text-h6 q-mb-md text-black col-11">Messages</div>
                                    <div class="col-1 justify-end text-black"
                                        style="top: 5px; right: 5px; position: absolute;">
                                        <q-btn flat dense round icon="fullscreen" @click="goToChatsFullScreen" />
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
                    <q-btn flat dense round :icon="homeIcon" @click="goHome" no-capture>

                    </q-btn>
                    <q-btn flat dense round :icon="notifIcon" @click="notifClicked">
                        <q-menu class="bg-yellow-4" :offset="[140, 0]" style="width: 350px">
                            <div class="row q-pa-md">
                                <div class="row justify-between">
                                    <div class="text-h6 q-mb-md text-black col-12">Notifications</div>
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
                    <q-btn flat dense round :icon="appIcon" @click="appClicked">
                        <q-menu class="bg-yellow-4" :offset="[198, 0]" style="width: 350px">
                            <div class="row q-pa-md">
                                <div class="row justify-between">
                                    <div class="text-h6 q-mb-md text-black col-12">Quick Tools</div>
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

        <!-- <q-toolbar-title class="text-center bg-yellow-4 text-black">
            {{ dynamicName }}
        </q-toolbar-title> -->
    </q-header>
</template>
  
<script setup>
import { useStore } from 'vuex';
import { computed, ref } from 'vue';
import ChatList from '@/components/ChatList.vue'
import { useRouter } from 'vue-router';
import axios from 'axios';


const router = useRouter();

const loading = ref(false);

const store = useStore();
const menuIcon = ref('menu_open');
const notifIcon = ref('notifications');
const msgIcon = ref('messages');
const accIcon = ref('account_circle');
const appIcon = ref('grid_view');
const homeIcon = ref('home');


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

const goHome = () => {
    homeIcon.value = homeIcon.value === 'home' ? 'cottage' : 'home';
    router.push({ name: 'home' });

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
        loading.value = true;
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

        // Reload the page after successful logout
        window.location.reload();

        // Emit a global event to notify other components about the logout
        window.dispatchEvent(new Event('logout'));

        // Redirect to login if needed
        router.push('/login');
    } catch (error) {
        console.error('Error during logout:', error);
        // Handle the error as needed
    } finally {
        // Set loading back to false after the process completes
        loading.value = false;
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

.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(142, 142, 141, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.loading-overlay img {
    width: 50px;
    /* Adjust the width and height based on your loading GIF dimensions */
    height: 50px;
}
</style>