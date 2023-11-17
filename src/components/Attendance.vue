<template>
    <q-card>
      <div class="q-pa-md">
        <div>
          <label for="roleFilter">Filter by Role:</label>
          <select id="roleFilter" v-model="selectedRole">
            <option value="">All Roles</option>
            <option value="students">Students</option>
            <option value="parents">Parents</option>
            <option value="staff">Staff</option>
          </select>
  
          <label for="eventFilter">Filter by Event:</label>
          <select id="eventFilter" v-model="selectedEvent">
            <option value="">All Events</option>
            <option value="meetings">Meetings</option>
            <option value="events">Events</option>
            <option value="sessions">Sessions</option>
          </select>
        </div>
  
        <q-table
          :rows="filteredData"
          :columns="columns"
          row-key="id"
          :pagination="pagination"
          virtual-scroll
        >
          <template v-slot:body="props">
            <q-tr :props="props">
              <q-td v-for="col in props.cols" :key="col.name" :props="props">
                {{ col.value }}
              </q-td>
            </q-tr>
          </template>
        </q-table>
      </div>
    </q-card>
  </template>
  
  <script>
  import { ref, computed } from 'vue';
  
  export default {
    setup() {
      const selectedRole = ref('');
      const selectedEvent = ref('');
  
      // Temporary data, replace this with your actual data
      const data = [
  { 
    id: 1, 
    firstname: 'Son', 
    lastname: 'Goku', 
    section: 'mekus mekus', 
    time_in: '08:01 AM', 
    time_out: '05:00 PM', 
    event_name: 'Dragon Ball Z', 
    role: 'students' 
  },
  { 
    id: 2, 
    firstname: 'Jane', 
    lastname: 'Doe', 
    section: 'B', 
    time_in: '10:00 AM', 
    time_out: '04:00 PM', 
    event_name: 'Event 2', 
    role: 'students' 
  },
  // Add more student entries

  { 
    id: 101, 
    firstname: 'Alice', 
    lastname: 'Smith', 
    position: 'Manager', 
    time_in: '08:30 AM', 
    time_out: '05:00 PM', 
    event_name: 'Meeting 1', 
    role: 'staff' 
  },
  { 
    id: 102, 
    firstname: 'Bob', 
    lastname: 'Johnson', 
    position: 'Developer', 
    time_in: '09:00 AM', 
    time_out: '06:00 PM', 
    event_name: 'Meeting 2', 
    role: 'staff' 
  },
  // Add more staff entries

  { 
    id: 201, 
    firstname: 'Eve', 
    lastname: 'Brown', 
    relationship: 'Parent', 
    address: '123 Main St', 
    event_name: 'Session 1', 
    time_in: '06:00 PM', 
    time_out: '08:00 PM', 
    role: 'parents' 
  },
  { 
    id: 202, 
    firstname: 'Charlie', 
    lastname: 'Green', 
    relationship: 'Guardian', 
    address: '456 Oak St', 
    event_name: 'Session 2', 
    time_in: '05:30 PM', 
    time_out: '07:30 PM', 
    role: 'parents' 
  },
  // Add more parent entries
]
  
      const sortField = ref(null);
      const sortOrder = ref('asc');
  
      const filteredData = computed(() => {
        let filtered = data.filter(item => {
          const roleFilter = selectedRole.value ? item.role === selectedRole.value : true;
          const eventFilter = selectedEvent.value ? item.event === selectedEvent.value : true;
          return roleFilter && eventFilter;
        });
  
        if (sortField.value) {
          const order = sortOrder.value === 'asc' ? 1 : -1;
          filtered = filtered.sort((a, b) => {
            return a[sortField.value] > b[sortField.value] ? order : -order;
          });
        }
  
        return filtered;
      });
  
      const columns = [
        { name: 'id', label: 'ID', align: 'center', field: 'id' },
        { name: 'firstname', label: 'First Name', align: 'center', field: 'firstname' },
        { name: 'lastname', label: 'Last Name', align: 'center', field: 'lastname' },
        { 
          name: 'section', 
          label: 'Section/Position/Relationship', 
          align: 'center', 
          field: row => {
            if (row.role === 'students') {
              return row.section;
            } else if (row.role === 'staff') {
              return row.position;
            } else if (row.role === 'parents') {
              return row.relationship;
            }
            return '';
          },
        },
        // Only show the address field for parents
        { 
          name: 'address', 
          label: 'Address', 
          align: 'center', 
          field: 'address',
          visible: row => row.role === 'parents' && selectedRole.value === 'parents',
          "header-align": 'center',
          "header-style": row => (row.role !== 'parents' && selectedRole.value !== 'parents'),
        },
        { name: 'time_in', label: 'Time In', align: 'center', field: 'time_in' },
        { name: 'time_out', label: 'Time Out', align: 'center', field: 'time_out' },
        { name: 'event_name', label: 'Event Name', align: 'center', field: 'event_name' },
      ];
  
      const pagination = { rowsPerPage: 10 };
  
      const handleSort = field => {
        if (sortField.value === field) {
          sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
        } else {
          sortField.value = field;
          sortOrder.value = 'asc';
        }
      };
  
      return {
        selectedRole,
        selectedEvent,
        filteredData,
        columns,
        pagination,
        handleSort,
        sortField,
        sortOrder,
      };
    },
  };
  </script>
  
  <style lang="sass" scoped>
  /* Add your styling here if needed */
  </style>
  