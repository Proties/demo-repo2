import NavBar from './Components/Navbar'
import Footer from './Components/Footer'

const Layout = ({ children }) => (
  <>
    <NavBar />
    <main className="main-content">{children}</main>
    <Footer />
  </>
);
