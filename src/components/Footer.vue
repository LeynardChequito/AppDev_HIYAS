<!-- <template>
    <q-layout view="hHh lpR fFf">
  
      <q-page-container>
        <router-view />
      </q-page-container>
  
      <q-footer bordered class="text-white custom-footer">
        <div>
            Developed in Oriental Mindoro, Philippines.<br />
        Copyright &copy; 2023-2024 HIYAS. All Rights Reserved.
        </div>
      </q-footer>
    </q-layout>
  </template> -->
  
  <template>
    <div class="q-pa-md">
        <q-layout view="lHh lpr lFf" container style="height: 250px" class="">
        
            <q-page-container>
        <router-view />
      </q-page-container>
  
      <q-footer bordered class="text-white custom-footer">
        <div>
            Developed in Oriental Mindoro, Philippines.<br />
        Copyright &copy; 2023-2024 HIYAS. All Rights Reserved.
        </div>
      </q-footer>
    </q-layout>
    </div>
  </template>


  <script>
  export default {
    // Other Vue.js component code
  };
  </script>
  
  <style scoped>
  .custom-footer {
    background-color: rgb(0, 155, 34); /* Change the background color to blue (customize this as needed) */
    color: white; /* Change the text color to white (customize this as needed) */
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    text-align: center;
    padding: 10px 0;
    box-shadow: 0px -2px 5px rgba(0, 0, 0, 0.2); /* Add a subtle shadow for aesthetics */
    /* Add any other custom styling here */
  }
  </style>
  