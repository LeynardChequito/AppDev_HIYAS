<template>
    <q-btn dense round :color="buttonColor" class="q-mr-md" @click="toggleChat" v-close-popup>
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

                        <!-- <template v-for="item in chatItems" :key="item.id"> -->
                        <chat-list />
                        <!-- <q-separator /> -->
                        <!-- </template> -->
                    </q-list>
                </div>
            </q-card>
        </div>
    </div>
</template>
  
<script>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import ChatList from '@/components/ChatList.vue';


export default {
    components: {
        ChatList
    },
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
    methods: {
        navigateToChat(userId) {
            // Programmatic navigation to /chats/:id
            this.$router.push({ name: 'chats', params: { id: userId } });
        },

    },
};
</script>
  
<style lang="sass" scoped>
  .my-card
    width: 350px
    max-width: 100%
    
  
  .scrollable-list
    max-height: 450px 
    overflow-y: auto
  
  
  .chat-card
    position: absolute
    z-index: 1
    top: 0
    right: 0
    margin-top: 55px
    margin-right: 10px
  </style>
  