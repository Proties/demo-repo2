import '../css/Navbar.css';
import '../css/Footer.css';

const Layout = ({ children }) => (
  <>
    <NavBar />
    <main className="main-content">{children}</main>
    <Footer />
  </>
);

export default Layout;
