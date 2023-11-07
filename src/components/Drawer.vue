
<template>
    <q-drawer v-model="drawer" show-if-above :mini="miniState" @mouseover="miniState = false" @mouseout="miniState = true"
        mini-to-overlay :width="200" :breakpoint="500" bordered :class="$q.dark.isActive ? 'bg-grey-9' : 'bg-grey-3'">
        <q-scroll-area class="fit" :horizontal-thumb-style="{ opacity: 0 }">
            <q-list padding>
                <q-item @click="goToRoute('students')" clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="child_care" />
                    </q-item-section>

                    <q-item-section>
                        Students
                    </q-item-section>
                </q-item>

                <q-item @click="goToRoute('parents')" clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="family_restroom" />
                    </q-item-section>

                    <q-item-section>
                        Parents
                    </q-item-section>
                </q-item>

                <q-item @click="goToRoute('finance')" clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="payments" />
                    </q-item-section>

                    <q-item-section>
                        Finance
                    </q-item-section>
                </q-item>


                <q-item @click="goToRoute('events')" clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="event" />
                    </q-item-section>

                    <q-item-section>
                        Events
                    </q-item-section>
                </q-item>
                <q-item @click="goToRoute('announcements')" clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="campaign" />
                    </q-item-section>

                    <q-item-section>
                        Announcements
                    </q-item-section>
                </q-item>

                <q-item @click="goToRoute('staff')" clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="people" />
                    </q-item-section>

                    <q-item-section>
                        Staff
                    </q-item-section>
                </q-item>
                <q-item @click="goToRoute('coaches')" clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="emoji_people" />
                    </q-item-section>

                    <q-item-section>
                        Coaches
                    </q-item-section>
                </q-item>

                <q-item @click="goToRoute('sponsors')" clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="handshake" />
                    </q-item-section>

                    <q-item-section>
                        Sponsors
                    </q-item-section>
                </q-item>
                <q-item @click="goToRoute('sections')" clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="class" />
                    </q-item-section>

                    <q-item-section>
                        Sections
                    </q-item-section>
                </q-item>
            </q-list>
        </q-scroll-area>
    </q-drawer>
</template>

<script>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

export default {
    setup() {

        const router = useRouter()

        const goToRoute = (route) => {
            router.push(`/${route}`)
        }
        return {
            drawer: ref(false),
            miniState: ref(true),
            goToRoute
        }


    }
}
</script>