<script setup>

import BaseButton from "@/Components/BaseButton.vue";
import { Link, useForm } from "@inertiajs/vue3";


const props = defineProps({
    posts: {
        type: Object,
        default: {}
    },
})

</script>

<template>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="post, index in props.posts.data" :key="post.id">
                <td data-label="ID"> {{ (props.posts.meta.per_page*(props.posts.meta.current_page-1))+index+1 }}</td>
                <td data-label="Name">{{ post.name }}</td>
            </tr>
        </tbody>
    </table>
</template>
