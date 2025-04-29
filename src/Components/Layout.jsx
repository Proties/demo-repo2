import NavBar from './Navbar';
import Footer from './Footer';

const Layout = ({ children }) => (
  <>
    <NavBar />
    <main className="main-content">{children}</main>
    <Footer />
  </>
);

export default Layout;
