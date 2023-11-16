<template>
    <div>
      <q-splitter
        v-model="splitterModel"
        style="height: 450px"
      >
  
        <template v-slot:before>
          <div class="q-pa-md">
            <q-date
              v-model="date"
              :events="events"
              event-color="orange"
            />
          </div>
        </template>
  
        <template v-slot:after>
          <q-tab-panels
            v-model="date"
            animated
            transition-prev="jump-up"
            transition-next="jump-up"
          >
            <q-tab-panel name="2019/02/01">
              <div class="text-h4 q-mb-md">Cleanup Party</div>
              <p>Get ready for a day of teamwork, fun, and environmental responsibility! We're excited to invite students, parents, teachers, and staff to our School Cleanup Bash. </p>
              <p>Let's join forces to give our campus a fresh makeover and instill a sense of pride in our shared learning environment.</p>
            </q-tab-panel>
  
            <q-tab-panel name="2019/02/05">
              <div class="text-h4 q-mb-md">Tailgate Party</div>
              <p>Get ready for the ultimate school spirit experience! Join us for a lively Tailgate Party before the big game. This is a fantastic opportunity for students, parents, teachers, 
                and staff to come together, enjoy delicious food, play games, and build excitement for the upcoming sports event. Let\'s create lasting memories, showcase our school pride, and cheer on our teams to victory!
                 Don\'t forget to wear your school colors and bring your energy to make this Tailgate Party a memorable celebration</p>
              
            </q-tab-panel>
  
            <q-tab-panel name="2019/02/06">
              <div class="text-h4 q-mb-md">Relay Day</div>
              <p>Get ready for an exhilarating day of camaraderie and competition at our annual Relay Day! This event brings together students, teachers, and staff for a day of fun, teamwork, and physical activities. 
                Participants will engage in a variety of relay races, challenges, and team-building exercises. It's a fantastic opportunity to foster school spirit, promote a healthy lifestyle, and create lasting memories. 
                Whether you're cheering from the sidelines or actively participating, Relay Day is all about bringing our school community together for a day of joy and celebration. Let's make it a day to remember</p>
              
            </q-tab-panel>
          </q-tab-panels>
        </template>
      </q-splitter>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue'
  
  export default {
    setup () {
      return {
        splitterModel: ref(50),
        date: ref('2019/02/01'),
        events: [ '2019/02/01', '2019/02/05', '2019/02/06' ]
      }
    }
  }
  </script>
  