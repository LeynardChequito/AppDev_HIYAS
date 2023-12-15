<template>
    <q-drawer side="right" v-model="drawerOpen" show-if-above :width="250" class="bg-yellow-3">
        <q-scroll-area style="height: calc(100% - 50px); margin-top: 50px; border-right: 1px solid #ddd;">
            <q-list padding class="text-grey-9">
                <router-link to="/parent/home" class="text-grey-9" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('home')" @click="setActiveLink('home')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="home" />
                        </q-item-section>
                        <q-item-section>Home</q-item-section>
                    </q-item>
                </router-link>


                <router-link to="/parent/attendance" class="text-grey-9" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('attendance')" @click="setActiveLink('attendance')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="receipt_long" />
                        </q-item-section>
                        <q-item-section>My Attendance</q-item-section>
                    </q-item>
                </router-link>

                <router-link to="/parent/reports" class="text-grey-9" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('reports')" @click="setActiveLink('reports')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="edit_note" />
                        </q-item-section>
                        <q-item-section>Report and Submit</q-item-section>
                    </q-item>
                </router-link>

                <router-link to="/parent/announcements" class="text-grey-9" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('announcements')" @click="setActiveLink('announcements')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="campaign" />
                        </q-item-section>
                        <q-item-section>Announcements</q-item-section>
                    </q-item>
                </router-link>


                <router-link to="/parent/schedule" class="text-grey-9" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('schedule')" @click="setActiveLink('schedule')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="calendar_month" />
                        </q-item-section>
                        <q-item-section>My Schedule</q-item-section>
                    </q-item>
                </router-link>
                <router-link to="/parent/child-schedule" class="text-grey-9" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('child_schedule')" @click="setActiveLink('child_schedule')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="calendar_month" />
                        </q-item-section>
                        <q-item-section>My Child's Schedule</q-item-section>
                    </q-item>
                </router-link>



            </q-list>
        </q-scroll-area>

        <div class="absolute-top bg-amber self-center justify-center row q-mb-sm" style="height: 50px;">
            <q-avatar size="40px">
                <img src="@/assets/images/hiyas-logo-wt-bg.jpg" alt="Logo" />
            </q-avatar>
        </div>
        <q-separator />
    </q-drawer>
</template>
  
<script setup>
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const drawerOpen = computed(() => store.state.drawerOpen);

// Initialize the active link on component mount
onMounted(() => {
    const storedLink = localStorage.getItem('activeLink');
    const defaultLink = storedLink || 'home';
    store.commit('setLink', defaultLink);
});

const isActive = (route) => route === store.state.link;

const setActiveLink = (newLink) => {
    store.commit('setLink', newLink);
};
</script>
  
<style scoped>
.my-menu-link {
    color: white;
    background: #4E342E;
    font-weight: bold;
}
</style>
  