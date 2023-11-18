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
  
      <q-dialog v-model="editModal" persistent>
        <q-card>
          <q-card-section>
            <q-form @submit="saveChanges" class="q-gutter-md">
              <q-input v-model="editedData.firstname" label="First Name"></q-input>
              <q-input v-model="editedData.lastname" label="Last Name"></q-input>
              <q-input v-model="editedData.birthday" label="Birthday"></q-input>
              <q-input v-model="editedData.age" label="Age"></q-input>
              <q-input v-model="editedData.gender" label="Gender"></q-input>
              <q-input v-model="editedData.address" label="Address"></q-input>
              <q-input v-model="editedData.contact_info" label="Contact Info"></q-input>
              <q-input v-model="editedData.guardian_parents" label="Parent/Guardian"></q-input>
              <q-input v-model="editedData.school" label="School"></q-input>
              <q-input v-model="editedData.grade_level" label="Grade Level"></q-input>
              <q-input v-model="editedData.coach" label="Coach"></q-input>
              <q-input v-model="editedData.section" label="Section"></q-input>
              <q-input v-model="editedData.sponsor" label="Sponsor"></q-input>
              <q-input v-model="editedData.staff" label="Staff"></q-input>
              <q-input v-model="editedData.fam_number" label="Number in Family" align="center"></q-input>
  
              <div class="q-mt-md">
                <q-btn type="submit" color="primary" label="Save Changes"></q-btn>
                <q-btn color="red" label="Cancel" @click="cancelEdit"></q-btn>
              </div>
            </q-form>
          </q-card-section>
        </q-card>
      </q-dialog>
  
      <q-dialog v-model="addModal" persistent>
        <q-card>
          <q-card-section>
            <q-form @submit="addNewData" class="q-gutter-md">
              <q-input v-model="newData.firstname" label="First Name"></q-input>
              <q-input v-model="newData.lastname" label="Last Name"></q-input>
              <q-input v-model="newData.birthday" label="Birthday"></q-input>
              <q-input v-model="newData.age" label="Age"></q-input>
              <q-input v-model="newData.gender" label="Gender"></q-input>
              <q-input v-model="newData.address" label="Address"></q-input>
              <q-input v-model="newData.contact_info" label="Contact Info"></q-input>
              <q-input v-model="newData.guardian_parents" label="Parent/Guardian"></q-input>
              <q-input v-model="newData.school" label="School"></q-input>
              <q-input v-model="newData.grade_level" label="Grade Level"></q-input>
              <q-input v-model="newData.coach" label="Coach"></q-input>
              <q-input v-model="newData.section" label="Section"></q-input>
              <q-input v-model="newData.sponsor" label="Sponsor"></q-input>
              <q-input v-model="newData.staff" label="Staff"></q-input>
              <q-input v-model="newData.fam_number" label="Number in Family" align="center"></q-input>
  
              <div class="q-mt-md">
                <q-btn type="submit" color="primary" label="Add Data"></q-btn>
                <q-btn color="red" label="Cancel" @click="cancelAdd"></q-btn>
              </div>
            </q-form>
          </q-card-section>
        </q-card>
      </q-dialog>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  // Define the columns outside the data method
  const columns = [
    { name: 'id_number', label: 'Id Number', align: 'left', field: 'id_number', sortable: true },
    { name: 'lastname', label: 'Lastname', align: 'left', field: 'lastname', sortable: true },
    { name: 'firstname', label: 'Firstname', align: 'left', field: 'firstname', sortable: true },
    { name: 'birthday', label: 'Birthday', align: 'left', field: 'birthday', sortable: true },
    { name: 'age', label: 'Age', align: 'left', field: 'age', sortable: true },
    { name: 'gender', label: 'Gender', align: 'left', field: 'gender', sortable: true },
    { name: 'address', label: 'Address', align: 'left', field: 'address', sortable: true },
    { name: 'contact_info', label: 'Contact Info', align: 'left', field: 'contact_info', sortable: true },
    { name: 'guardian_parents', label: 'Parent/Guardian', align: 'left', field: 'guardian_parents', sortable: true },
    { name: 'school', label: 'School', align: 'left', field: 'school', sortable: true },
    { name: 'grade_level', label: 'Grade Level', align: 'left', field: 'grade_level', sortable: true },
    { name: 'coach', label: 'Coach', align: 'left', field: 'coach', sortable: true },
    { name: 'section', label: 'Section', align: 'left', field: 'section', sortable: true },
    { name: 'sponsor', label: 'Sponsor', align: 'left', field: 'sponsor', sortable: true },
    { name: 'staff', label: 'Staff', align: 'left', field: 'staff', sortable: true },
    { name: 'fam_number', label: 'Number in Family', align: 'center', field: 'fam', sortable: true },
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
  .my-sticky-header-last-column-table {
    /* height or max-height is important */
    /* specifying max-width so the example can highlight the sticky column on any browser window */
  }

  td:last-child {
    /* bg color is important for td; just specify one */
    background-color: #EEEE;
  }

  tr th {
    position: sticky;
    /* higher than z-index for td below */
    z-index: 2;
    /* bg color is important; just specify one */
    background: #EEEEEE;
  }

  /* this will be the loading indicator */
  thead tr:last-child th {
    /* height of all previous header rows */
    top: 48px;
    /* highest z-index */
    z-index: 3;
  }

  thead tr:first-child th {
    top: 0;
    z-index: 1;
  }

  tr:last-child th:last-child {
    /* highest z-index */
    z-index: 3;
  }

  td:last-child {
    z-index: 1;
  }

  td:last-child, th:last-child {
    position: sticky;
    right: 0;
  }

  /* prevent scrolling behind sticky top row on focus */
  tbody {
    /* height of all previous header rows */
    scroll-margin-top: 48px;
  }

  .q-form {
    width: 800px; /* Adjust the form width as needed */
    height: auto;
    margin: 0 auto;
  }

  .q-mt-md {
    margin-top: 20px; /* Adjust the margin as needed */
  }
</style>
