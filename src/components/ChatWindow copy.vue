

<template>
  <div v-if="user">
    <h2>{{ user.firstname }}</h2>
    <p>Email: {{ user.mobile_or_email }}</p>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      user: null,
      loading: true
    }
  },

  async created() {
    try {
      const response = await axios.get('login')
      this.user = response.data
    } catch (error) {
      console.log(error)
    } finally {
      this.loading = false
    }
  }
}
</script>