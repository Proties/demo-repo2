CREATE TABLE Users(
	userID INT AUTO_INCREMENT,
	email varchar(254) UNIQUE,
	name varchar(52),
	username varchar(20) UNIQUE,
	password varchar(30),
	primary key (userID)
);
CREATE TABLE Posts(
	postID INT AUTO_INCREMENT,
	postDate date,
	postTime time,
	userID int,
	caption text,
	postLocation text,
	previewStatus boolean,
	postStatus varchar(10),
	primary key (postID),
	foreign key (userID) references (userID)Users
);
CREATE TABLE Collaborators(
	collaboratorID INT,
	postID INT,
	primary key (collaboratorID),
	foreign key (userID) references (userID)Users

);
CREATE TABLE CollaboratorsUsers(
	collaboratorID int,
	userID int,
	dateMade date,
	timeMade time,
	status varchar(10),
	primary key (collaboratorID),
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
	filepath varchar(50),
	filename varchar(50),
	primary key (imageID)
);
CREATE TABLE PostImages(
	postID int,
	imageID int,
	foreign key (postID) references Posts(postID),
	foreign key (imageID) references Images(imageID)
)
CREATE TABLE ServedPost(
	postID int,
	userID int,
	foreign key (postID) references (postID)Posts,
	foreign key (userID) references (userID)Users

);
CREATE TABLE ViewedPost(
	postID int,
	userID int,
	foreign key (postID) references (postID)Posts,
	foreign key (userID) references (userID)Users

);
CREATE TABLE Comments(
	commentID INT AUTO_INCREMENT,
	commentDate date,
	commentTime time,
	commentTxt text,
	postID int,
	userID int,
	primary key(commentID),
	foreign key (postID) references (postID)Posts,
	foreign key (userID) references (userID)Users


);
CREATE TABLE Likes(
	likeID int AUTO_INCREMENT,
	likeDate date,
	likeTime time,
	postID int,
	userID int ,
	primary key (likeID),
	foreign key (postID) references (postID)Posts,
	foreign key (userID) references (userID)Users

);
CREATE TABLE Category(
	categoryID int AUTO_INCREMENT,
	categoryName varchar(15) UNIQUE,
	dateAdded date,
	timeAdded time,
	viewCount int,
	primary key(categoryID)
);
CREATE TABLE PostCategory(
	categoryID int,
	postID int,
	foreign key (postID) references (postID)Posts,
	foreign key (categoryID) references (categoryID)Category

);
CREATE INDEX id_username
ON Users (username);

CREATE INDEX id_email
ON Users (email);

CREATE INDEX cat_categoryName
ON Category (categoryName);

