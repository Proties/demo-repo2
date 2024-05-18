-- sql triggers
CREATE TRIGGER audit_user_changes
BEFORE
INSERT,DELETE UPDATE ON Users
FOR EACH ROW
BEGIN
check_age()
END;

-- sql stored procedures


-- sql procedures



