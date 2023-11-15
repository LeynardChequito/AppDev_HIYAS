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
  },
  {
    path: "/reports",
    name: "reports",
    component: ReportsView,
  },
  {
    path: "/coaches",
    name: "coaches",
    component: CoachesView,
  },
  {
    path: "/events",
    name: "events",
    component: EventsView,
  },
  {
    path: "/reports/students",
    name: "students",
    component: StudentsView,
  },
  {
    path: "/announcements",
    name: "announcements",
    component: AnnouncementsView,
  },
  {
    path: "/profile",
    name: "profile",
    component: Profile,
  },
  {
    path: "/coachdash",
    name: "coachdash",
    component: CoachDash,
  },
  {
    path: "/reports/students/:id",
    // name: "coachdash",
    component: IndividualStudent,
  },
  {
    path: "/reports/finance",
    name: "finance",
    component: FinanceView,
  },
  {
    path: "/EventsCal",
    name: "EventsCal",
    component: EventsCalendar,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
