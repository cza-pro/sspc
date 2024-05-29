<script setup>
import { ref, watch } from 'vue';
import { mdiFile } from '@mdi/js';
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
import SubjectTable from './Components/SubjectTable.vue';
import GradeTable from './Components/GradeTable.vue';
import TopicTable from './Components/TopicTable.vue';
// import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import CardBox from "@/Components/CardBox.vue";

const props = defineProps({
  subjects: {
    type: Object,
    default: {}
  },
  grades: {
    type: Object,
    default: {}
  },
  topics: {
    type: Object,
    default: {}
  }

})

</script>

<template>
  <Head title="Selector" />

     <SectionMain>
          <div class="min-w-full mx-auto max-w-7xl sm:px-6 lg:px-8">

              <CardBox has-table>
                  <SubjectTable
                    :subjects="props.subjects"
                  />
              </CardBox>
           </div>
     </SectionMain>

     <SectionMain>
          <div class="min-w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
              <CardBox has-table>
                  <GradeTable
                    :grades="props.grades"
                  />
              </CardBox>
           </div>
     </SectionMain>

     <SectionMain>
          <div class="min-w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
              <CardBox has-table>
                  <TopicTable
                    :topics="props.topics"
                  />
              </CardBox>
           </div>
     </SectionMain>


</template>
