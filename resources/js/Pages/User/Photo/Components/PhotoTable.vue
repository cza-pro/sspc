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
    photos: {
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
            <tr v-for="photo, index in props.photos.data" :key="photo.id">
                <td data-label="ID"> {{ (props.photos.meta.per_page*(props.photos.meta.current_page-1))+index+1 }}</td>
                <td data-label="Name">{{ photo.name }}</td>

            </tr>
        </tbody>
    </table>
</template>
