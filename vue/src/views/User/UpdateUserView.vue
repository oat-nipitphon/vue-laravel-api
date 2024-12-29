
<style>
.ibox-form-update {
  width: 90%;
  margin: auto;
  margin-top: 40px;
  font-size: 16px;
  font-weight: 700;
}
.label-form-update {
  margin-top: 20px;
  margin-bottom: 20px;
  font-weight: 500;
  font-size: 16px;
}
</style>

<template>
  <div class="container">
    <div class="ibox-form-update" v-if="user">
      <form @submit.prevent="apiUpdateUser(formUpdate)">
        <div class="row">
          <div class="col-md-4">
            <label class="label-form-update"> User ID :: {{ user.id }} </label>
            <input
              type="hidden"
              v-model="formUpdate.userId"
              class="form-control"
            />
          </div>
          <div class="col-md-4">
            <label class="label-form-update">
              Status :: {{ user.status }}
            </label>
          </div>
          <div class="col-md-4">
            <label class="label-form-update">Birth Day</label>
            <input
              type="date"
              v-model="formUpdate.birthDay"
              class="form-control"
            />
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <label class="label-form-update">Email</label>
            <input
              type="email"
              v-model="formUpdate.email"
              class="form-control"
            />
          </div>
          <div class="col-md-4">
            <label class="label-form-update">Name</label>
            <input type="text" v-model="formUpdate.name" class="form-control" />
          </div>
          <div class="col-md-4">
            <label class="label-form-update">Tel Phone</label>
            <input
              type="text"
              v-model="formUpdate.telPhone"
              class="form-control"
            />
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <label class="label-form-update">Title Name</label>
            <input
              type="text"
              v-model="formUpdate.titleName"
              class="form-control"
            />
          </div>
          <div class="col-md-4">
            <label class="label-form-update">First Name</label>
            <input
              type="text"
              v-model="formUpdate.firstName"
              class="form-control"
            />
          </div>
          <div class="col-md-4">
            <label class="label-form-update">Last Name</label>
            <input
              type="text"
              v-model="formUpdate.lastName"
              class="form-control"
            />
          </div>
        </div>

        <div class="row">


          <div class="col-md-6">
            <label class="label-form-update">Address</label>
            <textarea
              v-model="formUpdate.address"
              cols="30"
              rows="3"
              class="form-control"
              placeholder="Address..."
            ></textarea>
          </div>
          <div class="col-md-6">
            <label class="label-form-update">Photo</label>
            <div class="row">
              <img
                :src="
                  userPhotoURL ||
                  'https://png.pngtree.com/png-clipart/20190920/original/pngtree-file-upload-icon-png-image_4646955.jpg'
                "
                alt="Image Preview"
                style="width: 250px; height: 200px; margin:auto;"
              />
            </div>
            <div class="row" style="margin-top: 20px;">
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
          </div>

        </div>

        <div class="row">
          <div class="col-md-12">
            <!-- <label class="label-form-update">Photo</label>
            <input type="file" ref="fileInput" class="form-control" /> -->
          </div>
        </div>

        <div class="col-md-12 text-right">
          <button
            type="submit"
            class="btn btn-sm btn-primary"
            :disabled="loading"
          >
            Update
          </button>
          <button class="btn btn-sm btn-danger">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { onMounted, reactive, ref } from "vue";
import { useRoute, useRouter, RouterLink } from "vue-router";
import { useDefineStoreUser } from "@/stores/users";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
const loading = ref(false);
const route = useRoute();
const { apiGetUser, apiUpdateUser } = useDefineStoreUser();

const user = ref(null);
const fileInput = ref(null);
const userPhotoURL = ref(null);
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
  filePhoto: "",
});

onMounted(async () => {
  user.value = await apiGetUser(route.params.id);
  console.log(user.value);
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

const openFileInput = () => {
  fileInput.value.click();
};

const handleFileChange = (event) => {
  const file = event.target.files[0];

  formUpdate.filePhoto = event.target.files[0];
  console.log(formUpdate.filePhoto);
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

</script>



