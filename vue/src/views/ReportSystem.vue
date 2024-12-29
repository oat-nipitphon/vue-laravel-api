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
    content: "users information, add, delete, edit information or status.",
  },
  {
    id: 2,
    link: "ReportPostView",
    name: "Post management system",
    content: "posts information, add, delete, edit information or type.",
  },
]);
</script>

<template>
  <div class="container">
    <div class="row" v-if="systemIboxs">
      <div
        class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2 p-1 mt-2 mx-auto lg:mx-2 md:mx-2 justify-between"
      >
        <!--Top user 1-->
        <div
          class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3"
          v-for="systemIbox in systemIboxs"
          :key="systemIbox.id"
        >
          <RouterLink :to="{ name: systemIbox.link }">
            <div class="row">
              <img src="https://i.imgur.com/w1Bdydo.jpg" class="w-full" />
              <div class="flex justify-center -mt-8">
                <img
                  src="https://i.imgur.com/8Km9tLL.jpg"
                  class="rounded-full border-solid border-white border-2 -mt-3"
                />
              </div>
              <div class="text-center px-3 pb-6 pt-2">
                <h3 class="text-black text-sm bold font-sans">
                  {{ systemIbox.name }}
                </h3>
                <p class="mt-2 font-sans font-light text-grey-700">
                  {{ systemIbox.content }}
                </p>
              </div>
              <div class="flex justify-center pb-3 text-grey-dark">
                <div class="text-center mr-3 border-r pr-3">
                  <span class="text-sm">ADMIN</span>
                </div>
                <div class="text-center">
                  <span class="text-sm">USER</span>
                </div>
              </div>
            </div>
          </RouterLink>
        </div>
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
