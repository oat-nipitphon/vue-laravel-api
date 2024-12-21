<script setup lang="ts">
import { ref, onMounted } from "vue";
import { useAuthStore } from '../stores/auth';
import DataTable from 'datatables.net-bs5';
import DataTablesCore  from 'datatables.net-vue3';
DataTable.use(DataTablesCore);
const userStore = useAuthStore();
const userData = ref([]);



onMounted(async () => {
  await userStore.getUser();
  userData.value = userStore.user;
  console.log(userData);
});

</script>
<template>
  <div class="container">
    <span class="title">Report users</span>
  </div>
</template>