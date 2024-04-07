<template>
  <div class="login-container">
    <form @submit.prevent="login">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" id="email" v-model="credentials.email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" v-model="credentials.password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import router from '../router';

// Reactive reference for the JWT
const jwt = ref(localStorage.getItem('jwt'));

const credentials = ref({
  email: '',
  password: ''
});

const login = async () => {
  try {
    const response = await fetch('/api/v1/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(credentials.value)
    });
    if (!response.ok) throw new Error('Login failed');
    const data = await response.json();
    localStorage.setItem('jwt', data.access_token); // Save the JWT in localStorage
    jwt.value = data.access_token; // Save the JWT in the reactive variable

    router.push('/'); // Redirect to home page after successful login
  } catch (error) {
    console.error(error);
  }
};
</script>
  
  <style scoped>
  .login-container {
    max-width: 400px; /* Adjust the width of the form */
    margin: 100px auto; /* Center the form on the page with some margin */
    padding: 1rem; /* Padding inside the container */
    background: #ffffff; /* White background */
    border: 1px solid #dee2e6; /* Light grey border */
    border-radius: 0.25rem; /* Slightly rounded corners */
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Bootstrap's box-shadow for modals */
  }
  
  .form-group {
    margin-bottom: 1rem;
  }
  
  label {
    display: block;
    margin-bottom: 0.5rem;
  }
  
  input[type="email"],
  input[type="password"] {
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }
  
  input[type="email"]:focus,
  input[type="password"]:focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
  }
  
  .btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
  }
  
  .btn-primary:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
  }
  
  /* Add responsiveness as needed */
  @media (max-width: 576px) {
    .login-container {
      padding: 1rem;
      margin: 1rem;
    }
  }
  </style>
  