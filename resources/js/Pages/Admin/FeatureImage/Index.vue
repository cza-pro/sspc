<script setup>
import { ref, watch } from 'vue';
import { mdiFile } from '@mdi/js';
import toast from "@/Stores/toast";
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
import FeatureImageTable from './Components/FeatureImageTable.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import CardBox from "@/Components/CardBox.vue";
import PictureCollection from "../../../Components/PictureCollection.vue";
import MySelector from "../../../Components/MySelector.vue";
import moment from 'moment';

const props = defineProps({
  feature_images: {
    type: Object,
    default: {}
  }

})

const addForm = useForm({
  feature_image: ''
});


// const isAddModalActive = ref(false);
const isLoading = ref(false);
const featureUploadModal = ref(false);

// const confirmAdd = () => {
//   isAddModalActive.value = true;
//    addForm.reset();

// }


// const closeAddModal = () => {
//   isAddModalActive.value = false;
// }


// const closeCloseModal = () => {
//   isCloseModalActive.value = false;
// }

const closeFeatureUpload = () => {
  featureUploadModal.value = false;
};


const createFeatureImageFunc = () => {
  addForm.post(route('admin.feature_image.create'), {
    preserveScroll: true,
    preserveState: true,
    onStart: () => {
        isLoading.value = true;
    },
    onSuccess: () => {
       closeFeatureUpload();
        addForm.reset();
       toast.add({
          message: usePage().props.toast.message
       });
    },
    onError: () => {
       addForm.reset(),
       toast.add({
          message: usePage().props.toast.message
       });
       closeFeatureUpload()
    }
  })
}


</script>

<template>
  <!-- <Head title="Feature Image" /> -->

     <!-- <SectionMain> -->

    <!-- Create Subject Modal Box -->
        <!-- <MediumCardBoxModal v-model="isAddModalActive" title="Add Subject">

            <div class="mt-6">
                <InputLabel for="feature_image" value="Feature Image" />
                <input type="file" @input="addForm.feature_image = $event.target.files[0]" />

                <InputError :message="addForm.errors.feature_image" class="mt-2" />
            </div>


            <div class="flex justify-end pt-6">
                <SecondaryButton @click="closeAddModal"> Cancel </SecondaryButton>
                <PrimaryButton class="ml-3" @click="createFeature" :class="{ 'opacity-25': addForm.processing }" :disabled="addForm.processing">
                    Confirm
                </PrimaryButton>
            </div>
        </MediumCardBoxModal> -->


    <!-- Create Feature Button -->
        <!-- <BaseButton
            label="Add"
            color="contrast"
            small
            rounded-full
            @click.prevent="confirmAdd"
        />

          <div class="min-w-full mx-auto max-w-7xl sm:px-6 lg:px-8">

              <CardBox has-table>
                  <FeatureImageTable
                    :feature_images="props.feature_images"
                  />
              </CardBox>
           </div>
     </SectionMain> -->



<div class="photo-content">
    <div class="left-content">
      <PictureCollection @menu-manage="menuManage" />
    </div>
    <div class="right-content">

        <div class="btn-div">
          <div class="btn-css" @click="featureUploadModal = true">
            <img src="/images/admin/img-icon.png" alt="upload" class="upload-img">
            <p class="upload-txt">上傳圖片</p>
          </div>
        </div>

        <FeatureImageTable
            :feature_images="props.feature_images"
        />

    </div>

    <div v-if="featureUploadModal" class="featureModal">
      <div class="modal-confirm-content">
        <span class="confirmation-close" @click="closeFeatureUpload">&times;</span>
        <div class="file-div">
          <p class="selectFile">選擇檔案
            <input type="file" @input="addForm.feature_image = $event.target.files[0]" />

            <InputError :message="addForm.errors.feature_image" class="mt-2" />
          </p>
        </div>
        <p class="f1name">檔案名稱：</p>
        <div class="file-div">
          <button class="select1File" @click="createFeatureImageFunc">確認上傳 </button>
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
  .text-disable {
    color: red
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
