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

const fname = ref("");
const photoEditModal = ref(false);
const photoDeleteModal = ref(false);
const closeEdit = () => {
  photoEditModal.value = false;
};
const closeDelete = () => {
  photoDeleteModal.value = false;
};

const deleteFunc = () => {
  console.log('Deleted')
  closeDelete();
};
const cancelFunc = () => {
  console.log('Cancel')
  closeDelete();
};

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

const subjects = ref('')
const grade = ref('')
const knowledgeTopic = ref('')
const photoType = ref('')

const suboptions = [
  {
    value: 'Subject1',
    label: 'Subject1',
  },
  {
    value: 'Subject2',
    label: 'Subject2',
  },
  {
    value: 'Subject3',
    label: 'Subject3',
  }
]
const gradeoptions = [
  {
    value: 'Grade1',
    label: 'Grade1',
  },
  {
    value: 'Grade2',
    label: 'Grade2',
  },
  {
    value: 'Grade3',
    label: 'Grade3',
  }
]
const topicoptions = [
  {
    value: 'topic1',
    label: 'topic1',
  },
  {
    value: 'topic2',
    label: 'topic2',
  },
  {
    value: 'topic3',
    label: 'topic3',
  }
]
const typeoptions = [
  {
    value: 'type1',
    label: 'type1',
  },
  {
    value: 'type2',
    label: 'type2',
  },
  {
    value: 'type3',
    label: 'type3',
  }
]

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
                <p class="btn-one" @click="photoEditModal = true">編輯</p>
                <p class="btn-two">下架</p>
                <p class="btn-three" @click="photoDeleteModal = true">刪除</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="photoEditModal" class="modal">
      <div class="modal-confirm-content">
        <span class="confirmation-close" @click="closeEdit">&times;</span>
        <img src="/images/photo1.png" alt="upload" class="modal-photo">
        <p class="fname">圖片名稱</p>
        <input type="text" v-model="fname" id="fname" name="fname" class="inputname" placeholder="Name of the photo">
        <div class="selection-block">
          <el-select
            v-model="subjects"
            placeholder="科目"
            size="large"
            style="width: 240px"
            class="elselectwrapper1"
          >
            <el-option
              v-for="item in suboptions"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
          <el-select
            v-model="grade"
            placeholder="年級"
            size="large"
            style="width: 240px"
            class="elselectwrapper2"
          >
            <el-option
              v-for="item in gradeoptions"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </div>
        <div class="selection-block">
          <el-select
            v-model="knowledgeTopic"
            placeholder="知識主題"
            size="large"
            style="width: 240px"
            class="elselectwrapper1"
          >
            <el-option
              v-for="item in topicoptions"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
          <el-select
            v-model="photoType"
            placeholder="圖片類型"
            size="large"
            style="width: 240px"
            class="elselectwrapper2"
          >
            <el-option
              v-for="item in typeoptions"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </div>
        <div class="photoinfo">
          <p>圖片格式：JPG</p>
          <p>圖片尺寸：300x140</p>
          <p>圖片流水號：32130026412320</p>
        </div>
      </div>
    </div>
    <div v-if="photoDeleteModal" class="modal">
      <div class="modal-confirm-content">
        <span class="confirmation-close" @click="closeDelete">&times;</span>
        <p class="confirm-text">確定刪除”圖片名稱”？</p>
        <button @click="deleteFunc" class="delete-button">刪除</button>
        <button @click="cancelFunc" class="cancel-button">取消</button>
      </div>
    </div>
  </div>
</template>
<style>
  .elselectwrapper1 .el-select__wrapper {
    border: 0 solid red !important;
  }
  .elselectwrapper2 .el-select__wrapper {
    border: 0 solid red !important;
  }

  .el-select__suffix {
    background-image: url('/images/admin/admin-dd.png');
    background-size: 100% 100%;
    width: 20px; /* Adjust icon size as needed */
    height: 10px;
  }
  .el-select__caret {
    display: none;
  }
  .el-select__placeholder {
    font-weight: 400;
    font-size: 20px;
    color: #000 !important;
  }
  .el-select {
    width: 50% !important;
    margin: 0;
  }
</style>
<style lang="scss" scoped>
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
  .modal {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(4px); /* Apply blur effect */
  }
  .modal-confirm-content {
    position: relative;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    text-align: center;

    text-align: center;
    background: #F6C791;
    border-radius: 12px;
    padding: 2.2rem 2rem 1.3rem;
  }
  .confirmation-close {
    position: absolute;
    top: -6px;
    right: 13px;
    color: #FFF;
    font-size: 35px;
    cursor: pointer;
  }
  .confirmation-close:hover,
  .confirmation-close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
  }
  .confirm-text {
    font-weight: 400;
    font-size: 24px;
    color: #392F26;
  } 
  .delete-button, .cancel-button {
    margin-top: 25px;
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    width: 100px;
    height: 48px;
    line-height: 24px;
    font-weight: 400;
    font-size: 20px;
    color: #fff;
    cursor: pointer;
  }
  .delete-button {
    background: #FF5F5F;
    margin-right: 12px;
  }
  .cancel-button {
    background-color: #181818;
    margin-left: 12px;
  }
  .modal-photo {
    width: 200px;
    height: 200px;
    margin: auto;
  }
  .fname {
    font-weight: 400;
    font-size: 1rem;
    color: #392F26;
    text-align: left;
    margin: 1rem 0 3px;
  }
  .inputname {
    border: none;
    border-radius: 6px;
    width: 100%;
  }
  .inputname::-ms-input-placeholder { /* Edge 12-18 */
    font-weight: 400;
    font-size: 20px;
    color: #392F26;
  }

  .inputname::placeholder {
    font-weight: 400;
    font-size: 20px;
    color: #392F26;
  }
  .selection-block {
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
  }
  .photoinfo {
    font-weight: 400;
    font-size: 16px;
    color: #392F26;

    text-align: left;
    margin-top: 3rem;
  }
  .elselectwrapper1, .elselectwrapper2 {
    width: 150px !important;
    border-radius: 14px;
  }
  .elselectwrapper1 {
    margin-right: 5px;
  }
  .elselectwrapper2 {
    margin-left: 5px;
  }
</style>
