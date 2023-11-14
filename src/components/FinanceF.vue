<template>
    <div class="q-gutter-md row items-start justify-end q-pa-sm">
        <q-select filled v-model="selectedTimeframe" :options="timeframeOptions" label="Filter" style="width: 250px">
            <template v-slot:append>
                <q-icon v-if="model !== null" class="cursor-pointer" name="clear" @click.stop.prevent="single = null" />
            </template>
        </q-select>
    </div>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: String,
      required: true,
    },
    'onUpdate:modelValue': {
      type: Function,
      required: true,
    },
  },
  data() {
    return {
      selectedTimeframe: this.modelValue,
      timeframeOptions: ['weekly', 'monthly', 'quarterly', 'yearly'],
    };
  },
  watch: {
    selectedTimeframe() {
      this.$emit('update:modelValue', this.selectedTimeframe);
    },
  },
};
</script>