<template>
    <q-btn dense round :color="buttonColor" class="q-mr-md hays" @click="accountClicked">
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

                        <q-item clickable v-ripple>
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

export default {
    setup() {
        const cardVisible = ref(false);
        const clicked = ref(false);

        const accountClicked = () => {
            cardVisible.value = !cardVisible.value;
            clicked.value = !clicked.value;
            // Toggle the 'clicked' state
        };
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

        // Computed property to calculate button color based on 'clicked' state
        const buttonColor = computed(() => {
            return clicked.value ? 'grey' : ''; // Set to 'red' when clicked, else empty
        });

        return {
            cardVisible,
            accountClicked,
            buttonColor,
            handleGlobalClick, // Expose the computed 'buttonColor' to the template
            lorem: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
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
  


  