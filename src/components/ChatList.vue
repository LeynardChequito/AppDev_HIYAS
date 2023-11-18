<template>
    <div class="one">
        <h4>Connected Users</h4>
        <q-list bordered>
            <q-item v-for="user in connectedUsers" :key="user.id" clickable v-ripple @click="navigateToChat(user.id)">
                <q-item-section top avatar>
                    <q-avatar>
                        <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
                    </q-avatar>
                </q-item-section>

                <q-item-section>
                    <q-item-label>{{ user.firstname }}</q-item-label>
                    <q-item-label caption>{{ user.latest_message }}</q-item-label>
                </q-item-section>

                <q-item-section side top>
                    <q-badge label>{{ user.when }}</q-badge>
                </q-item-section>
            </q-item>
        </q-list>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            connectedUsers: [],
        };
    },

    methods: {
        async fetchConnectedUsers() {
            try {
                const token = localStorage.getItem('token');

                // Make an API call to retrieve the list of connected users
                const response = await axios.get('getConnectedUsers', {
                    headers: {
                        Authorization: `${token}`,
                    },
                });

                // Set the connectedUsers based on the retrieved user information
                this.connectedUsers = response.data.users;

                // Emit an event to notify the parent component
                this.$emit('connected-users-fetched', this.connectedUsers);
            } catch (error) {
                console.error('Error fetching connected users:', error);
            }
        },

        navigateToChat(userId) {
            // Programmatic navigation to /chats/:id
            this.$router.push({ name: 'chats', params: { id: userId } });
        },
    },

    mounted() {
        // Call the fetchConnectedUsers method when the component is mounted
        this.fetchConnectedUsers();

        // Automatically fetch connected users every 5 seconds
        this.autoReload = setInterval(() => {
            this.fetchConnectedUsers();
        }, 5000);
    },

    beforeDestroy() {
        // Clear the interval when the component is destroyed
        clearInterval(this.autoReload);
    },
};
</script>
  
<style scoped>
/* Add your scoped styles here */
</style>
