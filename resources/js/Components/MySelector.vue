<script setup>
import { computed, ref } from "vue";
import ImageModal from '../Pages/User/Photo/Components/ImageModal.vue';
import ImageModal1 from '../Pages/User/Photo/Components/ImageModal1.vue';

import { defineProps } from 'vue';

// Define props
const props = defineProps({
  results: {
    type: Array,
    required: true
  },
  searchName: {
    type: String,
    required: true
  }
});

const activeNames = ref(['1', '2'])
const checkList = ref([])
const handleChange = (val) => {
  console.log(val)
}
</script>

<template>
  <div class="home-left-component">
    <div class="search-row">
      <div class="filter-div">
        <img src="/images/filter-icon.png" alt="Filter" class="filter-img">
        <p class="filter-text">篩選</p>
      </div>
      <p class="search-btn">
        搜尋
      </p>
    </div>
    
    <div class="demo-collapse">
      <el-collapse v-model="activeNames" @change="handleChange">
        <el-collapse-item title="科目" name="1">

          <el-checkbox-group v-model="checkList" class="check-css">
            <el-checkbox label="地理" value="Value A" class="custom-checkbox" />
            <el-checkbox label="歷史" value="Value B" class="custom-checkbox" />
            <el-checkbox label="公民" value="Value C" class="custom-checkbox" />
          </el-checkbox-group>

        </el-collapse-item>
        <el-collapse-item title="年級" name="2">
          <el-checkbox-group v-model="checkList" class="check-css">
            <el-checkbox label="一年級" value="Value A" class="custom-checkbox" />
            <el-checkbox label="二年級" value="Value B" class="custom-checkbox" />
            <el-checkbox label="三年級" value="Value C" class="custom-checkbox" />
          </el-checkbox-group>
        </el-collapse-item>
        <el-collapse-item title="知識主題" name="3">
          
        </el-collapse-item>
        <el-collapse-item title="圖片類型" name="4">
          
        </el-collapse-item>
      </el-collapse>
    </div>

  </div>
</template>
<style>
  .el-collapse-item__header {
      border-bottom: none !important;
      color: #D0D0D0;
      font-weight: 700;
      font-size: 20px;
      height: 45px;
      line-height: 45px;
  }
  .el-collapse-item__arrow {
      margin: 0 8px 0 auto;
      transition: transform 0.3s;
      font-weight: 300;
      transform: rotate(90deg);
  }
  .el-collapse-item__arrow {
    margin: 0 8px 0 auto;
    transition: transform 0.3s;
    font-weight: 300;
    transform: rotate(90deg);
  }
  .el-collapse-item__arrow {
    font-size: 2rem;
  }
  .el-checkbox:last-of-type {
    margin-right: 30px;
  }
  .el-checkbox__inner {
      width: 24px;
      height: 24px;
      border: 1px solid #B3B3B3;
      border-radius: 6px;
  }
  .el-collapse {
    border-top: 0 solid #333;
  }

  .el-collapse-item {
      border-bottom: 1px solid var(--el-collapse-border-color);
  }
  .el-collapse-item__wrap {
      border-bottom: 0 solid var(--el-collapse-border-color);
  }
  .el-checkbox__inner:after {
    left: 43%;
    top: 28%;
  }
  
  .el-checkbox__input.is-checked .el-checkbox__inner {
    background-color: #00A15D;
    border-color: #00A15D;
  }
  .el-checkbox {
    --el-checkbox-checked-text-color: #00A15D;
  }
</style>
<style scoped>
.demo-collapse {
  margin: 0 0 0 10px;
}
</style>
