<template>
    <div>
        <div class="row col-12 justify-end">
            <q-btn @click="openAddAccountDialog" color="positive" label="Add Account" class="q-my-md" />
        </div>
        <q-table title="" :rows="tableData" :columns="columns" row-key="name" class="my-sticky-last-column-table">
            <template #body-cell-actions="props">
                <q-td :props="props">
                    <q-btn flat round icon="edit" @click="editAccount(props.row)" />
                    <q-btn flat round icon="delete" @click="deleteAccount(props.row)" color="negative" />
                </q-td>
            </template>
        </q-table>

        <q-dialog v-model="addAccountDialog" position="standard">
            <q-card>
                <q-card-section>
                    <q-card-title class="text-h6">Accounts Data</q-card-title>


                    <q-input v-model="newAccount.firstname" label="First Name" />
                    <q-input v-model="newAccount.lastname" label="Last Name" />
                    <q-input filled v-model="newAccount.mobile_or_email" label="Mobile or Email" />
                    <q-input v-model="newAccount.password" label="Password" />
                    <q-input v-model="newAccount.user_role" label="Role" />
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn label="Cancel" color="negative" v-close-popup />
                    <q-btn :label="editMode ? 'Edit Account' : 'Add Account'" :color="editMode ? 'primary' : 'positive'"
                        @click="addOrEditAccount" />
                </q-card-actions>
            </q-card>
        </q-dialog>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';

const columns = [
    { name: 'firstname', label: 'First Name', field: 'firstname', align: 'left', sortable: true },
    { name: 'lastname', label: 'Last Name', field: 'lastname', align: 'left', sortable: true },
    { name: 'mobile_or_email', label: 'Mobile or Email', field: 'mobile_or_email', align: 'left', sortable: true },
    // { name: 'password', label: 'Password', field: 'password', align: 'left', sortable: true },
    { name: 'user_role', label: 'User Role', field: 'user_role', align: 'left', sortable: true },
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
const addAccountDialog = ref(false);
const newAccount = ref({
    firstname: '',
    lastname: '',
    mobile_or_email: '',
    password: '',
    user_role: '',
});


const openAddAccountDialog = async () => {
    // Reset the newSection object when opening the dialog
    editMode.value = false;
    // Show the dialog
    addAccountDialog.value = true;
    newAccount.value = {
        firstname: '',
        lastname: '',
        mobile_or_email: '',
        password: '',
        user_role: '',
    };

};



// Define the created lifecycle hook
onMounted(async () => {
    try {
        const response = await axios.get('getaccount');
        // Filter the data to keep only entries with event_type "WLA"
        tableData.value = response.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});


const editAccount = async (account) => {
    try {
        // Set to "Edit" mode

        // Open the addSectionDialog in "Edit" mode
        openAddAccountDialog();

        // Update the newSection object with the selected section's data
        newAccount.value = { ...account };

        editMode.value = true;
        // Note: You may need to adjust the API endpoint based on your actual implementation
    } catch (error) {a
        console.error('Error fetching section data for editing:', error);
    }
};



const deleteAccount = async (account) => {
    try {
        // Call your API endpoint to delete a coach
        await axios.delete(`deleteaccount/${account.id}`);
        // Remove the deleted coach from the tableData
        tableData.value = tableData.value.filter(item => item.id !== account.id);
    } catch (error) {
        console.error('Error deleting coach:', error);
    }
};


const addOrEditAccount = async () => {
    try {
        if (editMode.value) {
            // Call your API endpoint to update a coach
            await axios.put(`updateaccount/${newAccount.value.id}`, newAccount.value);
        } else {
            // Call your API endpoint to add a section
            await axios.post('addaccount', newAccount.value);
        }

        // Refresh the section data after adding/editing a section
        const response = await axios.get('getaccount');
        tableData.value = response.data;

        // Close the dialog after successfully adding/editing a section
        addAccountDialog.value = false;
    } catch (error) {
        console.error(`Error ${editMode.value ? 'editing' : 'adding'}account :`, error);
    }
};

</script>
<style lang="sass">
.my-sticky-last-column-table
  /* specifying max-width so the example can
    highlight the sticky column on any browser window */

  thead tr:last-child th:last-child
    /* bg color is important for th; just specify one */

  td:last-child

  th:last-child,
  td:last-child
    position: sticky
    right: 0
    z-index: 1
</style>