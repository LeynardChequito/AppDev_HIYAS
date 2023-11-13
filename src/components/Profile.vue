<template>
    <div class="q-pa-md row items-start q-gutter-md one col-12 justify-center">
      <div v-for="profile in profiles" :key="profile.id">
        <q-card class="my-card">
          <q-card-section>
            <text-caption><b>Name: </b>{{ profile.name }}</text-caption>
            <br>
            <text-body2><b>Age: </b>{{ profile.age }}</text-body2><br>
            <br>
            <text-caption><b>Gender: </b>{{ profile.gender }}</text-caption>
            <br>
            <text-body2><b>Address: </b>{{ profile.address }}</text-body2><br>
            <br>
            <text-body2><b>Phone: </b>{{ profile.phone }}</text-body2><br>
            <br>
            <text-caption><b>Birthday: </b>{{ profile.birthday }}</text-caption>
            <br>
            <text-body2><b>date_hired: </b>{{ profile.date_hired }}</text-body2><br>
            <br>
            <text-caption><b>Coach_id: </b>{{ profile.coach_id}}</text-caption>
            <br>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        profiles: [
          {
            id: 1,
            name: 'kas',
            age: '21',
            gender: 'female',
            address: 'Lazareto',
            phone: '0999',
            birthday: 'august 6',
            datedhired: 'aaaa',
            coachid: 'f2',
          },
          
        ],
      };
    },
  };
  </script>
  
  <style>
  .my-card {
    width: 300px;
    margin: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    border-radius: 8px;
    overflow: hidden;
  }
  
  .my-card:hover {
    transform: scale(1.05);
  }
  
  .q-card-section {
    padding: 16px;
  }
  
  .text-caption,
  .text-body2 {
    color: #333;
  }
  
  .text-caption {
    font-weight: bold;
    margin-bottom: 8px;
    font-size: 16px;
  }
  
  .text-body2 {
    margin-bottom: 16px;
  }
  
  .text-center {
    display: flex;
    justify-content: center;
    margin-top: 16px;
  }
  
  .q-btn {
    background-color: #4caf50;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
  }
  
  .q-btn:hover {
    background-color: #388e3c;
  }
  </style>
  
  