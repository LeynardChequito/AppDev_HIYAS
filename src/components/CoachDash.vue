<template>
    <div>
      <q-drawer
        v-model="drawer"
        show-if-above
        :mini="miniState"
        @mouseover="miniState = false"
        @mouseout="miniState = true"
        mini-to-overlay
        :width="200"
        :breakpoint="500"
        bordered
        :class="$q.dark.isActive ? 'bg-grey-9' : 'bg-grey-3'"
      >
        <q-scroll-area class="fit" :horizontal-thumb-style="{ opacity: 0 }">
          <q-list padding>
            <q-item v-for="item in menuItems" :key="item.route" @click="goToRoute(item.route)" clickable v-ripple>
              <q-item-section avatar>
                <q-icon :name="item.icon" />
              </q-item-section>
              <q-item-section>{{ item.label }}</q-item-section>
            </q-item>
          </q-list>
        </q-scroll-area>
      </q-drawer>
  
     
  
      <div class="q-pa-md">
        <q-drawer
          class="text-black q-gutter-md"
          flat
          bordered
          title="Grades"
          
          :columns="columns"
          row-key="grades"
        />
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  
  const columns = [
    {
      name: 'name',
      required: true,
      label: 'Name of Students',
      align: 'left',
      field: 'name',
      format: val => `${val}`,
      sortable: true,
    },
    {
      name: 'Age',
      align: 'center',
      label: 'Age',
      field: 'Age',
      sortable: true,
    },
    {
      name: 'Address',
      label: 'Address',
      field: 'Address',
      sortable: true,
    },
   
  ];
  
  
  export default {
    setup() {
      const router = useRouter();
  
      const menuItems = [
        { route: 'dashboard', icon: 'child_care', label: 'Dashboard' },
        { route: 'notifications', icon: 'family_restroom', label: 'Notifications' },
        { route: 'events', icon: 'event', label: 'Events' },
        { route: 'announcements', icon: 'campaign', label: 'Announcements' },
      ];
  
      const goToRoute = route => {
        router.push(`/${route}`);
      };
  
      return {
        drawer: ref(false),
        miniState: ref(true),
        goToRoute,
        menuItems,
        columns,
        
      };
    },
  };
  </script>
  
  <style lang="sass">
  .my-sticky-header-table
    height: 310px
  
    .q-table__top,
    .q-table__bottom,
    thead tr:first-child th
      background-color: #00b4ff
  
    thead tr th
      position: sticky
      z-index: 1
    thead tr:first-child th
      top: 0
  
    &.q-table--loading thead tr:last-child th
      top: 48px
  
    tbody
      scroll-margin-top: 48px
  </style>
  