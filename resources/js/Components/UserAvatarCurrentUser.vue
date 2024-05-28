<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import UserAvatar from "@/Components/UserAvatar.vue";

const userName = computed(() => usePage().props.auth.user.name);
const userProfile = computed(() => usePage().props.auth.candidate.profile_photo);
</script>

<template>
  <UserAvatar :username="userName" :avatar="userProfile" api="initials">
    <slot />
  </UserAvatar>
</template>