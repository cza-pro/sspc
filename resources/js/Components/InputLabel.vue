<script setup>
defineProps(['value', 'custom_class', 'is_required']);
</script>

<template>
    <label 
        :class="custom_class"
        class="block font-medium text-sm text-gray-700">
        <span v-if="is_required" class="font-medium text-red-600 dark:text-red-500 mr-1">*</span>
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
