<template>
  <div class="page-container">
    <div class="left-panel">
      <!-- Centered Card -->
      <q-card class="my-card">
        <q-card-section>
          <div class="text-h3 text-center">Announcements</div>
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
    v-for="announcement in filteredAnnouncements"
    :key="announcement.id"
    :title="announcement.title"
    :subtitle="formatDate(announcement.date)"
  >
    {{ announcement.description }}
  </q-timeline-entry>
            </q-timeline>
          </q-scroll-area>
      
      </q-card>

    </div>


    <div class="add-announcement-panel">
      <q-card class="my-card">
        <q-card-section>
          <div class="text-h3 text-center">New Announcement</div>
        </q-card-section>

        <q-separator />

        <div class="q-pa-md">
          <form @submit.prevent="addNewAnnouncement" class="announcement-form">
            <q-input v-model="newAnnouncement.title" label="Title" outlined />
            <q-input v-model="newAnnouncement.date" label="Date" type="date" outlined />
            <q-input v-model="newAnnouncement.description" label="Description" outlined />

            <div class="button-group">
              <q-btn type="submit" label="Add Announcement" color="primary" />
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
      announcements: [
        // Add other announcements here
      ],
      splitterModel: ref(50),
      newAnnouncement: {
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
    filteredAnnouncements() {
      return this.announcements.map((announcement) => ({
        ...announcement,
        date: this.formatDate(announcement.date),
      }));
    },
    events() {
      // Combine announcements and additional events
      const allEvents = [...this.announcements];
      // Add any additional events here if needed
      allEvents.push(
        { id: 100, title: 'Event 1', date: '2023-11-20', description: 'Description for Event 1' },
        { id: 101, title: 'Event 2', date: '2023-11-22', description: 'Description for Event 2' },
      );
      return allEvents.map((event) => event.date);
    },
    tabPanels() {
      const uniqueDates = [...new Set(this.announcements.map((announcement) => announcement.date))];
      return uniqueDates.map((date) => {
        return {
          date,
          announcements: this.announcements.filter((announcement) => announcement.date === date),
        };
      });
    },
  },
  methods: {
    addNewAnnouncement() {
      // Validate the new announcement data
      if (
        this.newAnnouncement.title &&
        this.newAnnouncement.date &&
        this.newAnnouncement.description
      ) {
        // Push the new announcement to the announcements array
        this.announcements.push({
          id: this.announcements.length + 1, // or use a unique identifier
          title: this.newAnnouncement.title,
          date: this.newAnnouncement.date,
          description: this.newAnnouncement.description,
        });

        // Clear the form fields after adding the announcement
        this.newAnnouncement = {
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

<style lang="scss" scoped>
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

.announcement-form {
  display: flex;
  flex-direction: column;
}

.button-group {
  display: flex;
  justify-content: flex-end;
  margin-top: 20px;
}
</style>
