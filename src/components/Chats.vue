<template>
    <q-btn dense round icon="messages" :color="buttonColor" class="q-mr-md" @click="chatClicked">
        <q-badge color="red" floating>1</q-badge>
    </q-btn>

    <div class="row one justify-center">
        <div class="chat-card" v-if="cardVisible">
            <q-card bordered class="my-card" v-if="cardVisible">
                <div class="scrollable-list">

                    <q-list bordered class="rounded-borders" style="max-width: 350px">
                        <div class="row">
                            <div class="row col-5 items-start q-pa-md">
                                Chats
                            </div>
                            <div class="row col-7 justify-end">
                                <q-btn flat dense icon="fullscreen" v-close-popup />
                            </div>
                        </div>



                        <q-separator />

                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-avatar>
                                    <img src="https://cdn.quasar.dev/img/avatar4.jpg">
                                </q-avatar>
                            </q-item-section>

                            <q-item-section>
                                <q-item-label lines="1">Jan</q-item-label>
                                <q-item-label caption lines="1">
                                    Can we schedule a call for tomorrow?
                                </q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>1 min</q-item-label>
                            </q-item-section>
                        </q-item>


                        <q-separator />

                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-avatar>
                                    <img src="https://cdn.quasar.dev/img/avatar4.jpg">
                                </q-avatar>
                            </q-item-section>

                            <q-item-section>
                                <q-item-label lines="2">Jan</q-item-label>
                                <q-item-label caption lines="1">
                                    Can we schedule a call for tomorrow?
                                </q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>1 min</q-item-label>
                            </q-item-section>
                        </q-item>


                        <q-separator />

                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-avatar>
                                    <img src="https://cdn.quasar.dev/img/avatar4.jpg">
                                </q-avatar>
                            </q-item-section>

                            <q-item-section>
                                <q-item-label lines="2">Jan</q-item-label>
                                <q-item-label caption lines="1">
                                    Can we schedule a call for tomorrow?
                                </q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>1 min</q-item-label>
                            </q-item-section>
                        </q-item>


                        <q-separator />

                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-avatar>
                                    <img src="https://cdn.quasar.dev/img/avatar4.jpg">
                                </q-avatar>
                            </q-item-section>

                            <q-item-section>
                                <q-item-label lines="2">Jan</q-item-label>
                                <q-item-label caption lines="1">
                                    Can we schedule a call for tomorrow?
                                </q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>1 min</q-item-label>
                            </q-item-section>
                        </q-item>


                        <q-separator />

                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-avatar>
                                    <img src="https://cdn.quasar.dev/img/avatar4.jpg">
                                </q-avatar>
                            </q-item-section>

                            <q-item-section>
                                <q-item-label lines="2">Jan</q-item-label>
                                <q-item-label caption lines="1">
                                    Can we schedule a call for tomorrow?
                                </q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>1 min</q-item-label>
                            </q-item-section>
                        </q-item>


                        <q-separator />

                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-avatar>
                                    <img src="https://cdn.quasar.dev/img/avatar4.jpg">
                                </q-avatar>
                            </q-item-section>

                            <q-item-section>
                                <q-item-label lines="2">Jan</q-item-label>
                                <q-item-label caption lines="1">
                                    Can we schedule a call for tomorrow?
                                </q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>1 min</q-item-label>
                            </q-item-section>
                        </q-item>


                        <q-separator />

                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-avatar>
                                    <img src="https://cdn.quasar.dev/img/avatar4.jpg">
                                </q-avatar>
                            </q-item-section>

                            <q-item-section>
                                <q-item-label lines="2">Jan</q-item-label>
                                <q-item-label caption lines="1">
                                    Can we schedule a call for tomorrow?
                                </q-item-label>
                            </q-item-section>

                            <q-item-section side top>
                                <q-item-label caption>1 min</q-item-label>
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

        const chatClicked = () => {
            cardVisible.value = !cardVisible.value;
            clicked.value = !clicked.value; // Toggle the 'clicked' state
        };

        // Computed property to calculate button color based on 'clicked' state
        const buttonColor = computed(() => {
            return clicked.value ? 'grey' : ''; // Set to 'red' when clicked, else empty
        });

        return {
            cardVisible,
            chatClicked,
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

.chat-card
  position: absolute
  z-index: 1
  top: 0
  right: 0
  margin-top: 45px
  margin-right: 10px
</style>
  


  