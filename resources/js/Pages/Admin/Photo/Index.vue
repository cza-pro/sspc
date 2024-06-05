<script setup>

import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";
import PictureCollection from "../../../Components/PictureCollection.vue";
import MySelector from "../../../Components/MySelector.vue";

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
const results = ref([
  {
    id: 1,
    name: '1',
    title: 'CZA',
    content: 'Content for item 1',
    srcPath: '/images/photo1.png',
    checkCondition: false
  },
  {
    id: 2,
    name: '1',
    title: 'TDA',
    content: 'Content for item 2',
    srcPath: '/images/photo1.png',
    checkCondition: false
  },
  {
    id: 3,
    name: '1',
    title: 'MMM',
    content: 'Content for item 3',
    srcPath: '/images/photo1.png',
    checkCondition: false
  },
  {
    id: 4,
    name: '1',
    title: 'MMLM',
    content: 'Content for item 4',
    srcPath: '/images/photo1.png',
    checkCondition: false
  },
  {
    id: 5,
    name: '1',
    title: 'KT',
    content: 'Content for item 5',
    srcPath: '/images/photo1.png',
    checkCondition: false
  }
]);
const initialSearchQuery = ref('');
const searchName = ref('');


</script>

<template>
  <div class="photo-content">
    <div class="left-content">
      <PictureCollection />
      <MySelector :results="results" :searchName="searchName" />
    </div>
    <div class="right-content">
      <div class="btn-div">
        <div class="btn-css">
          <img src="/images/admin/img-icon.png" alt="upload" class="upload-img">
          <p class="upload-txt">上傳圖片</p>
        </div>
      </div>
      <div>
        <div v-for="i in 2" :key="i" class="each-block">
          <div class="first-row">
            <p class="datetime-css">建立日期(2004/05/06/13:05)</p>
            <div class="available-css">
              <div class="green-circle"></div>
              <p class="available-txt">上架中</p>
            </div>
          </div>
          <div class="photo-row">
            <div class="photo-left">
              <img src="/images/photo1.png" alt="upload" class="imagecss">
              <div class="photoright-content">
                <p class="photo-info">
                  圖片名稱：{{}}Name of the photo
                </p>
                <p class="photo-info">
                  科目：{{}}Subject of this photo belong
                </p>
                <p class="photo-info">
                  年級：{{}}Grade of this photo related to
                </p>
                <p class="photo-info">
                  圖片類型：{{}}type of this photo
                </p>
                <p class="photo-info">
                  圖片格式：{{}}JPG
                </p>
                <p class="photo-info">
                  圖片尺寸：{{}}300x140
                </p>
                <p class="photo-info">
                  圖片流水號：{{}}32130026412320
                </p>
              </div>
            </div>
            <div class="row-data">
              <div class="btn-row">
                <p class="btn-one">編輯</p>
                <p class="btn-two">下架</p>
                <p class="btn-three">刪除</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang="scss" scopee>
  .photo-content {
    display: flex;
    max-width: 1200px;
    margin: 4rem auto;
    .left-content {
      width: 250px;
      margin-right: 2rem;
    }
    .right-content {
      width: calc(100% - 200px);
      .btn-div {
        display: flex;
        justify-content: end;
        .btn-css {
          display: flex;
          align-items: center;
          padding: 10px 1rem;
          background: #FF7652;
          border-radius: 6px;
          .upload-img {
            width: 26px;
          }
          .upload-txt {
            margin-left: 1rem;
            font-weight: 700;
            font-size: 16px;
            color: #FFF;
          }
        }
      }
      .each-block {
        border: 1px solid #D7D7D7;
        margin-top: 10px;
        padding: 1rem;
        .first-row {
          display: flex;
          justify-content: space-between;
          padding-bottom: 1rem;
          .datetime-css {
            font-weight: 400;
            font-size: 16px;
            color: #FA9559;
          }
          .available-css {
            display: flex;
            justify-content: center;
            align-items: center;
            .green-circle {
              width: 12px;
              height: 12px;
              border-radius: 6px;
              background: #2CEE28;
            }
            .available-txt {
              font-weight: 400;
              font-size: 16px;
              color: #000;
              margin-left: 7px;
            }
          }
        }
        .photo-row {
          display: flex;
          justify-content: space-between;
        }
        .photo-left {
          display: flex;
          .imagecss {
            width: 148px;
          }
          .photoright-content {
            width: 100%;
            padding-left: 1rem;
            .photo-info {
              font-weight: 400;
              font-size: 1rem;
              color: #392F26;
              line-height: 1.3;
            }
          }
        }
        .row-data {
          display: flex;
          align-items: flex-end;
          justify-content: space-between;
          .btn-row {
            display: flex;
          }
          .btn-one, .btn-two, .btn-three {
            font-weight: 400;
            font-size: 1rem;
            color: #FFF;
            border-radius: 6px;
            padding: 3px 1rem;
            margin-left: 1rem;
            cursor: pointer;
            background: #F294A5;
          }
          .btn-one {
            background: #2BCF32;
          }
        }
        
        
      }
    }
  }
</style>
