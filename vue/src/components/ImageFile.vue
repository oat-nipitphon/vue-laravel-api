<script setup>
import { reactive, ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useSupportStore } from "@/stores/support";

const authStore = useAuthStore();
const { uploadUserPhoto } = useSupportStore();

const fileInput = ref(null);
const userPhotoURL = ref(null);

const formData = reactive({
  user_id: null,
  filePhoto: null,
});

const handleFileChange = (event) => {
  const file = event.target.files[0];

  formData.filePhoto = event.target.files[0];
  console.log(formData.filePhoto);
  showInputFileEXP(file);
};

const showInputFileEXP = (file) => {
  // Check status file show exp input
  if (file && file.type.startsWith("image/")) {
    userPhotoURL.value = URL.createObjectURL(file);
    console.log("Preview URL:", userPhotoURL.value);
  } else {
    event.target.value = ""; // Reset file input
    console.log("Please select a valid image file.");
  }
  return file;
};

const openFileInput = () => {
  fileInput.value.click();
};
</script>

<template>
  <div class="flex-container">
    <form @submit.prevent="uploadUserPhoto(formData)">
      <div class="ibox-file-photo">
        <div class="row">
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
            @change="handleFileChange"
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
        </div>
        <div class="row" style="margin-top: 50px">
          <button type="submit" class="btn btn-sm btn-success">Upload</button>
        </div>
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
}

.flex-container img {
  display: block;
  margin: 0 auto;
}

.row {
  margin-bottom: 20px;
}
</style>
