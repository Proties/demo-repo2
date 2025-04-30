import { useAuth } from '../Context/AuthContext';
import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import '../css/LoginPage.css';

const Login = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();
  const { login } = useAuth();

  const handleLogin = (e) => {
    e.preventDefault(); // ✅ Moved this to the top
    const mockUser = { id: 1, name: 'Pro' }; // Replace with real login logic
    login(mockUser);
    console.log("Logging in with:", { email, password });
    navigate("/"); // ✅ or use "/fyp" if that's your actual home route
  };

  return (
    <div className="login-container">
      <form className="login-form" onSubmit={handleLogin}>
        <h2>Welcome Back</h2>

        <input
          type="email"
          placeholder="Email"
          value={email}
          required
          onChange={(e) => setEmail(e.target.value)}
        />

        <input
          type="password"
          placeholder="Password"
          value={password}
          required
          onChange={(e) => setPassword(e.target.value)}
        />

        <button type="submit">Login</button>

        <p className="link-text">
          Don’t have an account?{" "}
          <span onClick={() => navigate("/signin")}>Register</span> {/* ✅ Adjusted to match your route */}
        </p>
      </form>
    </div>
  );
};

export default Login;
