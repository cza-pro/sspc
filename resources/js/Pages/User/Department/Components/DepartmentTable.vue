<script setup>
import { computed, ref } from "vue";
import { mdiEye, mdiPencil, mdiTrashCan } from "@mdi/js";
import CardBoxModal from "@/Components/CardBoxModal.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import BaseButton from "@/Components/BaseButton.vue";
import { Link, useForm } from "@inertiajs/vue3";
import moment from 'moment'
import PaginationLinks from "@/Components/PaginationLinks.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    ministry: {
        type: Object,
        default: {}
    },
    departments: {
        type: Object,
        default: {}
    },
})

let isEditDepartmentModalActive = ref(false)
const isModalActive = ref(false);

const isModalDangerActive = ref(false);
const selectedDepartment = ref('');

const showDepartmentModal = (department) => {
    isModalActive.value = true
    selectedDepartment.value = department
}

const showEditDepartmentModal = (department) => {
    isEditDepartmentModalActive.value = true
    editDepartmentEditForm.id = department.id
    editDepartmentEditForm.name = department.name
    editDepartmentEditForm.ministry_id = props.ministry.id
}

const editDepartmentEditForm = useForm({
    id: '',
    name: '',
    ministry_id: null
})

const updateDepartmentRequest = () => {
    editDepartmentEditForm.post(route('departments:update'), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
        isEditDepartmentModalActive.value = false;
        toast.add({
            message: "Updated !"
        })
    },
    onError: () => {
      toast.add({
        message: "Failed !"
      })
    },
    onFinish: () => editDepartmentEditForm.reset(),
  });
}

</script>

<template>
    <CardBoxModal v-model="isModalActive" title="Department">
        <table class="border-collapse border border-slate-400 ...">
        <tbody>
          <tr>
            <td>Name</td>
            <td >{{ selectedDepartment.name }}</td>
          </tr>
          
        </tbody>
    </table>
    </CardBoxModal>
    <CardBoxModal v-model="isEditDepartmentModalActive" title="Edit Department Name" :has-exit="true">
        <div class="">
            <div class="mt-6">
                <InputLabel for="name" value="text" class="sr-only" />

                <TextInput id="name" ref="nameRef" v-model="editDepartmentEditForm.name" type="text" class="mt-1 block w-full"
                    placeholder="Name" />

                <InputError :message="editDepartmentEditForm.errors.title" class="mt-2" />
            </div>
            <div class="mt-6">
                <InputLabel for="ministry" value="ministry" class="sr-only" />

                <TextInput id="ministry" ref="ministryRef" v-model="props.ministry.name" type="text"
                    class="mt-1 block w-full" placeholder="Ministry"  disabled />

                <InputError :message="editDepartmentEditForm.errors.ministry" class="mt-2" />
            </div>
            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="isEditDepartmentModalActive = false"> Cancel </SecondaryButton>

                <PrimaryButton class="ml-3" :class="{ 'opacity-25': editDepartmentEditForm.processing }"
                    :disabled="editDepartmentEditForm.processing" @click="updateDepartmentRequest">
                    Update
                </PrimaryButton>
            </div>
        </div>
    </CardBoxModal>

    <CardBoxModal v-model="isModalDangerActive" title="Please confirm" button="danger" has-cancel>
        <p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
        <p>This is sample modal</p>
    </CardBoxModal>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="department, index in props.departments.data" :key="department.id">
                <td data-label="ID"> {{ (props.departments.meta.per_page*(props.departments.meta.current_page-1))+index+1 }}</td>
                <td data-label="Name">{{ department.name }}</td>
                <td data-label="Action">
                    <BaseButtons type="justify-start lg:justify-start" no-wrap>
                        <!-- <BaseButton color="info" :icon="mdiEye" small @click="showDepartmentModal(department)" /> -->
                        <BaseButton color="bg-yellow-400 text-white" :icon="mdiPencil" small @click="showEditDepartmentModal(department)" />
                        <!-- <BaseButton color="danger" :icon="mdiTrashCan" small @click="isModalDangerActive = true" /> -->
                    </BaseButtons>
                </td>
            </tr>
        </tbody>
    </table>
</template>
