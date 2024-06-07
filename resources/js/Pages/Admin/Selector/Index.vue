<script setup>
import { ref, watch } from 'vue';
import { mdiFile } from '@mdi/js';
import debounce from 'lodash/debounce';
import VueMultiselect from 'vue-multiselect';
import { Head, router, useForm, Link } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import BaseButton from '@/Components/BaseButton.vue';
import InputError from '@/Components/InputError.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SectionMain from '@/Components/SectionMain.vue';
import MediumCardBoxModal from '@/Components/MediumCardBoxModal.vue';
import SubjectTable from './Components/SubjectTable.vue';
import GradeTable from './Components/GradeTable.vue';
import TopicTable from './Components/TopicTable.vue';
// import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import CardBox from "@/Components/CardBox.vue";

import PictureCollection from "../../../Components/PictureCollection.vue";

const props = defineProps({
  subjects: {
    type: Object,
    default: {}
  },
  grades: {
    type: Object,
    default: {}
  },
  topics: {
    type: Object,
    default: {}
  }

})

const currentActive = ref('editFilter')
const newGrade = ref('四年級')
const grade = ref('')

</script>

<template>
  <Head title="Selector" />

  <!-- <SectionMain>
      <div class="min-w-full mx-auto max-w-7xl sm:px-6 lg:px-8">

          <CardBox has-table>
              <SubjectTable
                :subjects="props.subjects"
              />
          </CardBox>
        </div>
  </SectionMain>

  <SectionMain>
      <div class="min-w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
          <CardBox has-table>
              <GradeTable
                :grades="props.grades"
              />
          </CardBox>
        </div>
  </SectionMain>

  <SectionMain>
      <div class="min-w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
          <CardBox has-table>
              <TopicTable
                :topics="props.topics"
              />
          </CardBox>
        </div>
  </SectionMain> -->

  <div class="photo-content">
    <div class="left-content">
      <PictureCollection currentActive="editFilter" />
    </div>
    <div class="right-content">
      <div>

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

    width: 377px;
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
  .grade-text {
    font-weight: 700;
    font-size: 20px;
    color: #392F26;
    margin-bottom: 4rem;
  }
  .btn-btn {
    display: flex;
    justify-content: center;
    margin-top: 6rem;
  }
  .grade-btn {
    font-weight: 700;
    font-size: 1rem;
    color: #FFF;
    width: 135px;
    height: 36px;
    line-height: 36px;
    background: #000;
    border-radius: 6px;
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
    .gradecss {
      height: 36px;
      border: none;
      border-radius: 12px;
      font-weight: 400;
      font-size: 20px;
      color: #392F26;
    }
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
  .f1name {
    font-weight: 400;
    font-size: 1rem;
    color: #392F26;
    text-align: left;
    margin: 1rem 0 2rem;
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
