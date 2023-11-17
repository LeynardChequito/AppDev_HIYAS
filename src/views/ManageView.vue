<template>
  <div class="q-pa-md one">
    <div class="q-col-gutter-md row items-start">
      <!-- Left Image with Caption -->
      <div class="col-6">
        <q-img src="https://cdn.quasar.dev/img/parallax2.jpg">
          <div class="absolute-full text-subtitle2 flex flex-center" @click="openMenu">
            Caption
          </div>
          <!-- Display the menu items when the menu is open -->
          <div v-if="isMenuOpen" class="menu-items">
            <div v-for="(item, index) in menuItems" :key="index" class="menu-item"
              @click="handleMenuItemClick(item.route)">
              <q-icon :name="item.icon" />
              {{ item.label }}
            </div>
          </div>
        </q-img>
      </div>

      <!-- Right Content for Manage View -->
      <div class="col-6">
        <!-- Temporary data for the manage view -->
        <div class="manage-content">
          <h2 class="text-h4">Manage View</h2>
          <p v-if="isLoading">Loading...</p>
          <div v-else>
            <h3>Student Information</h3>
            <div v-if="manageData.students.length === 0">
              <p>No student data available.</p>
            </div>
            <div v-else>
              <ul>
                <li v-for="(student, index) in manageData.students" :key="index">
                  <strong>Name:</strong> {{ student.name }}<br>
                  <strong>Age:</strong> {{ student.age }}<br>
                  <strong>Grade:</strong> {{ student.grade }}<br>
                  <strong>Parents:</strong>
                  <ul>
                    <li v-for="(parent, parentIndex) in student.parents" :key="parentIndex">
                      <strong>{{ parent.relationship }}:</strong> {{ parent.name }} ({{ parent.email }})
                    </li>
                  </ul>
                </li>
              </ul>
            </div>

            <h3>Parents Information</h3>
            <div v-if="manageData.parents.length === 0">
              <p>No parent data available.</p>
            </div>
            <div v-else>
              <ul>
                <li v-for="(parent, index) in manageData.parents" :key="index">
                  <strong>Name:</strong> {{ parent.name }}<br>
                  <strong>Email:</strong> {{ parent.email }}<br>
                  <strong>Phone:</strong> {{ parent.phone }}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>
  
<script>
export default {
  components: {
  },
  name: 'manage',
  data() {
    return {
      isMenuOpen: false,
      isLoading: true,
      manageData: {
        students: [],
        parents: [],
        events: [],
      },
      menuItems: [
        { route: 'students', icon: 'child_care', label: 'Students' },
        { route: 'parents', icon: 'family_restroom', label: 'Parents' },
        { route: 'finance', icon: 'payments', label: 'Finance' },
        { route: 'events', icon: 'event', label: 'Events' },
        { route: 'announcements', icon: 'campaign', label: 'Announcements' },
        { route: 'staff', icon: 'people', label: 'Staff' },
        { route: 'coaches', icon: 'emoji_people', label: 'Coaches' },
        { route: 'sponsors', icon: 'handshake', label: 'Sponsors' },
        { route: 'sections', icon: 'class', label: 'Sections' },
        { route: 'accounts', icon: 'manage_accounts', label: 'Accounts' },
      ],
    };
  },
  mounted() {
    // Simulate an asynchronous operation to fetch data
    setTimeout(() => {
      this.manageData.students = [
        {
          name: 'Student 1',
          age: 5,
          grade: 'Kindergarten',
          parents: [
            { name: 'Parent 1', email: 'parent1@email.com', phone: '123-456-7890', relationship: 'Mother' },
            { name: 'Parent 2', email: 'parent2@email.com', phone: '987-654-3210', relationship: 'Father' },
          ],
        },
        // Add more student data as needed
      ];

      this.manageData.parents = [
        { name: 'Parent 1', email: 'parent1@email.com', phone: '123-456-7890' },
        { name: 'Parent 2', email: 'parent2@email.com', phone: '987-654-3210' },
        // Add more parent data as needed
      ];

      this.isLoading = false;
    }, 1500);
  },
  methods: {
    openMenu() {
      // Toggle the menu visibility
      this.isMenuOpen = !this.isMenuOpen;
    },
    handleMenuItemClick(route) {
      // Implement navigation logic for menu items
      console.log(`Navigating to ${route}`);
    },
  },
};
</script>
  
<style scoped>
/* Styling for the right content */
.manage-content {
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Additional styling for a better layout */
.row {
  display: flex;
  justify-content: space-between;
}

/* Adjustments for better responsiveness */
@media screen and (max-width: 600px) {
  .row {
    flex-direction: column;
  }
}

.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  /* Adjust the opacity as needed */
  z-index: 999;
  /* Make sure the overlay is on top of other elements */
}

/* Style for the fixed bottom right button */
.NewDrawer {
  position: fixed;
  bottom: 16px;
  right: 16px;
  z-index: 1000;
  /* Make sure the button is on top of other elements */
}
</style>
  