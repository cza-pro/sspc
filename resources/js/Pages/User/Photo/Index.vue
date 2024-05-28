<script setup>

import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import table from "@/Stores/table";
import debounce from "lodash/debounce";
// import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import PhotoTable from "./Components/PhotoTable.vue";
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
  <Head title="Photo" />
        <div v-if="canLogin" class="p-6 sm:fixed sm:top-0 sm:right-0 text-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Dashboard</Link
            >

                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="font-semibold text-gray-600 ms-4 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Register</Link
                >
        </div>
      <SectionMain>
        <div class="min-w-full mx-auto text-xs max-w-7xl sm:px-6 lg:px-8">

          <!-- <div class="flex justify-between mb-4 align-middle">
            <h6 class="text-xs font-extrabold uppercase">
              Total - {{ props.photos.meta.total }}
            </h6>
          </div> -->

          <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <CardBox has-table>
              <PhotoTable
                :photos="props.photos"
              />
            </CardBox>
          </div>
          <!-- <pagination-links :links="props.photos.meta.links" /> -->
        </div>
      </SectionMain>

</template>
