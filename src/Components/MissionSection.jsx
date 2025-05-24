import React from "react";
import { useNavigate } from "react-router-dom";
import "../css/MissionStatement.css";

const MissionStatement = () => {
  const navigate = useNavigate();

  const handleDonate = () => {
    navigate("/payment"); // Adjust path if needed
  };

  return (
    <div className="mission-container">
      <h2 className="mission-title">🎨 Our Mission</h2>
      <p className="mission-text">
        At Terti, we believe every artist—beginner or pro—deserves a safe, inspiring space to showcase their work and grow within a supportive community.
      </p>
      <button className="donate-button" onClick={handleDonate}>
        💖 Donate to Support Us
      </button>
    </div>
  );
};

export default MissionStatement;
