<script setup>
import { computed, ref ,reactive,onMounted} from 'vue';
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

  feature_images: {
    type: Object,
    default: {}
  }

})

const removeFeatureImage = (feature_image) => {
    console.log(feature_image);
  router.post(
    route("admin.feature_image.remove", {
      feature_image: feature_image,
    }),
    {
      onSuccess: () => {
          toast.add({
            message: "Remove Feature Image!",
        })
      },
      onError: () => {
        toast.add({
          message: "Remove failed !",
        });
      },
    }
  );
};

const deleteFeatureImage = (feature_image) => {
    console.log(feature_image);
  router.delete(
    route("admin.feature_image.delete", {
      feature_image: feature_image,
    }),
    {
      onSuccess: () => {
          toast.add({
            message: "Remove Feature Image!",
        })
      },
      onError: () => {
        toast.add({
          message: "Remove failed !",
        });
      },
    }
  );
};

</script>

<template>


  <CardBox has-table>
    <p>feature_image</p>
    <table class="text-xs bg-white rounded">
        <thead>
            <tr>
                <th class="text-left">စဥ်</th>
                <th class="text-left">အမည်</th>
                <th class="text-left">No</th>
                <th class="text-left">Name</th>
                <th class="text-left">Photo Type</th>
                <th class="text-left">Photo Size</th>
            </tr>
        </thead>
        <tbody>


            <tr v-for="(feature_image, index) in props.feature_images" :key="feature_image.id">
                <td class="text-left">{{ index + 1}}</td>
                <td class="text-left">{{ feature_image.name }}</td>
                <td class="text-left">{{ feature_image.photo_type }}</td>
                <td class="text-left">{{ feature_image.photo_size }}</td>
                <img
                    :src="feature_image.feature_photo_url"
                    class="w-10 h-10 mx-auto"
                    alt="feature image"
                />

                <td>
                   <PrimaryButton class="ml-3" @click="removeFeatureImage(feature_image.id)">
                        Remove
                    </PrimaryButton>

                   <PrimaryButton class="ml-3" @click="deleteFeatureImage(feature_image.id)">
                        Delete
                    </PrimaryButton>
                </td>

              </tr>

            </tbody>
    </table>
  </CardBox>

</template>

<style scoped>
.text-disable {
    color: red;
}
</style>
<style src="@vueform/toggle/themes/default.css"></style>
