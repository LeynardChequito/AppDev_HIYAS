<template>
    <q-btn dense round  :color="buttonColor" class="q-mr-md" @click="notifClicked">
        <q-icon name="notifications" style="color: black;" />
        <q-badge color="red" floating>4</q-badge>
    </q-btn>

    <div class="row one justify-center">
        <div class="notification-card" v-if="cardVisible">
            <q-card bordered class="my-card" v-if="cardVisible">
                <div class="scrollable-list">

                    <q-list bordered class="rounded-borders">
                        <div class="row">
                            <div class="row col-5 items-start q-pa-md">
                                Notifications
                            </div>
                        </div>



                        <q-separator spaced />

                        <q-item clickable v-ripple>
                            <q-item-section top avatar>
                                <q-avatar color="primary" text-color="white" icon="bluetooth" />
                            </q-item-section>

                            <q-item-section>
                                <q-item-label>Single line item</q-item-label>
                                <q-item-label caption lines="2">Secondary line text. Lorem ipsum dolor sit amet, consectetur
                                    adipiscit elit.</q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>5 min ago</q-item-label>
                                <q-icon name="star" color="yellow" />
                            </q-item-section>
                        </q-item>

                        <q-separator spaced />

                        <q-item clickable v-ripple>
                            <q-item-section top avatar>
                                <q-avatar color="primary" text-color="white" icon="bluetooth" />
                            </q-item-section>

                            <q-item-section>
                                <q-item-label>Single line item</q-item-label>
                                <q-item-label caption lines="2">Secondary line text. Lorem ipsum dolor sit amet, consectetur
                                    adipiscit elit.</q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>5 min ago</q-item-label>
                                <q-icon name="star" color="yellow" />
                            </q-item-section>
                        </q-item>

                        <q-separator spaced />

                        <q-item clickable v-ripple>
                            <q-item-section top avatar>
                                <q-avatar color="primary" text-color="white" icon="bluetooth" />
                            </q-item-section>

                            <q-item-section>
                                <q-item-label>Single line item</q-item-label>
                                <q-item-label caption lines="2">Secondary line text. Lorem ipsum dolor sit amet, consectetur
                                    adipiscit elit.</q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>5 min ago</q-item-label>
                                <q-icon name="star" color="yellow" />
                            </q-item-section>
                        </q-item>

                        <q-separator spaced />

                        <q-item clickable v-ripple>
                            <q-item-section top avatar>
                                <q-avatar color="primary" text-color="white" icon="bluetooth" />
                            </q-item-section>

                            <q-item-section>
                                <q-item-label>Single line item</q-item-label>
                                <q-item-label caption lines="2">Secondary line text. Lorem ipsum dolor sit amet, consectetur
                                    adipiscit elit.</q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>5 min ago</q-item-label>
                                <q-icon name="star" color="yellow" />
                            </q-item-section>
                        </q-item>

                        <q-separator spaced />

                        <q-item clickable v-ripple>
                            <q-item-section top avatar>
                                <q-avatar color="primary" text-color="white" icon="bluetooth" />
                            </q-item-section>

                            <q-item-section>
                                <q-item-label>Single line item</q-item-label>
                                <q-item-label caption lines="2">Secondary line text. Lorem ipsum dolor sit amet, consectetur
                                    adipiscit elit.</q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>5 min ago</q-item-label>
                                <q-icon name="star" color="yellow" />
                            </q-item-section>
                        </q-item>

                        <q-separator spaced />

                        <q-item clickable v-ripple>
                            <q-item-section top avatar>
                                <q-avatar color="primary" text-color="white" icon="bluetooth" />
                            </q-item-section>

                            <q-item-section>
                                <q-item-label>Single line item</q-item-label>
                                <q-item-label caption lines="2">Secondary line text. Lorem ipsum dolor sit amet, consectetur
                                    adipiscit elit.</q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>5 min ago</q-item-label>
                                <q-icon name="star" color="yellow" />
                            </q-item-section>
                        </q-item>

                        <q-separator spaced />

                        <q-item clickable v-ripple>
                            <q-item-section top avatar>
                                <q-avatar color="primary" text-color="white" icon="bluetooth" />
                            </q-item-section>

                            <q-item-section>
                                <q-item-label>Single line item</q-item-label>
                                <q-item-label caption lines="2">Secondary line text. Lorem ipsum dolor sit amet, consectetur
                                    adipiscit elit.</q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>5 min ago</q-item-label>
                                <q-icon name="star" color="yellow" />
                            </q-item-section>
                        </q-item>
                    </q-list>
                </div>
            </q-card>
        </div>
    </div>
</template>

<script>
import { ref, computed } from 'vue';

export default {
    setup() {
        const cardVisible = ref(false);
        const clicked = ref(false);

        const notifClicked = () => {
            cardVisible.value = !cardVisible.value;
            clicked.value = !clicked.value; // Toggle the 'clicked' state
        };

        // Computed property to calculate button color based on 'clicked' state
        const buttonColor = computed(() => {
            return clicked.value ? 'grey' : ''; // Set to 'red' when clicked, else empty
        });

        return {
            cardVisible,
            notifClicked,
            buttonColor, // Expose the computed 'buttonColor' to the template
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

.notification-card
  position: absolute
  z-index: 1
  top: 0
  right: 0
  margin-top: 45px
  margin-right: 10px
</style>
  


  