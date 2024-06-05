<script setup>
import { ref, watch } from 'vue';
import { mdiFile } from '@mdi/js';
import toast from "@/Stores/toast";
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
import FeatureImageTable from './Components/FeatureImageTable.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import CardBox from "@/Components/CardBox.vue";

const props = defineProps({
  feature_images: {
    type: Object,
    default: {}
  }

})

const addForm = useForm({
  name: '',
  feature_image: ''
});


const isAddModalActive = ref(false);
const isLoading = ref(false);

const confirmAdd = () => {
  isAddModalActive.value = true;
}


const closeAddModal = () => {
  isAddModalActive.value = false;
}

const closeCloseModal = () => {
  isCloseModalActive.value = false;
}

const createFeature = () => {
  addForm.post(route('admin.feature_image.create'), {
    preserveScroll: true,
    preserveState: true,
    onStart: () => {
        isLoading.value = true;
    },
    onSuccess: () => {
       closeAddModal();
       toast.add({
          message: usePage().props.toast.message
       });
    },
    onError: () => {
       addForm.reset(),
       toast.add({
          message: usePage().props.toast.message
       });
       closeAddModal()
    }
  })
}


</script>

<template>
  <Head title="Feature Image" />

     <SectionMain>

    <!-- Create Subject Modal Box -->
        <MediumCardBoxModal v-model="isAddModalActive" title="Add Subject">
            <div class="mt-6">
            <div class="mt-2">
                <label for="batch_no" class="block mb-3 text-xs">Feature Image</label>
                <TextInput
                    id="name"
                    v-model="addForm.name"
                    type="text"
                    class="block w-full mt-1 form-input placeholder:text-xs"
                    placeholder="Feature Name"
                />
                <InputError :message="addForm.errors.name" class="mt-2" />
            </div>
            <div class="mt-6">
                <InputLabel for="feature_image" value="Feature Image" />
                <input type="file" @input="addForm.feature_image = $event.target.files[0]" />

                <InputError :message="addForm.errors.feature_image" class="mt-2" />
            </div>
            </div>
            <div class="flex justify-end pt-6">
                <SecondaryButton @click="closeAddModal"> Cancel </SecondaryButton>
                <PrimaryButton class="ml-3" @click="createFeature" :class="{ 'opacity-25': addForm.processing }" :disabled="addForm.processing">
                    Confirm
                </PrimaryButton>
            </div>
        </MediumCardBoxModal>


    <!-- Create Feature Button -->
        <BaseButton
            label="Add"
            color="contrast"
            small
            rounded-full
            @click.prevent="confirmAdd"
        />

          <div class="min-w-full mx-auto max-w-7xl sm:px-6 lg:px-8">

              <CardBox has-table>
                  <FeatureImageTable
                    :feature_images="props.feature_images"
                  />
              </CardBox>
           </div>
     </SectionMain>

</template>
