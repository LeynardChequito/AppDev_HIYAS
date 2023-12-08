<template>
    <div>
        <div class="row col-12 justify-end">
            <q-btn @click="openAddCoachDialog" color="positive" label="Add Coach" class="q-my-md" />
        </div>
        <q-table title="" :rows="tableData" :columns="columns" row-key="name" class="my-sticky-last-column-table">
            <template #body-cell-actions="props">
                <q-td :props="props">
                    <q-btn flat round icon="edit" @click="editCoach(props.row)" />
                    <q-btn flat round icon="delete" @click="deleteCoach(props.row)" color="negative" />
                </q-td>
            </template>
        </q-table>

        <q-dialog v-model="addCoachDialog" position="standard">
            <q-card class="q-pa-md" style="width: 800px;">
                <q-card-section>
<<<<<<< Updated upstream
                    <q-card-title class="text-h6">Add Coach</q-card-title>
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-6 q-pr-xs"> 
                            <q-input filled v-model="newCoach.firstname" label="First Name"  label-color="black" class="bg-grey-2"/>
                        </div>
                        <div class="col-6 q-pl-xs"> 
                            <q-input filled v-model="newCoach.lastname" label="Last Name"  label-color="black" class="bg-grey-2"/>
                        </div>
                    </div>
                    
                    <div class="row" >
                        <div class="col-6 q-pr-xs">
                            <q-input filled v-model="newCoach.age" label="Age"  label-color="black" class="bg-grey-2"/>
                        </div>
                        <div class="col-6 q-pl-xs"> 
                            <q-input 
                                v-model="newCoach.birthday"
                            label="Birthday"
                                filled
                                mask="date"
                                :rules="['date']"
                                label-color="black"
                                class="bg-grey-1"
                            >
                                <template v-slot:append>
                                <q-icon name="event" class="cursor-pointer">
                                    <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                    <q-date v-model="newCoach.birthday">
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

                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-6 q-pr-xs"> 
                            <q-input filled v-model="newCoach.phone" label="Phone"  label-color="black" class="bg-grey-2"/>
                        </div>
                        <div class="col-6 q-pl-xs"> 
                            <q-select filled
                                v-model="newCoach.gender"
                            label="Gender"
                                :options="[ { label: 'Male', value: 'male' }, { label: 'Female', value: 'female' } ]"
                            label-color="black" class="bg-grey-2"/>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-6 q-pr-xs" style="margin-bottom: 1px;" > 
                            <q-input 
                                v-model="newCoach.date_hired"
                                label="Date Hired"
                                filled
                                mask="date"
                                :rules="['date']"
                                label-color="black"
                                class="bg-grey-1"
                            >
                                <template v-slot:append>
                                <q-icon name="event" class="cursor-pointer">
                                    <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                        <q-date v-model="newCoach.date_hired">
                                            <div class="row items-center justify-end">
                                            <q-btn v-close-popup label="Close" color="primary" flat />
                                            </div>
                                        </q-date>
                                    </q-popup-proxy>
                                </q-icon>
                                </template>
                            </q-input>
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input filled v-model="newCoach.coach_id" label="Coach ID"  label-color="black" class="bg-grey-2"/>
                        </div>
                    </div>

                        <q-select 
                            v-model="newCoach.address"
                            label="Address"
                            :options="addressOptions"
                            :rules="[v => !!v ]"
                        label-color="black" class="bg-grey-2"/>
                        
=======
                    <q-card-title class="text-h6">Coach Data</q-card-title>
                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newCoach.firstname" label="First Name" />
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input v-model="newCoach.lastname" label="Last Name" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newCoach.age" label="Age" />
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input v-model="newCoach.birthday" label="Birthday" mask="date" :rules="['date']">
                                <template v-slot:append>
                                    <q-icon name="event" class="cursor-pointer">
                                        <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                            <q-date v-model="newCoach.birthday">
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

                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newCoach.phone" label="Phone" />
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-select v-model="newCoach.gender" label="Gender"
                                :options="[{ label: 'Male', value: 'Male' }, { label: 'Female', value: 'Female' }]" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newCoach.date_hired" label="Date Hired" filled mask="date" :rules="['date']">
                                <template v-slot:append>
                                    <q-icon name="event" class="cursor-pointer">
                                        <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                            <q-date v-model="newCoach.date_hired">
                                                <div class="row items-center justify-end">
                                                    <q-btn v-close-popup label="Close" color="primary" flat />
                                                </div>
                                            </q-date>
                                        </q-popup-proxy>
                                    </q-icon>
                                </template>
                            </q-input>
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input v-model="newCoach.coach_id" label="Coach ID" />
                        </div>
                    </div>
                    <q-select v-model="newCoach.address" label="Address" :options="addressOptions" :rules="[v => !!v]"
                        dense />
>>>>>>> Stashed changes
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn label="Cancel" color="negative" v-close-popup />
                    <q-btn :label="editMode ? 'Edit Coach' : 'Add Coach'" :color="editMode ? 'primary' : 'positive'"
                        @click="addOrEditCoach" />
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
    { name: 'age', label: 'Age', field: 'age', align: 'left', sortable: true },
    { name: 'birthday', label: 'Birthday', field: 'birthday', align: 'left', sortable: true },
    { name: 'phone', label: 'Phone', field: 'phone', align: 'left', sortable: true },
    { name: 'gender', label: 'Gender', field: 'gender', align: 'left', sortable: true },
    { name: 'date_hired', label: 'Date Hired', field: 'date_hired', align: 'left', sortable: true },
    { name: 'coach_id', label: 'Coach ID', field: 'coach_id', align: 'left', sortable: true },
    { name: 'address', label: 'Address', field: 'address', align: 'left', sortable: true },
    {
        name: 'actions',
        label: 'Actions',
        field: 'actions',
        align: 'center',
        sortable: false,
        // Custom slot for rendering buttons
        bodySlot: 'actions',
    },
];
const editMode = ref(false);
const tableData = ref([]);
const addCoachDialog = ref(false);
const newCoach = ref({
    firstname: '',
    lastname: '',
    age: '',
    birthday: '',
    phone: '',
    gender: '',
    date_hired: '',
    coach_id: '',
    address: '',

});


const addressOptions = [
    'Balite',
    'Baruyan',
    'Bayanan I',
    'Bayanan II',
    'Calero',
    'Camilmil',
    'Canubing I',
    'Canubing II',
    'Guinobatan',
    'GulodIbaba East',
    'Ibaba West',
    'Ilaya',
    'Lalud',
    'Lazareto',
    'Lumangbayan',
    'Masipit',
    'Pachoca',
    'San Antonio',
    'Suqui',
    'Tawagan',
    'Tawiran',
    'Tibag',
];

const openAddCoachDialog = () => {
    // Reset the newCoach object when opening the dialog
    newCoach.value = {
        firstname: '',
        lastname: '',
        age: '',
        birthday: '',
        phone: '',
        gender: '',
        date_hired: '',
        coach_id: '',
        address: '',

        // Reset other fields as needed
    };
    addCoachDialog.value = true;
    editMode.value = false; // Set to "Add" mode by default
};
// Define the created lifecycle hook
onMounted(async () => {
    try {
        const response = await axios.get('getcoachdata');
        // Filter the data to keep only entries with event_type "WLA"
        tableData.value = response.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});

const editCoach = async (coach) => {
    try {
        // Open the addCoachDialog in "Edit" mode
        openAddCoachDialog();

        // Update the newCoach object with the selected coach's data
        newCoach.value = { ...coach };

        // Set to "Edit" mode
        editMode.value = true;

        // Note: You may need to adjust the API endpoint based on your actual implementation
    } catch (error) {
        console.error('Error fetching coach data for editing:', error);
    }
};

const deleteCoach = async (coach) => {
    try {
        // Call your API endpoint to delete a coach
        await axios.delete(`deletecoach/${coach.id}`);
        // Remove the deleted coach from the tableData
        tableData.value = tableData.value.filter(item => item.id !== coach.id);
    } catch (error) {
        console.error('Error deleting coach:', error);
    }
};

const addOrEditCoach = async () => {
    try {
        if (editMode.value) {
            // Call your API endpoint to update a coach
            await axios.put(`updatecoach/${newCoach.value.id}`, newCoach.value);
        } else {
            // Call your API endpoint to add a coach
            await axios.post('addcoach', newCoach.value);
        }

        // Refresh the coach data after adding/editing a coach
        const response = await axios.get('getcoachdata');
        tableData.value = response.data;

        // Close the dialog after successfully adding/editing a coach
        addCoachDialog.value = false;
    } catch (error) {
        console.error(`Error ${editMode.value ? 'editing' : 'adding'} coach:`, error);
    }
};
</script>
    

<style lang="sass">
.my-sticky-last-column-table
  /* specifying max-width so the example can
    highlight the sticky column on any browser window */

  thead tr:last-child th:last-child
    /* bg color is important for th; just specify one */
    background-color: white

  td:last-child
    background-color: white

  th:last-child,
  td:last-child
    position: sticky
    right: 0
    z-index: 1
</style>