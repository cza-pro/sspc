<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <!-- <GuestLayout> -->
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 bg-color-class">

        <div class="w-full py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">

        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="label-class">
                    南一國中社會圖輯網
                </div>
            <div class="mt-5">
                <!-- <InputLabel for="name" value="Name" /> -->
                <label for="name" class="name-lable-class">姓名</label>
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 ml-2 w-80"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-5">
                <!-- <InputLabel for="email" value="Email" /> -->
                <label for="email" class="email-lable-class">電子郵件</label>

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 ml-2 w-80"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <label for="password" class="name-lable-class">密碼</label>

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 ml-2 w-80"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="email-lable-class">確認密碼</label>

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 ml-2 w-80"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center px-6 mt-4 mb-5">
                <Link
                    :href="route('login')"
                    class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    已經註冊?
                </Link>

                <!-- <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    登記
                </PrimaryButton> -->

                <button class="ml-4 button-class">登記</button>

            </div>
        </form>
    <!-- </GuestLayout> -->
    </div>
    </div>
</template>
<style>
    .label-class {
        text-align: center;
        color: #FF8C00;
        font-weight: bold;
    }
    .button-class {
        background-color: #FF8C00;
        width: 60%;
        padding: 9px;
        border-radius: 7px;
        color: white;
    }
    .name-lable-class, .password-lable-class , .email-lable-class{
        color: #FF8C00;
    }
    .name-lable-class {
        padding-left: 40px;
    }
    .email-lable-class {
        padding-left: 10px;
    }
    .bg-color-class {
        background-color: #f0dddf;
    }
</style>
