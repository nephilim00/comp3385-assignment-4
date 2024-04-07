<template>
    <div class="movies-container">
      <h2>Movies</h2>
      <div class="movies-grid">
        <div v-for="movie in movies" :key="movie.id" class="movie-card">
          <div class="movie-content">
            <img :src="movie.poster" :alt="movie.title" class="movie-poster" />
            <div class="movie-info">
              <h3>{{ movie.title }}</h3>
              <p>{{ movie.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  const movies = ref([]);
  
  onMounted(async () => {
    try {
      const response = await fetch('/api/v1/movies');
      if (!response.ok) throw new Error('Failed to fetch movies');
      movies.value = await response.json();
    } catch (error) {
      console.error(error.message);
      // Display a user-friendly error message on the webpage
      movies.value = [{ title: 'Error', description: 'Could not load movies. Please try again later.' }];
    }
  });
  </script>
  
  <style scoped>
.movies-container {
  padding: 2rem;
}

h2 {
  text-align: left;
  margin-bottom: 2rem;
}

.movies-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(500px, 1fr)); /* Adjust the min-width for your preference */
  gap: 2rem;
}

.movie-card {
  display: flex;
  flex-direction: row; /* Ensure items are laid out in a row */
  align-items: center; /* Center items vertically */
  background: #fff;
  border-radius: 0.5rem;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.movie-info {
  padding: 1rem;
  text-align: left; /* Align the text to the right side */
  flex-grow: 1; /* Allow the info section to grow as needed */
}


.movie-poster {
  width: auto; /* Auto width for the image */
  flex-shrink: 0; /* Prevent the poster from shrinking */
  height: 300px; /* Fixed height for the poster */
  object-fit: cover; /* Cover the whole area without stretching the image */
}



@media (max-width: 768px) {
  .movies-grid {
    grid-template-columns: 1fr; /* One column grid layout for smaller screens */
  }

  .movie-card {
    flex-direction: column; /* Stack items on smaller screens */
    align-items: stretch; /* Stretch items to fit the container */
  }

  .movie-poster {
    width: 100%; /* Full width for the image */
    height: auto; /* Auto height to maintain aspect ratio */
  }
}
</style>
