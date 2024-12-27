<script setup>
import axios from "axios";

import moment from 'moment-timezone';
function dateTimeNow() {
  const dateTime = moment.tz('Asia/Bangkok').format('YYYY-MM-DD HH:mm:ss');
  return dateTime;
}

import { reactive, onMounted } from "vue";
import { useAuthStore } from "@/stores/auth"
import { storeToRefs } from "pinia";

const { errors } = storeToRefs(useAuthStore());
const { authenticate } = useAuthStore();

const formData = reactive({
  email: "",
  password: "",
});

onMounted(() => (errors.value = {}));

</script>

<template>
  <div class="row">
    <div
      class="col-md-12"
      style="margin-top: 40px; margin-left: auto; margin-right: auto"
    >
      <form class="mx-auto"
        @submit.prevent="authenticate(`login`, formData)"
        >
        <div class="row">
          <div class="col-md-6">
            <h1 class="title">
                Login 
                <!-- {{ authStore }} -->
            </h1>
          </div>
          <div class="col-md-6 text-center">
            <label class="error" style="font-size: 16px;">
              {{ dateTimeNow() }}
            </label>
            <!-- <input type="hidden" v-model="formData.created" /> -->
          </div>
        </div>
        <label style="margin-top: 15px;"> Email </label>
        <input
          class="form-control"
          placeholder="email@gmail.com"
          type="email"
          v-model="formData.email"
          autocomplete="email"
        />
        <p v-if="errors.email" class="error">{{ errors.email[0] }}</p>
        <label style="margin-top: 15px;"> Password </label>
        <input
          class="form-control"
          placeholder="Abc123456789"
          type="password"
          v-model="formData.password"
          autocomplete="current-password"
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
</template>