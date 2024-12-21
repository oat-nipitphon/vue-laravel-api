<script setup>
import axios from "axios";
import Swal from "sweetalert2";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import axiosAPI from "../services/axiosAPI";

const router = useRouter();

const form = ref({
  username: "",
  email: "",
  password: "",
  password_confirmation: "",
  title: "",
  body: "",
});

const onSave = async () => {
  try {
    if (form.value.password === form.value.password_confirmation) {
      const response = await axiosAPI.post(`/api/save`, form.value);

      if (response.data.status == 201) {
        console.log("save successfully.");
        Swal.fire("save success.").setTimeout(() => {
          router.push("/");
        }, 1500);
      } else {
        console.log("save error", response.data);
      }
    } else {
      console.error("Passwords do not match.");
      return;
    }
  } catch (error) {
    console.error("Error during save request:", error);
  }
};

import ImageFile from "@/components/ImageFile.vue";

</script>
<template>
  <div class="container">
    <div class="row">
      <ImageFile />
  </div>
  <div>
    <label> Username :: </label>
    <input class="form-control" type="text" v-model="form.username" />
    <label> Email :: </label>
    <input class="form-control" type="email" v-model="form.email" />
    <label> Password :: </label>
    <input class="form-control" type="password" v-model="form.password" />
    <label> Password Confirm :: </label>
    <input
      class="form-control"
      type="password"
      v-model="form.password_confirmation"
    />
    <label> Title :: </label>
    <input type="text" class="form-control" v-model="form.title" />
    <label> Body :: </label>
    <textarea class="form-control" v-model="form.body"></textarea>
    <button class="btn btn-success" style="margin-top: 30px" @click="onSave">
      Save
    </button>
  </div>
  </div>
</template>
