<script setup>
import { ref, watch, computed, onMounted } from "vue";
import {
  Chart,
  registerables
} from "chart.js";
import ChartDataLabels from 'chartjs-plugin-datalabels'

const props = defineProps({
  data: {
    type: Object,
    required: true,
  },
  type: {
    type: String
  }
});
const root = ref(null);

let chart;

Chart.register(...registerables);

onMounted(() => {
  // console.log('props data', props.data)
  chart = new Chart(root.value, {
    type: props.type,
    data: props.data,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
          position: 'top'
        },
        datalabels: {
          formatter: function (value, context) {
            return '';
          },
        },
        title: {
          display: true,
          text: '၀န်ကြီးဌာန အလိုက်သင်တန်းသား ဦးရေစာရင်း'
        }
      },
    },
  });
});



const chartData = computed(() => props.data);

watch(chartData, (data) => {
  if (chart) {
    chart.data = data;
    chart.update();
  }
});
</script>

<template>
  <canvas ref="root" />
</template>
