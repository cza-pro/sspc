<script setup>
import { mdiCog } from "@mdi/js";
import CardBox from "@/Components/CardBox.vue";
import NumberDynamic from "@/Components/NumberDynamic.vue";
import BaseIcon from "@/Components/BaseIcon.vue";
import BaseLevel from "@/Components/BaseLevel.vue";
import PillTagTrend from "@/Components/PillTagTrend.vue";
import BaseButton from "@/Components/BaseButton.vue";

defineProps({
  number: {
    type: Number,
    default: 0,
  },
  icon: {
    type: String,
    default: null,
  },
  prefix: {
    type: String,
    default: null,
  },
  suffix: {
    type: String,
    default: null,
  },
  label: {
    type: String,
    default: null,
  },
  color: {
    type: String,
    default: null,
  },
  trend: {
    type: String,
    default: null,
  },
  trendType: {
    type: String,
    default: null,
  },
});
</script>

<template>
  <CardBox>
    <BaseLevel v-if="trend" class="mb-3" mobile>
      <PillTagTrend :trend="trend" :trend-type="trendType" small />
      <BaseButton
        :icon="mdiCog"
        icon-w="w-4"
        icon-h="h-4"
        color="lightDark"
        small
      />
    </BaseLevel>
    <BaseLevel mobile>
      <div>
        <h3 class="text-sm leading-tight text-gray-500 dark:text-slate-400">
          {{ label }}
        </h3>
        <div class=" flex w-full">
          <div class=" flex-none w-24 text-3xl pt-4 font-semibold">
            <NumberDynamic :value="number" :prefix="prefix" :suffix="suffix" />
          </div>
          <BaseIcon
            v-if="icon"
            :path="icon"
            size="40"
            w=""
            h="h-16"
            :class="color"
          />
        </div>
       
      </div>
     
    </BaseLevel>
  </CardBox>
</template>
