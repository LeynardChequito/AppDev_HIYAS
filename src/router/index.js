import { createRouter, createWebHistory } from "vue-router";
import LoginView from "../views/LoginView.vue";
import HomeView from "../views/HomeView.vue";
import RegisterView from "../views/RegisterView.vue";
import Experiment from "../views/Experiment.vue";
import ManageView from "../views/ManageView.vue";
import ReportsView from "../views/ReportsView.vue";
import CoachesView from "../views/CoachesView.vue";
import EventsView from "../views/EventsView.vue";
import StudentsView from "../views/StudentsView.vue";
import AnnouncementsView from "../views/AnnouncementsView.vue";
import Profile from "../components/Profile.vue";
import CoachDash from "../components/CoachDash.vue";
import IndividualStudent from "../components/Student/IndividualStudent.vue";
import FinanceView from "../views/FinanceView.vue";
import EventsCalendar from "../views/EventsCalendarView.vue";

import ChatView from "../views/ChatView.vue";
import authService from '../JWT/authService';


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
    meta: { requiresAuth: true },
  },
  {
    path: "/reports",
    name: "reports",
    component: ReportsView,
    meta: { requiresAuth: true },

  },
  {
    path: "/coaches",
    name: "coaches",
    component: CoachesView,
    meta: { requiresAuth: true },

  },
  {
    path: "/events",
    name: "events",
    component: EventsView,
    meta: { requiresAuth: true },

  },
  {
    path: "/reports/students",
    name: "students",
    component: StudentsView,
    meta: { requiresAuth: true },

  },
  {
    path: "/announcements",
    name: "announcements",
    component: AnnouncementsView,
    meta: { requiresAuth: true },

  },
  {
    path: "/profile",
    name: "profile",
    component: Profile,
    meta: { requiresAuth: true },

  },
  {
    path: "/coachdash",
    name: "coachdash",
    component: CoachDash,
    meta: { requiresAuth: true },

  },
  {
    path: "/reports/students/:id",
    // name: "coachdash",
    component: IndividualStudent,
    meta: { requiresAuth: true },

  },
  {
    path: "/reports/finance",
    name: "finance",
    component: FinanceView,
    meta: { requiresAuth: true },

  },
  {
    path: "/chats",
    name: "chats",
    component: ChatView,
    meta: { requiresAuth: true },

  },
  {
    path: "/EventsCal",
    name: "EventsCal",
    component: EventsCalendar,
    meta: { requiresAuth: true },
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
    next('/login'); // Redirect to the login page
  } else {
    next(); // Proceed to the route
  }
});

export default router;
