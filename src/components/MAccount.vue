<template>
     <div class="q-pa-md">
    <q-btn color="primary" label="Add New" @click="addNew"></q-btn>

    <q-table class="my-sticky-header-last-column-table" flat bordered :rows="info" :columns="columns" row-key="id">
      <template v-slot:body="props">
        <q-tr :props="props">
          <q-td v-for="col in columns" :key="col.name" :props="props">
            {{ props.row[col.name] }}
          </q-td>
          <q-td>
            <q-btn icon="visibility" round flat @click="handleRowClick(props.row)"></q-btn>
            <q-btn icon="edit" round flat @click="editRow(props.row)"></q-btn>
            <q-btn icon="delete" round flat @click="deleteRow(props.row)"></q-btn>
          </q-td>
        </q-tr>
      </template>
    </q-table>
  
    <div v-if="editModal" class="modal-overlay">
      <div class="modal-content">
    <div class="modal-header">
      <h2>Edit Data</h2>
    </div>
    <div class="modal-body">
      <form @submit.prevent="saveChanges" class="q-gutter-md">
        <div class="form-group">
          <label for="editFirstName">First Name</label>
          <input v-model="editedData.firstname" id="editFirstName" type="text">
        </div>
        <div class="form-group">
          <label for="editLastName">Last Name</label>
          <input v-model="editedData.lastname" id="editLastName" type="text">
        </div>
        <div class="form-group">
          <label for="editEmailOrPhone">Email_or_Phone</label>
          <input v-model="editedData.email_or_phone" id="editEmailOrPhone" type="text">
        </div>
        <div class="form-group">
          <label for="editPassword">Password</label>
          <input v-model="editedData.password" id="editPassword" type="password">
        </div>

        <div class="button-group">
          <button type="submit" class="btn-primary">Save Changes</button>
          <button class="btn-cancel" @click="cancelEdit">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div v-if="addModal" class="modal-overlay">
      <div class="modal-content">
    <div class="modal-header">
      <h2>Add New Data</h2>
    </div>
    <div class="modal-body">
      <form @submit.prevent="addNewData" class="q-gutter-md">
        <div class="form-group">
          <label for="addFirstName">First Name</label>
          <input v-model="editedData.firstname" id="addFirstName" type="text">
        </div>
        <div class="form-group">
          <label for="addLastName">Last Name</label>
          <input v-model="editedData.lastname" id="addLastName" type="text">
        </div>
        <div class="form-group">
          <label for="addMobileOrEmail">Mobile_or_Email</label>
          <input v-model="editedData.mobile_or_email" id="addMobileOrEmail" type="text">
        </div>
        <div class="form-group">
          <label for="addPassword">Password</label>
          <input v-model="editedData.password" id="addPassword" type="password">
        </div>

        <div class="button-group">
          <button type="submit" class="btn-primary">Add Data</button>
          <button class="btn-cancel" @click="cancelAdd">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  // Define the columns outside the data method
  const columns = [
    { name: 'id_number', label: 'Id Number', align: 'left', field: 'id_number', sortable: true },
    { name: 'lastname', label: 'Lastname', align: 'left', field: 'lastname', sortable: true },
    { name: 'firstname', label: 'Firstname', align: 'left', field: 'firstname', sortable: true },
    { name: 'mobile_or_email', label: 'mobile_or_email', align: 'left', field: 'mobile_or_email', sortable: true },
    { name: 'password', label: 'password', align: 'left', field: 'password', sortable: true },
       { label: 'Action', align: 'center' },
  ];
  
  export default {
    data() {
      return {
        info: [],
        editModal: false,
        addModal: false,
        editedData: {},
        newData: {},
      };
    },
    created() {
      this.getInfo();
    },
    methods: {
      async getInfo() {
        try {
          const response = await axios.get('getstudentdata');
          this.info = response.data;
        } catch (error) {
          console.error('Error fetching data:', error);
        }
      },
      handleRowClick(row) {
        // Assuming the id property is present in the row object
        const id = row.id;
        // Navigate to the new route
        this.$router.push(`/reports/students/${id}`);
      },
      editRow(row) {
        // Set the data to be edited
        this.editedData = { ...row };
        // Show the edit modal
        this.editModal = true;
      },
      saveChanges() {
        // Assuming you have an endpoint for updating data
        axios
          .put(`updatestudentdata/${this.editedData.id}`, this.editedData)
          .then(response => {
            // Update the local data with the changes
            const index = this.info.findIndex(item => item.id === this.editedData.id);
            if (index !== -1) {
              this.$set(this.info, index, this.editedData);
            }
  
            // Close the edit modal
            this.editModal = false;
          })
          .catch(error => {
            console.error('Error updating data:', error);
          });
      },
      cancelEdit() {
        // Reset the edited data and close the edit modal
        this.editedData = {};
        this.editModal = false;
      },
      deleteRow(row) {
        // Implement your delete logic here
        // You may want to ask for confirmation or perform additional checks before deletion
      },
      addNew() {
        this.newData = {}; // Clear previous data
        this.addModal = true;
      },
      addNewData() {
        // Assuming you have an endpoint for adding new data
        axios
          .post('addstudentdata', this.newData)
          .then(response => {
            // Update the local data with the new data
            this.info.push(response.data);
  
            // Close the add modal
            this.addModal = false;
          })
          .catch(error => {
            console.error('Error adding data:', error);
          });
      },
      cancelAdd() {
        // Reset the new data and close the add modal
        this.newData = {};
        this.addModal = false;
      },
    },
    computed: {
      columns() {
        return columns;
      },
    },
  };
  </script>
  <style lang="scss" scoped>
  /* Table Styling */
  /*.my-sticky-header-last-column-table {
    /* Adjust table styles here */
  
  
  /* Modal Styling */
  .modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5); /* semi-transparent background */
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    /* Adjust modal content styles */
  }
  
  .modal-header {
    text-align: center;
    margin-bottom: 15px;
  }
  
  .modal-header h2 {
    margin: 0;
  }
  
  /*.modal-body {
    /* Adjust modal body styles */
  
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
  }
  
  .button-group {
    text-align: center;
  }
  
  .btn-primary,
  .btn-cancel {
    margin-right: 10px;
  }
  
  /* Additional styles can be added as needed */
  </style>