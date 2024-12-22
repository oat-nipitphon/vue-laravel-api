<script setup>
import { reactive, ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { storeToRefs } from "pinia";
import { useAuthStore } from "@/stores/auth";
import { usePostsStore } from "@/stores/posts";
import { usePostTypeStore } from "@/stores/postType";

const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();
const { getPostType } = usePostTypeStore();
const user = authStore.storeUser;
const { errors } = storeToRefs(usePostsStore());
const { updatePost, getPost } = usePostsStore();
const post = ref(null);
const formPostType = ref(null);
const formData = reactive({
  user_id: authStore.storeUser.id,
  title: "",
  content: "",
  post_id: "",
  postType: "",
});

// On mounted, fetch the post data
onMounted(async () => {
  post.value = await getPost(route.params.id);
  formData.post_id = post.value.post.id;
  formData.title = post.value.post.title;
  formData.content = post.value.post.content;
  formData.postType = post.value.post.type;

  const postTypes = await getPostType();
  if (Array.isArray(postTypes)) {
    formPostType.value = postTypes;
  } else {
    console.error("Failed to fetch post types.");
  }

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
        <label class="text-form">Type</label>
        <div class="custom-select-wrapper">
          <select
            class="form-control"
            id="selectOption"
            v-model="formData.postType"
          >
            <option
              v-for="type in formPostType"
              :key="type.id"
              :value="type.type_name"
            >
              {{ type.type_name }}
            </option>
            <option value="addNew">เพิ่มตัวเลือกใหม่</option>
          </select>

          <!-- Show input when "addNew" is selected -->
          <div
            v-if="formData.postType === 'addNew'"
            id="addInputWrapper"
            class="add-input"
          >
            <label for="newOption">กรุณากรอกข้อมูลใหม่:</label>
            <input
              class="form-control"
              type="text"
              id="newOption"
              v-model="formData.newPostType"
              placeholder="กรอกข้อมูลใหม่ที่นี่"
            />
          </div>
        </div>
        <label class="text-form">Title</label>
        <input
          placeholder="title of the post"
          type="text"
          v-model="formData.title"
          class="form-control"
        />
        <p v-if="errors.title" class="error">{{ errors.title[0] }}</p>

        <label class="text-form">Content</label>
        <textarea
          placeholder="content of the post"
          v-model="formData.content"
          class="form-control"
          cols="30"
          rows="10"
        ></textarea>
        <p v-if="errors.content" class="error">{{ errors.content[0] }}</p>

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
