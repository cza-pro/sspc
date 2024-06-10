<script setup>
import { computed, ref ,reactive,onMounted} from 'vue';
import toast from '@/Stores/toast';
import { mdiShape } from '@mdi/js';
import Toggle from '@vueform/toggle';
import VueMultiselect from 'vue-multiselect';
import CardBox from '@/Components/CardBox.vue';
import TextInput from '@/Components/TextInput.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import BaseButton from '@/Components/BaseButton.vue';
import InputError from '@/Components/InputError.vue';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import CardBoxModal from '@/Components/CardBoxModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PaginationLinks from '@/Components/PaginationLinks.vue';
import MediumCardBoxModal from '@/Components/MediumCardBoxModal.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import { faL } from '@fortawesome/free-solid-svg-icons';
import PictureCollection from "../../../../Components/PictureCollection.vue";
import MySelector from "../../../../Components/MySelector.vue";
import moment from 'moment';

const props = defineProps({

  feature_images: {
    type: Object,
    default: {}
  }

})

const photoDeleteModal = ref(false);
const photoRemoveModal = ref(false);
const fea_img = ref();

const closeDelete = () => {
  photoDeleteModal.value = false;
};


const closeRemove = () => {
    photoRemoveModal.value = false;
};

const cancelDelFunc = () => {
  closeDelete();
};

const cancelRevFunc = () => {
  closeRemove();
};

const photoRemoveId = (feature_img) => {
    fea_img.value = feature_img;
    photoRemoveModal.value = true;
}

const photoDeleteId = (feature_image) => {
    fea_img.value = feature_image;
    photoDeleteModal.value = true;
}

const removeFeatureImageFunc = (feature_image) => {
  router.post(
    route("admin.feature_image.remove", {
      feature_image: feature_image,
    }),
    {
      onSuccess: () => {
          toast.add({
            message: "Remove Feature Image!",
        });
        closeRemove();
      },
      onError: () => {
        toast.add({
          message: "Remove failed !",
        });
        closeRemove();
      },
    }
  );
    closeRemove();
};

const deleteFeatureImageFunc = (feature_image) => {
  router.delete(
    route("admin.feature_image.delete", {
      feature_image: feature_image,
    }),
    {
      onSuccess: () => {
          toast.add({
            message: "Remove Feature Image!",
        });
        closeDelete();
      },
      onError: () => {
        toast.add({
          message: "Remove failed !",
        });
        closeDelete();
      },
    }
  );
};

</script>

<template>

<div>
    <div v-for="feature_img in feature_images" :key="feature_img" class="each-block">
        <div class="first-row">
            <p class="datetime-css">建立日期({{moment(String(feature_img.created_at)).format('YYYY/MM/DD/hh:mm')}})</p>
            <div class="available-css">
            <div :class="feature_img.public === 'on' ? 'green-circle' : 'grey-circle'"></div>
            <p class="available-txt">上架中</p>
            </div>
        </div>
        <div class="photo-row">
            <div class="photo-left">
            <img :src="feature_img.feature_photo_url" alt="upload" class="imagecss">
            <div class="photoright-content">
                <p class="photo-info">
                圖片名稱：{{feature_img.name}}
                </p>
                <p class="photo-info">
                圖片格式：{{feature_img.photo_format}}
                </p>
                <p class="photo-info">
                圖片尺寸：{{feature_img.photo_size}}
                </p>
            </div>
            </div>
            <div class="row-data">
            <div class="btn-row">
                <!-- <p class="btn-two" @click="photoRemoveModal = true">下架</p>
                <p class="btn-three" @click="photoDeleteModal = true">刪除</p> -->

                <p class="btn-two" @click="photoRemoveId(feature_img)">下架</p>
                <p class="btn-three" @click="photoDeleteId(feature_img)">刪除</p>
            </div>
            </div>
        </div>

    </div>

    <div v-if="photoRemoveModal" class="editModal">
        <div class="modal-confirm-content">
            <span class="confirmation-close" @click="closeRemove">&times;</span>
            <p class="confirm-text">確定刪除 "{{fea_img.name}}"？</p>
            <button @click="removeFeatureImageFunc(fea_img.id)" class="delete-button">下架</button>
            <button @click="cancelRevFunc" class="cancel-button">取消</button>
        </div>
    </div>

    <div v-if="photoDeleteModal" class="editModal">
        <div class="modal-confirm-content">
            <span class="confirmation-close" @click="closeDelete">&times;</span>
            <p class="confirm-text">確定刪除 "{{fea_img.name}}"？</p>
            <button @click="deleteFeatureImageFunc(fea_img.id)" class="delete-button">刪除</button>
            <button @click="cancelDelFunc" class="cancel-button">取消</button>
        </div>
    </div>
</div>

</template>

<style lang="scss" scoped>
    .grey-circle {
        width: 12px;
        height: 12px;
        border-radius: 6px;
        background: #524f4f;
    }
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

<style src="@vueform/toggle/themes/default.css"></style>
