import axios from "axios";

const authService = {
  async login(credentials) {
    try {
      // Replace the URL with your actual login endpoint
      const response = await axios.post("/login", credentials);

      // Assuming your server sends the token in the response
      const token = response.data.token;

      // Save the token to localStorage or a secure storage
      localStorage.setItem("token", token);

      // Set the Authorization header for future requests
      this.setAuthHeader();

      return { success: true, message: "Login successful" };
    } catch (error) {
      console.error("Error logging in:", error);
      return { success: false, message: "Login failed" };
    }
  },
  logout() {
    // Perform logout logic, remove the token from storage
    localStorage.removeItem("token");
  },
  isAuthenticated() {
    // Check if the user is authenticated (e.g., token exists)
    return !!this.getToken();
  },
  getToken() {
    // Retrieve the authentication token from storage
    return localStorage.getItem("token");
  },
  setAuthHeader() {
    // Set the Authorization header for Axios requests
    const token = this.getToken();
    if (token) {
      axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    }
  },
  getUserRole() {
    // Retrieve the user role from the decoded token
    const token = this.getToken();
    if (token) {
      const decodedToken = token;
      return decodedToken.user_role;
    }
    return null;
  },
};

export default authService;
