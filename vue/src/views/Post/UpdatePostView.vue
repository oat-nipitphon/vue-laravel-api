<script setup>
import { reactive, ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { storeToRefs } from "pinia";
import { useAuthStore } from "@/stores/auth";
import { usePostsStore } from "@/stores/posts";

const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();
const user = authStore.storeUser;
const { errors } = storeToRefs(usePostsStore());
const { updatePost, getPost } = usePostsStore();
const post = ref(null);

const formData = reactive({
  user_id: authStore.storeUser.id,
  title: "",
  body: "",
  post_id: "",
});

// On mounted, fetch the post data
onMounted(async () => {
  post.value = await getPost(route.params.id);
  formData.post_id = post.value.post.id;
  formData.title = post.value.post.title;
  formData.body = post.value.post.body;
});

// Function to handle the back button navigation
const btnBack = () => {
  router.push({ name: "DashboardView" }); // Change this to the correct route for your back button
};
</script>

<template>
  <div class="container">
    <div class="col-md-12">
      <h1 class="title">Update Post ID: {{ formData.post_id }}</h1>
    </div>
    <div class="col-md-12">
      <form class="w-1.5/2 mx-auto space-y-6" @submit.prevent="updatePost(formData)">
        <label class="text-form">Title</label>
        <input
          placeholder="title of the post"
          type="text"
          v-model="formData.title"
          class="form-control"
        />
        <p v-if="errors.title" class="error">{{ errors.title[0] }}</p>

        <label class="text-form">Body</label>
        <textarea
          placeholder="content body of the post"
          v-model="formData.body"
          class="form-control"
          cols="30"
          rows="10"
        ></textarea>
        <p v-if="errors.body" class="error">{{ errors.body[0] }}</p>

        <div class="text-form text-right">
          <button type="submit" class="btn btn-footer btn-primary btn-sm">Update</button>
        </div>
      </form>
      <div class="text-right">
        <button type="submit" class="btn btn-footer btn-danger btn-sm" @click="btnBack">
          Back
        </button>
      </div>
    </div>
  </div>
</template>

<style>
.text-form {
  margin-top: 30px;
  font-size: 16px;
  font-weight: 500;
  color: #000000;
}
.btn-footer {
  margin: 10px;
}
</style>
