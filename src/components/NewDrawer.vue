<template>
    <q-page-sticky position="bottom-right">
        <q-btn-dropdown rounded color="primary" dropdown-icon="menu" v-show="$q.screen.lt.md" class="fixed-button q-ma-md" >
            <q-list>
                <q-item v-for="item in menuItems" :key="item.route" @click="goToRoute(item.route)" clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon :name="item.icon" />
                    </q-item-section>
                    <q-item-section>{{ item.label }}</q-item-section>
                </q-item>
            </q-list>
        </q-btn-dropdown>
    </q-page-sticky>
</template>
  
<script>
import { ref } from 'vue';
import { useRouter } from 'vue-router';


export default {
    setup() {

    const router = useRouter();

        const menuItems = [
            { route: 'students', icon: 'child_care', label: 'Students' },
            { route: 'parents', icon: 'family_restroom', label: 'Parents' },
            { route: 'finance', icon: 'payments', label: 'Finance' },
            { route: 'events', icon: 'event', label: 'Events' },
            { route: 'announcements', icon: 'campaign', label: 'Announcements' },
            { route: 'staff', icon: 'people', label: 'Staff' },
            { route: 'coaches', icon: 'emoji_people', label: 'Coaches' },
            { route: 'sponsors', icon: 'handshake', label: 'Sponsors' },
            { route: 'sections', icon: 'class', label: 'Sections' },
            { route: 'attendance', icon: 'fact_check', label: 'Attendance' },
            { route: 'accounts', icon: 'manage_accounts', label: 'Accounts' },
        ];

        const goToRoute = (route) => {
            const currentRoute = router.currentRoute.value.path;

            // Check if the current route starts with '/manage'
            if (currentRoute.startsWith('/manage')) {
                // Replace the last segment with the new route
                const newRoute = `/manage/${route}`;
                router.push(newRoute);
            }
            else if (currentRoute.startsWith('/reports')) {
                // Replace the last segment with the new route
                const newRoute = `/reports/${route}`;
                router.push(newRoute);
            } else {
                // If '/manage' is not part of the current route, append it along with the new route
                router.push(`/manage/${route}`);
            }
        };

        return {
            menuItems,
            goToRoute,

        };
    },
};
</script>
  
<style>
.new {
    background-color: green;
}

.fixed-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}
</style>
  