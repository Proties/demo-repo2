// src/Pages/PersonalProfile.jsx
import '../css/PersonalProfile.css';

const PersonalProfile = () => {
  return (
    <div className="profile-container">
      <div className="profile-banner"></div>

      <div className="profile-header">
        <img
          src="https://via.placeholder.com/150"
          alt="Profile"
          className="profile-image"
        />
        <div className="profile-info">
          <h2>Username</h2>
          <p className="bio">This is a short user bio. Welcome to my page!</p>
          <div className="profile-stats">
            <span><strong>12</strong> Posts</span>
            <span><strong>340</strong> Followers</span>
            <span><strong>120</strong> Following</span>
          </div>
        </div>
      </div>

      <div className="profile-gallery">
        {[...Array(6)].map((_, i) => (
          <div key={i} className="gallery-item">
            <img
              src={`https://picsum.photos/seed/${i}/300`}
              alt={`Post ${i + 1}`}
            />
          </div>
        ))}
      </div>
    </div>
  );
};

export default PersonalProfile;
