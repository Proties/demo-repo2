import { useAuth } from '../Context/AuthContext';

const LoginPage = () => {
  const { login } = useAuth();

  const handleLogin = () => {
    const mockUser = { id: 1, name: 'Pro' }; // Replace with real login logic
    login(mockUser);
  };

  return (
    <button onClick={handleLogin}>Log in</button>
  );
};