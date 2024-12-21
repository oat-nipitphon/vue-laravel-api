<script setup>
import { ref, onMounted, reactive } from "vue";
import { usePostsStore } from "@/stores/posts";
import { RouterLink } from "vue-router";

const { getAllPosts } = usePostsStore();
const posts = ref([]);

onMounted(async () => {
  posts.value = await getAllPosts();
  console.log("Posts :: ", posts);
});
</script>

<template>
  <div class="container">
    <div class="col-md-12 text-right" style="margin-top: 30px">
      <RouterLink class="btn btn-primary btn-sm" :to="{ name: 'NewPostView' }">
        New Post
      </RouterLink>
    </div>
    <div style="margin-top: 30px">
      <div v-if="posts.length > 0">
        <div
          class="border-l-4 border-blue-500 pl-4 mb-12"
          v-for="post in posts"
          :key="post.id"
        >
          <h1 class="font-bold text-3xl">
            {{ post.title }}
          </h1>
          <div class="text-xs text-slate-600 mb-4">
            {{ post.body }}
          </div>

          <div>
            <RouterLink
              :to="{
                name: 'DetailPostView',
                params: { id: post.id },
              }"
            >
              Move..
            </RouterLink>
          </div>
        </div>
      </div>
      <div v-else>
        <p>No posts available.</p>
      </div>
    </div>
  </div>
</template>
