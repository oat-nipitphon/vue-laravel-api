<script setup>
import { useAuthStore } from "@/stores/auth";
import { usePostsStore } from "@/stores/posts";
import { reactive } from "vue";
import { storeToRefs } from "pinia";

const authStore = useAuthStore();
const user = authStore.storeUser;
const { errors } = storeToRefs(usePostsStore());
const { createPost } = usePostsStore();

const handleFileChange = (e) => {
  formData.photo = e.target.files[0];
};

const formData = reactive({
  user_id: authStore.storeUser.id,
  title: "",
  content: "",
  type: "",
});
</script>
<script>
function toggleAddInput() {
    var select = document.getElementById("selectOption");
    var addInputWrapper = document.getElementById("addInputWrapper");
    var addOptionText = document.getElementById("addOptionText");

    if (select.value === "addNew") {
        addInputWrapper.style.display = "block";
        addOptionText.style.display = "none";
    } else {
        addInputWrapper.style.display = "none";
        addOptionText.style.display = "inline-block";
    }
}
</script>
<template>
  <div class="container">
    <div class="col-md-12">
      <h1 class="title" style="margin-top: 50px">Create Post</h1>
    </div>
    <div class="col-md-12">
      <form class="w-1/2 mx-auto space-y-6" @submit.prevent="createPost(formData)">

        <label class="text-form">type</label>
        <!-- <select class="form-control" v-model="formData.type">
          <option value=""></option>
        </select> -->

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
          v-model="formData.body"
          class="form-control"
          cols="30"
          rows="10"
        >
        </textarea>
        <p v-if="errors.body" class="error">{{ errors.body[0] }}</p>

        <label class="text-form">
          <button type="submit" class="btn btn-success">Save</button>
        </label>
      </form>
    </div>
  </div>
</template>
<style>
.text-form {
  margin-top: 20px;
  font-size: 16px;
  font-weight: 500;
  color: #000000;
}
</style>
