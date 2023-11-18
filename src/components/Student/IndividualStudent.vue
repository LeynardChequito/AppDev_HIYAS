<template>
    <div>
      <!-- Image Section -->
      <div class="q-pa-md q-gutter-sm text-left">
        <q-img
          src="https://picsum.photos/500/300"
          loading="lazy"
          spinner-color="white"
          height="140px"
          style="max-width: 150px; border-radius: 50%"
        />
      </div>
  
      <!-- Table Section -->
      <div class="q-pa-md">
        <q-table
          class="my-sticky-dynamic"
          flat bordered
          title="Treats"
          :rows="rows"
          :columns="columns"
          row-key="index"
          virtual-scroll
          :virtual-scroll-item-size="48"
          :virtual-scroll-sticky-size-start="48"
          :pagination="pagination"
          :rows-per-page-options="[0]"
          @virtual-scroll="onScroll"
        />
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
      };
    },
    created() {
      this.loadTemporaryData();
    },
    methods: {
      async loadTemporaryData() {
        const temporaryData = [
          { id_number: '1', lastname: 'Doe', firstname: 'John', age: 25, /* ... other fields ... */ },
          { id_number: '2', lastname: 'Smith', firstname: 'Jane', age: 22, /* ... other fields ... */ },
          // Add more temporary data as needed
        ];
  
        this.rows = temporaryData;
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
    },
  };
  </script>
  
  <style scoped>
  .my-sticky-dynamic {
    height: 410px;
  
    .q-table__top,
    .q-table__bottom,
    thead tr:first-child th {
      background-color: #00b4ff;
    }
  
    thead tr th {
      position: sticky;
      z-index: 1;
    }
    thead tr:last-child th {
      top: 48px;
    }
  
    thead tr:first-child th {
      top: 0;
    }
    tbody {
      scroll-margin-top: 48px;
    }
  
    tbody tr {
      display: flex;
      flex-direction: row;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      padding: 10px;
    }
  
    tbody tr td {
      flex: 1;
      word-wrap: break-word;
    }
  }
  
  .hey {
    background-color: green;
  }
  
  .heyq {
  }
  </style>
  