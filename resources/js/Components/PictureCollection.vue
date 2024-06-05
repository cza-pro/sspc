<script setup>

import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";

const props = defineProps({
  canLogin: {
      type: Boolean,
  },
  canRegister: {
      type: Boolean,
  },
  photos: {
    type: Object,
    default: {},
  },
  filters: {
    type: Object,
    default: {},
  },
});

const statusRef = ref("");


</script>

<template>
  <div class="picture-collection">
    <p class="collection-title">南一國中社會圖輯網</p>
    <div class="btn-block">
      <p class="picture-management activecss">圖片管理</p>
      <p class="picture-management">精選圖片管理</p>
      <p class="picture-management">編輯篩選器</p>
    </div>
  </div>
</template>
<style lang="scss" scopee>
  .picture-collection {
    border: 1px solid #D7D7D7;
    padding: 1rem;
    .collection-title {
      font-weight: 700;
      font-size: 20px;
      color: #FA9559;
      padding-bottom: 10px;
      border-bottom: 1px solid #DADADA;
    }
    .btn-block {
      padding-top: 1rem;
      
      .picture-management, .feature-management, .filter-management {
        font-weight: 400;
        font-size: 20px;
        border-radius: 6px;
        text-align: center;
        height: 48px;
        line-height: 48px;
        margin-bottom: 10px;
        color: #392F26;
        background: #FFD6A7;
      }
      .activecss {
        color: #FFF;
        background: #FF8A00;
      }
    }
  }
</style>
