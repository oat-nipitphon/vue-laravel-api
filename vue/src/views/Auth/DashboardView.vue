<script setup>
import { useAuthStore } from "@/stores/auth";
import { ref, onMounted } from "vue";
import { RouterLink } from "vue-router";
import FromView from "../FromView.vue";
import ImageFile from "@/components/ImageFile.vue";
const authStore = useAuthStore();

// Fetch user data when the component is mounted
onMounted(async () => {
  await authStore.getUsers();
});

// Define the system options with their ids and corresponding view names
const systemIboxs = ref([
  { 
    id: 1, 
    link: "ReportUserView", 
    name: "User management system",
    content: "users information, add, delete, edit information or status."
  },
  { 
    id: 2, 
    link: "ReportPostView", 
    name: "Post management system",
    content: "posts information, add, delete, edit information or type." 
  },
]);
</script>

<template>
  <div
    class="bg-white py-24 sm:py-5"
    v-if="authStore.storeUser && systemIboxs.length"
  >

  <div class="row">
    <ImageFile />
  </div>

    <!-- Iterate over systemIboxs to generate RouterLinks for each -->
    <div
      class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t
       border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3"
    >

      <!-- Content for each system box -->
      <div class="row" v-for="systemIbox in systemIboxs" :key="systemIbox.id">
        <RouterLink :to="{ name: systemIbox.link }">
          <div class="ibox-system-header p-6 rounded-lg shadow-lg">
            <div class="text-xl font-semibold">
              {{ systemIbox.name }}
            </div>
            <div class="text-md font-semibold ibox-system-sub-body">
              <p class="ibox-system-font-content">
                {{ systemIbox.content }}
              </p>
            </div>
          </div>
        </RouterLink>
      </div>

    </div>
  </div>
</template>

<style>
.ibox-system-header {
  color: #ffffff;
  margin-top: 30px;
  background-color: rgb(4, 121, 184);
}
.ibox-system-sub-body {
  width: 100%;
  color: #000000;
  margin-top: 30px;
  background-color: rgb(222, 255, 35);
}
.ibox-system-font-content {
  margin: auto;
}
</style>
