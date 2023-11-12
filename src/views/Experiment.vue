<!-- src/pages/TablePage.vue -->

<template>
    <div>
      <q-table
        :rows="info"
        :columns="columns"
        row-key="id"
      >
        <template v-slot:body="props">
          <q-tr :props="props">
            <q-td
              v-for="col in columns"
              :key="col.name"
              :props="props"
            >
              {{ props.row[col.name] }}
            </q-td>
          </q-tr>
        </template>
      </q-table>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  // Define the columns outside the data method
  const columns = [
    { name: 'id', label: 'ID', align: 'left', field: 'id' },
    { name: 'name', label: 'Name', align: 'left', field: 'name' },
    // Add more columns as needed
  ];
  
  export default {
    data() {
      return {
        info: [],
      };
    },
    created() {
      this.getInfo();
    },
    methods: {
      async getInfo() {
        try {
          const response = await axios.get('getdata');
          this.info = response.data;
        } catch (error) {
          console.error('Error fetching data:', error);
        }
      },
    },
    // Bind the columns to the component
    computed: {
      columns() {
        return columns;
      },
    },
  };
  </script>
  