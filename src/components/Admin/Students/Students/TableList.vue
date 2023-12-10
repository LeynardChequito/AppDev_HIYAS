<template>
    <div>
        <div class="row col-12 justify-end">
            <q-btn @click="openAddStudentDialog" color="positive" label="Add Student" class="q-my-md" />
        </div>
        <q-table title="" :rows="tableData" :columns="columns" row-key="name" class="my-sticky-last-column-table">
            <template #body-cell-actions="props">
                <q-td :props="props">
                    <q-btn flat round icon="edit" @click="editStudent(props.row)" />
                    <q-btn flat round icon="delete" @click="deleteStudent(props.row)" color="negative" />
                </q-td>
            </template>
        </q-table>

        <q-dialog v-model="addStudentDialog" position="standard">
            <q-card>
                <q-card-section>
                    <q-card-title class="text-h6">Student Data</q-card-title>

                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newStudent.firstname" label="First Name" />
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input v-model="newStudent.lastname" label="Last Name" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newStudent.age" label="Age" />
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input v-model="newStudent.birthday" label="Birthday" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newStudent.gender" label="Gender" />
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input v-model="newStudent.address" label="Address" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newStudent.contact_info" label="Contact Info" />
                        </div>
                        <div class="col-6 q-pr-xs">
                            <q-select v-model="newStudent.parent_guardian" :options="parentGuardianOptions"
                                label="Parent/Guardian" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 q-pl-xs">
                            <q-select v-model="newStudent.coach" :options="coachOptions" label="Coach" />
                        </div>
                        <div class="col-6 q-pr-xs">
                            <q-select v-model="newStudent.section" :options="sectionOptions" label="Section" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newStudent.sponsor" label="Sponsor" />
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input v-model="newStudent.id_number" label="ID Number" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newStudent.school" label="School" />
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input v-model="newStudent.grade_level" label="Grade Level" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 q-pr-xs">
                            <q-input v-model="newStudent.fam_number" label="Number in Family" />
                        </div>
                        <div class="col-6 q-pl-xs">
                            <q-input v-model="newStudent.staff" label="Staff" />
                        </div>
                    </div>

                </q-card-section>


                <q-card-actions align="right">
                    <q-btn label="Cancel" color="negative" v-close-popup />
                    <q-btn :label="editMode ? 'Edit Student' : 'Add Student'" :color="editMode ? 'primary' : 'positive'"
                        @click="addOrEditStudent" />
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
    { name: 'gender', label: 'Gender', field: 'gender', align: 'left', sortable: true },
    { name: 'address', label: 'Address', field: 'address', align: 'left', sortable: true },
    { name: 'contact_info', label: 'Contact Info', field: 'contact_info', align: 'left', sortable: true },
    { name: 'parent_guardian', label: 'Parent/Guardian', field: 'parent_guardian', align: 'left', sortable: true },
    { name: 'coach', label: 'Coach', field: 'coach', align: 'left', sortable: true },
    { name: 'section', label: 'Section', field: 'section', align: 'left', sortable: true },
    { name: 'sponsor', label: 'Sponsor', field: 'sponsor', align: 'left', sortable: true },
    { name: 'id_number', label: 'ID Number', field: 'id_number', align: 'left', sortable: true },
    { name: 'school', label: 'School', field: 'school', align: 'left', sortable: true },
    { name: 'grade_level', label: 'Grade Level', field: 'grade_level', align: 'left', sortable: true },
    { name: 'fam_number', label: 'Number in Family', field: 'fam', align: 'center', sortable: true },
    { name: 'staff', label: 'Staff', field: 'staff', align: 'left', sortable: true },
    {
        name: 'actions',
        label: 'Actions',
        field: 'actions',
        align: 'center',
        sortable: false,
        bodySlot: 'actions',
    },
];

const parentGuardianOptions = ref([]);
const coachOptions = ref([]);
const sectionOptions = ref([]);
const editMode = ref(false);

const tableData = ref([]);
const addStudentDialog = ref(false);
const newStudent = ref({
    firstname: '',
    lastname: '',
    age: '',
    birthday: '',
    gender: '',
    address: '',
    contact_info: '',
    parent_guardian: '',
    coach: '',
    section: '',
    sponsor: '',
    id_number: '',
    school: '',
    grade_level: '',
    fam_number: '',
    staff: '',
});


const openAddStudentDialog = async () => {
    // Reset the newSection object when opening the dialog
    editMode.value = false;
    // Show the dialog
    addStudentDialog.value = true;
    newStudent.value = {
        firstname: '',
        lastname: '',
        age: '',
        birthday: '',
        gender: '',
        address: '',
        contact_info: '',
        parent_guardian: '',
        coach: '',
        section: '',
        sponsor: '',
        id_number: '',
        school: '',
        grade_level: '',
        fam_number: '',
        staff: '',
    };
    axios.get('getcoachdata')
        .then(response => {
            coachOptions.value = response.data.map(coach => ({
                label: `${coach.firstname} ${coach.lastname}`,
                value: coach.id,
            }));

        })
        .catch(error => {
            console.error('Error fetching coach data:', error);
        });

    axios.get('getsection')
        .then(response => {
            sectionOptions.value = response.data.map(section => ({
                label: `${section.name}`,
                value: section.id,
            }));

        })
        .catch(error => {
            console.error('Error fetching coach data:', error);
        });

    axios.get('getparent')
        .then(response => {
            parentGuardianOptions.value = response.data.map(parent => ({
                label: `${parent.firstname} ${parent.lastname}`,
                value: parent.id,
            }));

        })
        .catch(error => {
            console.error('Error fetching coach data:', error);
        });
};



// Define the created lifecycle hook
onMounted(async () => {
    try {
        const response = await axios.get('getstudentdata');
        // Filter the data to keep only entries with event_type "WLA"
        tableData.value = response.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});


const editStudent = async (student) => {
    try {
        // Set to "Edit" mode

        // Open the addSectionDialog in "Edit" mode
        openAddStudentDialog();

        // Update the newSection object with the selected section's data
        newStudent.value = { ...student };

        editMode.value = true;
        // Note: You may need to adjust the API endpoint based on your actual implementation
    } catch (error) {
        console.error('Error fetching section data for editing:', error);
    }
};



const deleteStudent = async (student) => {
    try {
        // Call your API endpoint to delete a coach
        await axios.delete(`deletestudent/${student.id}`);
        // Remove the deleted coach from the tableData
        tableData.value = tableData.value.filter(item => item.id !== student.id);
    } catch (error) {
        console.error('Error deleting coach:', error);
    }
};


const addOrEditStudent = async () => {
    try {
        if (editMode.value) {
            // Call your API endpoint to update a coach
            await axios.put(`updatestudent/${newStudent.value.id}`, newStudent.value);
            console.log('eto');

        } else {
            // Call your API endpoint to add a section
            await axios.post('addstudent', newStudent.value);
        }

        // Refresh the section data after adding/editing a section
        const response = await axios.get('getstudentdata');
        tableData.value = response.data;

        // Close the dialog after successfully adding/editing a section
        addStudentDialog.value = false;
    } catch (error) {
        console.error(`Error ${editMode.value ? 'editing' : 'adding'} Student:`, error);
    }
};

</script>

<style lang="sass">
.my-sticky-last-column-table
  /* specifying max-width so the example can
    highlight the sticky column on any browser window */

  thead tr:last-child th:last-child
  background-color: white

    /* bg color is important for th; just specify one */

  td:last-child
    background-color: white

  th:last-child,
  td:last-child
    position: sticky
    background-color: white
    right: 0
    z-index: 1
</style>