<template>
    <div class="dense">
        <div v-for="role in roles" :key="role">
            <div class="text-subtitle1 text-bold">
                <i>{{ role }}</i>
                <q-list dense bordered class="bg-grey-2">

                    <q-item v-for="user in getUsersByRole(role)" :key="user.id" clickable v-ripple
                        @click="navigateToChat(user.id)">
                        <q-item-section top avatar>
                            <q-avatar>
                                <img src="https://cdn.quasar.dev/img/avatar4.jpg" />
                            </q-avatar>
                        </q-item-section>
                        <q-item-section>
                            <q-item-label>{{ user.firstname }} {{ user.lastname }}</q-item-label>
                        </q-item-section>
                    </q-item>
                </q-list>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';


const router = useRouter();

const roles = ['Student', 'Parent/Guardian', 'Coach', 'Staff'];
const users = ref([]);

const navigateToChat = (userId) => {
    // Programmatic navigation to /chats/:id
    router.push({ name: 'chats', params: { id: userId } });
};

const getUsersByRole = (role) => {
    return users.value.filter(user => user.user_role === role);
};

onMounted(async () => {
    try {
        const response = await axios.get('/getaccount'); // Adjust the endpoint based on your actual implementation
        users.value = response.data;
    } catch (error) {
        console.error('Error fetching user data:', error);
    }
});
</script>
  
<style scoped>
/* Add your scoped styles here */
</style>
  