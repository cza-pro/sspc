<script setup>
import AsideMenuLayer from "@/Components/AsideMenuLayer.vue";
import OverlayLayer from "@/Components/OverlayLayer.vue";
import { computed } from "vue";

const props = defineProps({
  menu: {
    type: Array,
    default: [],
    required: true,
  },
  isAsideMobileExpanded: Boolean,
  isAsideLgActive: Boolean,
});

const emit = defineEmits(["menu-click", "aside-lg-close-click"]);

const menuClick = (event, item) => {
  emit("menu-click", event, item);
};

const asideLgCloseClick = (event) => {
  emit("aside-lg-close-click", event);
};

const menuComputed = computed( () => props.menu)
</script>

<template>
  <AsideMenuLayer
    :menu="menuComputed"
    :class="[
      isAsideMobileExpanded ? 'left-0' : '-left-60 lg:left-0',
      { 'lg:hidden min-[1250px]:flex': !isAsideLgActive },
    ]"
    @menu-click="menuClick"
    @aside-lg-close-click="asideLgCloseClick"
  />
  <OverlayLayer
    v-show="isAsideLgActive"
    z-index="z-30"
    @overlay-click="asideLgCloseClick"
  />
</template>
