<script setup>
defineProps({
  title: {
    type: String,
    required: true,
  },
  custom_class: {
    type: String,
    default: ''
  }
});
</script>

<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-2xl" :class="custom_class">
      {{ title }}
    </h1>
    <slot />
  </div>
</template>
