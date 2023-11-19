<template>
  <div class="q-pa-md q-gutter-sm student-profile-container">
    <div class="student-image-section">
      <!-- Image Section -->
      <q-img
        :src="getImageSrc"
        loading="lazy"
        spinner-color="white"
        height="500px"
        style="max-width: 500px; border-radius: 50%"
      />
    </div>

    <!-- Card Section -->
    <div class="q-pa-md student-info-section">
      <q-card v-if="selectedStudent" class="half-width-card">
        <q-card-section>
          <!-- Display Student Data -->
          <q-item v-for="(value, key) in selectedStudent" :key="key">
            <q-item-section>
              <q-item-label>{{ key }}</q-item-label>
            </q-item-section>
            <q-item-section>{{ value }}</q-item-section>
          </q-item>
        </q-card-section>
      </q-card>

      <!-- Navigation Buttons -->
      <div class="navigation-buttons">
        <q-btn @click="showPreviousStudent" label="Previous" />
        <q-btn @click="showNextStudent" label="Next" />
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed, nextTick } from 'vue';
import axios from 'axios';

const columns = [
  { label: 'Id Number', align: 'left', field: 'id_number' },
  { label: 'Lastname', align: 'left', field: 'lastname' },
  { label: 'Firstname', align: 'left', field: 'firstname' },
  { label: 'Age', align: 'left', field: 'age' },
  { label: 'Birthday', align: 'left', field: 'birthday' },
  { label: 'Gender', align: 'left', field: 'gender' },
  { label: 'Address', align: 'left', field: 'address' },
  { label: 'Contact Info', align: 'left', field: 'contact_info' },
  { label: 'Parent/Guardian', align: 'left', field: 'guardian/parents' },
  { label: 'Coach', align: 'left', field: 'coach' },
  { label: 'Section', align: 'left', field: 'section' },
  { label: 'Sponsor', align: 'left', field: 'sponsor' },
  { label: 'Staff', align: 'left', field: 'staff' },
  // ... (other fields)
];

export default {
  data() {
    return {
      info: [],
      loading: false,
      rows: [], // Temporary data for testing
      pagination: {},
      selectedStudent: null,
    };
  },
  created() {
    this.loadTemporaryData();
  },
  methods: {
    async loadTemporaryData() {
      const temporaryData = [
        { 
          id_number: '1',
          lastname: 'Doe',
          firstname: 'John',
          age: 25,
          birthday: '1998-01-15',
          gender: 'Male',
          address: '123 Main St',
          contact_info: '555-1234',
          'guardian/parents': 'John Doe Sr.',
          coach: 'Coach A',
          section: 'A',
          sponsor: 'Company XYZ',
          staff: 'Staff Member 1',
          // ... (other fields)
        },
        { 
          id_number: '2',
          lastname: 'Smith',
          firstname: 'Jane',
          age: 22,
          birthday: '2001-03-22',
          gender: 'Female',
          address: '456 Oak St',
          contact_info: '555-5678',
          'guardian/parents': 'Jane Smith Sr.',
          coach: 'Coach B',
          section: 'B',
          sponsor: 'Company ABC',
          staff: 'Staff Member 2',
          // ... (other fields)
        },
        // Add more temporary data as needed
      ];

      // Assume you want to display the first student initially
      this.selectedStudent = temporaryData[0];
      this.info = temporaryData;
    },
    showPreviousStudent() {
      const currentIndex = this.getStudentIndex();
      const newIndex = currentIndex > 0 ? currentIndex - 1 : this.info.length - 1;
      this.selectedStudent = this.info[newIndex];
    },
    showNextStudent() {
      const currentIndex = this.getStudentIndex();
      const newIndex = currentIndex < this.info.length - 1 ? currentIndex + 1 : 0;
      this.selectedStudent = this.info[newIndex];
    },
    getStudentIndex() {
      return this.info.findIndex(student => student === this.selectedStudent);
    },
    onScroll({ to, ref }) {
      const lastIndex = this.rows.length - 1;

      if (!this.loading && to === lastIndex) {
        this.loading = true;

        setTimeout(() => {
          this.nextPage++;
          nextTick(() => {
            ref.refresh();
            this.loading = false;
          });
        }, 500);
      }
    },
  },
  computed: {
    columns() {
      return columns;
    },
    getImageSrc() {
      return this.selectedStudent ? 'https://picsum.photos/500/300' : '';
    },
  },
};
</script>

<style scoped>
/* Your styling goes here */

.student-profile-container {
  display: grid;
  grid-template-columns: 1fr 2fr; /* Adjust the width of the student section */
  align-items: start;
}

.student-image-section {
  padding: 16px;
}

.student-info-section {
  padding-right: 40px; /* Adjust the padding as needed */
}

.half-width-card {
  width: 50%; /* Adjust the width of the card section */
}

.navigation-buttons {
  display: flex;
  justify-content: space-between;
  margin-top: 16px;
}

.navigation-buttons q-btn {
  margin-right: 1px; /* Adjust the margin between buttons */
}
</style>
