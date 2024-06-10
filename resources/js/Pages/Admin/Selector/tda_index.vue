<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";
import PictureCollection from "../../../Components/PictureCollection.vue";
import SubjectTable from './Components/SubjectTable.vue';
import SectionMain from '@/Components/SectionMain.vue';
import MediumCardBoxModal from '@/Components/MediumCardBoxModal.vue';
import GradeTable from './Components/GradeTable.vue';
import TopicTable from './Components/TopicTable.vue';
// import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import CardBox from "@/Components/CardBox.vue";

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
    subjects: {
    type: Object,
    default: {}
  },
});

const fname = ref("");
const photoName = ref("");
const photoEditModal = ref(false);
const photoDeleteModal = ref(false);
const photoUploadModal = ref(false);
const addNewLabel = ref(false);
const photoRemoveModal = ref(false);
const featureUploadModal = ref(false);
const closeEdit = () => {
  photoEditModal.value = false;
};
const closeDelete = () => {
  photoDeleteModal.value = false;
};
const closeRemove = () => {
  photoRemoveModal.value = false;
};
const closeUpload = () => {
  photoUploadModal.value = false;
};
const closeNewLbl = () => {
  addNewLabel.value = false;
};
const closeFeatureUpload = () => {
  featureUploadModal.value = false;
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

// const suboptions = [
//   {
//     value: 'Subject1',
//     label: 'Subject1',
//   },
//   {
//     value: 'Subject2',
//     label: 'Subject2',
//   },
//   {
//     value: 'Subject3',
//     label: 'Subject3',
//   }
// ]
// const gradeoptions = [
//   {
//     value: 'Grade1',
//     label: 'Grade1',
//   },
//   {
//     value: 'Grade2',
//     label: 'Grade2',
//   },
//   {
//     value: 'Grade3',
//     label: 'Grade3',
//   }
// ]
// const topicoptions = [
//   {
//     value: 'topic1',
//     label: 'topic1',
//   },
//   {
//     value: 'topic2',
//     label: 'topic2',
//   },
//   {
//     value: 'topic3',
//     label: 'topic3',
//   }
// ]
// const typeoptions = [
//   {
//     value: 'type1',
//     label: 'type1',
//   },
//   {
//     value: 'type2',
//     label: 'type2',
//   },
//   {
//     value: 'type3',
//     label: 'type3',
//   }
// ]
const removeItemsFunc = () => {
  photoRemoveModal.value = false
}

</script>

<template>
  <div class="photo-content">
    <div class="left-content">
      <PictureCollection />
    </div>


    <div class="right-content">
      <div>


        <div class="filter-block">
          <div class="filter-left">
            <p class="subject-section">科目選擇</p>
            <div class="subject-btns">
              <p class="each-btn">歷史</p>
              <p class="each-btn">地理</p>
              <p class="each-btn">公民</p>
              <p class="each-btn">國語</p>
              <p class="each-btn">數學</p>
              <p class="each-btn">英文</p>
              <p class="each-btn">物理</p>
              <p class="each-btn">生物</p>
              <p class="each-btn removeitem">地球科學</p>
            </div>
          </div>
          <div class="filter-right">
            <p class="addnewtag" @click="addNewLabel = true">新增標籤</p>
            <p class="closetag" @click="photoRemoveModal = true">關閉標籤</p>
          </div>
        </div>


        <SubjectTable
        :subjects="props.subjects"
        />


        <div class="filter-block">
          <div class="filter-left">
            <p class="subject-section">年級選擇</p>
            <div class="subject-btns">
              <p class="each-btn">一年級</p>
              <p class="each-btn">二年級</p>
              <p class="each-btn">三年級</p>
            </div>
          </div>
          <div class="filter-right">
            <p class="addnewtag">新增標籤</p>
            <p class="closetag">關閉標籤</p>
          </div>
        </div>


        <div class="filter-block">
          <div class="filter-left">
            <p class="subject-section">知識主題選擇</p>
            <div class="subject-btns">
              <p class="each-btn">項目1</p>
              <p class="each-btn">項目2</p>
              <p class="each-btn">項目3</p>
            </div>
          </div>
          <div class="filter-right">
            <p class="addnewtag">新增標籤</p>
            <p class="closetag">關閉標籤</p>
          </div>
        </div>
      </div>
    </div>



    <div v-if="photoEditModal" class="editModal">
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
    <div v-if="photoDeleteModal" class="editModal">
      <div class="modal-confirm-content">
        <span class="confirmation-close" @click="closeDelete">&times;</span>
        <p class="confirm-text">確定刪除”圖片名稱”？</p>
        <button @click="deleteFunc" class="delete-button">刪除</button>
        <button @click="cancelFunc" class="cancel-button">取消</button>
      </div>
    </div>
    <div v-if="photoUploadModal" class="editModal">
      <div class="modal-confirm-content">
        <span class="confirmation-close" @click="closeUpload">&times;</span>
        <p class="fname">檔案名稱：</p>
        <div class="file-div">
          <p class="selectFile">選擇檔案</p>
        </div>
        <p class="fname">圖片名稱</p>
        <input type="text" v-model="photoName" id="photoName" name="photoName" class="photoName" placeholder="請輸入圖片名稱">
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
    <div v-if="featureUploadModal" class="featureModal">
      <div class="modal-confirm-content">
        <span class="confirmation-close" @click="closeFeatureUpload">&times;</span>
        <div class="file-div">
          <p class="selectFile">選擇檔案</p>
        </div>
        <p class="f1name">檔案名稱：</p>
        <div class="file-div">
          <p class="select1File">確認上傳</p>
        </div>
      </div>
    </div>
    <div v-if="photoRemoveModal" class="removeModal">
      <div class="modal-closelbl-content">
        <span class="confirmation-close" @click="closeRemove">&times;</span>
        <p class="closelbl-text">請選擇欲關閉之標籤</p>
        <p class="sub-selection">科目選擇</p>
        <div class="itemremove-block">
          <div class="filter1-left">
            <div class="subject1-btns">
              <p class="each1-btn">歷史</p>
              <p class="each1-btn">地理</p>
              <p class="each1-btn btn-active">公民</p>
              <p class="each1-btn">國語</p>
              <p class="each1-btn">數學</p>
              <p class="each1-btn">英文</p>
              <p class="each1-btn">物理</p>
              <p class="each1-btn">生物</p>
              <p class="each1-btn">地球科學</p>
            </div>
          </div>
        </div>
        <div class="confirm-div">
          <p class="confirmRemove" @click="removeItemsFunc">確認關閉</p>
        </div>
      </div>
    </div>
    <div v-if="addNewLabel" class="modal">
      <div class="modal-confirm-content">
        <span class="confirmation-close" @click="closeNewLbl">&times;</span>
        <p class="fname">檔案名稱：</p>
        <div class="file-div">
          <p class="selectFile">選擇檔案</p>
        </div>
        <p class="fname">圖片名稱</p>
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
          cursor: pointer;
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
      .filter-block {
        background: #FFD6A7;
        display: flex;
        justify-content: space-between;
        min-height: 160px;
        margin-bottom: 1rem;
        .filter-left {
          padding: 1rem 0 0;
          width: 100%;
          border-right: 1px solid #FFF;
          .subject-section {
            font-weight: 700;
            font-size: 1rem;
            color: #000;
            padding: 0 1rem;
            margin-bottom: 1rem;
          }
          .subject-btns {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            .each-btn {
              font-weight: 400;
              font-size: 1rem;
              color: #000;
              background: #FFF;
              padding: 6px 0;
              border-radius: 12px;
              width: 100px;
              width: calc((100% - 7rem) / 6);
              text-align: center;
              margin-left: 8px;
              margin-right: 8px;
              margin-bottom: 1rem;
            }
            .each-btn:nth-child(6n) {
              margin-right: 1rem;
            }
            .each-btn:nth-child(6n+1) {
              margin-left: 1rem;
            }
            .removeitem {
              color: #EAEAEA;
              background: #C1C1C1;
            }
          }
        }
        .filter-right {
          width: 112px;
          padding: 0 12px;
          display: flex;
          flex-direction: column;
          justify-content: space-evenly;
          .addnewtag {
            font-weight: 700;
            font-size: 1rem;
            color: #FFF;
            padding: 7px;
            border-radius: 6px;
            text-align: center;
            background: #000;
            cursor: pointer;
          }
          .closetag {
            font-weight: 700;
            font-size: 1rem;
            color: #FFF;
            padding: 7px;
            border-radius: 6px;
            text-align: center;
            background: #FF5454;
            cursor: pointer;
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
    // background-color: rgba(0, 0, 0, 0.8);
    // backdrop-filter: blur(4px);
    background-color: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(2px); /* Apply blur effect */
  }
  .editModal {
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
  }
  .removeModal {
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
    background-color: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(4px);
  }
  .featureModal {
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
  }
  .modal-confirm-content, .modal-closelbl-content {
    position: relative;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    text-align: center;

    text-align: center;
    background: #F6C791;
    border-radius: 12px;
    padding: 2.2rem 2rem 1.3rem;

    width: 377px;
  }
  .modal-closelbl-content {
    padding-top: 10px;
    padding-bottom: unset;
    width: 727px;
    height: 290px;
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
  .confirm-text, .closelbl-text {
    font-weight: 400;
    font-size: 24px;
    color: #392F26;
  }
  .sub-selection {
    font-weight: 700;
    font-size: 1rem;
    color: #392F26;
    text-align: left;
  }
  .itemremove-block {
    background: #ECBF8A;
    border-radius: 12px;
    min-height: 138px;
    .filter1-left {
      padding: 1.4rem 0 0;
      width: 100%;
      .subject1-btns {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        .each1-btn {
          font-weight: 400;
          font-size: 1rem;
          color: #000;
          background: #FFF;
          padding: 6px 0;
          border-radius: 12px;
          width: 100px;
          width: calc((100% - 6rem) / 5);
          text-align: center;
          margin-left: 8px;
          margin-right: 8px;
          margin-bottom: 1.3rem;
        }
        .each1-btn:nth-child(5n) {
          margin-right: 1rem;
        }
        .each1-btn:nth-child(5n+1) {
          margin-left: 1rem;
        }
        .btn-active {
          background: #FF5252;
        }
      }
    }
  }
  .confirm-div {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1.4rem;
  }
  .confirmRemove {
    font-weight: 700;
    font-size: 1rem;
    color: #FFF;
    background: #000;
    border-radius: 6px;
    width: 135px;
    text-align: center;
    height: 36px;
    line-height: 36px;
    cursor: pointer;
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
  .file-div {
    display: flex;
    justify-content: center;
  }
  .selectFile, .select1File {
    font-weight: 700;
    font-size: 1rem;
    color: #FFF;
    background: #FF7652;
    width: 135px;
    height: 36px;
    line-height: 36px;
    border-radius: 6px;
  }
  .select1File {
    background: #000;
  }
  .fname {
    font-weight: 400;
    font-size: 1rem;
    color: #392F26;
    text-align: left;
    margin: 1rem 0 3px;
  }
  .f1name {
    font-weight: 400;
    font-size: 1rem;
    color: #392F26;
    text-align: left;
    margin: 1rem 0 2rem;
  }
  .photoName {
    font-weight: 400;
    font-size: 1rem;
    color: #392F26;
    text-align: left;
    margin: 5px 0 3px;
    border: none;
    border-radius: 6px;
    width: 100%;
  }
  .photoName::placeholder {
    font-weight: 400;
    font-size: 20px;
    color: #B1B1B0;
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
