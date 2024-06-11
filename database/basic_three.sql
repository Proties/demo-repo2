CREATE TABLE Users(
	userID INT AUTO_INCREMENT,
	email varchar(52) UNIQUE,
	name varchar(52),
	username varchar(15),
	password varchar(30),
	primary key (userID)
);
CREATE TABLE Posts(
	postID INT AUTO_INCREMENT,
	postDate date,
	postTime time,
	userID int,
	primary key (postID),
	foreign key (userID) references (userID)Users
);
CREATE TABLE Images(

	imageID int AUTO_INCREMENT,
	image_type varchar(10),
	image_size int,
	image_width int,
	image_height int,
	created_at time,
	updated_at time,
	filepath varchar(15),
	filename varchar(19),
	primary key (imageID),
	foreign key (postID) references (postID)Posts
);
CREATE TABLE Collaborators(
	userID INT,

);
CREATE TABLE ServedPost(
	postID,
	userID,
	foreign key (postID) references (postID)Posts
	foreign key (userID) references (userID)Users

);
CREATE TABLE ViewedPost(
	postID,
	userID,
	foreign key (postID) references (postID)Posts
	foreign key (userID) references (userID)Users

);
CREATE TABLE Comments(
	commentID INT,
	commentDate date,
	commentTime time,
	commentTxt,
	postID,
	userID,
	primary key(commentID),
	foreign key (postID) references (postID)Posts
	foreign key (userID) references (userID)Users


);
CREATE TABLE Likes(
	likeID,
	likeDate,
	likeTime,
	postID,
	userID,

);
CREATE TABLE Category(
	categoryID int AUTO_INCREMENT,
	categoryName varchar(15) UNIQUE,
	dateAdded date,
	timeAdded time,
	primary key(categoryID)
);
CREATE TABLE PostCategory(
	categoryID,
	postID,
	foreign key (postID) references (postID)Posts
	foreign key (categoryID) references (categoryID)Category

);