<script setup>
const authStore = useAuthStore();
import { reactive, ref } from "vue";
import { usePostsStore } from "@/stores/posts";
import { useAuthStore } from "@/stores/auth";

const { createPost } = usePostsStore();

const form = ref({
  fileImg: null
});

const handleFileChange = (e) => {
  form.fileImg = e.target.files[0];
};

</script>

<template>
  <div class="flex-container">
    <form @submit.prevent="createPost(form)">
    <input type="file" @change="handleFileChange">
      <button type="submit">upload</button>
    </form>
  </div>
</template>

<style>
.flex-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 300px;
  background-color: #f1f1f1;
}

.flex-container > div {
  background-color: #4caf50;
  color: white;
  width: 100px;
  height: 100px;
}
</style>
