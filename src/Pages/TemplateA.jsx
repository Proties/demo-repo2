import '../css/TemplateA.css';

const TemplateA = () => {
  return (
    <div className="template-a-container">
      <div className="template-a-banner">
        <img src="https://via.placeholder.com/1200x300" alt="Banner" />
      </div>
      <div className="template-a-profile">
        <img src="https://via.placeholder.com/150" alt="Profile" className="profile-pic" />
        <h1>Username</h1>
        <p>Bio: This is a short artist bio. Express yourself.</p>
      </div>
      <div className="template-a-gallery">
        <h2>Artworks</h2>
        <div className="gallery-grid">
          {[...Array(6)].map((_, i) => (
            <img key={i} src={`https://via.placeholder.com/250?text=Art+${i + 1}`} alt={`Art ${i + 1}`} />
          ))}
        </div>
      </div>
    </div>
  );
};

export default TemplateA;
