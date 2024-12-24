<script setup>
import { useAuthStore } from "@/stores/auth";
import { ref, onMounted } from "vue";
import { RouterLink } from "vue-router";

const authStore = useAuthStore();

onMounted(async () => {
  await authStore.getUsers();
});

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
  <div class="container">
  <div
    class="row bg-white py-24 sm:py-5"
    v-if="authStore.storeUser && systemIboxs.length"
  >
      <!-- Content for each system box -->
      <div class="col-md-6" v-for="systemIbox in systemIboxs" :key="systemIbox.id">
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
  color: #ffffff;
  margin-top: 30px;
}
.ibox-system-font-content {
  margin: auto;
}
</style>
