<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">COMP3385</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <RouterLink class="nav-link" to="/">Home</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/about">About</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/movies">Movies</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/movies/create">Add Movie</RouterLink>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
  <li class="nav-item">
    <RouterLink v-if="!isLoggedIn" class="nav-link" to="/login">Login</RouterLink>
    <!-- Use handleLogout here -->
    <a v-else class="nav-link" @click.prevent="handleLogout">Logout</a>
  </li>
</ul>

      </div>
    </div>
  </nav>
</template>

<script setup>
import { useRouter, RouterLink } from 'vue-router';
import { useAuth } from '@/composables/useAuth'; // Adjust path as necessary

const { isLoggedIn, logout } = useAuth();
const router = useRouter();

const handleLogout = async () => {
  await logout();
  router.push('/login');
};
</script>


  
  



<style scoped>
.login-container {
  max-width: 500px; /* Adjust the width of the form */
  margin: 2rem auto; /* Center the form on the page with some margin */
  padding: 2rem; /* Padding inside the container */
  background: #ffffff; /* White background */
  border: 1px solid #dee2e6; /* Light grey border */
  border-radius: 0.25rem; /* Slightly rounded corners */
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Bootstrap's box-shadow for modals */
}

label {
  font-weight: 600; /* Makes labels bold */
}

input {
  margin-bottom: 1rem; /* Adds space below the inputs */
}

button {
  width: 100%; /* Full width */
  padding: 0.5rem; /* Padding for the button */
  border: none;
  border-radius: 0.25rem;
  background-color: #007bff; /* Bootstrap primary color */
  color: white;
  transition: background-color 0.15s ease-in-out;
}

button:hover {
  background-color: #0056b3; /* Darken the button slightly when hovered */
}

/* Responsive sizing */
@media (max-width: 576px) {
  .login-container {
    padding: 1rem; /* Less padding on smaller screens */
    margin-top: 1rem; /* Less margin on the top on smaller screens */
    margin-bottom: 1rem; /* Less margin on the bottom on smaller screens */
  }
}
</style>
