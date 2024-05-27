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
  chart = new Chart(root.value, {
    type: props.type,
    data: props.data,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          display: true,
          stacked: true,
        },
        x: {
          display: true,
          stacked: true,
        },
      },
      plugins: {
        legend: {
          display: 'top',
        },
        title: {
          display: true,
          text: "သင်တန်းအလိုက် ကျား / မ ဦးရေ စာရင်း"
        },
        datalabels: {
          formatter: function (value, context) {
            return '';
          },
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
