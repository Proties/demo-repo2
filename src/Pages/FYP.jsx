// src/Pages/FYP.jsx
import '../css/FYP.css';

const FYP = () => {
  // Dummy posts – you can replace these with real data later
  const posts = [
    { id: 1, username: 'artlover99', content: 'My latest digital sketch!', image: '/images/art1.jpg' },
    { id: 2, username: 'pixelqueen', content: 'Trying out a new brush style.', image: '/images/art2.jpg' },
    { id: 3, username: 'sketchguru', content: 'Speedpaint from today’s stream.', image: '/images/art3.jpg' },
  ];

  return (
    <div className="fyp-container">
      <section className="fyp-header">
        <h1>For You</h1>
        <p>Curated posts from artists you may love</p>
      </section>

      <section className="fyp-feed">
        {posts.map(post => (
          <div key={post.id} className="fyp-post-card">
            <img src={post.image} alt="user post" className="fyp-post-image" />
            <div className="fyp-post-info">
              <h3>@{post.username}</h3>
              <p>{post.content}</p>
            </div>
          </div>
        ))}
      </section>
    </div>
  );
};

export default FYP;
