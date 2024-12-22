<script setup>
import { reactive, ref } from "vue";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();

import { useSupportStore } from "@/stores/support";
const { uploadImg } = useSupportStore();

const fileInput = ref(null);
const postPhotoURL = ref(null);

const form = reactive({
  userID: authStore.storeUser.id,
  file: null
});

const openFileInput = () => {
  fileInput.value.click();
};

const handleFileChange = (event) => {
  form.file = event.target.files[0];
  postPhotoURL.value = URL.createObjectURL(form.file);
};

const submitForm = () => {
  // Create FormData object inside the submit function
  const formData = new FormData();
  formData.append('user_id', form.userID);
  formData.append('user_img', form.file);
  formData.append('user_img_url', postPhotoURL.value);

  // Call the action to upload the image
  uploadImg(formData);
};

</script>

<template>
  <div class="flex-container">
    <form @submit.prevent="submitForm">
      <div class="row">
        <img 
          style="width: 250px; height: 150px;"
          :src="postPhotoURL || 'https://png.pngtree.com/png-clipart/20190920/original/pngtree-file-upload-icon-png-image_4646955.jpg'"
          alt="Image Preview"
        >
      </div>
      <div class="row">
        <input ref="fileInput" type="file" @change="handleFileChange">
      </div>
      <div class="row" style="margin-top: 50px;">
        <button type="submit" class="btn btn-sm btn-success">Upload</button>
      </div>
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
