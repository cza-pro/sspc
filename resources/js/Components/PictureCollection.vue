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
  currentActive: {
    type: String
  }
});

const statusRef = ref("");

const emit = defineEmits(['menu-manage']);
const manageFunc = (val) => {
  emit('menu-manage', val);
};

</script>

<template>
  <div class="picture-collection">
    <p class="collection-title">南一國中社會圖輯網</p>
    <div class="btn-block">
      <a href="/admin/photo"><p @click="manageFunc('pictureManage')" :class="currentActive == 'pictureManage' ? 'activecss' : ''" class="picture-management">圖片管理</p></a>
      <a href="/admin/feature-image"><p @click="manageFunc('featureImage')" :class="currentActive == 'featureImage' ? 'activecss' : ''" class="picture-management">精選圖片管理</p></a>
      <a href="/admin/selector"><p @click="manageFunc('editFilter')" :class="currentActive == 'editFilter' ? 'activecss' : ''" class="picture-management">編輯篩選器</p></a>

    </div>
  </div>
</template>
<style lang="scss" scoped>
  .picture-collection {
    border: 1px solid #D7D7D7;
    padding: 1rem;
    border-radius: 6px;
    .collection-title {
      font-weight: 700;
      font-size: 20px;
      color: #FA9559;
      padding-bottom: 10px;
      border-bottom: 1px solid #DADADA;
      text-align: center;
    }
    .btn-block {
      padding-top: 1rem;
      .picture-management {
        font-weight: 400;
        font-size: 20px;
        border-radius: 6px;
        text-align: center;
        height: 48px;
        line-height: 48px;
        margin-bottom: 10px;
        color: #392F26;
        background: #FFD6A7;
        cursor: pointer;
      }
      .activecss {
        color: #FFF;
        background: #FF8A00;
      }
    }
  }
</style>
