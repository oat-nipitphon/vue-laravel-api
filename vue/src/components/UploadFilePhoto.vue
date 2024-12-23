<template>
  <div>
    <form @submit.prevent="uploadFile">
      <input type="file" @change="onFileChange" />
      <button type="submit">Upload</button>
    </form>
  </div>
</template>

<script>
import { ref } from "vue";
import axiosAPI from "../services/axiosAPI";

export default {
  setup() {
    const file = ref(null);

    const onFileChange = (e) => {
      file.value = e.target.files[0];
    };

    const uploadFile = async () => {
      const formData = new FormData();
      formData.append("file", file.value);

      try {
        const response = await axiosAPI.post("/api/uploadFilePhoto", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });
        console.log(response.data);
      } catch (error) {
        console.error(error);
      }
    };

    return {
      onFileChange,
      uploadFile,
    };
  },
};
</script>
