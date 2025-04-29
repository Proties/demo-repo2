// src/Components/Footer.jsx
import '../css/Footer.css';

const Footer = () => {
  return (
    <footer className="footer">
      <div className="footer-content">
        <div className="footer-brand">
          <h2>Terti</h2>
          <p>Bringing artists together.</p>
        </div>

        <nav className="footer-links">
          <a href="/">Home</a>
          <a href="/profile">Profile</a>
          <a href="/search">Search</a>
          <a href="/templatepicker">Templates</a>
        </nav>

        <div className="footer-social">
          <a href="#"><span role="img" aria-label="Twitter">🐦</span></a>
          <a href="#"><span role="img" aria-label="Instagram">📸</span></a>
          <a href="#"><span role="img" aria-label="Discord">💬</span></a>
        </div>
      </div>

      <div className="footer-bottom">
        <p>&copy; {new Date().getFullYear()} Terti. All rights reserved.</p>
      </div>
    </footer>
  );
};

export default Footer;
