<script setup>
import { ref, onMounted, reactive } from "vue";
import { useRoute, useRouter, RouterLink } from "vue-router";
import { useDefineStoreUser } from "@/stores/users";
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs5";
DataTable.use(DataTablesCore);

const router = useRouter();
const usersStore = useDefineStoreUser();
const userProfilePhotos = ref([]);

onMounted(async () => {
  await usersStore.apiUserProfilePhoto();
  userProfilePhotos.value = usersStore.reqUsers.map((user) => ({
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
    created_at: formatDate(user.created_at),
  }));
});

function formatDate(date) {
  const d = new Date(date);
  const day = d.getDate().toString().padStart(2, "0");
  const month = (d.getMonth() + 1).toString().padStart(2, "0");
  const year = d.getFullYear();
  return `${day}/${month}/${year}`;
}

const columns = [
  {
    title: "ID",
    data: "id",
  },
  {
    title: "Photo",
    data: "photo",
    render(data) {
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
    render(data) {
      return `
        <div class="btn-group dropend">
          <button class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" type="button" 
            data-bs-toggle="dropdown" aria-expanded="false">
            Event
          </button>
          <ul class="dropdown-menu">
            <li>
              <button class="dropdown-item btn btn-sm btn-warning event-show" data-id="${data}">
                Show
              </button>
            </li>
            <li>
              <button class="dropdown-item btn btn-sm btn-warning event-edit" data-id="${data}">
                Edit
              </button>
            </li>
            <li>
              <button class="dropdown-item btn btn-sm btn-danger event-delete" data-id="${data}">
                Delete
              </button>
            </li>
          </ul>
        </div>
      `;
    },
  },
];

const options = reactive({
  paging: true,
  searching: true,
  ordering: true,
  drawCallback: function () {
    // Attach event listeners using delegation
    const table = document.querySelector(".ibox-table-report table");

    table.addEventListener("click", (e) => {
      if (e.target.matches(".event-show")) {
        const userId = e.target.getAttribute("data-id");
        onShow(userId);
      }
      if (e.target.matches(".event-edit")) {
        const userId = e.target.getAttribute("data-id");
        onEdit(userId);
      }
      if (e.target.matches(".event-delete")) {
        const userId = e.target.getAttribute("data-id");
        onDelete(userId);
      }
    });
  },
});

function onShow(userId) {
  console.log("Show userId:", userId);
  // router.push(`/users/`+userId);
  router.push({
    name: 'ShowUserDetail',
    params: {
      id: userId
    },
  });

}

function onEdit(userId) {
  console.log("Edit userId:", userId);
  console.log("Show userId:", userId);
  // router.push(`/users/`+userId);
  router.push({
    name: 'UpdateUserView',
    params: {
      id: userId
    },
  });
}

function onDelete(userId) {
  console.log("Delete userId:", userId);
}
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
        :options="options"
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
