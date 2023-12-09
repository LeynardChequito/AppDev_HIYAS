<template>
    <div>
        <div class="row col-12 justify-end">
            <q-btn @click="openAddParentDialog" color="positive" label="Add Parent" class="q-my-md" />
        </div>
        <q-table title="" :rows="tableData" :columns="columns" row-key="name" class="my-sticky-last-column-table">
            <template #body-cell-actions="props">
                <q-td :props="props">
                    <q-btn flat round icon="edit" @click="editParent(props.row)" />
                    <q-btn flat round icon="delete" @click="deleteParent(props.row)" color="negative" />
                </q-td>
            </template>
        </q-table>

        <q-dialog v-model="addParentDialog" position="standard">
            <q-card class="q-pa-md" style="width: 800px;">
                <q-card-section>
                    <q-card-title class="text-h6">Parent Data</q-card-title>
                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newParent.firstname" label="First Name" />
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input v-model="newParent.lastname" label="Last Name" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newParent.age" label="Age" />
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input v-model="newParent.birthday" label="Birthday" mask="date" :rules="['date']">
                                <template v-slot:append>
                                    <q-icon name="event" class="cursor-pointer">
                                        <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                            <q-date v-model="newParent.birthday">
                                                <div class="row items-center justify-end">
                                                    <q-btn v-close-popup label="Close" color="primary" flat />
                                                </div>
                                            </q-date>
                                        </q-popup-proxy>
                                    </q-icon>
                                </template>
                            </q-input>
                        </div>
                    </div>

                    <q-select v-model="newParent.address" label="Address" :options="addressOptions" :rules="[v => !!v]"
                        dense />
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn label="Cancel" color="negative" v-close-popup />
                    <q-btn :label="editMode ? 'Edit Parent' : 'Add Parent'" :color="editMode ? 'primary' : 'positive'"
                        @click="addOrEditParent" />
                </q-card-actions>
            </q-card>
        </q-dialog>
    </div>
</template>
  
<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';

// Specify the emitted event
const columns = [
    { name: 'firstname', label: 'First Name', field: 'firstname', align: 'left', sortable: true },
    { name: 'lastname', label: 'Last Name', field: 'lastname', align: 'left', sortable: true },
    { name: 'age', label: 'Age', field: 'age', align: 'left', sortable: true },
    { name: 'birthday', label: 'Birthday', field: 'birthday', align: 'left', sortable: true },
    { name: 'address', label: 'Address', field: 'address', align: 'left', sortable: true },
    {
        name: 'actions',
        label: 'Actions',
        field: 'actions',
        align: 'center',
        sortable: false,
        bodySlot: 'actions',
    },
];

const editMode = ref(false);

const tableData = ref([]);
const addParentDialog = ref(false);
const newParent = ref({
    firstname: '',
    lastname: '',
    age: '',
    birthday: '',
    address: '',
});

const addressOptions = [
    'Balite', 'Baruyan', 'Bayanan I', 'Bayanan II', 'Calero', 'Camilmil', 'Canubing I',
    'Canubing II', 'Guinobatan', 'GulodIbaba East', 'Ibaba West', 'Ilaya', 'Lalud', 'Lazareto',
    'Lumangbayan', 'Masipit', 'Pachoca', 'San Antonio', 'Suqui', 'Tawagan', 'Tawiran', 'Tibag',
];

const openAddParentDialog = async () => {
    editMode.value = false;
    addParentDialog.value = true;

    newParent.value = {
        lastname: '',
        age: '',
        birthday: '',
        firstname: '',
        address: '',
    };

};

onMounted(async () => {
    try {
        const response = await axios.get('getparent');
        tableData.value = response.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }

});

const editParent = async (parent) => {
    try {
        // Open the addSectionDialog in "Edit" mode
        openAddParentDialog();

        // Update the newSection object with the selected section's data
        newParent.value = { ...parent };

        editMode.value = true;
        // Note: You may need to adjust the API endpoint based on your actual implementation
    } catch (error) {
        console.error('Error fetching section data for editing:', error);
    }
};

const deleteParent = async (parent) => {
    try {
        // Call your API endpoint to delete a coach
        await axios.delete(`deleteparent/${parent.id}`);
        // Remove the deleted coach from the tableData
        tableData.value = tableData.value.filter(item => item.id !== parent.id);
    } catch (error) {
        console.error('Error deleting coach:', error);
    }
};

const addOrEditParent = async () => {
    try {
        if (editMode.value) {
            // Call your API endpoint to update a coach
            await axios.put(`updateparent/${newParent.value.id}`, newParent.value);
        } else {
            // Call your API endpoint to add a section
            await axios.post('addparent', newParent.value);
        }

        // Refresh the section data after adding/editing a section
        const response = await axios.get('getparent');
        tableData.value = response.data;

        // Close the dialog after successfully adding/editing a section
        addParentDialog.value = false;
    } catch (error) {
        console.error(`Error ${editMode.value ? 'editing' : 'adding'} event:`, error);
    }
};
</script>
  
<style lang="sass">
  .my-sticky-last-column-table
    thead tr:last-child th:last-child
      background-color: white
  
    td:last-child
      background-color: white
  
    th:last-child,
    td:last-child
      position: sticky
      right: 0
      z-index: 1
  </style>
  