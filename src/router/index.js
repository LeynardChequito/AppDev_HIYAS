import { createRouter, createWebHistory } from "vue-router";
// import LoginView from "../views/LoginView.vue";
import HomeView from "../views/HomeView.vue";
// import RegisterView from "../views/RegisterView.vue";
import Experiment from "../views/Experiment.vue";
import ManageView from "../views/ManageView.vue";
import ManageAnnouncementsView from "../views/Manage/ManageAnnouncementsView.vue";
import Profile from "../components/Profile.vue";
import IndividualStudent from "../components/Student/IndividualStudent.vue";
import EventsCalendar from "../views/EventsCalendarView.vue";
import ManageAttendanceView from "../views/Manage/ManageAttendanceView.vue";

import ChatView from "../views/ChatView.vue";
import authService from "../JWT/authService";

//Reports-----------------------------------------------------------------------
import ReportsView from "../views/ReportsView.vue";
import ReportsCoachesView from "../views/Reports/ReportsCoachesView.vue";
import ReportsEventsView from "../views/Reports/ReportsEventsView.vue";
import ReportsStudentsView from "../views/Reports/ReportsStudentsView.vue";
import ReportsFinanceView from "../views/Reports/ReportsFinanceView.vue";

//Reports-----------------------------------------------------------------------

import ManageStudentsView from "../views/Manage/ManageStudentsView.vue";
import ManageAccountsView from "../views/Manage/ManageAccountsView.vue";
import ManageParentsView from "../views/Manage/ManageParentsView.vue";
import ManageEventsView from "../views/Manage/ManageEventsView.vue";
import ManageSectionsView from "../views/Manage/ManageSectionsView.vue";

const routes = [
  {
    path: "/home",
    name: "home",
    component: HomeView,
  },
  // {
  //   path: "/login",
  //   name: "login",
  //   component: LoginView,
  //   meta: { requiresGuest: true },
  // },
  // {
  //   path: "/register",
  //   name: "register",
  //   component: RegisterView,
  //   meta: { requiresGuest: true },
  // },
  {
    path: "/exp",
    name: "exp",
    component: Experiment,
  },
  {
    path: "/manage",
    name: "manage",
    component: ManageView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/reports",
    name: "reports",
    component: ReportsView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/reports/coaches",
    name: "reportsCoaches",
    component: ReportsCoachesView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/reports/events",
    name: "reportsEvents",
    component: ReportsEventsView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/reports/students",
    name: "reportsStudents",
    component: ReportsStudentsView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/manage/announcements",
    name: "manageAnnouncements",
    component: ManageAnnouncementsView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/manage/attendance",
    name: "manageAttendance",
    component: ManageAttendanceView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/manage/students",
    name: "manageStudents",
    component: ManageStudentsView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/profile",
    name: "profile",
    component: Profile,
    // meta: { requiresAuth: true },
  },
  {
    path: "/reports/students/:id",
    component: IndividualStudent,
    // meta: { requiresAuth: true },
  },
  {
    path: "/reports/finance",
    name: "reportsFinance",
    component: ReportsFinanceView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/chats/:id",
    name: "chats",
    component: ChatView,
    meta: { requiresAuth: true },
  },
  {
    path: "/EventsCal",
    name: "EventsCal",
    component: EventsCalendar,
    // meta: { requiresAuth: true },
  },
  {
    path: "/manage/accounts",
    name: "account",
    component: ManageAccountsView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/manage/parents",
    name: "parents",
    component: ManageParentsView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/manage/events",
    name: "manageEvents",
    component: ManageEventsView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/manage/sections",
    name: "manageSections",
    component: ManageSectionsView,
    // meta: { requiresAuth: true },
  },
  {
    path: "/admin",
    name: "admin",
    component: () => import("@/views/Admin/AdminView.vue"),
    meta: { requiresAuth: true },
    children: [
      {
        path: "dashboard",
        name: "admin-dashboard",
        component: () => import("@/views/Admin/Pages/DashboardView.vue"),
      },
      {
        path: "",
        redirect: { name: "admin-dashboard" },
      },
      {
        path: "students",
        name: "admin-students",
        component: () => import("@/views/Admin/Pages/StudentsView.vue"),
      },
      {
        path: "students/:id",
        name: "admin-student-details",
        component: () => import("@/views/Admin/Pages/StudentDetailsView.vue"),
      },
      {
        path: "coaches",
        name: "admin-coaches",
        component: () => import("@/views/Admin/Pages/CoachesView.vue"),
      },
      {
        path: "parents",
        name: "admin-parents",
        component: () => import("@/views/Admin/Pages/ParentsView.vue"),
      },
      {
        path: "sections",
        name: "admin-sections",
        component: () => import("@/views/Admin/Pages/SectionsView.vue"),
      },
      {
        path: "schedules",
        name: "admin-schedules",
        component: () => import("@/views/Admin/Pages/SchedulesView.vue"),
      },
      {
        path: "accounts",
        name: "admin-accounts",
        component: () => import("@/views/Admin/Pages/AccountsView.vue"),
      },
    ],
  },
  {
    path: "/student",
    name: "student",
    component: () => import("@/views/Student/StudentView.vue"),
    meta: { requiresAuth: true },
    children: [
      {
        path: "home",
        name: "student-home",
        component: () => import("@/views/Student/Pages/HomeView.vue"),
      },
      {
        path: "",
        redirect: { name: "student-home" },
      },
      {
        path: "section",
        name: "student-section",
        component: () => import("@/views/Student/Pages/SectionView.vue"),
      },
      {
        path: "attendance",
        name: "student-attendance",
        component: () => import("@/views/Student/Pages/AttendanceView.vue"),
      },
      {
        path: "reports",
        name: "student-reports",
        component: () =>
          import("@/views/Student/Pages/ReportAndSubmitView.vue"),
      },
      {
        path: "announcements",
        name: "student-announcements",
        component: () => import("@/views/Student/Pages/AnnouncementsView.vue"),
      },
      {
        path: "schedule",
        name: "student-schedule",
        component: () => import("@/views/Student/Pages/ScheduleView.vue"),
      },
    ],
  },
  {
    path: "/parent",
    name: "parent",
    component: () => import("@/views/Parent/ParentView.vue"),
    meta: { requiresAuth: true },
    children: [
      {
        path: "home",
        name: "parent-home",
        component: () => import("@/views/Parent/Pages/HomeView.vue"),
      },
      {
        path: "",
        redirect: { name: "parent-home" },
      },
    ],
  },
  {
    path: "/login",
    name: "login",
    component: () => import("@/views/Users/LoginView.vue"),
    meta: { requiresGuest: true },
  },
  {
    path: "/register",
    name: "register",
    component: () => import("@/views/Users/RegisterView.vue"),
    meta: { requiresGuest: true },
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

// Global navigation guard
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !authService.isAuthenticated()) {
    // If the route requires authentication and the user is not authenticated
    next("/login"); // Redirect to the login page
  } else if (to.meta.requiresGuest && authService.isAuthenticated()) {
    // If the route requires a guest (unauthenticated) user and the user is authenticated
    const userRole = authService.getUserRole(); // Replace with your actual method to get the user role

    // Redirect based on user role
    if (userRole === "Staff") {
      next("/admin"); // Redirect to the admin page
    } else if (userRole === "Student") {
      next("/student"); // Redirect to the home page for roles "Student" or "Parent"
    } else if (userRole === "Parent/Guardian") {
      next("/parent"); // Redirect to the home page for roles "Student" or "Parent"
    }
  } else {
    next(); // Proceed to the route
  }
});

export default router;
