<template>
    <q-btn dense round :color="buttonColor" class="q-mr-md hays" @click="accountClicked" v-close-popup>
        <q-icon name="person" style="color: black;" />
    </q-btn>

    <div class="row one justify-center">
        <div class="account-card" v-if="cardVisible">
            <q-card bordered class="my-card" v-if="cardVisible">
                <div class="scrollable-list">

                    <q-list bordered class="rounded-borders">

                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-avatar>
                                    <img src="https://cdn.quasar.dev/img/avatar4.jpg">
                                </q-avatar>
                            </q-item-section>

                            <q-item-section>
                                <q-item-label lines="1">Jan Dyze Malaluan</q-item-label>
                            </q-item-section>

                        </q-item>

                        <q-separator spaced />

                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-avatar color="grey" text-color="white" icon="settings" />
                            </q-item-section>

                            <q-item-section>Settings</q-item-section>
                            <q-item-section side>
                                <q-icon name="chevron_right" />
                            </q-item-section>
                        </q-item>

                        <q-item clickable v-ripple @click="logout">
                            <q-item-section avatar>
                                <q-avatar color="grey" text-color="white" icon="logout" />
                            </q-item-section>
                            <q-item-section>Logout</q-item-section>
                            <q-space />
                            <q-item-section side>
                                <q-icon name="chevron_right" />
                            </q-item-section>
                        </q-item>

                    </q-list>
                </div>
            </q-card>
        </div>
    </div>
</template>

<script>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import axios from 'axios'; // Import Axios for making HTTP requests
import router from '@/router';

export default {
    setup() {
        const cardVisible = ref(false);
        const clicked = ref(false);

        const accountClicked = () => {
            cardVisible.value = !cardVisible.value;
            clicked.value = !clicked.value;
        };

        const handleGlobalClick = (event) => {
            const isOutsideButton = !event.target.closest('.q-btn');
            const isOutsideNotificationCard = !event.target.closest('.notification-card');

            if (cardVisible.value && isOutsideButton && isOutsideNotificationCard) {
                cardVisible.value = false;
                clicked.value = false;
            }
        };

        const closeNotificationCard = () => {
            cardVisible.value = false;
            clicked.value = false;
        };

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
                closeNotificationCard();
            } catch (error) {
                console.error('Error during logout:', error);
                // Handle the error as needed
            }
        };


        onMounted(() => {
            document.addEventListener('click', handleGlobalClick);
        });

        onBeforeUnmount(() => {
            document.removeEventListener('click', handleGlobalClick);
        });

        window.addEventListener('closeNotificationCard', closeNotificationCard);

        const buttonColor = computed(() => {
            return clicked.value ? 'grey' : '';
        });

        return {
            cardVisible,
            accountClicked,
            buttonColor,
            handleGlobalClick,
            logout,
        };
    },
};
</script>

<style lang="sass" scoped>
.my-card
    width: 350px
    max-width: 100%
    color: black
.scrollable-list
    max-height: 450px 
    overflow-y: auto

.one
    background-color: black

.account-card
  position: absolute
  z-index: 1
  top: 0
  right: 0
  margin-top: 55px
  margin-right: 10px
.hays .icon
    color: black
</style>
