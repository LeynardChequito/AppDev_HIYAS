import { createRouter, createWebHistory } from "vue-router";
import LoginView from "../views/LoginView.vue";
import HomeView from "../views/HomeView.vue";
import RegisterView from "../views/RegisterView.vue";
import Experiment from "../views/Experiment.vue";
import ManageView from "../views/ManageView.vue";
import ManageAnnouncementsView from "../views/Manage/ManageAnnouncementsView.vue";
import Profile from "../components/Profile.vue";
import IndividualStudent from "../components/Student/IndividualStudent.vue";
import EventsCalendar from "../views/EventsCalendarView.vue";
import ManageAttendanceView from "../views/Manage/ManageAttendanceView.vue";

import ChatView from "../views/ChatView.vue";
import authService from '../JWT/authService';

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


const routes = [
  {
    path: "/home",
    name: "home",
    component: HomeView,
  },
  {
    path: "/login",
    name: "login",
    component: LoginView,
  },
  {
    path: "/register",
    name: "register",
    component: RegisterView,
  },
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
   // meta: { requiresAuth: true },

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

  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

// Global navigation guard
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !authService.isAuthenticated()) {
    // If the route requires authentication and the user is not authenticated
    next('/login'); // Redirect to the login page
  } else {
    next(); // Proceed to the route
  }
});

export default router;
