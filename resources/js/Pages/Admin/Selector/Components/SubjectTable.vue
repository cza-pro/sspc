<script setup>
import { computed, ref ,reactive,onMounted} from 'vue';
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

  subjects: {
    type: Object,
    default: {}
  }

})

const addForm = useForm({
  name: ''
});


const isAddModalActive = ref(false);
const isCloseModalActive = ref(false);
const checkedSubject = ref([])

const items = computed(() => props.items)

const confirmAdd = () => {
  isAddModalActive.value = true;
}

const confirmClose = () => {
  isCloseModalActive.value = true;
}


const closeAddModal = () => {
  isAddModalActive.value = false;
}

const closeCloseModal = () => {
  isCloseModalActive.value = false;
}

const addSubject = () => {
  addForm.post(route('admin.subject.create'), {
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


const formData = reactive({
  checkedSubject: checkedSubject
})


function closeAction() {
    formData.checkedSubject = checkedSubject
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

    closeCloseModal();

}



</script>

<template>
    <!-- Create Subject Modal Box -->
  <MediumCardBoxModal v-model="isAddModalActive" title="Add Subject">
    <div class="mt-6">
      <div class="mt-2">
          <label for="batch_no" class="block mb-3 text-xs">Subject Name</label>
          <TextInput
            id="name"
            v-model="addForm.name"
            type="text"
            class="block w-full mt-1 form-input placeholder:text-xs"
            placeholder="Subject Name"
          />
          <InputError :message="addForm.errors.name" class="mt-2" />
      </div>
    </div>
    <div class="flex justify-end pt-6">
          <SecondaryButton @click="closeAddModal"> Cancel </SecondaryButton>
          <PrimaryButton class="ml-3" @click="addSubject" :class="{ 'opacity-25': addForm.processing }" :disabled="addForm.processing">
            Confirm
          </PrimaryButton>
    </div>
  </MediumCardBoxModal>


<!--  Close Subject Modal -->
  <MediumCardBoxModal v-model="isCloseModalActive" title="Close Subject">
    <div class="mt-6">
        <SecondaryButton @click="closeCloseModal"> Cancel </SecondaryButton>

      <div class="mt-2">
          <label for="batch_no" class="block mb-3 text-xs">Subject Name</label>
          <div v-for="subject in props.subjects" :key="subject.id">

            <input v-model="checkedSubject" :value="subject.id" type="checkbox" name="checkedSubject">
            {{subject.name}}

          </div>
          <InputError :message="addForm.errors.name" class="mt-2" />
      </div>
    </div>
    <div class="flex justify-end pt-6" v-if="checkedSubject.length > 0">
          <PrimaryButton class="ml-3" @click="closeAction" :class="{ 'opacity-25': addForm.processing }" :disabled="addForm.processing">
            Confirm
          </PrimaryButton>
    </div>
  </MediumCardBoxModal>



  <CardBox has-table>
    <p>subject</p>
    <table class="text-xs bg-white rounded">
        <thead>
            <tr>
                <th class="text-left">စဥ်</th>
                <th class="text-left">အမည်</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(subject, index) in props.subjects" :key="subject.id">
                <td class="text-left">{{ index + 1}}</td>
                <td class="text-left" :class="subject.available === 'off' ? 'text-disable' : ''">{{ subject.name }}</td>
              </tr>

                <BaseButton
                    label="Add"
                    color="contrast"
                    small
                    rounded-full
                    @click.prevent="confirmAdd"
                />

                  <BaseButton
                    label="Close"
                    color="contrast"
                    small
                    rounded-full
                    @click.prevent="confirmClose"
                />
            </tbody>
    </table>
  </CardBox>

</template>

<style scoped>
.text-disable {
    color: red;
}
</style>
<style src="@vueform/toggle/themes/default.css"></style>
