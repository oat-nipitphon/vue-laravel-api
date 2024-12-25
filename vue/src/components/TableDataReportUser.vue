<script setup lang="ts">
import { ref, onMounted, reactive, render } from "vue";
import { useDefineStoreUser } from "@/stores/users";
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs5";
DataTable.use(DataTablesCore);

const usersStore = useDefineStoreUser();
const userProfilePhotos = ref([]);

onMounted(async () => {
  await usersStore.apiUserProfilePhoto();
  userProfilePhotos.value = usersStore.reqUsers.map((user: any) => ({
    id: user.id || null,
    photo: user.user_photos?.photo_name || "PhotoDefault.png",
    status: user.status || "N/A",
    email: user.email || "N/A",
    fullname: [
      user.user_profiles?.title_name || "",
      user.user_profiles?.first_name || "",
      user.user_profiles?.last_name || "",
    ]
      .filter(Boolean)
      .join(" "),
    created_at: formatDate(user.created_at), // ใช้ฟังก์ชัน formatDate
  }));
});

function formatDate(date: string): string {
  const d = new Date(date); // แปลงจาก string เป็น Date object
  const day = d.getDate().toString().padStart(2, '0'); // หาวันที่ พร้อมเติม 0 ถ้าน้อยกว่า 10
  const month = (d.getMonth() + 1).toString().padStart(2, '0'); // หาชื่อเดือน (เริ่มจาก 0) พร้อมเติม 0
  const year = d.getFullYear(); // หาปี
  return `${day}/${month}/${year}`; // คืนค่ารูปแบบ dd/mm/yyyy
}

const columns = [
  {
    title: "ID",
    data: "id",
  },
  {
    title: "Photo",
    data: "photo",
    render: function (data: any) {
      const baseUrl = "/uploads/";
      return `<img class="table-photo" src="${baseUrl}${data}" alt="User Photo" onerror="this.src='/uploads/PhotoDefault.png';" />`;
    },
  },
  {
    title: "Status",
    data: "status",
  },
  {
    title: "Email",
    data: "email",
  },
  {
    title: "Name",
    data: "fullname",
  },
  {
    title: "Created_at",
    data: "created_at",
  },
  {
    title: "Event",
    data: "id",
    render: function (data: any) {
      return `
       <div class="btn-group dropend">
        <button class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Event
        </button>
        <ul class="dropdown-menu">
          <li class="dropdown-item">Show</li>
          <li class="dropdown-item">Edit</li>
          <li class="dropdown-item">Delete</li>
        </ul>
      </div>
      `;
    },
  },
];
</script>

<template>
  <div class="container">
    <div class="ibox-header">
      <span class="span-header"
        >DataTables + Vue3 example + Bootstrap 5 styled DataTable</span
      >
    </div>

    <div class="ibox-table-report">
      <DataTable
        width="100%"
        class="table table-hover table-striped"
        :columns="columns"
        :data="userProfilePhotos"
      >
        <thead></thead>
        <tbody></tbody>
      </DataTable>
    </div>
  </div>
</template>

<style>
@import "bootstrap";
@import "datatables.net-bs5";

.ibox-header {
  max-width: 100%;
  margin-top: 20px;
  margin-left: auto;
  margin-right: auto;
  background-color: bisque;
}
.span-header {
  font-size: 24px;
  font-weight: 700;
  margin-left: 30px;
  padding: auto;
}
.ibox-table-report {
  max-width: 100%;
  margin-top: 30px;
  margin-left: auto;
  margin-right: auto;
}
.table-photo {
  width: 70px;
  height: 70px;
  object-fit: cover;
  border-radius: 5px;
}
</style>
