<script setup>
import { onMounted, reactive, ref } from "vue";
import { useRoute, useRouter, RouterLink } from "vue-router";
import { useDefineStoreUser } from "@/stores/users";

const route = useRoute();
const user = ref(null);
const { apiGetUser, apiUpdateUser } = useDefineStoreUser();

const formUpdate = reactive({
    userId: "",
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
        formUpdate.userId = user.value.id;
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
          <label for="">
            ID :: {{ user.id }}
            <input
              type="text"
              v-model="formUpdate.userId"
              class="form-control"
            />
          </label>
          <label for=""> Name :: {{ user.name }} </label>
        </div>
        <div class="row">

            <label for="">titleName</label>
          <input
            type="text"
            v-model="formUpdate.titleName"
            class="form-control"
          />

          <label for="">firstName</label>
          <input
            type="text"
            v-model="formUpdate.firstName"
            class="form-control"
          />

          <label for="">lastName</label>
          <input
            type="text"
            v-model="formUpdate.lastName"
            class="form-control"
          />

          <label for="">address</label>
          <textarea
            v-model="formUpdate.address"
            cols="30"
            rows="10"
            placeholder="address.."
          ></textarea>

          <label for="">telPhone</label>
          <input type="number" v-model="formUpdate.telPhone" class="form-control" />

          <label for="">birthDay</label>
          <input type="date" v-model="formUpdate.birthDay" class="form-control" />
          
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
