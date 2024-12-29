<script setup>
import { onMounted, reactive, ref } from "vue";
import { useRoute, useRouter, RouterLink } from "vue-router";
import { useDefineStoreUser } from "@/stores/users";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
const route = useRoute();
const user = ref(null);
const { apiGetUser, apiUpdateUser } = useDefineStoreUser();

const formUpdate = reactive({
  userId: "",
  name: "",
  email: "",
  status: "",
  titleName: "",
  firstName: "",
  lastName: "",
  address: "",
  telPhone: "",
  birthDay: "",
});

onMounted(async () => {
  user.value = await apiGetUser(route.params.id);
  if (user.value) {
    formUpdate.userId = user.value.id || "";
    formUpdate.name = user.value.name || "";
    formUpdate.email = user.value.email || "";
    formUpdate.status = user.value.status || "";
    formUpdate.titleName = user.value.user_profiles?.title_name || "";
    formUpdate.firstName = user.value.user_profiles?.first_name || "";
    formUpdate.lastName = user.value.user_profiles?.last_name || "";
    formUpdate.address = user.value.user_profiles?.address || "";
    formUpdate.telPhone = user.value.user_profiles?.tel_phone || "";
    formUpdate.birthDay = user.value.user_profiles?.birth_day || "";
  }
});
</script>

<template>
  <div class="container">
    <div class="ibox-form-update" v-if="user">
      <form @submit.prevent="apiUpdateUser(formUpdate)">
        <div class="row">
          <div class="col-md-6 text-center">
            User ID :: {{ user.id }}
            <input
              type="hidden"
              v-model="formUpdate.userId"
              class="form-control"
            />
          </div>
          <div class="col-md-6 text-center">
            <div class="row" v-if="formUpdate.status == 'developer'">
              <div class="col-md-3">
                <label> Status :: </label>
              </div>
              <div class="col-md-9">
                <input
                  type="text"
                  v-model="formUpdate.status"
                  class="form-control"
                />
              </div>
            </div>
            <div v-else>Status :: {{ user.status }}</div>
          </div>

          <div class="col-md-4">
            <label>email</label>
            <input
              type="email"
              v-model="formUpdate.email"
              class="form-control"
            />
          </div>
          <div class="col-md-4">
            <label>name</label>
            <input type="text" 
            v-model="formUpdate.name" 
            class="form-control" 
            />
          </div>
          <div class="col-md-4">
            <label for="">telPhone</label>
            <input
              type="number"
              v-model="formUpdate.telPhone"
              class="form-control"
            />
          </div>

          <div class="col-md-4">
            <label for="">titleName</label>
            <input
              type="text"
              v-model="formUpdate.titleName"
              class="form-control"
            />
          </div>
          <div class="col-md-4">
            <label for="">firstName</label>
            <input
              type="text"
              v-model="formUpdate.firstName"
              class="form-control"
            />
          </div>
          <div class="col-md-4">
            <label for="">lastName</label>
            <input
              type="text"
              v-model="formUpdate.lastName"
              class="form-control"
            />
          </div>

          <div class="col-md-4">
            <label for="">birthDay</label>
            <input
              type="date"
              v-model="formUpdate.birthDay"
              class="form-control"
            />
          </div>
          <div class="col-md-8">
            <label for="">address</label>
            <textarea
              v-model="formUpdate.address"
              cols="30"
              rows="10"
              placeholder="address.."
            ></textarea>
          </div>
        </div>
        <div class="row">
          <button class="btn btn-sm btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</template>
<style>
.ibox-form-update {
  width: 80%;
  margin: auto;
  font-size: 16px;
  font-weight: 700;
}
</style>
