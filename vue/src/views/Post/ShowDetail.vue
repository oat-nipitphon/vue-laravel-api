<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import { usePostsStore } from "@/stores/posts";
import { useAuthStore } from "@/stores/auth";
const route = useRoute();
const { getPost, deletePost } = usePostsStore();
const authStore = useAuthStore();
const post = ref(null);
const error = ref(null);

onMounted(async () => {
  post.value = await getPost(route.params.id);
});
</script>

<template>
  <div class="container">
    <div style="margin-top: 50px">
      <div class="row text-right">
        <RouterLink
          class="text-lg text-red-600 mb-4"
          :to="{ name: 'DashboardView' }"
          >Back</RouterLink
        >
      </div>
      <div v-if="post">
        <div class="border-l-4 border-blue-500 pl-4 mb-12">
          <h2
            class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl"
          >
            <span>Title: {{ post.title }}</span>
          </h2>
          <div class="" style="background-color:antiquewhite; margin-top: 30px;">
            <p class="mt-6 text-xl/8 text-gray-700 ">
              Content: {{ post.body }}
            </p>
          </div>
          <div class="row max-w-xl text-base/7 text-gray-700 lg:max-w-lg" style="background-color:antiquewhite; margin-top: 100px;">
            <div class="col-md-6">
              <p class="mt-6 text-xl/8 text-gray-700">
                By: {{ post.user.name }}
              </p>
            </div>
            <div class="col-md-6" v-if="post.user_id == authStore.storeUser.id">
              <form @submit.prevent="deletePost(post.id)">
                <button class="text-xs text-red-600 mb-4">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Error message -->
      <div v-else-if="error">
        <p class="text-red-500">{{ error }}</p>
      </div>

      <!-- No post message -->
      <div v-else>
        <p>No post available.</p>
      </div>
    </div>
  </div>
</template>
