<template>
  <div>
    <div v-for="message in messages" :key="message.id" class="cover">
      {{ message.user }}: {{ message.message }}
    </div>
  </div>
</template>

<script>
export default {
  props: ['messages'],
};
</script>

<style scoped>
.cover{
  background-color: blue;
}
</style>