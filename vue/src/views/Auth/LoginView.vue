<script setup>
import axios from "axios";
import { reactive, onMounted } from "vue";
import { useAuthStore } from "@/stores/auth";
import { storeToRefs } from "pinia";
import { useRouter } from "vue-router";

const router = useRouter();
const { errors } = storeToRefs(useAuthStore());
const { authenticate } = useAuthStore();

const formData = reactive({
  email: "",
  password: "",
});

onMounted(() => (errors.value = {}));
</script>

<template>
  <div class="container">
    <div class="row">
      <div
        class="col-md-12"
        style="margin-top: 40px; margin-left: auto; margin-right: auto"
      >
        <form class="mx-auto" @submit.prevent="authenticate(`login`, formData)">
          <div class="row">
            <div class="col-md-6">
              <h1 class="title">
                Login
              </h1>
            </div>
          </div>
          <label style="margin-top: 15px"> Email </label>
          <input
            class="form-control"
            placeholder="email@gmail.com"
            type="email"
            v-model="formData.email"
          />
          <p v-if="errors.email" class="error">{{ errors.email[0] }}</p>
          <label style="margin-top: 15px"> Password </label>
          <input
            class="form-control"
            placeholder="Abc123456789"
            type="password"
            v-model="formData.password"
          />
          <p v-if="errors.password" class="error">{{ errors.password[0] }}</p>
          <button
            type="submit"
            class="btn btn-success"
            style="margin-top: 30px"
          >
            Login
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
