import React from "react";
import PostCard from "..Components/PostCard";
import "..css/PostFeedWrapper.css";

const PostFeedWrapper = ({ posts }) => {
  return (
    <div className="post-feed-wrapper">
      {posts.length > 0 ? (
        posts.map((post, index) => (
          <PostCard key={index} post={post} />
        ))
      ) : (
        <p className="no-posts">No posts to show right now.</p>
      )}
    </div>
  );
};

export default PostFeedWrapper;
