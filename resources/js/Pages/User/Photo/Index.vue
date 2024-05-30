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


</script>

<template>
  <Head title="Nani" />
  <MyNavBar v-if="canLogin" />
</template>
