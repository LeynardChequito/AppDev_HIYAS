<template>
    <q-btn dense round icon="person" :color="buttonColor" class="q-mr-md hays" @click="accountClicked">
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
import { ref, computed } from 'vue';

export default {
    setup() {
        const cardVisible = ref(false);
        const clicked = ref(false);

        const accountClicked = () => {
            cardVisible.value = !cardVisible.value;
            clicked.value = !clicked.value; // Toggle the 'clicked' state
        };

        // Computed property to calculate button color based on 'clicked' state
        const buttonColor = computed(() => {
            return clicked.value ? 'grey' : ''; // Set to 'red' when clicked, else empty
        });

        return {
            cardVisible,
            accountClicked,
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

.account-card
  position: absolute
  z-index: 1
  top: 0
  right: 0
  margin-top: 45px
  margin-right: 10px

</style>
  


  