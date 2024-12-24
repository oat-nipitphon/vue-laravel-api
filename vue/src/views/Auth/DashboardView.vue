<script setup>
import { ref, onMounted } from "vue";
import axiosAPI from "@/services/axiosAPI";
import { useAuthStore } from "@/stores/auth";
import ReportSystem from "@/views/Auth/ReportSystem.vue";
import { useRouter } from "vue-router";

const router = useRouter();
const authStore = useAuthStore();
const file = ref(null);

const onFileChange = (e) => {
  file.value = e.target.files[0];
};

const uploadFile = async () => {
  const formData = new FormData();
  formData.append("user_id", authStore.storeUser.id);
  formData.append("file", file.value);

  try {
    const response = await axiosAPI.post("/api/uploadFilePhoto", formData, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
        "Content-Type": "multipart/form-data",
      },
    });

    if (response.data) {
      router.push({ name: 'ReportUserView' });
      console.log("upload photo success : ", response.data);
    } else {

    }

  } catch (error) {
    console.error(error);
  }
};

onMounted(async () => {
  await authStore.getUsers();
});

</script>

<template>
  <div class="container">
    <div class="row">
      <form @submit.prevent="uploadFile">
      {{ authStore.storeUser.id }}
      <input type="file" @change="onFileChange" />
      <button type="submit">Upload</button>
    </form>
    </div>
  <div class="row">
    <ReportSystem />
  </div>
</div>
</template>

<style>
.ibox-system-header {
  color: #ffffff;
  margin-top: 30px;
  background-color: rgb(4, 121, 184);
}
.ibox-system-sub-body {
  width: 100%;
  color: #ffffff;
  margin-top: 30px;
}
.ibox-system-font-content {
  margin: auto;
}
</style>
