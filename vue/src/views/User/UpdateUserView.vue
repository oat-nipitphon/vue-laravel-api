<script setup>
import { onMounted, reactive, ref } from "vue";
import { useRoute, useRouter, RouterLink } from "vue-router";
import { useDefineStoreUser } from "@/stores/users";

const route = useRoute();
const user = ref(null);
const { apiGetUser, apiUpdateUser } = useDefineStoreUser();

const formUpdate = reactive({
  userId: "",
  statusUser: "",
  email: "",
  userName: "",
  titleName: "",
  firstName: "",
  lastName: "",
  birthDay: "",
  telPhone: "",
  address: "",
  zipCode: "",
});

onMounted(async () => {
  user.value = await apiGetUser(route.params.id);
  if (user.value) {
    formUpdate.userId = user.value?.id || "";
    formUpdate.statusUser = user.value?.status || "";
    formUpdate.email = user.value?.email || "";
    formUpdate.userName = user.value?.name || "";
    formUpdate.titleName = user.value.user_profiles?.title_name || "";
    formUpdate.firstName = user.value.user_profiles?.first_name || "";
    formUpdate.lastName = user.value.user_profiles?.last_name || "";
    formUpdate.birthDay = user.value.user_profiles?.birth_day || "";
    formUpdate.telPhone = user.value.user_profiles?.tel_phone || "";
    formUpdate.address = user.value.user_profiles?.address || "";
    formUpdate.zipCode = user.value.user_profiles?.zip_code || "";
  }
});
</script>

<template>
  <div class="container">
    <div class="ibox-form-update" v-if="user">
      <form @submit.prevent="apiUpdateUser(formUpdate)">
        <div class="row">
          <input type="hidden" class="form-control" v-model="formUpdate.userId">
          <select class="form-control" v-model="formUpdate.titleName">
            <option value="null">--select--</option>
            <option value="mr">Mr.</option>
            <option value="miss">Miss.</option>
            <option value="mrs">Mrs.</option>
          </select>
          <label for="">Email</label>
          <input type="text" class="form-control" v-model="formUpdate.email">
          <label for="">Username</label>
          <input type="text" class="form-control" v-model="formUpdate.userName">
          <label for="">titleName</label>
          <select class="form-control" v-model="formUpdate.titleName">
            <option value="null">--select--</option>
            <option value="mr">Mr.</option>
            <option value="miss">Miss.</option>
            <option value="mrs">Mrs.</option>
          </select>
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
          <label for="">birthDay</label>
          <input
            type="date"
            v-model="formUpdate.birthDay"
            class="form-control"
          />
          <label for="">telPhone</label>
          <input
            type="number"
            v-model="formUpdate.telPhone"
            class="form-control"
          />
          <label for="">address</label>
          <textarea
            v-model="formUpdate.address"
            cols="30"
            rows="5"
            placeholder="address.."
          ></textarea>
          <label for="">zip code</label>
          <input type="text" class="form-control" v-model="formUpdate.zipCode">
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
