import './Css/App.css'
import Home from './Pages/FYP'
import Login from './Pages/LoginPage'
import Signin from './Pages/SigninPage'
import Profile from './Pages/PersonalProfile'
import ProfileSetUp from './Pages/ProfileSetup'
import SearchPage from './Pages/SearchPage'
import PickTemplate from './Pages/PickTemplate'
import Payment from './Pages/PaymentPage'
import TemplateA from './Pages/Templates/TemplateA'
import TemplateB from './Pages/Templates/TemplateB'
import {Routes, Route} from 'react-router-dom'
import NavBar from './Components/Navbar'
import Footer from './Components/Footer'

function App() {
  return (
      <MovieProvider>
        <NavBar />
      <main className="main-content">
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/Login" element={<Login />} />
          <Route path="/Signin" element={<Signin />} />
          <Route path="/Profile" element={<Profile />} />
          <Route path="/ProfileSetUp" element={<ProfileSetUp />} />
          <Route path="/Search" element={<SearchPage />} />
          <Route path="/TemplatePicker" element={<PickTemplate />} />
          <Route path="/Payment" element={<Payment />} />
          <Route path="/TemplateA" element={<TemplateA />} />
          <Route path="/TemplateB" element={<TemplateB />} />          
        </Routes>
      </main>
      <Footer />
      </MovieProvider>
    )
}


export default App
