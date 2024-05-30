<script setup>
import { computed, ref } from "vue";

// Defining primitive values with ref
const loginState = ref(false);  // Similar to data { return { loginState: true } } in Vue 2
const isDropdownVisible = ref(false);

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

</script>

<template>
  <div class="p-4 sm:top-0 nav-bar">
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
  </div>
</template>
