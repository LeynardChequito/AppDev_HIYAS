<template>
    <div class="student-details">
      <h2>{{ student.firstname }} {{ student.lastname }}'s Profile</h2>
      
      <div class="profile-section">
        <img v-if="student.avatar" :src="student.avatar" alt="Student Avatar" class="avatar" />
        <div class="info-section">
          <div>
            <strong>First Name:</strong> {{ student.firstname }}
          </div>
          <div>
            <strong>Last Name:</strong> {{ student.lastname }}
          </div>
          <div>
            <strong>Age:</strong> {{ student.age }}
          </div>
          <div>
            <strong>Birthday:</strong> {{ student.birthday }}
          </div>
          <div>
            <strong>Gender:</strong> {{ student.gender }}
          </div>
          <div>
            <strong>Address:</strong> {{ student.address }}
          </div>
          <div>
            <strong>Contact Info:</strong> {{ student.contact_info }}
          </div>
          <div>
            <strong>Parent/Guardian:</strong> {{ student.parent_guardian }}
          </div>
          <!-- Add other details as needed -->
        </div>
      </div>
  
      <!-- Add more sections for other details such as education, activities, etc. -->
  
    </div>
  </template>
  
  <style scoped>
  .student-details {
    max-width: 600px;
    margin: auto;
  }
  
  .profile-section {
    display: flex;
    align-items: center;
  }
  
  .avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
  }
  </style>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRoute } from 'vue-router';
  
  const route = useRoute();
  const student = ref({});
  
  onMounted(async () => {
    const studentId = route.params.id;
  
    try {
      const response = await axios.get(`getstudentdata/${studentId}`);
      student.value = response.data;
    } catch (error) {
      console.error('Error fetching student details:', error);
    }
  });
  </script>
  