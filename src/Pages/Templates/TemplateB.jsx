import './TemplateB.css';

const TemplateB = () => {
  return (
    <div className="template-b-container">
      <aside className="template-b-sidebar">
        <img src="https://via.placeholder.com/120" alt="Profile" />
        <h2>Username</h2>
        <p>Creative Explorer & Digital Artist</p>
      </aside>
      <main className="template-b-main">
        <h1>My Portfolio</h1>
        <div className="template-b-grid">
          {[...Array(8)].map((_, i) => (
            <img key={i} src={`https://via.placeholder.com/200?text=Post+${i + 1}`} alt={`Post ${i + 1}`} />
          ))}
        </div>
      </main>
    </div>
  );
};

export default TemplateB;
