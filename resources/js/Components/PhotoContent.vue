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
  <div class="home-right-component">
    <div v-if="results.length" class="content-width">
      <p class="right-title">
        搜尋結果
      </p>
      <div v-if="searchName && searchName !== ''">
        <!-- <div v-for="photo in results" :key="photo" class="result-photo"> -->
          <ImageModal
            thumbnailSrc="/images/photo1.png"
            fullImageSrc="/images/photo1.png"
            :photo="photo"
            searchbar="true"
            :results="results"
          />
        <!-- </div> -->
      </div>
      <div v-else>
        <!-- <div v-for="photo in results" :key="photo" class="each-photo"> -->
          <ImageModal
            thumbnailSrc="/images/photo1.png"
            fullImageSrc="/images/photo1.png"
            searchbar="false"
            :results="results"
          />
        <!-- </div> -->
      </div>
    </div>
    <div v-else class="content-width">
      <p class="nodata-title">
        查無此內容：OOXXOOXX
      </p>
      <p class="right-title">
        精選圖片
      </p>
      <div class="photo-block">
        <div v-for="i in 4" :key="i" class="each-photo">
          <!-- <img src="/images/photo1.png" alt="Filter" class="photo-img"> -->
          <ImageModal1
            thumbnailSrc="/images/test-img.png"
            fullImageSrc="/images/test-img.png"
          />
        </div>
      </div>
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
</style>
