<script setup>
import { computed, ref ,reactive, onMounted} from 'vue';
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

  grades: {
    type: Object,
    default: {}
  }

})

const addForm = useForm({
  name: ''
});


const isAddModalActive = ref(false);
const isCloseModalActive = ref(false);
const checkedGrade = ref([])

const items = computed(() => props.items)

const confirmAdd = () => {
  isAddModalActive.value = true;
}


const closeAddModal = () => {
  isAddModalActive.value = false;
}

const confirmClose = () => {
  isCloseModalActive.value = true;
}


const closeCloseModal = () => {
  isCloseModalActive.value = false;
}

const addGrade = () => {
  addForm.post(route('admin.grade.create'), {
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
  checkedGrade: checkedGrade
})


function closeAction() {
    formData.checkedGrade = checkedGrade
    router.post('/admin/grade/close', formData)
    if (checkedGrade instanceof Set) {
        checkedGrade.clear();
    } else {
        checkedGrade.value = [];
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
  <MediumCardBoxModal v-model="isAddModalActive" title="Add Grade">
    <div class="mt-6">
      <div class="mt-2">
          <label for="name" class="block mb-3 text-xs">Grade Name</label>
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
          <PrimaryButton class="ml-3" @click="addGrade" :class="{ 'opacity-25': addForm.processing }" :disabled="addForm.processing">
            Confirm
          </PrimaryButton>
    </div>
  </MediumCardBoxModal>


  <!--  Close Grade Modal -->
  <MediumCardBoxModal v-model="isCloseModalActive" title="Close Subject">
    <div class="mt-6">
        <SecondaryButton @click="closeCloseModal"> Cancel </SecondaryButton>

      <div class="mt-2">
          <label for="batch_no" class="block mb-3 text-xs">Grade Name</label>
          <div v-for="grade in props.grades" :key="grade.id">

            <input v-model="checkedGrade" :value="grade.id" type="checkbox" name="checkedGrade">
            {{grade.name}}

          </div>
          <InputError :message="addForm.errors.name" class="mt-2" />
      </div>
    </div>
    <div class="flex justify-end pt-6" v-if="checkedGrade.length > 0">
          <PrimaryButton class="ml-3" @click="closeAction" :class="{ 'opacity-25': addForm.processing }" :disabled="addForm.processing">
            Confirm
          </PrimaryButton>
    </div>
  </MediumCardBoxModal>


<p>Grade</p>
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
            <tr v-for="(grade, index) in props.grades" :key="grade.id">
                <td class="text-left">{{ index + 1}}</td>
                <td class="text-left">{{ grade.name }}</td>
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
