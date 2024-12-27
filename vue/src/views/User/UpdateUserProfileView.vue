<template>
    <div class="container">

    </div>
</template>
<script setup>
import { onMounted, reactive, ref } from "vue";
import { useDefineStoreUsers } from '@/stores/users';
import { useRoute, useRouter } from "vue-router";

const userEdit = ref(null);
const updateUserProfile = reactive({

});

onMounted(async () => {
    
});

</script>