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
  console.log(post.value);
});
</script>
<template>
  <div class="mx-auto" style="margin-top: 50px">
    <div class="row text-right mt-10">
      <RouterLink
        class="text-lg text-red-600 mb-4"
        :to="{ name: 'DashboardView' }"
        >Back</RouterLink
      >
    </div>
    <!-- Content layout left -->
    <div style="margin: auto" v-if="post">
      <div class="row">
        <span>
          <label
            class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl"
          >
            {{ post.post.title }}
          </label>
          <label>
            {{ post.post.type }}
          </label>
        </span>
        <p class="mt-6 text-xl/8 text-gray-700">
          {{ post.post.content }}
        </p>
      </div>

      <div style="margin-top: 30px" class="row">
        <div class="col-md-8 text-lef">
          <p class="text-base/7 font-semibold text-gray-500">
            By. {{ post.user.name || " ? " }}
          </p>
        </div>
        <div
          class="col-md-2 text-right"
          v-if="
            post.post.user_id == authStore.storeUser.id ||
            authStore.storeUser.status == 'developer'
          "
        >
          <RouterLink
            class="text-md text-blue-600 mb-4"
            :to="{
              name: 'UpdatePostView',
              params: {
                id: post.id,
              },
            }"
          >
            Update
          </RouterLink>
        </div>
        <div
          class="col-md-2 text-right"
          v-if="
            post.post.user_id == authStore.storeUser.id ||
            authStore.storeUser.status == 'developer'
          "
        >
          <form @submit.prevent="deletePost(post.post.id)">
            <button type="submit" class="text-md text-red-500 mb-4">
              Delete
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
