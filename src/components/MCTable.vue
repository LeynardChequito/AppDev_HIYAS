<template>
    <div>
      <q-btn color="primary" @click="addRow" class="q-mt-md">
        Add New
      </q-btn>
  
      <q-table
        class="my-sticky-header-last-column-table"
        flat
        bordered
        :rows="info"
        :columns="columns"
        row-key="id"
      >
            <template v-slot:body="props">
              <q-tr :props="props">
                <q-td v-for="col in columns" :key="col.name" :props="props">
                  {{ props.row[col.field] }}
                </q-td>
                <q-td>
                  <q-btn
                    icon="visibility"
                    round
                    flat
                    @click="handleRowClick(props.row)"
                  ></q-btn>
                  <q-btn
                    icon="edit"
                    round
                    flat
                    @click="editRow(props.row)"
                  ></q-btn>
                  <q-btn
                    icon="delete"
                    round
                    flat
                    @click="deleteRow(props.row)"
                  ></q-btn>
                </q-td>
              </q-tr>
            </template>
          </q-table>
        </div>
    
        <div class="edit-form" v-if="editMode">
         
      <div class="form-container q-gutter-md">
          <h4 style="margin-top: 1px; text-align: center;">Edit Coaches Information</h4> 
        <div class="row">
          <div v-for="col in columns" :key="col.name" class="col-3 form-group">
            <label v-if="col.label !== 'Action'" :for="'edit-' + col.field">
              {{ col.label }}:
            </label>
            <input
              v-if="col.label !== 'Action'"
              :type="col.field === 'birthday' ? 'date' : 'text'"
              v-model="editForm[col.field]"
              :id="'edit-' + col.field"
            />
          </div>
        </div>
        <div class="form-actions">
          <button @click="saveEdit">Save Changes</button>
          <button @click="cancelEdit">Cancel</button>
        </div>
      </div>
    </div>
  
    <!-- Add Form -->
    <div class="add-form" v-if="addMode">
      <div class="form-container q-gutter-md">
          <h4 style="margin-top: 1px; text-align: center;">Add Another Coaches</h4> 
        <div class="row">
          <div v-for="col in columns" :key="col.name" class="col-3 form-group">
            <label v-if="col.label !== 'Action'" :for="'add-' + col.field">
              {{ col.label }}:
            </label>
            <input
              v-if="col.label !== 'Action'"
              :type="col.field === 'birthday' ? 'date' : 'text'"
              v-model="addForm[col.field]"
              :id="'add-' + col.field"
            />
          </div>
        </div>
        <div class="form-actions">
          <button @click="saveAdd">Add Data</button>
          <button @click="cancelAdd">Cancel</button>
        </div>
      </div>
    </div>
  </template>
    
    <script>
    import axios from 'axios';
    
    const columns = [
      { name: 'id_number', label: 'Id Number', align: 'left', field: 'id_number', sortable: true },
      { name: 'lastname', label: 'Lastname', align: 'left', field: 'lastname', sortable: true },
      { name: 'firstname', label: 'Firstname', align: 'left', field: 'firstname', sortable: true },
      { name: 'birthday', label: 'Birthday', align: 'left', field: 'birthday', sortable: true },
      { name: 'age', label: 'Age', align: 'left', field: 'age', sortable: true },
      { name: 'gender', label: 'Gender', align: 'left', field: 'gender', sortable: true },
      { name: 'phone', label: 'Phone', align: 'left', field: 'phone', sortable: true },
      { name: 'dated_hired', label: 'Dated_hired', align: 'left', field: 'dated_hired', sortable: true },
      { name: 'employeeid', label: 'Employee_id', align: 'left', field: 'employeeid', sortable: true },


      
      { label: 'Action', align: 'center' },
    ];
    
    export default {
      data() {
        return {
          info: [],
          editMode: false,
          editForm: {},
          addMode: false,
          addForm: {},
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
          const id = row.id;
          this.$router.push(`/reports/students/${id}`);
        },
    
        navigateToManage() {
          this.$router.push('/manage/students');
        },
    
        editRow(row) {
          this.editMode = true;
          this.editForm = { ...row };
        },
    
        saveEdit() {
        // Implement save logic, update the row in the info array
        // Call an API, update in the database, etc.
        // Assuming you have a unique identifier like 'id' for each row
        const editedRowIndex = this.info.findIndex(
          (row) => row.id === this.editForm.id
        );
        if (editedRowIndex !== -1) {
          // Update the existing row in the info array
          this.info.splice(editedRowIndex, 1, { ...this.editForm });
        }
  
        // Reset editMode after saving
        this.editMode = false;
      },
    
        cancelEdit() {
          this.editMode = false;
        },
    
        addRow() {
          this.addMode = true;
          // Initialize addForm fields if needed
        },
    
        saveAdd() {
        // Implement save logic, add a new row to the info array
        // Call an API, insert in the database, etc.
        // Assuming you have a unique identifier like 'id' for each row
        const newId = this.info.length + 1; // Generate a new unique id
        const newRow = { id: newId, ...this.addForm };
  
        // Add the new row to the info array
        this.info.push(newRow);
  
        // Reset addMode after saving
        this.addMode = false;
          },
        cancelAdd() {
          this.addMode = false;
        },
    
        deleteRow(row) {
        // Add a confirmation dialog before deletion
        const isConfirmed = window.confirm('Are you sure you want to delete this data?');
        if (!isConfirmed) {
          return; // Cancel deletion if not confirmed
        }
  
       
        const deletedRowIndex = this.info.findIndex(
          (item) => item.id === row.id
        );
        if (deletedRowIndex !== -1) {
          // Remove the row from the info array
          this.info.splice(deletedRowIndex, 1);
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
    
    <style lang="scss" scoped>
      td:last-child {
        background-color: #EEEE;
      }
    
      tr th {
        position: sticky;
        z-index: 9;
        background: #EEEEEE;
      }
    
      thead tr:last-child th {
        top: 48px;
        z-index: 9;
      }
    
      thead tr:first-child th {
        top: 0;
        z-index: 1;
      }
    
      tr:last-child th:last-child {
        z-index: 3;
      }
    
      td:last-child {
        z-index: 1;
      }
    
      td:last-child, th:last-child {
        position: sticky;
        right: 0;
      }
    
      tbody {
        scroll-margin-top: 48px;
      }
    
      .q-form {
        width: 500px;
        height: 500px;
        margin: 0 auto;
      }
    
      .q-mt-md {
        margin-top: 20px;
        margin-left: 20px;
        margin-bottom: 5px;
      }
    
      .form-container {
      background-color: #fff;
      padding: 30px; /* Adjust the padding as needed */
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(52, 52, 52, 0.1);
      margin: 1px 0;
    }
  
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
  
    input {
      width: 75%;
      padding: 6px; /* Adjust the padding for smaller input forms */
      font-size: 12px; /* Adjust the font size as needed */
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
  
    .form-actions {
      margin-top: 10px;
    }
  
    button {
      margin-right: 10px; /* Adjust the margin as needed */
      padding: 9px; /* Adjust the padding as needed */
      font-size: 12px; /* Adjust the font size as needed */
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
  
    button:hover {
      background-color:rgb(102, 58, 233);
      color: #ffffff;
    }
  </style>