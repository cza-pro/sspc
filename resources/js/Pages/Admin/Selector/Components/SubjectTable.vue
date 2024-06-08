<script setup>
import { computed, ref ,reactive,onMounted} from 'vue';
import toast from '@/Stores/toast';
import { mdiShape } from '@mdi/js';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import { faL } from '@fortawesome/free-solid-svg-icons';

const props = defineProps({
  subjects: {
    type: Object,
    default: {}
  }
})
const addForm = useForm({
  name: '四年級'
});
const checkedSubject = ref([])
const addNewLabel = ref(false);
const toRemoveItem = ref([]);
const photoRemoveModal = ref(false);
const tempSubjects = ref([]); // Create a local copy of props.subjects

const formData = reactive({
  checkedSubject: checkedSubject
})

const items = computed(() => props.items)

onMounted(() => {
  console.log('Subject is mounted');
  // Make a deep copy of props.subjects if tempSubjects is empty
  if (tempSubjects.value.length === 0) {
    tempSubjects.value = JSON.parse(JSON.stringify(props.subjects));
  }
});

const addSubject = () => {
  addForm.post(route('admin.subject.create'), {
    preserveState: true,
    onSuccess: () => {
       closeSubjectNewLbl();
       toast.add({
          message: usePage().props.toast.message
       });
    },
    onError: () => {
       addForm.reset(),
       toast.add({
          message: usePage().props.toast.message
       });
       closeSubjectNewLbl()
    }
  })
}

function removeSubjectsFunc() {
  // formData.checkedSubject = checkedSubject
  formData.checkedSubject = toRemoveItem
  router.post('/admin/subject/close', formData)
  if (checkedSubject instanceof Set) {
      checkedSubject.clear();
  } else {
      checkedSubject.value = [];
  }
  toast.add({
      message: "Add !",
      duration: 3000
  });
  tempSubjects.value = JSON.parse(JSON.stringify(props.subjects));
  closeRemove();
}

const closeSubjectNewLbl = () => {
  addNewLabel.value = false;
};
const closeRemove = () => {
  toRemoveItem.value = []
  photoRemoveModal.value = false;
};

function getButtonClass(subject) {
  return (subject.available === 'off' || toRemoveItem.value.some(item => item == subject.id)) ? 'btn-active' : '';
}
const lblToRemoveFunc = (val) => {
  if (toRemoveItem.value.indexOf(val.id) === -1) {
    toRemoveItem.value.push(val.id);
  } else {
    toRemoveItem.value.splice(toRemoveItem.value.indexOf(val.id), 1);
  }
};
</script>

<template>

  <div class="filter-block">
    <div class="filter-left">
      <p class="subject-section">科目選擇</p>
      <div class="subject-btns">
        <p class="each-btn" :class="subject.available === 'off' ? 'removeitem' : ''" v-for="(subject) in props.subjects" :key="subject.id">{{subject.name}}</p>
      </div>
    </div>
    <div class="filter-right">
      <p class="addnewtag" @click="addNewLabel = true">新增標籤</p>
      <p class="closetag" @click="photoRemoveModal = true">關閉標籤</p>
    </div>
  </div>
  <div v-if="addNewLabel" class="modal">
    <div class="modal-newgrade-content">
      <span class="confirmation-close" @click="closeSubjectNewLbl">&times;</span>
      <p class="grade-text">新增標籤：年級選擇</p>
      <div class="file-div">
        <input type="text" v-model="addForm.name" id="newGrade" name="newGrade" class="gradecss" placeholder="Name of the photo">
      </div>
      <div class="btn-btn">
        <p class="grade-btn" @click="addSubject">確認新增</p>
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
            {{toRemoveItem}}
            <p :class="getButtonClass(subject)" class="each1-btn" @click="lblToRemoveFunc(subject)" v-for="subject in props.subjects" :key="subject.id">{{subject.name}}</p>
          </div>
        </div>
      </div>
      <div class="confirm-div">
        <p class="confirmRemove" @click="removeSubjectsFunc">確認關閉</p>
      </div>
    </div>
  </div>

</template>

<style lang="scss" scoped>
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
.modal-closelbl-content, .modal-newgrade-content {
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
</style>
<style lang="scss" scoped>
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
    cursor: pointer;
  }
  .closelbl-text {
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
          cursor: pointer;
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
  .select1File {
    font-weight: 700;
    font-size: 1rem;
    color: #FFF;
    background: #FF7652;
    width: 135px;
    height: 36px;
    line-height: 36px;
    border-radius: 6px;
    background: #000;
  }
</style>
