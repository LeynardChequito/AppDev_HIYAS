<template>
    <div class="text-h2 my-font text-center">BIRTHDAY CELEBRANTS</div>
    <div class="q-pa-md row items-start q-gutter-md one col-12 justify-center">
        <div class="q-pa-md">
          <q-card class="my-card" flat bordered>
            <div class="q-pa-md" style="max-width: 350px">
                <div class="text-subtitle2-H4 text-center ">JANUARY</div>
                    <q-list bordered separator>
                        <q-item clickable v-ripple>
                            <q-item-section>Leynard</q-item-section>
                        </q-item>
                        <q-item clickable v-ripple>
                            <q-item-section>John</q-item-section>
                        </q-item>
                        <q-item clickable v-ripple>
                            <q-item-section>Gadreel</q-item-section>
                        </q-item>
                    </q-list>
                </div> 
          </q-card>
        </div>
        <div class="q-pa-md">
          <q-card class="my-card" flat bordered>
            <div class="q-pa-md" style="max-width: 350px">
                <div class="text-subtitle2-H4 text-center ">JANUARY</div>
                    <q-list bordered separator>
                        <q-item clickable v-ripple>
                            <q-item-section>Leynard</q-item-section>
                        </q-item>
                        <q-item clickable v-ripple>
                            <q-item-section>John</q-item-section>
                        </q-item>
                        <q-item clickable v-ripple>
                            <q-item-section>Gadreel</q-item-section>
                        </q-item>
                    </q-list>
                </div> 
          </q-card>
        </div>
        <div class="q-pa-md">
          <q-card class="my-card" flat bordered>
            <div class="q-pa-md" style="max-width: 350px">
                <div class="text-subtitle2-H4 text-center ">JANUARY</div>
                    <q-list bordered separator>
                        <q-item clickable v-ripple>
                            <q-item-section>Leynard</q-item-section>
                        </q-item>
                        <q-item clickable v-ripple>
                            <q-item-section>John</q-item-section>
                        </q-item>
                        <q-item clickable v-ripple>
                            <q-item-section>Gadreel</q-item-section>
                        </q-item>
                    </q-list>
                </div> 
          </q-card>
        </div>
        </div>
      </template>
      <script>
      import { ref } from 'vue';
      
      export default {
        setup() {
          return {
            tab: ref('one'),
          };
        },
      };
      </script>
      
      <style lang="sass" scoped>
      .my-card
        width: 100%
        max-width: 250px
      
      .my-font
        font-family: 'Lugrasimo', cursive /* Use 'cursive' as the generic font family in case Lugrasimo isn't available */
        
      @font-face
        font-family: 'Lugrasimo'
        src: url('https://fonts.gstatic.com/s/lugrasimo/v7/PCjtKkPp9Wp9RB2QBkREtefKlbNvSdKsN9e-pQ.woff2') format('woff2') /* URL for the Lugrasimo font */
        font-weight: normal
        font-style: normal
      </style>