CREATE PROCEDURE new_user @username nvarchar(30),@userID int,@dateMade date,@timeMade time,@password nvarchar(20),@name varchar(25)
AS
BEGIN
	INSERT INTO Users
	VALUES(@username,@userID,@dateMade,@timeMade,@password)

END


CREATE PROCEDURE get_users
AS
BEGIN
	SELECT DISTINCT u1.username,p1.postLink,p1.postID,p1.postLinkID,p1.postLinkID as post2LinkID,p2.postLink AS post2Link,p2.postID AS post2ID FROM Users AS u1
    INNER JOIN post AS p1 ON u1.userID=p1.userID
    INNER JOIN post AS p2 ON p1.userID=u1.userID
    WHERE p1.postID<>p2.postID
    AND p1.previewStatus=1 AND p2.previewStatus=1
    GROUP BY (u1.username);
END



BEGIN TRANSACTION;
    INSERT INTO Posts
    VALUES(:postLinkID,:caption,:userID,:pdate,:ptime,:postLink,:location,:preview,:status)

    INSERT INTO Images
    VALUES(:typ,:size,:width,:height,:made,:updat,:fname,:fpath)

    INSERT INTO ImagePost
    VALUES(:postID,:imageID)

    INSERT INTO Category
    VALUES(:categoryName,:catDate,:catTime,:vw)

    INSERT INTO CategoryPost
    VALUES(:catID,:post)

    INSERT INTO Collaborator
    VALUES(:dateAdded)

    INSERT INTO CollaboratorPost
    VALUES(:postID,:collaboratorID)
COMMIT;

ROLLBACK;





