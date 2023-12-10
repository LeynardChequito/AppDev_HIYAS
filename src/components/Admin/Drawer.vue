<template>
    <q-drawer side="right" v-model="drawerOpen" show-if-above :width="250" class="bg-blue-grey-9">
        <q-scroll-area style="height: calc(100% - 50px); margin-top: 50px; border-right: 1px solid #ddd;">
            <q-list padding class="text-grey-5">
                <router-link to="/admin/dashboard" class="text-grey-5" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('dashboard')" @click="setActiveLink('dashboard')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="fa fa-gauge-high" />
                        </q-item-section>
                        <q-item-section>Dashboard</q-item-section>
                    </q-item>
                </router-link>

                <router-link to="/admin/students" class="text-grey-5" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('students')" @click="setActiveLink('students')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="fa fa-child" />
                        </q-item-section>
                        <q-item-section>Students</q-item-section>
                    </q-item>
                </router-link>

                <router-link to="/admin/coaches" class="text-grey-5" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('coaches')" @click="setActiveLink('coaches')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="fa fa-person-chalkboard" />
                        </q-item-section>
                        <q-item-section>Coaches</q-item-section>
                    </q-item>
                </router-link>

                <router-link to="/admin/parents" class="text-grey-5" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('parents')" @click="setActiveLink('parents')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="fa fa-person-breastfeeding" />
                        </q-item-section>
                        <q-item-section>Parents</q-item-section>
                    </q-item>
                </router-link>
                <router-link to="/admin/sections" class="text-grey-5" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('sections')" @click="setActiveLink('sections')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="class" />
                        </q-item-section>
                        <q-item-section>Sections</q-item-section>
                    </q-item>
                </router-link>
                <router-link to="/admin/events" class="text-grey-5" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('events')" @click="setActiveLink('events')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="event" />
                        </q-item-section>
                        <q-item-section>Events</q-item-section>
                    </q-item>
                </router-link>
                <router-link to="/admin/accounts" class="text-grey-5" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('accounts')" @click="setActiveLink('accounts')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="people"/>
                        </q-item-section>
                        <q-item-section>Accounts</q-item-section>
                    </q-item>
                </router-link>

                <router-link to="/admin/staff" class="text-grey-5" style="text-decoration: none">
                    <q-item clickable v-ripple :active="isActive('staff')" @click="setActiveLink('staff')"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="supervisor_account"/>
                        </q-item-section>
                        <q-item-section>Staff</q-item-section>
                    </q-item>
                </router-link>

            </q-list>
        </q-scroll-area>

        <div class="absolute-top bg-blue-grey-10 self-center justify-center row q-mb-sm" style="height: 50px;">
            <q-avatar size="40px">
                <img src="@/assets/images/hiyas-logo.png" alt="Logo" />
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
    const defaultLink = storedLink || 'dashboard';
    store.commit('setLink', defaultLink);
});

const isActive = (route) => route === store.state.link;

const setActiveLink = (newLink) => {
    store.commit('setLink', newLink);
};
</script>
  
<style scoped>
.my-menu-link {
    color: black;
    background: #F8CB0D;
    font-weight: bold;
}
</style>
  