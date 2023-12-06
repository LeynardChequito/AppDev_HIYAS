<template>
    <q-drawer side="right" v-model="drawer" show-if-above :width="250" class="bg-blue-grey-9">
        <q-scroll-area style="height: calc(100% - 50px); margin-top: 50px; border-right: 1px solid #ddd;">
            <q-list padding class="text-grey-5">
                <router-link to="dashboard" class="text-grey-5" style="text-decoration: none;">
                    <q-item clickable v-ripple :active="link === 'dashboard'" @click="link = 'dashboard'"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="fa fa-gauge-high" />
                        </q-item-section>
                        <q-item-section>Dashboard</q-item-section>
                    </q-item>
                </router-link>
                <router-link to="students" class="text-grey-5" style="text-decoration: none;">
                    <q-item clickable v-ripple :active="link === 'students'" @click="link = 'students'"
                        active-class="my-menu-link">
                        <q-item-section avatar>
                            <q-icon name="fa fa-child" />
                        </q-item-section>
                        <q-item-section>Students</q-item-section>
                    </q-item>
                </router-link>

                <q-item clickable v-ripple :active="link === 'help'" @click="link = 'help'" active-class="my-menu-link">
                    <q-item-section avatar>
                        <q-icon name="help" />
                    </q-item-section>

                    <q-item-section>Help</q-item-section>
                </q-item>
            </q-list>
        </q-scroll-area>

        <div class="absolute-top bg-blue-grey-10 self-center justify-center row q-mb-sm" style="height: 50px;">
            <q-avatar size="40px">
                <img src="@/assets/images/hiyas-logo.png">
            </q-avatar>
        </div>
        <q-separator />

    </q-drawer>
</template>

<script setup>
import { ref, watch } from 'vue'
import { drawer, activeLink, setDynamicName } from '@/assets/store';

const link = ref('');

watch(link, (newLink) => {
  activeLink.value = newLink;
  setDynamicName(newLink === 'dashboard' ? 'Dashboard' : newLink === 'students' ? 'Students' : '');
});

</script>


<style scoped>
.my-menu-link {
    color: black;
    background: #F8CB0D;
    bold: true;
}
</style>