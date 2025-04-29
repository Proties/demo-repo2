import './css/App.css';
import Home from './Pages/FYP';
import Login from './Pages/LoginPage';
import Signin from './Pages/SigninPage';
import Profile from './Pages/PersonalProfile';
import ProfileSetUp from './Pages/ProfileSetup';
import SearchPage from './Pages/SearchPage';
import PickTemplate from './Pages/PickTemplate';
import Payment from './Pages/PaymentPage';
import TemplateA from './Pages/Templates/TemplateA';
import TemplateB from './Pages/Templates/TemplateB';
import { Routes, Route } from 'react-router-dom';
import NavBar from './Components/Navbar';
import ProtectedRoute from './Components/ProtectedRoute';
import Layout from './Components/Layout';
import Footer from './Components/Footer';
import { useAuth } from './Context/AuthContext'; // 👈 import useAuth

function App() {
  const { user } = useAuth(); // 👈 get current user

  return (
    <>
      <NavBar />
      <main className="main-content">
        <Routes>
          <Route path="/" element={<Layout><Home /></Layout>} />
          <Route path="/login" element={<Login />} />
          <Route path="/signin" element={<Signin />} />
          <Route path="/profile" element={
            <ProtectedRoute user={user}>
              <Profile />
            </ProtectedRoute>
          } />
          <Route path="/profilesetup" element={<ProfileSetUp />} />
          <Route path="/search" element={<SearchPage />} />
          <Route path="/templatepicker" element={<PickTemplate />} />
          <Route path="/payment" element={<Payment />} />
          <Route path="/templatea" element={<TemplateA />} />
          <Route path="/templateb" element={<TemplateB />} />
        </Routes>
      </main>
      <Footer />
    </>
  );
}

export default App;
