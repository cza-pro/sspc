<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 bg-color-class">

        <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">

            <Head title="Log in" />

            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div class="label-class">
                    南一國中社會圖輯網
                </div>
                <div class="mt-5 text-center">
                    <!-- <InputLabel for="email" value="Email" /> -->

                    <label for="email" class="email-lable-class">帳號</label>
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 ml-2 w-80"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-5 text-center">
                    <label for="password" class="password-lable-class">密碼</label>
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 ml-2 w-80"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <!-- <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="text-sm text-gray-600 ms-2">Remember me</span>
                    </label>
                </div> -->
    <!--
                <div class="flex items-center justify-end mt-4">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Forgot your password?
                    </Link>

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Log in
                    </PrimaryButton>
                </div> -->
                <div class="mt-10 mb-5 text-center">
                    <button class="button-class">登入</button>
                </div>
            </form>

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
        width: 90%;
        padding: 9px;
        border-radius: 7px;
        color: white;
    }
    .email-lable-class, .password-lable-class {
        color: #FF8C00;
    }
    .bg-color-class {
        background-color: #f0dddf;
    }
</style>
