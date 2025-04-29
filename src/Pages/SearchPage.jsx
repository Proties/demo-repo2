import { useEffect, useState } from 'react';
import './SearchPage.css';
import { useNavigate } from 'react-router-dom';

const SearchPage = () => {
  const [isMobile, setIsMobile] = useState(window.innerWidth <= 768);
  const navigate = useNavigate();

  useEffect(() => {
    const handleResize = () => {
      const mobile = window.innerWidth <= 768;
      setIsMobile(mobile);

      if (!mobile) {
        navigate('/'); // redirect desktop users
      }
    };

    window.addEventListener('resize', handleResize);
    return () => window.removeEventListener('resize', handleResize);
  }, [navigate]);

  if (!isMobile) return null;

  return (
    <div className="search-page">
      <h2>Search</h2>
      <input
        type="text"
        className="search-input"
        placeholder="Search for people or posts..."
      />
      {/* Optionally: render results here */}
      <div className="search-results">
        <p>Search results will appear here.</p>
      </div>
    </div>
  );
};

export default SearchPage;
