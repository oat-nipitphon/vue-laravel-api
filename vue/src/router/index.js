import { useAuthStore } from '@/stores/auth'
import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import RegisterView from '@/views/Auth/RegisterView.vue'
import LoginView from '@/views/Auth/LoginView.vue'
import DashboardView from '@/views/DashboardView.vue'
import ReportPostView from '@/views/Post/ReportPostView.vue'
import NewPostView from '@/views/Post/NewPostView.vue'
import DetailPostView from '@/views/Post/DetailPostView.vue'
import UpdatePostView from '@/views/Post/UpdatePostView.vue'
import ReportUserView from '@/views/User/ReportUserView.vue'
import EventFormView from '@/views/User/EventFormView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'HomeView',
      component: HomeView,
    },
    {
      path: '/LoginView',
      name: 'LoginView',
      component: LoginView,
      meta: { guest: true }
    },
    {
      path: '/RegisterView',
      name: 'RegisterView',
      component: RegisterView,
      meta: { guest: true }
    },
    {
      path: '/DashboardView',
      name: 'DashboardView',
      component: DashboardView,
      meta: { auth: true }
    },
    {
      path: '/ReportUserView',
      name: 'ReportUserView',
      component: ReportUserView,
      meta: { auth: true }
    },
    {
      path: '/EventFormView',
      name: 'EventFormView',
      component: EventFormView,
      meta: { auth: true }
    },
    {
      path: '/ReportPost',
      name: 'ReportPostView',
      component: ReportPostView,
      meta: { auth: true }
    },
    {
      path: '/NewPost',
      name: 'NewPostView',
      component: NewPostView,
      meta: { auth: true }
    },
    {
      path: '/posts/:id',
      name: 'DetailPostView',
      component: DetailPostView,
      meta: { auth: true }
    },
    {
      path: '/posts/update/:id',
      name: 'UpdatePostView',
      component: UpdatePostView,
      meta: { auth: true }
    }
  ],
});

router.beforeEach(async (to, form) => {

  const authStore = useAuthStore();
  await authStore.getUsers();

  if(!authStore.storeUser && to.meta.auth){
    return { name: "HomeView" };
  }

  if(authStore.storeUser && to.meta.guest){
    return { name: "DashboardView" };
  }



});

export default router


// Additional explanation
// คำอธิบายเพิ่มเติม

// guest: true: Specifies that this path is only accessible to users who are not logged in.
// guest: true: ระบุว่าเส้นทางนี้เข้าถึงได้เฉพาะผู้ใช้ที่ยังไม่ได้เข้าสู่ระบบ

// auth: true: Specifies that this route requires the user to log in before access.
// auth: true: ระบุว่าเส้นทางนี้ต้องการให้ผู้ใช้เข้าสู่ระบบก่อนเข้าถึง
