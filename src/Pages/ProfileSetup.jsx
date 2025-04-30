import { useState } from 'react';
import '../css/ProfileSetup.css';

const ProfileSetUp = () => {
  const [profilePic, setProfilePic] = useState(null);
  const [username, setUsername] = useState('');
  const [bio, setBio] = useState('');

  const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      setProfilePic(URL.createObjectURL(file));
    }
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log({
      username,
      bio,
      profilePic,
    });
    // You can replace this with backend or context logic
    alert('Profile setup complete!');
  };

  return (
    <div className="profile-setup-container">
      <h2>Set Up Your Profile</h2>
      <form className="profile-setup-form" onSubmit={handleSubmit}>
        <div className="profile-pic-section">
          <label htmlFor="profilePicInput">
            {profilePic ? (
              <img src={profilePic} alt="Preview" className="profile-preview" />
            ) : (
              <div className="upload-placeholder">Click to upload profile picture</div>
            )}
          </label>
          <input
            type="file"
            id="profilePicInput"
            accept="image/*"
            onChange={handleImageChange}
            hidden
          />
        </div>

        <div className="form-group">
          <label>Username</label>
          <input
            type="text"
            value={username}
            onChange={(e) => setUsername(e.target.value)}
            placeholder="Enter your username"
            required
          />
        </div>

        <div className="form-group">
          <label>Short Bio</label>
          <textarea
            value={bio}
            onChange={(e) => setBio(e.target.value)}
            placeholder="Tell us a little about yourself"
            rows={4}
            required
          />
        </div>

        <button type="submit" className="submit-btn">Save Profile</button>
      </form>
    </div>
  );
};

export default ProfileSetUp;
