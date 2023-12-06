import { ref, watch, watchEffect } from "vue";

export const drawer = ref(true);
export const tab = ref("default");
export const tabs = ref([]);

export const activeLink = ref(""); // Initialize activeLink to an empty string
export const dynamicName = ref("");

export const setDynamicName = (name) => {
  dynamicName.value = name;
};

// Use watchEffect to handle initialization
watchEffect(() => {
  // Retrieve activeLink from localStorage during component creation
  activeLink.value = localStorage.getItem("activeLink") || "";
});

watch(activeLink, (newLink) => {
  localStorage.setItem("activeLink", newLink);
});
