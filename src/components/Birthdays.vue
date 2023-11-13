<template>
    <div class="text-h2 my-font text-center q-pa-sm">Birthdays</div>
    <div class="q-pa-md row q-gutter-md justify-center q-mb-md">
      <template v-for="month in months">
        <q-card class="my-card" flat bordered>
          <div class="" style="max-width: 250px">
            <div class="text-subtitle2-H4 text-center ">{{ month.name }}</div>
            <q-list bordered separator>
              <template v-for="person in month.people">
                <q-item clickable v-ripple dense class="justify-center self-center">
                  <q-item-section-main>{{ person.name }} </q-item-section-main>
                  <div class="q-item-section-divider"></div>
                  <q-item-section-sub> - {{ person.day }}</q-item-section-sub>
                </q-item>
              </template>
            </q-list>
          </div>
        </q-card>
      </template>
    </div>
    <q-separator />
  </template>
  
  <script>
  import { ref } from 'vue';
  
  export default {
    setup() {
      const months = ref([
        { name: 'January', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
        { name: 'February', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
        { name: 'March', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
        { name: 'April', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
        { name: 'May', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
        { name: 'June', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
        { name: 'July', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
        { name: 'August', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
        { name: 'September', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
        { name: 'October', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
        { name: 'November', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
        { name: 'December', people: [{ name: 'Leynard', day: 15 }, { name: 'John', day: 15 }, { name: 'Gadreel', day: 15 }] },
      ]);
  
      return {
        months,
      };
    },
  };
  </script>
  
  <style lang="sass" scoped>
  .my-card
    width: 100%
    max-width: 250px
    border-radius: 12px
  
//   .my-font
//     font-family: 'Lugrasimo', cursive
  
//   @font-face
//     font-family: 'Lugrasimo'
//     src: url('https://fonts.gstatic.com/s/lugrasimo/v7/PCjtKkPp9Wp9RB2QBkREtefKlbNvSdKsN9e-pQ.woff2') format('woff2')
//     font-weight: normal
//     font-style: normal
  
  .q-item-section-divider
    height: 1px
    background-color: green
    margin: 8px 0

  </style>
  