<template>
  <div class="q-pa-md row items-start q-gutter-md one col-12 justify-center">
    <div v-for="coach in coaches" :key="coach.id">
      <q-card class="my-card">
        <q-img src="@/assets/images/coach1.png">
          <div class="absolute-bottom text-h6">
            {{ coach.firstname }} {{ coach.lastname }}
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
import axios from 'axios';

export default {
  data() {
    return {
      coaches: []
    };
  },

  mounted() {
    // Call getInfo method when the component is mounted
    this.getInfo();
  },

  methods: {
    async getInfo() {
      try {
        const response = await axios.get('getcoachdata');
        this.coaches = response.data;
      } catch (error) {
        console.error('Error fetching coach data:', error);
      }
    },
  }
}
</script>
  
<style>
/* styling */
</style>
