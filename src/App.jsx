import './css/App.css';
import Home from './Pages/FYP';
import Login from './Pages/LoginPage';
import Signin from './Pages/SigninPage';
import Profile from './Pages/PersonalProfile';
import ProfileSetUp from './Pages/ProfileSetup';
import SearchPage from './Pages/SearchPage';
import PickTemplate from './Pages/PickTemplate';
import Payment from './Pages/PaymentPage';
import TemplateA from './Pages/TemplateA';
import TemplateB from './Pages/TemplateB';
import { Routes, Route } from 'react-router-dom';
import ProtectedRoute from './Components/ProtectedRoute';
import Layout from './Components/Layout';
import { useAuth } from './Context/AuthContext'; // 👈 import useAuth

function App() {
  const { user } = useAuth(); // 👈 get current user

  return (
    <>
      <main className="main-content">
        <Routes>
          <Route path="/" element={<Layout><Home /></Layout>} />
          <Route path="/search" element={<Layout><SearchPage /></Layout>} />
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

          <Route element={<AuthLayout />}>
            <Route path="/login" element={<Login />} />
            <Route path="/signin" element={<Signin />} />
          </Route>
          <Route path="*" element={<div>Page not found</div>} />
        </Routes>
      </main>

    </>
  );
}

export default App;
