<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import table from "@/Stores/table";
import debounce from "lodash/debounce";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import DepartmentTable from "./Components/DepartmentTable.vue";
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
  ministry: {
    type: Object,
    default: {},
  },
  departmentdata: {
    type: Object,
    default: {},
  },
  departments: {
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
const isDepartmentCreateModalActive = ref(false);
const ministryRef = ref(props.ministry.id);
const form = useForm({
  name: "",
  ministry: ministryRef.value,
});

const createDepartment = () => {
  form.post(route("departments:create"), {
    preserveScroll: true,
    onSuccess: () => {
      closeModal();
      toast.add({
        message: "Department Added !",
      });
    },
    onError: () => nameRef.value.focus(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  isDepartmentCreateModalActive.value = false;
  form.reset();
};

const removeSearch = () => {
  router.get(
    route("departments:all", {
      ministry: props.ministry,
    })
  );
};

let filterDepartment = ref(props.filters.filterDepartment);

watch(
  [filterDepartment],
  debounce(function ([filterDepartmentValue]) {
    router.get(
      route("departments:all", {
        ministry: props.ministry,
      }),
      {
        filterDepartment: filterDepartmentValue,
      },
      {
        preserveState: true,
        replace: true,
      }
    );
  }, 300)
);
</script>

<template>
  <Head title="Department" />

  <LayoutAuthenticated>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Department</h2>
    </template>

      <SectionMain>
        <div class="min-w-full max-w-7xl mx-auto sm:px-6 lg:px-8 text-xs">
          <SectionTitleLineWithButton :icon="mdiShape" :title="props.ministry.name">
            <BaseButton
              label="Add"
              color="contrast"
              small
              rounded-full
              @click.prevent="isDepartmentCreateModalActive = true"
            />
          </SectionTitleLineWithButton>
          <div>
            <ul
              class="breadcrumbs flex justify-start align-middle text-sm gap-3 text-blue-500 capitalize mb-3"
            >
              <li>
                <Link href="/ministries">ministries</Link>
                <!-- <a href="/ministries/" class="underline">ministries</a></li> -->
              </li>
              <li>&gt;</li>
              <li><Link href="#">departments</Link></li>
            </ul>
          </div>
          <div
            class="grid sm:grid-cols-1 md:grid-cols-4 gap-2 py-6 px-4 align-middle rounded mb-10 border-2 border-gray-400 text-xs"
          >
            <div class="my-1">
              <label for="department" class="block mb-3 text-xs">ဦးစီးဌာနများ</label>
              <select
                v-model="filterDepartment"
                class="form-select appearance-none rounded w-full border-gray-400 text-xs text-gray-700"
              >
                <option selected></option>

                <option
                  v-for="department in props.departmentdata"
                  :key="department.id"
                  :value="department.id"
                >
                  {{ department.name }}
                </option>
              </select>
            </div>

            <div class="align-middle relative">
              <button
                @click="removeSearch"
                class="mt-8 border-none rounded text-xs font-semibold bg-gray-400 py-2 px-4"
              >
                Clear
              </button>
            </div>
          </div>

          <!-- <SectionTitleLineWithButton :icon="mdiShape">
                      <BaseButton label="Add" color="contrast" small rounded-full
                          @click.prevent="isDepartmentCreateModalActive = true" />
                  </SectionTitleLineWithButton> -->

          <CardBoxModal v-model="isDepartmentCreateModalActive" title="Add Department">
            <div class="">
              <div class="mt-6">
                <InputLabel for="name" value="text" class="sr-only" />

                <TextInput
                  id="name"
                  ref="nameRef"
                  v-model="form.name"
                  type="text"
                  class="mt-1 block w-full"
                  placeholder="Name"
                />

                <InputError :message="form.errors.title" class="mt-2" />
              </div>
              <div class="mt-6">
                <InputLabel for="ministry" value="ministry" class="sr-only" />

                <TextInput
                  id="ministry"
                  ref="ministryRef"
                  v-model="props.ministry.name"
                  type="text"
                  class="mt-1 block w-full"
                  placeholder="Ministry"
                  disabled
                />

                <InputError :message="form.errors.ministry" class="mt-2" />
              </div>
              <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                <PrimaryButton
                  class="ml-3"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                  @click="createDepartment"
                >
                  Add
                </PrimaryButton>
              </div>
            </div>
          </CardBoxModal>
          <div class="flex justify-between align-middle mb-4">
            <h6 class="font-extrabold uppercase text-xs">
              Total - {{ props.departments.meta.total }}
            </h6>
          </div>

          <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <CardBox has-table>
              <DepartmentTable
                :departments="props.departments"
                :ministry="props.ministry"
              />
            </CardBox>
          </div>
          <pagination-links :links="props.departments.meta.links" />
        </div>
      </SectionMain>

  </LayoutAuthenticated>
</template>
