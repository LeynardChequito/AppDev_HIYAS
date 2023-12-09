<template>
    <div>
        <div class="row col-12 justify-end">
            <q-btn @click="openAddParentDialog" color="positive" label="Add Parent" class="q-my-md" />
        </div>
        <q-table :rows="tableData" :columns="columns" row-key="name" class="my-sticky-last-column-table">
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
import { ref, onMounted, defineProps, defineEmits } from 'vue';

const props = defineProps(['tableData']);  // Add any other props you might be using
const emits = defineEmits(['update:tableData']);  // Specify the emitted event

const columns = [
    { name: 'firstname', label: 'First Name', field: 'firstname', align: 'left', sortable: true },
    { name: 'lastname', label: 'Last Name', field: 'lastname', align: 'left', sortable: true },
    { name: 'age',      label: 'Age',       field: 'age',     align: 'left', sortable: true },
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
const addParentDialog = ref(false);
const newParent = ref({
    lastname: '',
    age: '',
    birthday: '',
    firstname: '',
    address: '',
});

const addressOptions = [
    'Balite', 'Baruyan', 'Bayanan I', 'Bayanan II', 'Calero', 'Camilmil', 'Canubing I',
    'Canubing II', 'Guinobatan', 'GulodIbaba East', 'Ibaba West', 'Ilaya', 'Lalud', 'Lazareto',
    'Lumangbayan', 'Masipit', 'Pachoca', 'San Antonio', 'Suqui', 'Tawagan', 'Tawiran', 'Tibag',
];

const openAddParentDialog = () => {
    newParent.value = {
        lastname: '',
        age: '',
        birthday: '',
        firstname: '',
        address: '',
    };
    addParentDialog.value = true;
    editMode.value = false;
};

onMounted(async () => {
    try {
        const response = await axios.get('/getparent');
        console.log(response.data);
        emits('update:tableData', response.data);  // Emit the event to update the prop
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});

const editParent = async (parent) => {
    try {
        openAddParentDialog();
        newParent.value = { ...parent };
        editMode.value = true;
    } catch (error) {
        console.error('Error fetching parent data for editing:', error);
    }
};


const deleteParent = async (parent) => {
    try {
        if (!parent || !parent.id) {
            console.error('Invalid parent data:', parent);
            return;
        }
        await axios.delete(`/deleteparent/${parent.id}`);
        emits('update:tableData', tableData.value.filter(item => item.id !== parent.id));  // Emit the event to update the prop
    } catch (error) {
        console.error('Error deleting parent:', error);
    }
};

const addOrEditParent = async () => {
    try {
        if (editMode.value) {
            await axios.put('/updateparent/${newParent.value.id}', newParent.value);
        } else {
            await axios.post('/addparent', newParent.value);
        }
        const response = await axios.get('/getparent');
        console.log(response.data);
        emits('update:tableData', response.data);  // Emit the event to update the prop
        addParentDialog.value = false;
    } catch (error) {
        console.error(`Error ${editMode.value ? 'editing' : 'adding'} parent:`, error);
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