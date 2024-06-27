<script setup>
import { computed, ref } from "vue";
import { defineProps } from 'vue';
import { Head, router } from '@inertiajs/vue3';

const props = defineProps({
  subjects: {
    type: Array,
    required: true
  },
  grades: {
    type: Array,
    required: true
  },
  topics: {
    type: Array,
    required: true
  },
  photo_types: {
    type: Array,
    required: true
  },
  userType: {
    type: String
  }
});

const activeNames = ref(['1', '2'])
const filterSubject = ref([])
const filterGrade = ref([])
const filterTopic = ref([])
const filterPhotoType = ref([])

const emit = defineEmits(["selector-value"]);

const filterSearch = () => {
  if(props.userType && props.userType == 'userType') {
    emit('selector-value', {
      subject: filterSubject?.value?.id,
      grade: filterGrade?.value?.id,
      topic: filterTopic?.value?.id,
      type: filterPhotoType?.value?.id
    });

    router.get(route('photo.index'), {
      filterSubject: filterSubject.value.id,
      filterGrade: filterGrade.value.id,
      filterTopic: filterTopic.value.id,
      filterPhotoType: filterPhotoType.value.id,
    },{
      preserveState: true,
      replace: true,
    });
  } else {
    router.get(route('admin.photo.index'), {
        filterSubject: filterSubject.value.id,
        filterGrade: filterGrade.value.id,
        filterTopic: filterTopic.value.id,
        filterPhotoType: filterPhotoType.value.id,
    },{
        preserveState: true,
        replace: true,
    });
  }
}

</script>

<template>
  <div class="home-left-component">
    <div class="search-row">
      <div class="filter-div">
        <img src="/images/filter-icon.png" alt="Filter" class="filter-img">
        <p class="filter-text">篩選</p>
      </div>
      <p class="search-btn" @click="filterSearch">
        搜尋
      </p>
    </div>

    <div class="demo-collapse">
      <el-collapse v-model="activeNames">
        <el-collapse-item title="科目" name="1">
          <el-checkbox-group v-model="filterSubject.id" class="check-css" v-for="subject in subjects" :key="subject.id">
            <el-checkbox :label="subject.name" :value="subject.id" :name="String(subject.id)" class="custom-checkbox" />
          </el-checkbox-group>
        </el-collapse-item>

        <el-collapse-item title="年級" name="2">
          <el-checkbox-group v-model="filterGrade.id" class="check-css" v-for="grade in grades" :key="grade.id">
            <el-checkbox :label="grade.name" :value="grade.id" :name="String(grade.id)" class="custom-checkbox" />
          </el-checkbox-group>
        </el-collapse-item>

        <el-collapse-item title="知識主題" name="3">
          <el-checkbox-group v-model="filterTopic.id" class="check-css" v-for="topic in topics" :key="topic.id">
            <el-checkbox :label="topic.name" :value="topic.id"  :name="String(topic.id)" class="custom-checkbox" />
          </el-checkbox-group>
        </el-collapse-item>

        <el-collapse-item title="圖片類型" name="4">
          <el-checkbox-group v-model="filterPhotoType.id" class="check-css" v-for="photo_type in photo_types" :key="photo_type.id">
            <el-checkbox :label="photo_type.name" :value="photo_type.id" :name="String(photo_type.id)" class="custom-checkbox" />
          </el-checkbox-group>
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
