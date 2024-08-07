DROP TABLE IF EXISTS Users;
CREATE TABLE Users(
 userID INT AUTO_INCREMENT,
 email varchar(254) UNIQUE,
 name varchar(52),
 username varchar(20) UNIQUE,
 password varchar(30),
 primary key (userID)
);

DROP TABLE IF EXISTS Posts;
CREATE TABLE Posts(
 postID INT AUTO_INCREMENT,
 postDate date,
 postTime time,
 postLink varchar(50),
 postLinkId varchar(20),
 userID int,
 caption text,
 postLocation text,
 previewStatus boolean,
 postStatus varchar(10),
 primary key (postID),
 foreign key (userID) references Users(userID)
);
DROP TABLE IF EXISTS Collaborators;
CREATE TABLE Collaborators(
 collaboratorID int,
 postID int,
 userID int,
 dateMade date,
 timeMade time,
 primary key (collaboratorID),
 foreign key (userID) references Users(userID),
 foreign key (postID) references Posts(postID)
);
DROP TABLE IF EXISTS Images;
CREATE TABLE Images(
 imageID int AUTO_INCREMENT,
 image_type varchar(10),
 image_size int,
 image_width int,
 image_height int,
 created_at time,
 updated_at time,
 filepath varchar(50),
 filename varchar(50),
 primary key (imageID)
);
DROP TABLE IF EXISTS PostImages;
CREATE TABLE PostImages(
 postID int,
 imageID int,
 foreign key (postID) references Posts(postID),
 foreign key (imageID) references Images(imageID)
);
DROP TABLE IF EXISTS ServedPost;
CREATE TABLE ServedPost(
 postID int,
 userID int,
 foreign key (postID) references Posts(postID),
 foreign key (userID) references Users(userID)
);
DROP TABLE IF EXISTS ViewedPost;
CREATE TABLE ViewedPost(
 postID int,
 userID int,
 foreign key (postID) references Posts(postID),
 foreign key (userID) references Users(userID)
);
DROP TABLE IF EXISTS Comments;
CREATE TABLE Comments(
 commentID INT AUTO_INCREMENT,
 commentDate date,
 commentTime time,
 commentTxt text,
 postID int,
 userID int,
 primary key(commentID),
 foreign key (postID) references Posts(postID),
 foreign key (userID) references Users(userID)
);
DROP TABLE IF EXISTS Likes;
CREATE TABLE Likes(
 likeID int AUTO_INCREMENT,
 likeDate date,
 likeTime time,
 postID int,
 userID int ,
 primary key (likeID),
 foreign key (postID) references Posts(postID),
 foreign key (userID) references Users(userID)
);
DROP TABLE IF EXISTS Category;
CREATE TABLE Category(
 categoryID int AUTO_INCREMENT,
 categoryName varchar(15) UNIQUE,
 dateAdded date,
 timeAdded time,
 viewCount int,
 primary key(categoryID)
);
DROP TABLE IF EXISTS PostCategory;
CREATE TABLE PostCategory(
 categoryID int,
 postID int,
 foreign key (postID) references Posts(postID),
 foreign key (categoryID) references Category(categoryID)
);
CREATE TABLE Location(
 locationID int,
 country varchar(40),
 region varchar(50),
 province varchar(40),
 street varchar(50),
 zipCode varchar(10),
 primary key (locationID)
);
CREATE TABLE PostLocation(
 locationID int,
 postID int,
 foreign key (locationID) references (locationID)Location,
 foreign key (postID) references (postID)Posts
);