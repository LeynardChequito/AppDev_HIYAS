<template>
    <div>
        <Slider />
    </div>
    <AnnouncementsAndEvents/>
    <Sections/>

</template>
  
<script>
// @ is an alias to /src
import Header from '@/components/Header.vue'
import Slider from '@/components/Slider.vue'
import AnnouncementsAndEvents from '@/components/AnnouncementsAndEvents.vue'
import Sections from '@/components/Sections.vue'

export default {
    name: 'home',
    components: {
        Header,
        Slider,
        AnnouncementsAndEvents,
        Sections,
    }
}
</script>

<style lang="sass" scoped>
.header-container 
  position: absolute
  top: 0
  left: 0
  right: 0
  z-index: 2
.slider-container 
  position: relative 
  z-index: 1

</style>


  