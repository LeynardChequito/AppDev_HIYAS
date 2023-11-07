<template>
    <div>
    <Birthdays />
    <UpcomingEvents />
</div>
</template>
<script>
// @ is an alias to /src
import Birthdays from '@/components/Birthdays.vue'
import UpcomingEvents from '@/components/UpcomingEvents.vue'
export default {
    name: 'events',
    components: {
        Birthdays,
        UpcomingEvents
    }
}
</script>
<style>
</style>
