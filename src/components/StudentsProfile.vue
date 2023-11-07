<template>
    <div class="q-pa-md">
      <q-table
        class="my-sticky-header-table"
        flat bordered
        title="Students"
        :rows="rows"
        :columns="columns"
        row-key="name"
      />
    </div>
  </template>
  
  <script>
  const columns = [
  {
    name: 'name',
    required: true,
    label: 'Name of Students',
    align: 'left',
    field: row => row.name,
    format: val => `${val}`,
    sortable: true
  },
  { 
    name: 'Age', 
    align: 'center', 
    label: 'Age', 
    field: 'Age',
    sortable: true 
  },
  { 
    name: 'Address', 
    label: 'Address', 
    field: 'Address',
    sortable: true
  },
  {
    name: 'Birthday', 
    label: 'Birthday',
    field: 'Birthday',
    
  },
  { 
    name: 'Gender', 
    label: 'Gender', 
    field: 'Gender',
    sortable: true
  },
  {
    name: 'Parent/Guardian',
    label: 'Parent/Guardian',
    field: 'Parent', 
    
  },
  {
    name: 'Relationship',
    label: 'Relationship',
    field: 'Relationship',
  },
  {
    name: 'Contact No.',
    label: 'Contact No.', 
    field: 'Contact',
    
  },
  {
    name: 'Coach',
    label: 'Coach',
    field: 'Coach',
    sortable: true,
    sort: (a, b) => parseInt(a, 10) - parseInt(b, 10)
  },
  {
    name: 'Section',
    label: 'Section',
    field: 'Section',
    sortable: true,
    sort: (a, b) => parseInt(a, 10) - parseInt(b, 10)
  },
  {
    name: 'ID',
    label: 'ID',
    field: 'ID',
  },
  {
    name: 'Sponsor',
    label: 'Sponsor',
    field: 'Sponsor',
  },
  {
    name: 'Staff',
    label: 'Staff',
    field: 'Staff',
  }
]
  
  const rows = [
  {
      name: 'Leynard Chequito',
      Age: 21,
      Address: 'Puerto Galera',
      Birthday: 'December 31, 2002',
      Gender: 'Male',
      Parent: 'Mrs. Chequito',
      Relationship: 'Mother',
      Contact: '09123456789',
      Coach: 'Dyze ',
      Section: '1',
      ID:'1245',
      Sponsor:' Eya',
      Staff:'Tere',
    },
    {
      name: 'Angelica Perez',
      Age: 19,
      Address: 'Pinahan, Naujan',
      Birthday: 'July 17, 2003',
      Gender: 'Female',
      Parent: 'Venus Perez',
      Relationship: 'Mother',
      Contact: '09124638382',
      Coach: 'Kas',
      Section: '2',
      ID:'9872',
      Sponsor:'Dyze',
      Staff:'Cheqs',
    },
    {
      name: 'Kasandra Jurquia',
      Age: 20,
      Address: 'Calapan City',
      Birthday: 'August 20, 2003',
      Gender: 'Female',
      Parent: 'Mrs. Jurqia',
      Relationship: 'Mother',
      Contact: '09152837453',
      Coach: 'Leynard',
      Section: '3',
      ID:'8254',
      Sponsor:'Dyze',
      Staff:'May',
    },
    {
      name: 'Dyze Malaluan',
      Age: 23,
      Address: 'Victoria',
      Birthday: 'December 01, 2000',
      Gender: 'Male',
      Parent: 'Mr. Malaluan',
      Relationship: 'Father',
      Contact: '09167893548',
      Coach: 'Eya',
      Section: '4',
      ID:'9321',
      Sponsor:'Kas',
      Staff:'Leynard',
    },
  ]
  
  export default {
    setup () {
      return {
        columns,
        rows
      }
    }
  }
  </script>
  
  <style lang="sass">
  .my-sticky-header-table
    /* height or max-height is important */
    height: 310px
  
    .q-table__top,
    .q-table__bottom,
    thead tr:first-child th
      /* bg color is important for th; just specify one */
      background-color: #00b4ff
  
    thead tr th
      position: sticky
      z-index: 1
    thead tr:first-child th
      top: 0
  
    /* this is when the loading indicator appears */
    &.q-table--loading thead tr:last-child th
      /* height of all previous header rows */
      top: 48px
  
    /* prevent scrolling behind sticky top row on focus */
    tbody
      /* height of all previous header rows */
      scroll-margin-top: 48px
  </style>