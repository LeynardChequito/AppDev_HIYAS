<template>
    <div class="q-pa-md row items-start q-gutter-md one col-12 justify-center">
  
      <div v-for="coach in coaches">
        
        <q-card class="my-card">
  
          <q-img src="@/assets/images/coach1.png">
            <div class="absolute-bottom text-h6">
              {{ coach.name }} 
            </div>
          </q-img>
  
          <q-card-section>
            <text-caption><b>Section: </b>{{ coach.section }}</text-caption>
            <br>
            <text-body2><b>Age Group: </b>{{ coach.ageGroup }}</text-body2><br>
            <div class="text-center">
              <q-btn color="primary" icon-right="visibility" label="View" class="text-none" />
            </div>
          </q-card-section>
  
        </q-card>
  
      </div>
  
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        coaches: [
          {
            name: 'Angelica Perez',
            image: 'coach1.png',
            section: 'Mapagpakumbaba',
            ageGroup: '4-10'
          },
          {
            name: 'John Doe', 
            image: '@/assets/images/coach1.png',
            section: 'Masipag',
            ageGroup: '10-15'
          },
          {
            name: 'John Doe', 
            image: '@/assets/images/coach1.png',
            section: 'Masipag',
            ageGroup: '10-15'
          },
          {
            name: 'John Doe', 
            image: '@/assets/images/coach1.png',
            section: 'Masipag',
            ageGroup: '10-15'
          },

        ]
      }
    }
  }
  </script>
  
  <style>
  /* styling */
  </style>