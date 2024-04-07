<template>
    <div class="form-container"> <!-- Wrapper added -->
      <form @submit.prevent="saveMovie" id="movieForm">
        <!-- Form fields for title, description, and poster -->
        <div class="form-group mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" id="title" v-model="movie.title" class="form-control" required>
        </div>
        <div class="form-group mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea id="description" v-model="movie.description" class="form-control" required></textarea>
        </div>
        <div class="form-group mb-3">
          <label for="poster" class="form-label">Poster</label>
          <input type="file" id="poster" ref="posterInput" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    
      <!-- Success and error messages -->
      <div v-if="successMessage" class="alert alert-success">
        {{ successMessage }}
      </div>
      <div v-if="errorMessage" class="alert alert-danger">
        {{ errorMessage }}
      </div>
    </div> <!-- Wrapper closed -->
  </template>
  
  <style scoped>
  .alert {
    margin-top: 20px;
  }
  
  .form-container {
    padding: 20px;  /* Adjust padding as needed */
    max-width: 1300px; /* Maximum width of the form container */
    margin: 40px auto; /* Top and bottom margin with automatic horizontal centering */
    background: #fff; /* Background color for the form container */
    box-shadow: 0 0 15px rgba(0,0,0,0.1); /* Shadow for visual depth */
    border-radius: 10px; /* Rounded corners for the form container */
  }
</style>

  
  <script setup>
  import { ref } from 'vue';
  
  
  const movie = ref({
    title: '',
    description: ''
  });

// Add these inside your <script setup>
const successMessage = ref('');
const errorMessage = ref('');

  const posterInput = ref(null);
  
  const saveMovie = async () => {
  const formData = new FormData();
  formData.append('title', movie.value.title);
  formData.append('description', movie.value.description);
  if (posterInput.value.files[0]) {
    formData.append('poster', posterInput.value.files[0]);
  }

  try {
    const response = await fetch('/api/v1/movies', {
      method: 'POST',
      body: formData,
      // ... other fetch options
    });

    if (!response.ok) throw new Error(`Error: ${response.status}`);

    const result = await response.json();
    successMessage.value = 'Movie added successfully!';
    errorMessage.value = ''; // Clear any previous error messages

    // Clear the form fields
    movie.value.title = '';
    movie.value.description = '';
    posterInput.value.value = ''; // This might need adjustment based on how you're handling file inputs

    // Clear the success message after 5 seconds
    setTimeout(() => successMessage.value = '', 5000);
    
  } catch (error) {
    errorMessage.value = error.message || 'An error occurred while saving the movie.';
    successMessage.value = ''; // Clear any previous success messages
  }
};


  
  </script>
  