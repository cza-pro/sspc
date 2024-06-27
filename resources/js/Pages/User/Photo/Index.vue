<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import table from "@/Stores/table";
import debounce from "lodash/debounce";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import BaseButton from "@/Components/BaseButton.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import toast from "@/Stores/toast";
import CardBox from "@/Components/CardBox.vue";

import MyNavBar from "./Components/MyNavBar.vue"
import MySelector from "../../../Components/MySelector.vue"
import SideBar from "../../Admin/Menu/SideBar.vue";
import PhotoContent from '../../../Components/PhotoContent.vue'

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
    default: {},
  },
  grades: {
    type: Object,
    default: {},
  },
  topics: {
    type: Object,
    default: {},
  },
  photo_types: {
    type: Object,
    default: {},
  },
  feature_images: {
    type: Object,
    default: {}
  },
});

const statusRef = ref("");
const nameRef = ref("");
const searchName = ref('');
const selectorBool = ref(false);

let changeStatusRef = (value) => {
  statusRef.value = value;
};
const closeModal = () => {
  isDepartmentCreateModalActive.value = false;
  form.reset();
};
const selectorFunc = (value) => {
  const hasValue = ['subject', 'grade', 'topic', 'type'].some(key => value[key] && value[key].length);
  
  if (hasValue) {
    selectorBool.value = true;
    // console.log("Emit At least one value is defined");
  } else {
    selectorBool.value = false
    // console.log("Emit All four values are undefined");
  }
};
// Function to handle the search query update from the child component
const handleSearchQuery = async (query) => {
  if (query) {
    searchName.value = query
  } else {
    searchName.value = ''
  }
}
</script>

<template>
  <Head title="Nani" />
  <MyNavBar v-if="canLogin" @update-search-query="handleSearchQuery" />
  <div class="home-content">
    <SideBar userType="userType" :subjects="subjects" :grades="grades" :topics="topics" :photo_types="photo_types" @selector-value="selectorFunc" />
    <PhotoContent :photos="photos.data" :featureImgs="feature_images" :searchName="searchName" :selectorBool="selectorBool" />
  </div>
</template>
