<script setup>

import { Head, Link, router, useForm , usePage} from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";
import PictureCollection from "../../../Components/PictureCollection.vue";
import MySelector from "../../../Components/MySelector.vue";
import SideBar from "../Menu/SideBar.vue";
import moment from 'moment';
import toast from '@/Stores/toast';
import InputError from '@/Components/InputError.vue';
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';


const props = defineProps({
  canLogin: {
      type: Boolean,
  },
  canRegister: {
      type: Boolean,
  },
  menuManage: {
      type: String,
  },
  photos: {
    type: Object,
    default: {},
  },
  subjectss: {
    type: Object,
    default: {},
  },
  gradess: {
    type: Object,
    default: {},
  },
  topicss: {
    type: Object,
    default: {},
  },
  photo_typess: {
    type: Object,
    default: {},
  },
  filters: {
    type: Object,
    default: {},
  },
});

const fname = ref("");
const photoName = ref("");
const photoEditModal = ref(false);
const photoDeleteModal = ref('');
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

const cancelFunc = () => {
  console.log('Cancel')
  closeDelete();
};

const removePhotoCancelFunc = () => {
  console.log('Cancel')
  closeRemove();
};

const statusRef = ref("");

const initialSearchQuery = ref('');
const searchName = ref('');

const subjects = ref('')
const newGrade = ref('四年級')
const grade = ref('')
const knowledgeTopic = ref('')
const photoType = ref('')
const currentActive = ref('pictureManage')
const $toast = useToast();


const menuManage = (val) => {
  currentActive.value = val
}

const removeItemsFunc = () => {
  photoRemoveModal.value = false
}

const photoAddForm = useForm({
    id: '',
    photo_url: '',
    name: '',
    subject_id: '',
    grade_id: '',
    topic_id: '',
    photo_type_id: ''
});



const createPhoto = () => {
  photoAddForm.post(route('admin.photo.create'), {
    preserveState: true,
    onSuccess: () => {
       closeUpload();
        photoAddForm.reset(),
        selectedFile.value = null;
        $toast.success("save photo",{
            message: "Create Photo Successfully!!",
            type: "success",
            position: "top-right",
            duration: 1000 * 10,
            dismissible: true
        });
    },
    onError: () => {
       toast.add({
          message: "erros please try again"
       });
    //    closeUpload()
    }
  })
}

const deleteId = ref('');

const photoDeleteId = (photo) => {
    photoDeleteModal.value = true
    deleteId.value = photo.id
    photoAddForm.name = photo.name;
}

 const deletePhoto = () => {
  router.delete(
    route("admin.photo.delete", {
      photo: deleteId.value,
    }),
    {
      onSuccess: () => {
        $toast.warning("delete photo",{
            message: "Delete Photo Successfully!!",
            type: "warning",
            position: "top-right",
            duration: 1000 * 10,
            dismissible: true
        });
        photoDeleteModal.value = false;
      },
      onError: () => {
        toast.add({
          message: "Delete failed !",
        });
        photoDeleteModal.value = false;
      },
    }
  );
};

const tdatest = ref('')
const selectedFile = ref(null)


const photoEdit = (photo) => {
  photoAddForm.id = photo.id;
  photoAddForm.name = photo.name;
  photoAddForm.subject_id = photo.subject_id;
  photoAddForm.grade_id = photo.grade_id;
  photoAddForm.topic_id = photo.topic_id;
  photoAddForm.photo_type_id = photo.photo_type_id;
  photoAddForm.upload_photo_url = photo.upload_photo_url;
  photoAddForm.photo_format = photo.photo_format;
  photoAddForm.photo_size = photo.photo_size;
  photoAddForm.generate_number = photo.generate_number;



    props.subjectss.forEach(item => {
        if(item.id == photo.subject_id) {
            tdatest.value = item.id
            console.log('heyyyyyyy ', tdatest.value)
        }
    })


  photoEditModal.value = true;

};



const updatePhoto = () => {
  photoAddForm.post(route('admin.photo.update', {
    photo: photoAddForm.id
  }), {
    preserveScroll: true,
    onSuccess: () => {
        $toast.success("update photo",{
            message: "Update Photo Successfully!!",
            type: "success",
            position: "top-right",
            duration: 1000 * 10,
            dismissible: true
        });
      photoAddForm.reset();
      photoEditModal.value = false;
    },
    onError: () => {
      toast.add({
        message: 'Photo update failed !'
      })
      photoAddForm.reset();
    //   photoEditModal.value = false;
    },
    onFinish: () => {
      photoAddForm.reset();
      router.reload('admin.photo.index');
    }
  })

}

const photoRemove = (photo) => {
  photoAddForm.id = photo.id;
  photoAddForm.name = photo.name;
  photoRemoveModal.value = true;

};

const removePhotoFunc = () => {
   photoAddForm.post(route('admin.photo.remove', {
    photo: photoAddForm.id
  }),
    {
      onSuccess: () => {
        $toast.info("remove photo",{
            message: "Remove Photo Successfully!!",
            type: "info",
            position: "top-right",
            duration: 1000 * 10,
            dismissible: true
        });
        photoRemoveModal.value = false;
      },
      onError: () => {
        toast.add({
          message: "Remove failed !",
        });
        photoRemoveModal.value = false;
      },
    }
  );
};

const onFileChange = (event) => {
  selectedFile.value = event.target.files[0];
  photoAddForm.photo_url = selectedFile.value;
}

</script>

<template>
  <Head title="Photo" />
  <div class="photo-content">
    <div class="left-content">
      <PictureCollection @menu-manage="menuManage" currentActive="pictureManage" />
      <!-- <MySelector :results="results" :searchName="searchName" /> -->
      <SideBar :subjects="subjectss" :grades="gradess" :topics="topicss" :photo_types="photo_typess"/>
    </div>
    <div class="right-content">
      <div v-if="currentActive == 'pictureManage'">
        <div class="btn-div">
          <div class="btn-css" @click="photoUploadModal = true">
            <img src="/images/admin/img-icon.png" alt="upload" class="upload-img">
            <p class="upload-txt">上傳圖片</p>
          </div>
        </div>
        <div>
            <!-- {{photos}} -->
          <div v-for="photo in photos" :key="photo.id" class="each-block">
            <div class="first-row">
              <p class="datetime-css">建立日期 ({{moment(String(photo.created_at)).format('YYYY/MM/DD/hh:mm')}})</p>
              <div class="available-css">
                <div :class="photo.public === 'on' ? 'green-circle' : 'grey-circle'"></div>
                <p class="available-txt">上架中</p>
              </div>
            </div>
            <div class="photo-row">
              <div class="photo-left">
                <img :src="photo.upload_photo_url" alt="upload" class="imagecss">
                <div class="photoright-content">
                  <p class="photo-info">
                    圖片名稱: {{photo.name}}
                  </p>
                  <p class="photo-info">
                    科目: {{photo.subject.name}}
                  </p>
                  <p class="photo-info">
                    年級：{{photo.grade.name}}
                  </p>
                  <p class="photo-info">
                    圖片類型： {{photo.photo_type.name}}
                  </p>
                  <p class="photo-info">
                    圖片格式：{{photo.photo_format}}
                  </p>
                  <p class="photo-info">
                    圖片尺寸 {{photo.photo_size}}
                  </p>
                  <p class="photo-info">
                    圖片流水號：{{photo.generate_number}}
                  </p>
                </div>
              </div>
              <div class="row-data">
                <div class="btn-row">
                  <!-- <p class="btn-one" @click="photoEditModal = true">編輯</p> -->
                  <p class="btn-one" @click="photoEdit(photo)">編輯</p>
                  <p class="btn-two" @click="photoRemove(photo)">下架</p>
                  <p class="btn-three" @click="photoDeleteId(photo)">刪除</p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- photo Edit Modal -->
    <div v-if="photoEditModal" class="editModal">
      <div class="modal-confirm-content">
        <span class="confirmation-close" @click="closeEdit">&times;</span>
        <!-- <img src="/images/photo1.png" alt="upload" class="modal-photo"> -->
        <img :src="photoAddForm.upload_photo_url" alt="upload" class="modal-photo">
        <p class="fname">圖片名稱</p>
        <input type="text" v-model="photoAddForm.name" id="photoAddForm.name" name="photoAddForm.name" class="inputname" placeholder="Name of the photo">
        <div class="selection-block">
            <!-- <el-select
                v-model="tdatest"
                placeholder="科目"
                size="large"
                style="width: 240px"
                class="elselectwrapper1"
            >
                <el-option
                v-for="subject in subjectss"
                :key="subject.id"
                :label="subject.name"
                :value="subject.id"
                :selected="photoAddForm.subject_id == subject.id"
                />
            </el-select> -->

        <select  v-model="photoAddForm.subject_id" class="elselectwrapper1">
            <option
                v-for="subject in subjectss"
                :value="subject.id"
                :key="subject.id"
                class="py-4 my-3 capitalize"
                :selected="
                    photoAddForm.subject_id == subject.id
                "
            >
            {{ subject.name }}
            </option>
        </select>

          <!-- <el-select
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
          </el-select> -->

        <select v-model="photoAddForm.grade_id" class="elselectwrapper2">
            <option
                v-for="grade in gradess"
                :value="grade.id"
                :key="grade.id"
                class="capitalize"
                :selected="
                    photoAddForm.grade_id == grade.id
                "
            >
            {{ grade.name }}
            </option>
        </select>
        </div>
        <div class="selection-block">
          <!-- <el-select
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
          </el-select> -->

        <select v-model="photoAddForm.topic_id" class="elselectwrapper1" >
            <option
                v-for="topic in topicss"
                :value="topic.id"
                :key="topic.id"
                class="capitalize"
                :selected="
                    photoAddForm.topic_id == topic.id
                "
            >
            {{ topic.name }}
            </option>
        </select>

        <select v-model="photoAddForm.photo_type_id" class="elselectwrapper1" >
            <option
                v-for="photo_type in photo_typess"
                :value="photo_type.id"
                :key="photo_type.id"
                class="capitalize"
                :selected="
                    photoAddForm.photo_type_id == photo_type.id
                "
            >
            {{ photo_type.name }}
            </option>
        </select>

        </div>

        <button class="confirm-btn" :class="{ 'opacity-25': photoAddForm.processing }" :disabled="photoAddForm.processing"
          @click="updatePhoto">
          Update
        </button>

        <div class="photoinfo">
          <p>圖片格式：{{photoAddForm.photo_format}}</p>
          <p>圖片尺寸：{{photoAddForm.photo_size}}</p>
          <p>圖片流水號：{{photoAddForm.generate_number}}</p>
        </div>
      </div>
    </div>
    <!-- end photo Edit Modal -->

    <!-- photo delete modal -->
    <div v-if="photoDeleteModal" class="editModal">
      <div class="modal-confirm-content">
        <span class="confirmation-close" @click="closeDelete">&times;</span>
        <p class="confirm-text">確定刪除”{{photoAddForm.name}}”？</p>
        <button @click="deletePhoto" class="delete-button">刪除</button>
        <button @click="cancelFunc" class="cancel-button">取消</button>
      </div>
    </div>
    <!-- end photo delete modal -->

    <!-- photo upload modal -->
    <div v-if="photoUploadModal" class="editModal">
      <div class="modal-confirm-content">
        <span class="confirmation-close" @click="closeUpload">&times;</span>
        <p class="fname">檔案名稱：</p>
        <div class="file-div">

          <!-- <p class="selectFile"><input type="file" @input="photoAddForm.photo_url = $event.target.files[0]" />選擇檔案</p> -->

          <label for="file-upload" class="custom-file-upload selectFile">
            <!-- Add an image or text to display the selected file name -->
            <span v-if="selectedFile">{{ selectedFile.name }}</span>
            <span v-else>選擇檔案</span>
          </label>
          <input id="file-upload" type="file" style="display: none;" @change="onFileChange">
        </div>
        <InputError :message="photoAddForm.errors.photo_url" class="mt-2" />

        <p class="fname">圖片名稱</p>
        <input type="text" v-model="photoAddForm.name" id="photoAddForm.name" name="photoAddForm.name" class="photoName" placeholder="請輸入圖片名稱">
        <br>
        <InputError :message="photoAddForm.errors.name" class="mt-2" />

        <div class="selection-block">

            <div>
            <el-select
                v-model="photoAddForm.subject_id"
                placeholder="科目"
                size="large"
                style="width: 240px"
                class="elselectwrapper1"
                name="subject_id"
            >
                <el-option
                v-for="subject in subjectss"
                :key="subject.value"
                :label="subject.name"
                :value="subject.id"
                />
            </el-select>
                <InputError :message="photoAddForm.errors.subject_id"/>
            </div>
            <div>
            <el-select
                v-model="photoAddForm.grade_id"
                placeholder="年級"
                size="large"
                style="width: 240px"
                class="elselectwrapper2"
                name="grade_id"
            >
                <el-option
                v-for="grade in gradess"
                :key="grade.value"
                :label="grade.name"
                :value="grade.id"
                />
            </el-select>
            <InputError :message="photoAddForm.errors.grade_id"/>
            </div>

        </div>
        <div class="selection-block">
            <div>
                <el-select
                    v-model="photoAddForm.topic_id"
                    placeholder="知識主題"
                    size="large"
                    style="width: 240px"
                    class="elselectwrapper1"
                    name="topic_id"
                >
                    <el-option
                    v-for="topic in topicss"
                    :key="topic.value"
                    :label="topic.name"
                    :value="topic.id"
                    />
                </el-select>
                <InputError :message="photoAddForm.errors.topic_id"/>
            </div>

            <div>
                <el-select
                    v-model="photoAddForm.photo_type_id"
                    placeholder="圖片類型"
                    size="large"
                    style="width: 240px"
                    class="elselectwrapper2"
                    name="photo_type_id"
                >
                    <el-option
                    v-for="photo_type in photo_typess"
                    :key="photo_type.value"
                    :label="photo_type.name"
                    :value="photo_type.id"
                    />
                </el-select>
                <InputError :message="photoAddForm.errors.photo_type_id"/>
            </div>

        </div>
        <button @click="createPhoto" class="confirm-btn" :class="{ 'opacity-25': photoAddForm.processing }" :disabled="photoAddForm.processing">
            Confirm
        </button>
        <div class="photoinfo">
          <p>圖片格式：JPG</p>
          <p>圖片尺寸：300x140</p>
          <p>圖片流水號：32130026412320</p>
        </div>
      </div>
    </div>

    <!-- end photo upload modal -->


    <!-- photo remove modal -->
    <div v-if="photoRemoveModal" class="editModal">
      <div class="modal-confirm-content">
        <span class="confirmation-close" @click="removePhotoCancelFunc">&times;</span>
        <p class="confirm-text">你確定要刪除嗎 "{{photoAddForm.name}}"？</p>
        <button @click="removePhotoFunc" class="delete-button">刪除</button>
        <button @click="removePhotoCancelFunc" class="cancel-button">取消</button>
      </div>
    </div>
    <!-- end photo remove modal -->

  </div>
</template>
<style>
  .elselectwrapper1 .el-select__wrapper {
    border: 0 solid red !important;
    border-radius: 14px;
  }
  .elselectwrapper2 .el-select__wrapper {
    border: 0 solid red !important;
    border-radius: 14px;
  }

  .el-select__suffix {
    background-image: url('/images/admin/admin-dd.png');
    background-size: 100% 100%;
    width: 20px; /* Adjust icon size as needed */
    height: 10px;
  }
  select {
    background-image: url('/images/admin/admin-dd.png');
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 21px 10px;
    background-position-x: 114px;
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
            .grey-circle {
              width: 12px;
              height: 12px;
              border-radius: 6px;
              background: #524f4f;
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
  .modal-confirm-content, .modal-closelbl-content, .modal-newgrade-content {
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
  .modal-newgrade-content {
    padding-top: 10px;
    width: 570px;
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
  .confirm-btn {
    font-weight: 700;
    font-size: 1rem;
    color: #FFF;
    background: #FF7652;
    width: 135px;
    height: 36px;
    line-height: 36px;
    border-radius: 6px;
    margin-top: 2rem;
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
    margin-top: 2rem;
  }
  .elselectwrapper1, .elselectwrapper2 {
    width: 150px !important;
    border-radius: 14px;
    border: 0 solid red !important;
    border-radius: 14px;
  }
  .elselectwrapper1 {
    margin-right: 5px;
  }
  .elselectwrapper2 {
    margin-left: 5px;
  }
</style>
