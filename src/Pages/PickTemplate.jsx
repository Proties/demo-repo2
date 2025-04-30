// src/Pages/TemplatePicker.jsx
import '../css/PickTemplate.css';
import { useNavigate } from 'react-router-dom';

const TemplatePicker = () => {
  const navigate = useNavigate();

  const handlePick = (template) => {
    // You can later store this selection in a database or context
    alert(`You picked ${template}`);
    navigate(`/template${template.toLowerCase()}`);
  };

  return (
    <div className="template-picker-container">
      <h1 className="template-picker-title">Choose Your Profile Template</h1>
      <div className="template-options">
        <div className="template-card">
          <img
            src="https://via.placeholder.com/400x250?text=Template+A"
            alt="Template A"
          />
          <h2>Template A</h2>
          <p>Clean and minimal layout focused on content and simplicity.</p>
          <button onClick={() => handlePick('A')}>Use Template A</button>
        </div>
        <div className="template-card">
          <img
            src="https://via.placeholder.com/400x250?text=Template+B"
            alt="Template B"
          />
          <h2>Template B</h2>
          <p>Bold and modern design with space for featured posts.</p>
          <button onClick={() => handlePick('B')}>Use Template B</button>
        </div>
      </div>
    </div>
  );
};

export default TemplatePicker;
