<script setup>
import { containerMaxW } from "@/config.js";
import BaseLevel from "@/Components/BaseLevel.vue";
import JustboilLogo from "@/Components/JustboilLogo.vue";

const year = new Date().getFullYear();
</script>

<template>
  <footer class="py-2 px-6 fixed bottom-0" :class="containerMaxW">
    <BaseLevel>
      <div class="text-center md:text-left">
        <b
          >&copy;{{ year }},
          <a href="#" target="_blank">SMS</a>.</b
        >
        <slot />
      </div>
      <div class="md:py-2">
        <!-- <a href="#">
          <JustboilLogo class="w-auto h-8 md:h-6" />
        </a> -->
      </div>
    </BaseLevel>
  </footer>
</template>
