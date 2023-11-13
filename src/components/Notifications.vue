<template>
    <q-btn dense round :color="buttonColor" class="q-mr-md no-shadow" @click="toggleNotification">
        <q-icon name="notifications" style="color: black;" />
        <q-badge color="red" floating>4</q-badge>
    </q-btn>

    <div class="row one justify-center">
        <div class="notification-card" v-if="cardVisible">
            <q-card bordered class="my-card">
                <div class="scrollable-list">
                    <q-list bordered class="rounded-borders">
                        <div class="row">
                            <div class="row col-5 items-start q-pa-md">Notifications</div>
                        </div>
                        <q-separator spaced />

                        <template v-for="item in notificationItems" :key="item.id">
                            <q-item clickable v-ripple>
                                <q-item-section top avatar>
                                    <q-avatar color="primary" text-color="white" icon="bluetooth" />
                                </q-item-section>

                                <q-item-section>
                                    <q-item-label>{{ item.title }}</q-item-label>
                                    <q-item-label caption lines="2">{{ item.description }}</q-item-label>
                                </q-item-section>

                                <q-item-section side top>
                                    <q-item-label caption>{{ item.time }}</q-item-label>
                                    <q-icon v-if="item.starred" name="star" color="yellow" />
                                </q-item-section>
                            </q-item>
                            <q-separator spaced />
                        </template>
                    </q-list>
                </div>
            </q-card>
        </div>
        <div @click="handleGlobalClick"></div>
    </div>
</template>
  
<script>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';

export default {
    setup() {
        const cardVisible = ref(false);
        const clicked = ref(false);

        const toggleNotification = () => {
            cardVisible.value = !cardVisible.value;
            clicked.value = !clicked.value; // Toggle the 'clicked' state
        };

        // Computed property to calculate button color based on 'clicked' state
        const buttonColor = computed(() => (clicked.value ? 'grey' : '')); // Set to 'red' when clicked, else empty

        const notificationItems = [
            { id: 1, title: 'Single line item', description: 'Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.', time: '5 min ago', starred: true },
            { id: 1, title: 'Single line item', description: 'Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.', time: '5 min ago', starred: true },
            { id: 1, title: 'Single line item', description: 'Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.', time: '5 min ago', starred: true },
            { id: 1, title: 'Single line item', description: 'Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.', time: '5 min ago', starred: true },
            { id: 1, title: 'Single line item', description: 'Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.', time: '5 min ago', starred: true },
            { id: 1, title: 'Single line item', description: 'Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.', time: '5 min ago', starred: true },
            { id: 1, title: 'Single line item', description: 'Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.', time: '5 min ago', starred: true },
            { id: 1, title: 'Single line item', description: 'Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.', time: '5 min ago', starred: true },
            { id: 1, title: 'Single line item', description: 'Secondary line text. Lorem ipsum dolor sit amet, consectetur adipiscit elit.', time: '5 min ago', starred: true },
            // Add more items as needed
        ];

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
            toggleNotification,
            buttonColor, // Expose the computed 'buttonColor' to the template
            notificationItems,
            handleGlobalClick,
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
  
  .notification-card
    position: absolute
    z-index: 1
    top: 0
    right: 0
    margin-top: 55px
    margin-right: 10px
  </style>
  