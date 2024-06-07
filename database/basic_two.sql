
-- groups post randommly aslong ass the post ids are differnet
DROP VIEW IF EXISTS post_user_two;

CREATE VIEW IF NOT EXISTS post_user_two AS
SELECT u1.username,DISTINCT p1.postID,p1.picture,p1.postTitle,p2.postID as post2,p2.picture as pic2,p2.postTitle as tilte2 FROM post p1
INNER JOIN post p2 ON p1.userID=p2.userID AND p1.postID<>p2.postID
INNER JOIN Users u1 ON p1.userID=u1.userID
WHERE  (SELECT count(postID) FROM post WHERE userID=u1.userID)>1;

SELECT DISTINCT postID,username FROM post_user_two;


-- this sql command get 2 post per user and assign them in a single row
-- a user must have more then one post to be listed

-- groups post by the same category name

INNER JOIN post_category pc On p1.postID=pc.postID
INNER JOIN category c On pc.categoryID=pc.categoryID
WHERE c.categoryName=:cat
