<script setup>

import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import table from "@/Stores/table";
import debounce from "lodash/debounce";
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

// Defining primitive values with ref
const loginState = ref(false);  // Similar to data { return { loginState: true } } in Vue 2

// // Defining an object with reactive
// const user = reactive({
//   name: '',
//   age: 20,
// });

// Reactive reference to control the visibility of the dropdown
const isDropdownVisible = ref(false);

// Define methods
function loginFunc() {
  // Logic to handle login
  loginState.value = true;
  console.log("Login function called", loginState.value);
}
function dropdownFunc() {
  // Logic to handle login
  isDropdownVisible.value = !isDropdownVisible.value
  console.log("Dropdown function called", loginState.value);
}
function logoutFunc() {
  // Logic to handle login
  loginState.value = false;
  console.log("Logout function called", loginState.value);
}

// Expose methods to the template
// const methods = {
//   loginFunc,
//   logoutFunc,
//   dropdownFunc
// };

</script>

<template>
  <Head title="Nani" />
  <div v-if="canLogin" class="p-6 sm:fixed sm:top-0 nav-bar">
    <div class="menu-logo">
      <p class="logo-text">南一國中社會圖輯網</p>
      <input type="text" id="search-bar" name="searchword" class="search-box" placeholder="搜尋圖片名稱、知識主題">
    </div>
    

    <div class="dropdown">
      <div class="dropbtn menu-title">
        <p class="first-letter sm:text-sm md:text-base">南</p>
        <p class="sec-letter sm:text-sm md:text-base text-lg">南一書局線上資源網站</p>
      </div>
      <div class="dropdown-content">
        <a href="#" class="text-xl">NaniBox 2.0</a>
        <a href="#" class="text-xl">NaniBook</a>
        <a href="#" class="text-xl">臺灣疊圖</a>
        <a href="#" class="text-xl">地理疊圖</a>
        <a href="#" class="text-xl">Taiwan GO</a>
        <a href="#" class="text-xl">歷史時間軸</a>
      </div>
    </div>
      <div v-if="loginState" class="dropdown">
        <div class="login-css">
          <img src="/images/login-icon.png" alt="Login" class="login-img">
          <p class="login-text text-lg" @click="dropdownFunc">會員功能</p>
        </div>
        <div v-if="isDropdownVisible" class="dropdown-click-content">
          <span >會員資料</span>
          <span @click="logoutFunc" class="text-xl">登出</span>
        </div>
      </div>
      <div v-else class="register-css">
        <img src="/images/user-icon.png" alt="Login" class="register-img">
        <p class="register-text text-xl" @click="loginFunc">登入</p>
      </div>
      
    <!-- <Link
        v-if="canRegister"
        :href="route('register')"
        class="font-semibold text-gray-600 ms-4 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
    >register
    </Link> -->
  </div>
  <!-- <SectionMain>
    <div class="min-w-full mx-auto text-xs max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <CardBox has-table>
          <PhotoTable
            :photos="props.photos"
          />
        </CardBox>
      </div>
    </div>
  </SectionMain> -->
</template>
