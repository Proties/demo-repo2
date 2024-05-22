USE u203973307_wholedata;
CREATE TABLE IF NOT EXISTS post(
    postID INT AUTO_INCREMENT,
    postLinkID VARCHAR(20),
    postDescription text,
    postTitle varchar(15),
    picture BLOB NOT NULL,
    userID INT,
    postDate DATE NOT NULL,
    postTime TIME NOT NULL,
    postLink VARCHAR(45),
    PRIMARY KEY (postID)
    
    
);

CREATE TABLE IF NOT EXISTS category(
    categoryID INT AUTO_INCREMENT,
    categoryName VARCHAR(255),
    PRIMARY KEY (categoryID)
);

CREATE TABLE IF NOT EXISTS post_category(
    categoryID INT,
    postID INT

);

CREATE TABLE IF NOT EXISTS likes(
    likeID int AUTO_INCREMENT,
    postID INT NOT NULL,
    userID INT NOT NULL,
    PRIMARY key (likeID)
);

CREATE TABLE IF NOT EXISTS comment(
    commentID INT AUTO_INCREMENT NOT NULL,
    postID INT NOT NULL,
    userID INT NOT NULL,
    commentText TEXT NOT NULL,
    commentDate DATE NOT NULL,
    commentTime TIME NOT NULL,
    PRIMARY KEY (commentID)
   
);

CREATE TABLE IF NOT EXISTS views(
    viewID INT NOT NULL AUTO_INCREMENT,
    postID INT NOT NULL,
    userID INT NOT NULL,
    dateViewed DATE NOT NULL,
    timeViewed TIME NOT NULL,
    PRIMARY KEY (viewID)
);

CREATE TABLE IF NOT EXISTS Users(
    userID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    fullname varchar(244) NOT NULL,
    email VARCHAR(255) UNIQUE,
    profilePicture BLOB,
    phone VARCHAR(12) UNIQUE,
    userPassword VARCHAR(255) ,
    dateMade date NOT NULL,
    timeMade time NOT NULL,
    PRIMARY KEY (userID)
);