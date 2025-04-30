import '../css/FYP.css';
import SearchBar from '../Components/SearchBar';
import MissionStatement from '../Components/MissionStatement';
import PostFeedWrapper from '../Components/PostFeedWrapper';
import PostCard from '../Components/PostCard';
import "../css/PostFeedWrapper.css";

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
        <SearchBar />
      </section>

      <div className="fyp-body">
        {/* Post Feed */}
        <PostFeedWrapper>
          {posts.map(post => (
            <PostCard key={post.id} post={post} />
          ))}
        </PostFeedWrapper>

        {/* Sidebar */}
        <aside className="sidebar">
          <MissionStatement />
        </aside>
      </div>
    </div>
  );
};

export default FYP;





