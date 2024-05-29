<script setup>
import { computed, ref } from 'vue';
import toast from '@/Stores/toast';
import { mdiShape } from '@mdi/js';
import Toggle from '@vueform/toggle';
import VueMultiselect from 'vue-multiselect';
import CardBox from '@/Components/CardBox.vue';
import TextInput from '@/Components/TextInput.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import BaseButton from '@/Components/BaseButton.vue';
import InputError from '@/Components/InputError.vue';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import CardBoxModal from '@/Components/CardBoxModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PaginationLinks from '@/Components/PaginationLinks.vue';
import MediumCardBoxModal from '@/Components/MediumCardBoxModal.vue';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import { faL } from '@fortawesome/free-solid-svg-icons';

const props = defineProps({

  topics: {
    type: Object,
    default: {}
  }

})

const addForm = useForm({
  name: ''
});


const isAddModalActive = ref(false);

const items = computed(() => props.items)

const confirmAdd = () => {
  isAddModalActive.value = true;
}


const closeAddModal = () => {
  isAddModalActive.value = false;
}

const addTopic = () => {
  addForm.post(route('admin.topic.create'), {
    preserveState: true,
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
    <!-- Create Subject Modal Box -->
  <MediumCardBoxModal v-model="isAddModalActive" title="Add Topic">
    <div class="mt-6">
      <div class="mt-2">
          <label for="name" class="block mb-3 text-xs">Topic Name</label>
          <TextInput
            id="name"
            v-model="addForm.name"
            type="text"
            class="block w-full mt-1 form-input placeholder:text-xs"
            placeholder="Grade Name"
          />
          <InputError :message="addForm.errors.name" class="mt-2" />
      </div>
    </div>
    <div class="flex justify-end pt-6">
          <SecondaryButton @click="closeAddModal"> Cancel </SecondaryButton>
          <PrimaryButton class="ml-3" @click="addTopic" :class="{ 'opacity-25': addForm.processing }" :disabled="addForm.processing">
            Confirm
          </PrimaryButton>
    </div>
  </MediumCardBoxModal>

  <CardBox has-table>
    <table class="text-xs bg-white rounded">
        <thead>
            <tr>
                <th class="text-left">စဥ်</th>
                <th class="text-left">အမည်</th>
            </tr>
        </thead>
        <tbody>
            <!-- sss => {{grades}} -->
            <tr v-for="(topic, index) in props.topics" :key="topic.id">
                <td class="text-left">{{ index + 1}}</td>
                <td class="text-left">{{ topic.name }}</td>
              </tr>

                <BaseButton
                    label="Add"
                    color="contrast"
                    small
                    rounded-full
                    @click.prevent="confirmAdd"
                />
            </tbody>
    </table>
  </CardBox>

</template>
