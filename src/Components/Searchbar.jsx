import '../css/Searchbar.css';

const SearchBar = ({ onSearch }) => {
  return (
    <div className="search-bar-container">
      <input
        type="text"
        placeholder="Search for artists or posts..."
        className="search-input"
        onChange={(e) => onSearch && onSearch(e.target.value)}
      />
    </div>
  );
};

export default SearchBar;
