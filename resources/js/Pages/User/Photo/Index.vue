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
import MySelector from "./Components/MySelector.vue"

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
let changeStatusRef = (value) => {
  statusRef.value = value;
};
const nameRef = ref("");

const closeModal = () => {
  isDepartmentCreateModalActive.value = false;
  form.reset();
};

// Define reactive references for the search query and results
// const searchName = ref('');
const searchName = [
  {
    name: '1',
    title: 'CZA',
    content: 'Content for item 1',
    srcPath: '/images/download.png'
  },
  {
    name: '2',
    title: 'TDA',
    content: 'Content for item 2',
    srcPath: '/images/download.png'
  },
  {
    name: '3',
    title: 'MMM',
    content: 'Content for item 3',
    srcPath: '/images/download.png'
  },
  {
    name: '4',
    title: 'MMLM',
    content: 'Content for item 4',
    srcPath: '/images/download.png'
  },
  {
    name: '5',
    title: 'KT',
    content: 'Content for item 5',
    srcPath: '/images/download.png'
  }
]
const results = ref([]);
const initialSearchQuery = ref('');


// Function to handle the search query update from the child component
const handleSearchQuery = async (query) => {
  searchName.value = query;
  console.log('hello data ', searchName.value)

  if (query) {
    // await fetchResults(query);
  } else {
    results.value = [];
  }
};
console.log('hello data2 ', searchName)

// // Function to fetch results from the server
// const fetchResults = async (query) => {
//   try {
//     const response = await axios.get('/api/search', {
//       params: { query }
//     });
//     results.value = response.data;
//   } catch (error) {
//     console.error('Error fetching search results:', error);
//   }
// };


</script>

<template>
  <Head title="Nani" />
  <MyNavBar v-if="canLogin" @update-search-query="handleSearchQuery" :initialQuery="initialSearchQuery" />
  {{searchName}}
  <MySelector :results="searchName" />
</template>
