<template>
    <div class="movies-container">
      <h2>Movies</h2>
      <div class="movies-grid">
        <div v-for="movie in movies" :key="movie.id" class="movie-card">
          <img :src="movie.poster" :alt="movie.title" class="movie-poster" />
          <div class="movie-info">
            <h3>{{ movie.title }}</h3>
            <p>{{ movie.description }}</p>
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
  align-items: flex-start; /* Align items to the top */
  background: #fff;
  border-radius: 0.5rem;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  transition: box-shadow 0.3s ease-in-out;
}

.movie-card:hover {
  box-shadow: 0 6px 12px rgba(0,0,0,0.2); /* Slight elevation effect on hover */
}

.movie-poster {
  width: 200px; /* Adjust width to match the design */
  object-fit: cover; /* Cover the whole area without stretching the image */
  height: 100%; /* Stretch to the full height of the card */
}

.movie-info {
  padding: 1rem;
  text-align: left; /* Align text to the left side */
  display: flex;
  flex-direction: column;
  justify-content: flex-start; /* Align text to the top */
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
    height: auto; /* Adjust height automatically */
  }

  .movie-info {
    order: -1; /* Move the movie-info above the poster on smaller screens */
  }
}
</style>
