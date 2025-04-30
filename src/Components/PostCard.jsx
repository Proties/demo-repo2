import React from "react";
import { Heart, MessageCircle } from "lucide-react";
import "../css/PostCard.css";

const PostCard = ({ post }) => {
  const { user, time, mediaUrl, caption, avatarUrl } = post;

  return (
    <div className="postcard">
      <div className="postcard-header">
        <img src={avatarUrl} alt={`${user}'s avatar`} className="avatar" />
        <div>
          <p className="username">{user}</p>
          <p className="timestamp">{time}</p>
        </div>
      </div>

      <div className="postcard-media">
        {mediaUrl.endsWith(".mp4") ? (
          <video src={mediaUrl} controls className="media" />
        ) : (
          <img src={mediaUrl} alt="post media" className="media" />
        )}
      </div>

      <p className="caption">{caption}</p>

      <div className="postcard-actions">
        <button className="icon-button">
          <Heart size={20} />
        </button>
        <button className="icon-button">
          <MessageCircle size={20} />
        </button>
      </div>
    </div>
  );
};

export default PostCard;
