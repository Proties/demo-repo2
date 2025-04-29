import { useState } from 'react';
import './SigninPage.css';
import { useNavigate } from 'react-router-dom';

const SigninPage = () => {
  const navigate = useNavigate();
  const [form, setForm] = useState({
    email: '',
    password: '',
    confirmPassword: '',
  });

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (form.password !== form.confirmPassword) {
      alert('Passwords do not match');
      return;
    }

    // Simulate signup logic (could connect to backend or Firebase)
    console.log('User signed up:', form);
    navigate('/profilesetup'); // redirect to profile setup
  };

  return (
    <div className="signin-container">
      <h2>Create Your Account</h2>
      <form onSubmit={handleSubmit} className="signin-form">
        <input
          type="email"
          name="email"
          placeholder="Email"
          value={form.email}
          onChange={handleChange}
          required
        />
        <input
          type="password"
          name="password"
          placeholder="Password"
          value={form.password}
          onChange={handleChange}
          required
        />
        <input
          type="password"
          name="confirmPassword"
          placeholder="Confirm Password"
          value={form.confirmPassword}
          onChange={handleChange}
          required
        />
        <button type="submit">Sign Up</button>
        <p className="switch-link">
          Already have an account? <span onClick={() => navigate('/login')}>Log in</span>
        </p>
      </form>
    </div>
  );
};

export default SigninPage;
