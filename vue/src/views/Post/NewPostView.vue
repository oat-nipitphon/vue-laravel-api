<script setup>
import { useAuthStore } from "@/stores/auth";
import { usePostsStore } from "@/stores/posts";
import { usePostTypeStore } from "@/stores/postType";
import { reactive, ref, onMounted } from "vue";
import { storeToRefs } from "pinia";

const authStore = useAuthStore();
const user = authStore.storeUser;
const { errors } = storeToRefs(usePostsStore());
const { createPost } = usePostsStore();
const { getPostType } = usePostTypeStore();


const formData = reactive({
  user_id: authStore.storeUser.id,
  title: "",
  content: "",
  postType: "",
  photo: null,
  newPostType: "", // for new type input
});


const handleFileChange = (e) => {
  formData.photo = e.target.files[0];
};

const formPostType = ref([]);

onMounted(async () => {
  const postTypes = await getPostType();
  if (Array.isArray(postTypes)) {
    formPostType.value = postTypes;
  } else {
    console.error("Failed to fetch post types.");
  }
});
</script>

<template>
  <div class="container">
    <div class="col-md-12">
      <h1 class="title" style="margin-top: 50px">Create Post</h1>
    </div>
    <div class="col-md-12">
      <form
        class="w-1/2 mx-auto space-y-6"
        @submit.prevent="createPost(formData)"
      >
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
          placeholder="title a post"
          type="text"
          v-model="formData.title"
          class="form-control"
        />
        <p v-if="errors.title" class="error">{{ errors.title[0] }}</p>

        <label class="text-form">Body</label>
        <textarea
          placeholder="content body a post"
          v-model="formData.content"
          class="form-control"
          cols="30"
          rows="10"
        ></textarea>
        <p v-if="errors.content" class="error">{{ errors.content[0] }}</p>

        <label class="text-form">Upload Photo</label>
        <input type="file" @change="handleFileChange" class="form-control" />
        <p v-if="errors.photo" class="error">{{ errors.photo[0] }}</p>

        <button type="submit" class="btn btn-success">Save</button>
      </form>
    </div>
  </div>
</template>

<script>
function toggleAddInput() {
  // This function is no longer necessary as Vue handles conditional rendering with v-if
}
</script>

<style>
.text-form {
  margin-top: 20px;
  font-size: 16px;
  font-weight: 500;
  color: #000000;
}

.add-input {
  margin-top: 10px;
}

.error {
  color: red;
  font-size: 12px;
}
</style>
