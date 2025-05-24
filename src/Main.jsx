import { StrictMode } from "react";
import ReactDOM from 'react-dom/client';
import { AuthProvider } from './Context/AuthContext';
import {BrowserRouter} from 'react-router-dom';
import App from "./App.jsx";

ReactDOM.createRoot(document.getElementById("root")).render(
  <StrictMode>
    <BrowserRouter>
      <AuthProvider>
        <App />
      </AuthProvider>
    </BrowserRouter>
  </StrictMode>
);