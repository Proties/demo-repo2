// Navbar.jsx
import { useAuth } from "../Context/AuthContext";
import { useNavigate } from "react-router-dom";
import '../css/Navbar.css'

function NavBar() {
  const { user, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = () => {
    logout();
    navigate("/login");
  };

  return (
    <nav>
      {/* other nav items */}
      {user && (
        <button onClick={handleLogout}>Logout</button>
      )}
    </nav>
  );
}

export default NavBar;
