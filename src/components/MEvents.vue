<template>
    <div class="page-container">
      <div class="left-panel">
        <!-- Centered Card -->
        <q-card class="my-card">
          <q-card-section>
            <div class="text-h3 text-center">Events</div>
          </q-card-section>
  
          <q-separator />
  
            <q-select
            v-model="selectedMonth"
            :options="months"
            label="Filter by Month"
            outlined
            >
            </q-select>
            <q-select
              v-model="selectedYear"
              :options="years"
              label="Filter by Year"
              outlined
            ></q-select>
  
            <q-scroll-area style="height: 500px;">
              <q-timeline>
                <q-timeline-entry
      v-for="events in filteredEvents"
      :key="events.id"
      :title="events.title"
      :subtitle="formatDate(events.date)"
    >
      {{ events.description }}
    </q-timeline-entry>
              </q-timeline>
            </q-scroll-area>
        
        </q-card>
  
      </div>
  
  
      <div class="add-events-panel">
        <q-card class="my-card">
          <q-card-section>
            <div class="text-h3 text-center">New Events</div>
          </q-card-section>
  
          <q-separator />
  
          <div class="q-pa-md">
            <form @submit.prevent="addNewevents" class="events-form">
              <div class="form-group">
                <label class="form-label">Title</label>
                <q-input v-model="newevents.title" outlined />
              </div>
  
              <div class="form-group">
                <label class="form-label">Date</label>
                <q-input v-model="newevents.date" type="date" outlined />
              </div>
  
              <div class="form-group">
                <label class="form-label">Description</label>
                <q-input v-model="newevents.description" type="textarea" outlined />
              </div>
  
              <div class="button-group">
                <q-btn type="submit" label="Add events" color="primary" />
              </div>
            </form>
          </div>
        </q-card>
      </div>
    </div>
  </template>
  
  
  <script>
  import { ref } from 'vue';
  
  export default {
    data() {
      return {
        selectedMonth: '',
        selectedYear: '',
        selectedDate: '',
        Events: [
          // Add other Events here
        ],
        splitterModel: ref(50),
        newevents: {
          title: '',
          date: '',
          description: '',
        },
      };
    },
    computed: {
      months() {
        return [
          { label: 'None', value: 'None' },
          { label: 'January', value: '1' },
          { label: 'February', value: '2' },
          { label: 'March', value: '3' },
          { label: 'April', value: '4' },
          { label: 'May', value: '5' },
          { label: 'June', value: '6' },
          { label: 'July', value: '7' },
          { label: 'August', value: '8' },
          { label: 'September', value: '9' },
          { label: 'October', value: '10' },
          { label: 'November', value: '11' },
          { label: 'December', value: '12' },
        ];
      },
      years() {
        const currentYear = new Date().getFullYear();
        return Array.from({ length: 10 }, (_, index) => currentYear - index);
      },
      filteredEvents() {
        return this.Events.map((events) => ({
          ...events,
          date: this.formatDate(events.date),
        }));
      },
      events() {
        // Combine Events and additional events
        const allEvents = [...this.Events];
        // Add any additional events here if needed
        allEvents.push(
          { id: 100, title: 'Event 1', date: '2023-11-20', description: 'Description for Event 1' },
          { id: 101, title: 'Event 2', date: '2023-11-22', description: 'Description for Event 2' },
        );
        return allEvents.map((event) => event.date);
      },
      tabPanels() {
        const uniqueDates = [...new Set(this.Events.map((events) => events.date))];
        return uniqueDates.map((date) => {
          return {
            date,
            Events: this.Events.filter((events) => events.date === date),
          };
        });
      },
    },
    methods: {
      addNewevents() {
        // Validate the new events data
        if (
          this.newevents.title &&
          this.newevents.date &&
          this.newevents.description
        ) {
          // Push the new events to the Events array
          this.Events.push({
            id: this.Events.length + 1, // or use a unique identifier
            title: this.newevents.title,
            date: this.newevents.date,
            description: this.newevents.description,
          });
  
          // Clear the form fields after adding the events
          this.newevents = {
            title: '',
            date: '',
            description: '',
          };
        }
      },
      formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-US', options);
        }
    },
  };
  </script>
  
  <style scoped>
  .page-container {
    display: flex;
    justify-content: space-between;
    padding: 20px;
  }
  .left-panel {
    flex: 1;
    margin-right: 20px;
    max-width: 600px;
  }
  .right-panel {
    flex: 1;
    max-width: 400px;
  }
  .my-card {
    width: 100%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .text-h3 {
    font-size: 1.5rem;
    font-weight: 500;
    margin-bottom: 10px;
  }
  .filter-section {
    display: flex;
    justify-content: space-between;
  }
  .events-form {
    display: flex;
    flex-direction: column;
  }
  .button-group {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
  }
  .add-events-panel {
    width: 40%;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    background-color: #f8f8f8;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-label {
    font-weight: bold;
    margin-bottom: 6px;
    display: block;
  }
  
  .q-input {
    width: 100%;
  }
  </style>