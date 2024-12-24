<template>
  <div class="container">
    <div class="col-md-12">
      <h1 class="title" style="margin-top: 50px">Create Post</h1>
    </div>
    <div class="col-md-12">
      <form class="w-1/2 mx-auto space-y-6" @submit.prevent="formSubmitNewPost">
        <!-- <div class="row">
          <img
            :src="
              userPhotoURL ||
              'https://png.pngtree.com/png-clipart/20190920/original/pngtree-file-upload-icon-png-image_4646955.jpg'
            "
            alt="Image Preview"
            style="width: 250px; height: 150px"
          />
        </div>
        <div class="row">
          <input
            ref="fileInput"
            type="file"
            @change="onFileChange"
            accept="image/*"
            hidden
          />
          <button
            type="button"
            class="btn btn-sm btn-primary"
            @click="openFileInput"
          >
            Choose File
          </button>
        </div> -->
        <label class="text-form">Type</label>
        <div class="custom-select-wrapper">
          <select
            class="form-control"
            id="selectOption"
            v-model="formNewPost.postType"
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
            v-if="formNewPost.postType === 'addNew'"
            id="addInputWrapper"
            class="add-input"
          >
            <label for="newOption">กรุณากรอกข้อมูลใหม่:</label>
            <input
              class="form-control"
              type="text"
              id="newOption"
              v-model="formNewPost.newPostType"
              placeholder="กรอกข้อมูลใหม่ที่นี่"
            />
          </div>
        </div>

        <label class="text-form">Title</label>
        <input
          placeholder="title a post"
          type="text"
          v-model="formNewPost.title"
          class="form-control"
        />
        <p v-if="errors.title" class="error">{{ errors.title[0] }}</p>

        <label class="text-form">Body</label>
        <textarea
          placeholder="content body a post"
          v-model="formNewPost.content"
          class="form-control"
          cols="30"
          rows="10"
        ></textarea>
        <p v-if="errors.content" class="error">{{ errors.content[0] }}</p>

        <label class="text-form">Upload Photo</label>
        <input type="file" @change="onFileChange" class="form-control" />
        <p v-if="errors.photo" class="error">{{ errors.photo[0] }}</p>

        <button type="submit" class="btn btn-success">Save</button>
      </form>
    </div>
  </div>
</template>

<script setup>

import axiosAPI from "@/services/axiosAPI";
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

const formPostType = ref(null);
const fileInput = ref(null);
const fileImgURL = ref(null);

const formNewPost = reactive({
  userID: authStore.storeUser.id,
  title: null,
  content: null,
  postType: null,
  fileImg: null,
});


const onFileChange = (e) => {
  fileInput.value = e.target.files[0];
  const file = e.target.files[0];
  console.log(fileInput.value);
  
  fileImgURL.value = URL.createObjectURL(file);
  
  console.log(fileImgURL.value);
};

const formSubmitNewPost = async () => {
  const payload = new FormData();
  payload.append("userID", formNewPost.userID);
  payload.append("title", formNewPost.title);
  payload.append("content", formNewPost.content);
  payload.append("postType", formNewPost.postType);
  payload.append("fileImg", fileInput.value);

  try {
    const response = await axiosAPI.post("/api/posts", payload, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
            "Content-Type": "multipart/form-data",
          },
        });

        console.log(response.data);
        
  } catch (error) {
    console.log("await error : ", error);
  }

};

onMounted(async () => {
  // get type post
  const postTypes = await getPostType();
  if (Array.isArray(postTypes)) {
    formPostType.value = postTypes;
  } else {
    console.error("Failed to fetch post types.");
  }
});
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
