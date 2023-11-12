<template>
  <div class="q-pa-md row items-start q-gutter-md">
    <q-card class="my-card">
      <q-card-section class="bg-grey-8 text-white">
        <div class="text-h6 text-center">Our Changing Planet</div>
        <div class="text-subtitle2 text-center">by John Doe</div>
      </q-card-section>

      <q-card-actions vertical align="center">
        <div class="text-h3 text-center">Our Changing Planet</div>
        <div class="text-h3 text-center">by John Doe</div>
      </q-card-actions>
    </q-card>
  </div>
</template>

<script>
export default {
  setup () {
    return {
      lorem: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
    }
  }
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 250px
</style>
