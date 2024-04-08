// Assuming this is in 'src/composables/useAuth.js' or equivalent
import { ref } from 'vue';

const jwt = ref(localStorage.getItem('jwt'));

export function useAuth() {
  const isLoggedIn = ref(!!jwt.value);

  const login = (token) => {
    jwt.value = token;
    localStorage.setItem('jwt', token);
    isLoggedIn.value = true;
  };

  const logout = () => {
    jwt.value = null;
    localStorage.removeItem('jwt');
    isLoggedIn.value = false;
  };

  return { isLoggedIn, login, logout };
}
