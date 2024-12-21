<script setup>
import { useAuthStore } from "@/stores/auth";
import { onMounted } from "vue";
import ReportPostView from "../Post/ReportPostView.vue";

const authStore = useAuthStore();

onMounted(async () => {
  await authStore.getUsers();
});



</script>
<template>
  <div v-if="authStore.storeUser" class="container">
    <div class="title text-center">
      Dashboard welcome to {{ authStore.storeUser.name }}
    </div>
    <div class="content">
      <ReportPostView />
    </div>
  </div>
</template>
