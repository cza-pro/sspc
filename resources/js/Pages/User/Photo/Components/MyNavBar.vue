<script setup>
import { computed, ref, watch } from "vue";
import { Link,router, useForm } from "@inertiajs/vue3";
import debounce from 'lodash/debounce'

// Defining primitive values with ref
const loginState = ref(false);  // Similar to data { return { loginState: true } } in Vue 2
const isDropdownVisible = ref(false);
const results = ref([]);
const searchName = ref('');

// Define the emit function
const emit = defineEmits(['update-search-query']);

// const emitSearchQuery = () => {
//   emit('update-search-query', searchName.value);
// };

// Define methods
function loginFunc() {
  loginState.value = true;
  console.log("Login function called", loginState.value);
}
function dropdownFunc() {
  isDropdownVisible.value = !isDropdownVisible.value
  console.log("Dropdown function called", loginState.value);
}
function logoutFunc() {
  loginState.value = false;
  console.log("Logout function called", loginState.value);
}

// Expose methods to the template
// const methods = {
//   loginFunc,
//   logoutFunc,
//   dropdownFunc
// };

watch([searchName], debounce(function([searchNameValue]) {
  emit('update-search-query', searchNameValue);
  router.get(route('photo.index'), {
    searchName: searchNameValue
  }, {
    preserveScroll: true,
    preserveState: true,
    replace: true,
  })
}, 1000));
</script>

<template>
  <div class="p-4 sm:top-0 nav-bar">
    <div class="menu-logo">
      <p class="logo-text">南一國中社會圖輯網</p>
      <!-- @input="emitSearchQuery" -->
      <input type="text" v-model="searchName" id="search-bar" name="searchword" class="search-box" placeholder="搜尋圖片名稱、知識主題">
    </div>

    <div class="dropdown">
      <div class="dropbtn menu-title">
        <p class="first-letter sm:text-sm md:text-base">南</p>
        <p class="text-lg sec-letter sm:text-sm md:text-base">南一書局線上資源網站</p>
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
      <div v-if="$page.props.auth.user" class="dropdown">
        <div class="login-css">
          <img src="/images/login-icon.png" alt="Login" class="login-img">
          <p class="text-lg login-text" @click="dropdownFunc">{{$page.props.auth.user.name}}</p>
        </div>
        <div v-if="isDropdownVisible" class="dropdown-click-content">
          <span >
            <Link :href="route('profile.edit')" method="get" as="button">
                會員資料
            </Link>
          </span>
          <span @click="logoutFunc" class="text-xl">
              <Link :href="route('logout')" method="post" as="button">
                登出
            </Link>
          </span>
        </div>
      </div>
      <div v-else class="register-css">
        <img src="/images/user-icon.png" alt="Login" class="register-img">
        <p @click="loginFunc">
            <Link :href="route('login')" class="text-xl register-text">登入</Link>
        </p>
      </div>
  </div>
</template>
