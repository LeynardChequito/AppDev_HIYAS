<template>
    <div>
    <Birthdays />
    <Events />
</div>
</template>
<script>
// @ is an alias to /src
import Birthdays from '@/components/Birthdays.vue'
import Events from '@/components/Events.vue'
export default {
    name: 'events',
    components: {
        Birthdays,
        Events
    }
}
</script>
<style>
</style>