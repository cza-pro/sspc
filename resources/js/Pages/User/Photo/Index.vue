<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import debounce from "lodash/debounce";

import PostTable from "./Components/PostTable.vue";
import BaseButton from "@/Components/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CardBox from "@/Components/CardBox.vue";

import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import NavBar from "@/Layouts/NavBar.vue";

const props = defineProps({
  posts: {
    type: Object,
    default: {},
  },
  filters: {
    type: Object,
    default: {},
  },
});



</script>

<template>
  <Head title="Post" />

<NavBar></NavBar>

  <!-- <LayoutAuthenticated> -->
      <SectionMain>
        <div class="min-w-full mx-auto text-xs max-w-7xl sm:px-6 lg:px-8">

          <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <CardBox has-table>
              <PostTable
                :posts="props.posts"
              />
            </CardBox>
          </div>
        </div>
      </SectionMain>

  <!-- </LayoutAuthenticated> -->

</template>
