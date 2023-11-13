<template>
    <q-btn dense round :color="buttonColor" class="q-mr-md" @click="toggleChat">
        <q-icon name="messages" style="color: black;" />
        <q-badge color="red" floating>1</q-badge>
    </q-btn>

    <div class="row one justify-center">
        <div class="chat-card" v-if="cardVisible">
            <q-card bordered class="my-card">
                <div class="scrollable-list">
                    <q-list bordered class="rounded-borders" style="max-width: 350px">
                        <div class="row">
                            <div class="row col-5 items-start q-pa-md">Chats</div>
                            <div class="row col-7 justify-end">
                                <q-btn flat dense icon="fullscreen" v-close-popup />
                            </div>
                        </div>
                        <q-separator />

                        <template v-for="item in chatItems" :key="item.id">
                            <q-item clickable v-ripple>
                                <q-item-section avatar>
                                    <q-avatar>
                                        <img :src="item.avatarSrc" />
                                    </q-avatar>
                                </q-item-section>

                                <q-item-section>
                                    <q-item-label lines="1">{{ item.name }}</q-item-label>
                                    <q-item-label caption lines="1">{{ item.message }}</q-item-label>
                                </q-item-section>

                                <q-item-section side top>
                                    <q-item-label caption>{{ item.time }}</q-item-label>
                                </q-item-section>
                            </q-item>
                            <q-separator />
                        </template>
                    </q-list>
                </div>
            </q-card>
        </div>
    </div>
</template>
  
<script>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';


export default {
    setup() {
        const cardVisible = ref(false);
        const clicked = ref(false);

        const toggleChat = () => {
            cardVisible.value = !cardVisible.value;
            clicked.value = !clicked.value; // Toggle the 'clicked' state
        };

        // Computed property to calculate button color based on 'clicked' state
        const buttonColor = computed(() => (clicked.value ? 'grey' : '')); // Set to 'red' when clicked, else empty

        const chatItems = Array.from({ length: 8 }, (_, index) => ({
            id: index + 1,
            name: 'Jan',
            message: 'Can we schedule a call for tomorrow?',
            time: '1 min',
            avatarSrc: 'https://cdn.quasar.dev/img/avatar4.jpg',
        }));

        const handleGlobalClick = (event) => {
            // Check if the clicked element is outside the button and the notification card
            const isOutsideButton = !event.target.closest('.q-btn');
            const isOutsideNotificationCard = !event.target.closest('.notification-card');

            // Close the notification card if it's open and the click is outside both the button and the card
            if (cardVisible.value && isOutsideButton && isOutsideNotificationCard) {
                cardVisible.value = false;
                clicked.value = false;
            }
        };

        // Close the notification card when a global click event is emitted from another component
        const closeNotificationCard = () => {
            cardVisible.value = false;
            clicked.value = false;
        };

        // Add and remove the global click event listener when the component is mounted and unmounted
        onMounted(() => {
            document.addEventListener('click', handleGlobalClick);
        });

        onBeforeUnmount(() => {
            document.removeEventListener('click', handleGlobalClick);
        });

        // Listen for global events from other components
        window.addEventListener('closeNotificationCard', closeNotificationCard);

        return {
            cardVisible,
            toggleChat,
            buttonColor, // Expose the computed 'buttonColor' to the template
            chatItems,
            handleGlobalClick
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
  
  .chat-card
    position: absolute
    z-index: 1
    top: 0
    right: 0
    margin-top: 55px
    margin-right: 10px
  </style>
  